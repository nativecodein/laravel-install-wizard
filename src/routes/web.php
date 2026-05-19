<?php

use Illuminate\Support\Facades\Route;
use Nativecodein\LaravelInstallWizard\Http\Controllers\InstallController;
use Nativecodein\LaravelInstallWizard\Http\Controllers\LocaleController;

$prefix     = config('installwizard.route_prefix', 'install');
$middleware = array_merge((array) config('installwizard.route_middleware', ['web']), ['installer.locale']);

Route::group([
    'prefix'     => $prefix,
    'middleware' => $middleware,
    'as'         => 'installwizard.',
], function () {

    Route::get('/', [InstallController::class, 'index'])->name('index');

    Route::get('/welcome',        [InstallController::class, 'welcome'])->name('welcome');
    Route::post('/welcome',       [InstallController::class, 'storeWelcome'])->name('welcome.store');

    Route::get('/environment',    [InstallController::class, 'environment'])->name('environment');
    Route::post('/environment',   [InstallController::class, 'storeEnvironment'])->name('environment.store');

    Route::get('/database',       [InstallController::class, 'database'])->name('database');
    Route::post('/database',      [InstallController::class, 'storeDatabase'])->name('database.store');
    Route::post('/database/test', [InstallController::class, 'testDatabase'])->name('database.test');

    Route::get('/requirements',   [InstallController::class, 'requirements'])->name('requirements');

    Route::get('/permissions',    [InstallController::class, 'permissions'])->name('permissions');

    Route::get('/finish',         [InstallController::class, 'finish'])->name('finish');
    Route::post('/finish',        [InstallController::class, 'runInstall'])->name('finish.run');

    Route::get('/complete',       [InstallController::class, 'complete'])->name('complete');

    Route::post('/locale',        [LocaleController::class, 'update'])->name('locale.update');
});
