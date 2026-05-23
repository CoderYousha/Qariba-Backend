<?php

use App\Http\Controllers\AboutusController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectImageController;
use App\Http\Controllers\ProjectVideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::post('/login', 'login');
    Route::middleware('check-auth')->group(function () {
        Route::prefix('profile')->group(function () {
            Route::get('/', 'profile');
            Route::post('/', 'updateProfile');
        });
        Route::post('/update-password', 'updatePassword');
        Route::post('/logout', 'logout');
    });
});

Route::controller(BannerController::class)->prefix('banners')->group(function () {
    Route::get('/', 'view');
    Route::get('/{banner}', 'show');
    Route::middleware('check-admin')->group(function () {
        Route::post('/', 'store');
        Route::post('/{banner}', 'update');
        Route::delete('/{banner}', 'destroy');
    });
});

Route::controller(ClientController::class)->prefix('clients')->group(function () {
    Route::get('/', 'view');
    Route::get('/{client}', 'show');
    Route::middleware('check-admin')->group(function () {
        Route::post('/', 'store');
        Route::post('/{client}', 'update');
        Route::delete('/{client}', 'destroy');
    });
});

Route::controller(AboutusController::class)->prefix('aboutus')->group(function () {
    Route::get('/', 'show');
    Route::middleware('check-admin')->group(function () {
        Route::post('/', 'setAboutus');
    });
});

Route::controller(ContactController::class)->prefix('contacts')->group(function () {
    Route::get('/', 'show');
    Route::middleware('check-admin')->group(function () {
        Route::post('/', 'setContacts');
    });
});

Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('/', 'view');
    Route::get('/{category}', 'show');
    Route::middleware('check-admin')->group(function (){
        Route::post('/', 'store');
        Route::post('/{category}', 'update');
        Route::delete('/{category}', 'destroy');
    });
});

Route::controller(ProjectController::class)->prefix('projects')->group(function () {
    Route::get('/', 'view');
    Route::get('/{project}', 'show');
    Route::middleware('check-admin')->group(function (){
        Route::post('/', 'store');
        Route::post('/{project}', 'update');
        Route::delete('/{project}', 'destroy');
    });
});

Route::controller(ProjectImageController::class)->middleware('check-admin')->prefix('project-images')->group(function () {
        Route::post('/', 'store');
        Route::post('/{projectImage}', 'update');
        Route::delete('/{projectImage}', 'destroy');
});

Route::controller(ProjectVideoController::class)->middleware('check-admin')->prefix('project-videos')->group(function () {
        Route::post('/', 'store');
        Route::delete('/{projectVideo}', 'destroy');
});