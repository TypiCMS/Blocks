<?php
Route::bind('blocks', function ($value) {
    return TypiCMS\Modules\Blocks\Models\Block::where('id', $value)
        ->with('translations')
        ->firstOrFail();
});

Route::group(
    array(
        'namespace' => 'TypiCMS\Modules\Blocks\Http\Controllers',
        'prefix'    => 'admin',
    ),
    function () {
        Route::resource('blocks', 'AdminController');
    }
);

Route::group(['prefix'=>'api'], function() {
    Route::resource('blocks', 'ApiController');
});
