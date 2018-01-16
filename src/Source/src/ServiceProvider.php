<?php

namespace {{ NAMESPACE }};

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class {{ UCNAME }}ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        // $router->aliasMiddleware('{{ NAME }}', \{{ NAMESPACE }}\Http\Middleware\{{ UCNAME }}Middleware::class);

        $this->publishes([
            __DIR__.'/publishable/config/{{ NAME }}.php' => config_path('{{ NAME }}.php'),
        ], '{{ NAME }}_config');

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/publishable/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', '{{ NAME }}');

        $this->publishes([
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/{{ NAME }}'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/resources/views', '{{ NAME }}');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/{{ NAME }}'),
        ]);

        $this->publishes([
            __DIR__ . '/resources/assets' => public_path('vendor/{{ NAME }}'),
        ], '{{ NAME }}_assets');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \{{ NAMESPACE }}\Commands\{{ UCNAME }}Command::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/publishable/config/{{ NAME }}.php', '{{ NAME }}'
        );
    }
}
