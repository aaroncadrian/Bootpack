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
        $this->bootLoadings();

        // $this->router = $router;
        // $this->bootMiddleware();

        // $this->bootPublications();

        // $this->bootCommands();

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../publishable/config/{{ NAME }}.php', '{{ NAME }}'
        );
    }

    protected function bootLoadings()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/../publishable/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', '{{ NAME }}');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', '{{ NAME }}');
    }

    protected function bootCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \{{ NAMESPACE }}\Commands\{{ UCNAME }}Command::class,
            ]);
        }
    }

    protected function bootMiddleware()
    {
        $this->router->aliasMiddleware('{{ NAME }}', \{{ NAMESPACE }}\Http\Middleware\{{ UCNAME }}Middleware::class);
    }

    protected function bootPublications()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/{{ NAME }}'),
        ]);

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('vendor/{{ NAME }}'),
        ], '{{ NAME }}_assets');

        $this->publishes([
            __DIR__.'/../publishable/config/{{ NAME }}.php' => config_path('{{ NAME }}.php'),
        ], '{{ NAME }}_config');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/{{ NAME }}'),
        ]);
    }
}
