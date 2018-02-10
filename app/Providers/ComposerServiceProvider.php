<?php

namespace App\Providers;

use App\Http\ViewComposers\AgencyListComposer;
use App\Http\ViewComposers\BatchListComposer;
use App\Http\ViewComposers\BusinessLogTotalComposer;
use App\Http\ViewComposers\BusinessProfileComposer;
use App\Http\ViewComposers\LastCustomerActiveComposer;
use App\Http\ViewComposers\LastDownloadComposer;
use App\Http\ViewComposers\ListCityComposer;
use App\Http\ViewComposers\ListCodeComposer;
use App\Http\ViewComposers\ListProductComposer;
use App\Http\ViewComposers\LocalActivatedComposer;
use App\Http\ViewComposers\ProductListComposer;
use App\Http\ViewComposers\TopAgencyActivatedComposer;
use App\Http\ViewComposers\TopProductActivatedComposer;
use App\Http\ViewComposers\TotalCountAgencyComposer;
use App\Http\ViewComposers\TotalCountBatchComposer;
use App\Http\ViewComposers\TotalCountCodeComposer;
use App\Http\ViewComposers\TotalCountProductComposer;
use App\Http\ViewComposers\TotalDownloadComposer;
use App\Http\ViewComposers\TutorialUpdateBusinessComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['layout', 'business.information'],
            BusinessProfileComposer::class
        );

        View::composer(
            ['product.list'],
            ProductListComposer::class
        );

        View::composer(
            ['agency.list'],
            AgencyListComposer::class
        );

        View::composer(
            ['agency.list', 'agency.edit'],
            ListCityComposer::class
        );

        View::composer(
            ['code.list'],
            ListCodeComposer::class
        );

        View::composer(
            ['batch.list'],
            BatchListComposer::class
        );

        View::composer(
            ['components.card-business-log-total'],
            BusinessLogTotalComposer::class
        );

        View::composer(
            ['components.card-top-product-acitvated'],
            TopProductActivatedComposer::class
        );

        View::composer(
            ['components.card-top-agency-activated'],
            TopAgencyActivatedComposer::class
        );

        View::composer(
            ['components.card-last-download'],
            LastDownloadComposer::class
        );

        View::composer(
            ['components.card-local-activated'],
            LocalActivatedComposer::class
        );

        View::composer(
            ['components.dialog-tutorial-update-business-information'],
            TutorialUpdateBusinessComposer::class
        );

        View::composer(
            [
                'components.dialog-update-product-for-batch',
                'components.dialog-update-product-for-code'
            ],
            ListProductComposer::class
        );

        View::composer(
            ['components.card-total-code'],
            TotalCountCodeComposer::class
        );

        View::composer(
            ['components.card-total-batch'],
            TotalCountBatchComposer::class
        );

        View::composer(
            ['components.card-total-download'],
            TotalDownloadComposer::class
        );

        View::composer(
            ['components.card-total-product'],
            TotalCountProductComposer::class
        );

        View::composer(
            ['components.card-total-agency'],
            TotalCountAgencyComposer::class
        );

        View::composer(
            ['guarantee.index'],
            LastCustomerActiveComposer::class
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
