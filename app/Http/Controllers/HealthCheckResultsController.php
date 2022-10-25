<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;
use Spatie\Health\Commands\RunHealthChecksCommand;
use Spatie\Health\Health;
use Artesaos\SEOTools\Facades\SEOMeta;
use Spatie\Health\ResultStores\ResultStore;

class HealthCheckResultsController
{
    public function __invoke(Request $request, ResultStore $resultStore, Health $health): JsonResponse|View
    {
        SEOMeta::setTitle('Health | Admin');

        if ($request->has('fresh')) {
            Artisan::call(RunHealthChecksCommand::class);
        }

        $checkResults = $resultStore->latestResults();

        return view('admin.health.health', [
            'lastRanAt' => new Carbon($checkResults?->finishedAt),
            'checkResults' => $checkResults,
            'assets' => $health->assets(),
            'theme' => config('health.theme'),
        ]);
    }
}
