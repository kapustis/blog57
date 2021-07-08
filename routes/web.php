<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::redirect('/', '/blog', 301);

Route::get('lang/{lang}', [\App\Http\Controllers\LocaleController::class, 'change'])->name('locale.change');
/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
includeRouteFiles(__DIR__.'/frontend/');
/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
includeRouteFiles(__DIR__.'/backend/');




