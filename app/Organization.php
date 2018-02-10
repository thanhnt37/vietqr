<?php

namespace App;

use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;
use Illuminate\Database\Eloquent\Model;
use File;
use Illuminate\Support\Facades\Storage;

class Organization extends Model
{
    protected $guarded = [];

    public function getDisplayName()
    {
        return $this->name;
    }

    public function getLogoUrl()
    {
        $url = asset('images/avatar-default.png');

        if ($this->hasLogo()) {
            $url = $this->logo;
        }

        return $url;
    }

    public function hasLogo()
    {
        return $this->logo != null && $this->logo != '';
    }

    public function generateQrcode()
    {
        $renderer = new Png();
        $renderer->setMargin(1);
        $renderer->setHeight(480);
        $renderer->setWidth(480);
        $writer = new Writer($renderer);

        if (! File::isDirectory("businesses/{$this->id}")) {
            Storage::makeDirectory("businesses/{$this->id}", 0777, true, true);
        }

        $path = storage_path("app/businesses/{$this->id}/qrinformation.png");
        $writer->writeFile(config('code.url_prefix')."D1{$this->id}", $path);

        return $path;
    }

    public function getQrPath()
    {
        return storage_path("app/businesses/{$this->id}/qrinformation.png");
    }
}
