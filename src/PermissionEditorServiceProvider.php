<?php



namespace TheMrJeff\Start;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PermissionEditorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load the package views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'yourpackage');

        // Publish the individual view files
        $this->publishes([
            __DIR__ . '/../resources/views/home.blade.php' => resource_path('views/home.blade.php'),
        ], 'views');

        // Publish the JS file
        $this->publishes([
            __DIR__ . '/../resources/js/app.js' => resource_path('js/app.js'),
        ], 'js');

        // Publish the additional layout files
        $this->publishes([
            __DIR__ . '/../resources/layouts/app.blade.php' => resource_path('views/layouts/app.blade.php'),
            __DIR__ . '/../resources/layouts/navigation.blade.php' => resource_path('views/layouts/navigation.blade.php'),
        ], 'layouts');

        // Publish the routes/web.php file
        $this->publishes([
            __DIR__ . '/../routes/web.php' => base_path('routes/web.php'),
        ], 'routes');

        // Remove welcome.blade.php if it exists
        $welcomeFile = resource_path('views/welcome.blade.php');
        if (File::exists($welcomeFile)) {
            File::delete($welcomeFile);
            Log::info('welcome.blade.php has been removed.');
        }

        // Run npm install htmx.org (Make sure npm is installed and available)

        $this->installHTMX();
    }

    protected function installHTMX()
    {
        // Check if npm is installed (works for both Unix and Windows environments)
        $npmExists = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'
            ? shell_exec('where npm')  // Windows check
            : shell_exec('which npm'); // Unix-based check

        if (empty($npmExists)) {
            Log::error('npm is not installed.');
            return;
        }

        // Run the npm install command for HTMX directly
        $output = shell_exec('npm install htmx.org');
        Log::info('HTMX installation output: ' . $output);
    }
}
