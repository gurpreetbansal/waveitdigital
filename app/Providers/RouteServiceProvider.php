<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

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
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
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
        /*Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));*/

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(function ($router) {
            require base_path('routes/web.php');
            /* add affiliate route */
            require base_path('routes/web/audit.php');
            require base_path('routes/web/searchConsole.php');
            require base_path('routes/web/googleAd.php');
            require base_path('routes/web/googleMyBusiness.php');
            require base_path('routes/web/pdfGenerate.php');
            require base_path('routes/web/test.php');
            require base_path('routes/web/social.php');
            require base_path('routes/web/ga4.php');
            require base_path('routes/web/email_templates.php');
            require base_path('routes/web/admin.php');
         });

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
