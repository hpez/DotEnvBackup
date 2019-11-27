<?php

namespace Hpez\DotEnvBackup;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class DotEnvBackupServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booted(function () {
            $schedule = app(Schedule::class);
            $schedule->call(function () {
                $basePath = config('dotenvbackup.backup_dir');
                $files = glob($basePath."/.env.backup*");
                $files = array_combine($files, array_map("filemtime", $files));
                arsort($files);

                $currentEnv = base_path()."/.env";

                $lastFileName = key($files);
                if ($lastFileName) {
                    $tempFile = @tempnam('/temp', 'dotenv');
                    xdiff_file_diff($currentEnv, $lastFileName, $tempFile);
                    $contents = file_get_contents($tempFile);
                } else {
                    $contents = ' ';
                }

                if (strlen($contents))
                    copy($currentEnv, $basePath."/.env.backup-".now()->format('Y-m-d-H-i-s'));
            })->cron(config('dotenvbackup.backup_interval'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/dotenvbackup.php' => config_path('dotenvbackup.php')
        ], 'config');
    }
}
