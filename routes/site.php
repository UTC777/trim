<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCommentController;



Auth::routes();

Route::resource('blog', BlogController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
Route::post('blog/{postId}/comments', [BlogCommentController::class, 'store'])->name('blog.comments.store');

Route::resource('faqs', 'FaqController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
Route::resource('success-stories', 'SuccessStoriesController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

Route::get('/{pagepath?}/{pageslug?}/{pagepath2?}/{pagepath3?}/{pagepath4?}', 'PagesController@show')->name('page.show');
Route::get('contact', 'SiteController@contact')->name('contact');






