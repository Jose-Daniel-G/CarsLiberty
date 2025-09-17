<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Config;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ConfigServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }


    public function boot(): void
    {
        try {
            if (DB::connection()->getDatabaseName() && Schema::hasTable('configs')) {
                $config = Cache::rememberForever('site_config', function () {
                    return Config::first();
                });

                if ($config) {
                    config([
                        'adminlte.logo' => '<b>' . $config->site_name . '</b>LTE',
                        'adminlte.logo_img' => $config->logo,
                        'adminlte.logo_img_class' => 'brand-image img-circle elevation-3',
                        'adminlte.logo_img_alt' => $config->site_name,
                        'adminlte.auth_logo' => [
                            'enabled' => true,
                            'img' => [
                                'path'  => $config->logo,
                                'alt'   => $config->site_name,
                                'class' => 'brand-image img-circle elevation-3',
                                'width' => 70,
                                'height' => 70,
                            ],
                        ],
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Ignorar errores si la BD aún no existe
        }
    }
}
