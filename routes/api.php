<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenController;

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

Route::controller(OpenController::class)->group(function () {
    Route::any('ModularTestSecurity', 'ModularTestSecurity')->name(
        'ModularTestSecurity'
    );

    Route::any('PracticalTestSecurity', 'PracticalTestSecurity')->name(
        'PracticalTestSecurity'
    );

    Route::any('PretestSecurity', 'PretestSecurity')->name('PretestSecurity');

    Route::any('PostTestSecurity', 'PostTestSecurity')->name(
        'PostTestSecurity'
    );
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});