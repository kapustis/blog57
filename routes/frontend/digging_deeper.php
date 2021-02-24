<?php

Route::group(['prefix' => 'digging_deeper'], function () {
    Route::get('collection', [App\Http\Controllers\DiggingDeeperController::class, 'collection'])
        ->name('digging_deeper.collection');
    Route::get('process-video', [App\Http\Controllers\DiggingDeeperController::class, 'processVideo'])
        ->name('digging_deeper.process-video');
    Route::get('prepare-catalog', [App\Http\Controllers\DiggingDeeperController::class, 'prepareCatalog'])
        ->name('digging_deeper.prepare-catalog');
});
