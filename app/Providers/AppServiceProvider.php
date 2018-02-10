<?php

namespace App\Providers;

use App\Batch;
use App\ExportCode;
use App\GuaranteeActive;
use App\GuaranteeService;
use App\Observers\BatchObserver;
use App\Observers\ExportCodeObserver;
use App\Observers\GuaranteeActiveObserver;
use App\Observers\OrganizationObserver;
use App\Observers\ProductObserver;
use App\Observers\SmsObserver;
use App\Organization;
use App\Product;
use App\Sms;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'guarantee' => GuaranteeService::class,
        ]);

        $this->bootObserver();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function bootObserver()
    {
        Batch::observe(BatchObserver::class);
        ExportCode::observe(ExportCodeObserver::class);
        Product::observe(ProductObserver::class);
        GuaranteeActive::observe(GuaranteeActiveObserver::class);
        Sms::observe(SmsObserver::class);
        Organization::observe(OrganizationObserver::class);
    }
}
