<?php

namespace TheMrJeff\Start;

use Illuminate\Support\ServiceProvider;
use TheMrJeff\Start\Console\Commands\InstallStartPackage;

class PermissionEditorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish views
        $this->publishes([
            __DIR__ . '/../resources/views/home.blade.php' => resource_path('views/home.blade.php'),
        ], 'views');

        // Publish JS
        $this->publishes([
            __DIR__ . '/../resources/js/app.js' => resource_path('js/app.js'),
        ], 'js');

        // Publish layouts
        $this->publishes([
            __DIR__ . '/../resources/layouts/app.blade.php' => resource_path('views/layouts/app.blade.php'),
            __DIR__ . '/../resources/layouts/navigation.blade.php' => resource_path('views/layouts/navigation.blade.php'),
        ], 'layouts');

        // Publish routes
        $this->publishes([
            __DIR__ . '/../routes/web.php' => base_path('routes/web.php'),
        ], 'routes');

        // Register the custom command
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallStartPackage::class,
            ]);
        }
    }
}
