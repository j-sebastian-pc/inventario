<?php
namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * El espacio de nombres para los controladores.
     *
     * @var string
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * La ruta a la ruta "home" para tu aplicación.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define tus límites de tasa de rutas.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
    
        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));
    
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configura los límites de tasa para la aplicación.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}