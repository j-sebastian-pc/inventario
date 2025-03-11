<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * El espacio de nombres para las rutas del controlador.
     *
     * @var string
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Registrar cualquier servicio de la aplicación.
     */
    public function register(): void
    {
        //
    }

    /**
     * Arrancar cualquier servicio de la aplicación.
     */
    public function boot(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}