<?php

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Termwind\Components\Raw;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/organization', function () {
    $profiles = [];

    $profiles_query = Profile::select('id','name', 'slug')
        ->with('media')
        ->get();

    foreach ($profiles_query as $profile) {
        $profiles[] = [
            'id' => $profile->id,
            'name' => $profile->name,
            'slug' => $profile->slug,
            'src' => $profile->getImage(),
        ];
    }

    return $profiles;
})->name('api.organization');
