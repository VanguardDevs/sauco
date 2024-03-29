<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Models\Application;
use App\Models\Fine;
use App\Models\Affidavit;
use App\Models\Ordinance;
use App\Models\Payment;
use App\Models\License;
use App\Models\Taxpayer;
use App\Models\Year;
use App\Models\EconomicActivity;
use App\Models\Community;
use App\Models\Settlement;
use App\Models\Liquidation;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::model('application', Application::class);
        Route::model('fine', Fine::class);
        Route::model('payment', Payment::class);
        Route::model('community', Community::class);
        Route::model('taxpayer', Taxpayer::class);
        Route::model('license', License::class);
        Route::model('activity', EconomicActivity::class);
        Route::model('year', Year::class);
        Route::model('ordinance', Ordinance::class);
        Route::model('affidavit', Affidavit::class);
        Route::model('settlement', Settlement::class);
        Route::model('liquidation', Liquidation::class);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
