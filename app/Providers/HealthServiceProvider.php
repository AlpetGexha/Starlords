<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\CommonMark\Environment\Environment;
use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\FlareErrorOccurrenceCountCheck;
use Spatie\Health\Checks\Checks\PingCheck;
use Spatie\Health\Checks\Checks\RedisCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\SecurityAdvisoriesHealthCheck\SecurityAdvisoriesCheck;


class HealthServiceProvider extends ServiceProvider
{
    public function register()
    {
        Health::checks([
            PingCheck::new()->url(env('APP_URL')),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            DatabaseCheck::new(),
            DatabaseConnectionCountCheck::new()
            ->warnWhenMoreConnectionsThan(50)
            ->failWhenMoreConnectionsThan(100),
            ScheduleCheck::new()->heartbeatMaxAgeInMinutes(2),
            // RedisCheck::new(),
            UsedDiskSpaceCheck::new()
                ->warnWhenUsedSpaceIsAbovePercentage(70)
                ->failWhenUsedSpaceIsAbovePercentage(90),
            // CpuLoadCheck::new()
            //     ->failWhenLoadIsHigherInTheLast5Minutes(2.0)
            //     ->failWhenLoadIsHigherInTheLast15Minutes(1.5),

            FlareErrorOccurrenceCountCheck::new()
                ->warnWhenMoreErrorsReceivedThan(20)
                ->failWhenMoreErrorsReceivedThan(50),
            // SecurityAdvisoriesCheck::new()->ignorePackages([
            //     'spatie/laravel-backup',
            //     'spatie/laravel-medialibrary',
            // ]),
        ]);
    }
}
