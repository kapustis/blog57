<?php

use Illuminate\Support\Facades\Route;


    Route::get('/', function () {
        return view('welcome');
    });

    includeRouteFiles(__DIR__.'/backend/');
    includeRouteFiles(__DIR__.'/frontend/');




