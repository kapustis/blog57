<?php

use Illuminate\Support\Facades\Route;


Route::redirect('/', '/blog', 301);

Route::get('lang/{lang}', [\App\Http\Controllers\LocaleController::class, 'change'])->name('locale.change');
includeRouteFiles(__DIR__.'/frontend/');
includeRouteFiles(__DIR__.'/backend/');




