<?php

namespace TheMrJeff\Start;

use Illuminate\Support\ServiceProvider;
use TheMrJeff\Start\Console\Commands\InstallStartPackage;

class PermissionEditorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Other publishing logic...

        // Register the custom command
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallStartPackage::class,
            ]);
        }
    }
}
