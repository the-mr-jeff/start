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
        $this->publishViews();

        // Publish JS
        $this->publishJS();

        // Publish layouts
        $this->publishLayouts();

        // Publish routes
        $this->publishRoutes();

        // Install npm dependencies (HTMX)
        $this->installHTMX();

        $this->info('Start package installed successfully!');
    }

    protected function publishViews()
    {
        $this->info('Publishing views...');
        $this->call('vendor:publish', [
            '--provider' => 'TheMrJeff\Start\PermissionEditorServiceProvider',
            '--tag' => 'views',
            '--force' => true
        ]);
    }

    protected function publishJS()
    {
        $this->info('Publishing JS...');
        $this->call('vendor:publish', [
            '--provider' => 'TheMrJeff\Start\PermissionEditorServiceProvider',
            '--tag' => 'js',
            '--force' => true
        ]);
    }

    protected function publishLayouts()
    {
        $this->info('Publishing layouts...');
        $this->call('vendor:publish', [
            '--provider' => 'TheMrJeff\Start\PermissionEditorServiceProvider',
            '--tag' => 'layouts',
            '--force' => true
        ]);
    }

    protected function publishRoutes()
    {
        $this->info('Publishing routes...');
        $this->call('vendor:publish', [
            '--provider' => 'TheMrJeff\Start\PermissionEditorServiceProvider',
            '--tag' => 'routes',
            '--force' => true
        ]);
    }

    protected function installHTMX()
    {
        $this->info('Installing HTMX...');
        $output = shell_exec('npm install htmx.org');
        $this->info('HTMX installation output: ' . $output);
    }
}
