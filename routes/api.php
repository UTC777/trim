<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Static Seo
    Route::post('static-seos/media', 'StaticSeoApiController@storeMedia')->name('static-seos.storeMedia');
    Route::apiResource('static-seos', 'StaticSeoApiController');

    // Testimonial
    Route::post('testimonials/media', 'TestimonialApiController@storeMedia')->name('testimonials.storeMedia');
    Route::apiResource('testimonials', 'TestimonialApiController');

    Route::get('files', 'MediaApiController@files')->name('media.files');
    Route::apiResource('media', 'MediaApiController');

    // Page Section
    Route::apiResource('page-sections', 'PageSectionApiController');

    // Comment
    Route::apiResource('comments', 'CommentApiController');
});
