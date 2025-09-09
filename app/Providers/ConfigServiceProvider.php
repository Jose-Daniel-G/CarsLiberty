<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Config;
use Illuminate\Support\Facades\Cache;

class ConfigServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Verificar si la tabla 'configs' existe antes de intentar acceder a ella
        if (Schema::hasTable('configs')) {
            // Cargar la configuración desde la base de datos
            $config = Cache::rememberForever('site_config', function () {
                return Config::first();
            });


            // Verificar si existe la configuración y establecerla dinámicamente
            if ($config) {
                config([
                    'adminlte.logo' => '<b>' . $config->site_name . '</b>LTE',
                    'adminlte.logo_img' => 'storage/' . $config->logo,
                    'adminlte.logo_img_class' => 'brand-image img-circle elevation-3',
                    'adminlte.logo_img_alt' => $config->site_name,

                    // Login
                    'adminlte.auth_logo' => [
                        'enabled' => true,
                        'img' => [
                            'path'  => 'storage/' . $config->logo,   // dinámico
                            'alt'   => $config->site_name,
                            'class' => 'brand-image img-circle elevation-3', // 👈 clase aquí
                            'width' => 70,
                            'height' => 70,
                        ],
                    ],
                ]);
            }
        }
    }
}
