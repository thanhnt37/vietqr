<?php

namespace App\Jobs;

use App\Code;
use App\GuaranteeActive;
use App\Mt;
use App\Sms;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use function GuzzleHttp\Psr7\str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Str;

class SendMt implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sms;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Sms $sms)
    {
        $this->sms = $sms;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sms = $this->sms;
        $mtid = implode('', [
            $sms->partnerid,
            Carbon::now()->format('YmdHis'),
            random_int(10000, 99999)
        ]);
        $message = $this->getMessage($sms);
        $transdate = Carbon::now()->format('YmdHis');
        $checksum = md5(implode('', [
            $mtid,
            $sms->moid,
            $sms->shortcode,
            $sms->keyword,
            urlencode($message),
            $transdate,
            'c70f730e81f680ffbb28e74e439a7002'
        ]));

        $data = [
            'partnerid' => $sms->partnerid,
            'moid' => $sms->moid,
            'mtid' => $mtid,
            'userid' => $sms->userid,
            'shortcode' => $sms->shortcode,
            'keyword' => $sms->keyword,
            'content' => $message,
            'messagetype' => 1,
            'transdate' => $transdate,
            'checksum' => strtolower($checksum),
            'amount' => $sms->amount
        ];

        $mt = Mt::create(array_merge($data, [
            'sms_id' => $sms->id
        ]));

        $client =  new Client([
            'base_uri' => 'http://sms.megapayment.net.vn:9099/'
        ]);

        try {
            $response = (string) $client->get('smsApi?'.http_build_query($data))->getBody();

            $mt->update([
                'response' => $response
            ]);
        } catch (RequestException $exception) {
            $mt->update([
                'response' => (string) $exception->getResponse()->getBody()
            ]);
        }
    }

    protected function getMessage($sms)
    {
        $content = $sms->content;
        $content = preg_replace('/\s+/', ' ', trim($content));
        $scode = substr($content, 4);
        $codes = explode(' ', $scode);

        switch (strtolower($codes[0])) {
            case 'cg':
                $type = 'cg';
                $code = isset($codes[1]) ? $codes[1] : '';
                break;
            case 'bh':
                $type = 'bh';
                $code = isset($codes[1]) ? $codes[1] : '';
                break;
            default:
                $type = 'cg';
                $code = $codes[0];
                break;
        }

        if (empty($code)) {
            return 'Ma khong ton tai.';
        }

        $cid = sms_to_id($code);
        $code = Code::find($cid);

        if (! $code) {
            return 'Ma khong ton tai.';
        }

        $business = $code->business;

        if ($type = 'cg') {
            return 'San pham chinh hang. Duoc phan phoi boi cong ty '.Str::ascii($business->name).'. Lien he '.$business->phone. ' de biet them chi tiet.';
        }

        if ($code->active == 0) {
            return 'Ma chua duoc kich hoat. Lien he '.$business->phone.' de duoc ho tro.';
        }

        $gactive = $code->guaranteeActive;

        if (! $gactive) {
            return 'San pham chua duoc ban ra thi truong. Lien he '.$business->phone.' de duoc ho tro.';
        }

        if ($gactive->user_active == 1) {

            if ($gactive->phone == $sms->userid) {
                return 'Ban da kich hoat san pham vao ngay'.$gactive->getActiveDate().'. San pham duoc bao hanh toi ngay '.$gactive->getExpireDate();
            }

            return 'San pham da duoc kich hoat vao ngay '.$gactive->getExpireDate().' boi so dien thoai '.$gactive->phone;
        }

        $gactive->update([
            'phone' => $sms->userid,
            'user_active' => 1,
        ]);

        $product = $code->product;

        return 'Kich hoat thanh cong. San pham '.$product->name.' cua cong ty '.Str::ascii($business->name).'. Lien he '.$business->phone. ' de biet them chi tiet.';
    }
}
