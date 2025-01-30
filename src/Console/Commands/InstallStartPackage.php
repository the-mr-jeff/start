<?php

namespace TheMrJeff\Start\Console\Commands;

use Illuminate\Console\Command;

class InstallStartPackage extends Command
{
    protected $signature = 'start:install';
    protected $description = 'Install the Start package, including views, routes, and assets';

    public function handle()
    {
        $this->info('Starting installation of Start package...');

        // Publish views
        $this->call('vendor:publish', [
            '--provider' => 'TheMrJeff\Start\PermissionEditorServiceProvider',
            '--tag' => 'views',
            '--force' => true
        ]);

        // Publish JS
        $this->call('vendor:publish', [
            '--provider' => 'TheMrJeff\Start\PermissionEditorServiceProvider',
            '--tag' => 'js',
            '--force' => true
        ]);

        // Publish layouts
        $this->call('vendor:publish', [
            '--provider' => 'TheMrJeff\Start\PermissionEditorServiceProvider',
            '--tag' => 'layouts',
            '--force' => true
        ]);

        // Publish routes
        $this->call('vendor:publish', [
            '--provider' => 'TheMrJeff\Start\PermissionEditorServiceProvider',
            '--tag' => 'routes',
            '--force' => true
        ]);

        // Install npm dependencies (HTMX)
        $this->installHTMX();

        $this->info('Start package installed successfully!');
    }

    protected function installHTMX()
    {
        // Run npm install for HTMX
        $this->info('Installing HTMX...');
        $output = shell_exec('npm install htmx.org');
        $this->info('HTMX installation output: ' . $output);
    }
}
