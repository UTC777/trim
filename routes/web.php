<?php

use Illuminate\Http\Request;

Route::get('admin/dashboard', function () {
    if (session('status')) {
        return redirect()->route('admin.dashboard')->with('status', session('status'));
    }

    return redirect()->route('admin.dashboard');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('dashboard', 'HomeController@index')->name('dashboard');

    Route::get('/menu', 'MenuController@index')->name('menu.index');

    // Story Category
    Route::delete('story-categories/destroy', 'StoryCategoryController@massDestroy')->name('story-categories.massDestroy');
    Route::post('story-categories/media', 'StoryCategoryController@storeMedia')->name('story-categories.storeMedia');
    Route::post('story-categories/ckmedia', 'StoryCategoryController@storeCKEditorImages')->name('story-categories.storeCKEditorImages');
    Route::resource('story-categories', 'StoryCategoryController');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Tag
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::resource('product-tags', 'ProductTagController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');
    Route::post('GetPageContentSectionModalForm', 'ContentPageController@GetPageContentSectionModalForm');
    Route::post('AddPageContentSection', 'ContentPageController@AddPageContentSection');
    Route::post('ChangePageContentSectionOrder', 'ContentPageController@ChangePageContentSectionOrder');
    Route::post('GetPageSectionModalForm', 'ContentPageController@GetPageSectionModalForm');
    Route::post('AddPageSection', 'ContentPageController@AddPageSection');
    Route::post('ChangePageSectionOrder', 'ContentPageController@ChangePageSectionOrder');
    Route::post('AddExistingPageSection', 'ContentPageController@AddExistingPageSection');
    Route::post('clearAllExistingPageSection', 'ContentPageController@clearAllExistingPageSection');
    Route::post('getpreviewimage', 'ContentPageController@getpreviewimage');
    Route::post('removeMedia', 'ContentPageController@removeMedia');

    // Pagesection
    Route::delete('pagesections/destroy', 'PageSectionController@massDestroy')->name('pagesections.massDestroy');
    Route::post('pagesections/remove', 'PageSectionController@remove_section')->name('pagesections.remove_section');
    Route::post('pagesections/media', 'PageSectionController@storeMedia')->name('pagesections.storeMedia');
    Route::resource('pagesections', 'PageSectionController');

    // Content Section
    Route::delete('content-sections/destroy', 'ContentSectionController@massDestroy')->name('content-sections.massDestroy');
    Route::resource('content-sections', 'ContentSectionController');

    // Product Types
    Route::delete('product-types/destroy', 'ProductTypesController@massDestroy')->name('product-types.massDestroy');
    Route::post('product-types/media', 'ProductTypesController@storeMedia')->name('product-types.storeMedia');
    Route::post('product-types/ckmedia', 'ProductTypesController@storeCKEditorImages')->name('product-types.storeCKEditorImages');
    Route::resource('product-types', 'ProductTypesController');

    // Static Seo
    Route::delete('static-seos/destroy', 'StaticSeoController@massDestroy')->name('static-seos.massDestroy');
    Route::post('static-seos/media', 'StaticSeoController@storeMedia')->name('static-seos.storeMedia');
    Route::post('static-seos/ckmedia', 'StaticSeoController@storeCKEditorImages')->name('static-seos.storeCKEditorImages');
    Route::resource('static-seos', 'StaticSeoController');

    // Post
    Route::delete('posts/destroy', 'PostController@massDestroy')->name('posts.massDestroy');
    Route::post('posts/media', 'PostController@storeMedia')->name('posts.storeMedia');
    Route::post('posts/ckmedia', 'PostController@storeCKEditorImages')->name('posts.storeCKEditorImages');
    Route::resource('posts', 'PostController');

    // Media Library
    Route::resource('media', 'MediaLibraryController');
    Route::get('media-library', 'MediaLibraryController@index')->name('media-library.index');
    Route::get('medialibrary', 'MediaLibraryController@index_medialibrary')->name('media.medialibrary');
    Route::post('mediaaction', 'MediaLibraryController@mediaaction')->name('media.mediaaction');
    Route::post('delete', 'MediaLibraryController@delete')->name('media.delete');

    // Slider
    Route::delete('sliders/destroy', 'SliderController@massDestroy')->name('sliders.massDestroy');
    Route::post('sliders/media', 'SliderController@storeMedia')->name('sliders.storeMedia');
    Route::post('sliders/ckmedia', 'SliderController@storeCKEditorImages')->name('sliders.storeCKEditorImages');
    Route::resource('sliders', 'SliderController');

    // Settings
    Route::delete('settings/destroy', 'SettingsController@massDestroy')->name('settings.massDestroy');
    Route::post('settings/media', 'SettingsController@storeMedia')->name('settings.storeMedia');
    Route::post('settings/ckmedia', 'SettingsController@storeCKEditorImages')->name('settings.storeCKEditorImages');
    Route::resource('settings', 'SettingsController');

    // Redirectors
    Route::delete('redirectors/destroy', 'RedirectorController@massDestroy')->name('redirectors.massDestroy');
    Route::resource('redirectors', 'RedirectorController');

    // Service
    Route::delete('services/destroy', 'ServiceController@massDestroy')->name('services.massDestroy');
    Route::post('services/media', 'ServiceController@storeMedia')->name('services.storeMedia');
    Route::post('services/ckmedia', 'ServiceController@storeCKEditorImages')->name('services.storeCKEditorImages');
    Route::resource('services', 'ServiceController');

    // Testimonial
    Route::delete('testimonials/destroy', 'TestimonialController@massDestroy')->name('testimonials.massDestroy');
    Route::post('testimonials/media', 'TestimonialController@storeMedia')->name('testimonials.storeMedia');
    Route::post('testimonials/ckmedia', 'TestimonialController@storeCKEditorImages')->name('testimonials.storeCKEditorImages');
    Route::resource('testimonials', 'TestimonialController');

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');
    Route::post('faq-questions/media', 'FaqQuestionController@storeMedia')->name('faq-questions.storeMedia');
    Route::post('faq-questions/ckmedia', 'FaqQuestionController@storeCKEditorImages')->name('faq-questions.storeCKEditorImages');

    // Success Stories
    Route::delete('success-stories/destroy', 'SuccessStoriesController@massDestroy')->name('success-stories.massDestroy');
    Route::post('success-stories/media', 'SuccessStoriesController@storeMedia')->name('success-stories.storeMedia');
    Route::post('success-stories/ckmedia', 'SuccessStoriesController@storeCKEditorImages')->name('success-stories.storeCKEditorImages');
    Route::resource('success-stories', 'SuccessStoriesController');

    // Routes for AJAX store methods
    Route::post('product-categories/store-ajax', 'ProductCategoryController@storeAjax')->name('product-categories.store-ajax');
    Route::post('product-tags/store-ajax', 'ProductTagController@storeAjax')->name('product-tags.store-ajax');
    Route::post('content-categories/store-ajax', 'ContentCategoryController@storeAjax')->name('content-categories.store-ajax');
    Route::post('content-tags/store-ajax', 'ContentTagController@storeAjax')->name('content-tags.store-ajax');

    // Comment
    Route::delete('comments/destroy', 'CommentController@massDestroy')->name('comments.massDestroy');
    Route::resource('comments', 'CommentController');

    // Seenon
    Route::delete('seenons/destroy', 'SeenonController@massDestroy')->name('seenons.massDestroy');
    Route::post('seenons/media', 'SeenonController@storeMedia')->name('seenons.storeMedia');
    Route::post('seenons/ckmedia', 'SeenonController@storeCKEditorImages')->name('seenons.storeCKEditorImages');
    Route::resource('seenons', 'SeenonController');

    // Environment conditionals
    Route::post('add_env_conditionals', function(Request $request) {
        if($request->evnsData){
            foreach ($request->evnsData as $key => $value) {
                \DB::table('admin_menu_items')->where('id', $value['menu_id'])->update([$value['envs'] => $value['check']]);
            }
        }
    })->name('add_env_conditionals');

    // Logged in only
    Route::post('logged_in_only', function (Request $request) {
        \DB::table('admin_menu_items')->where('id', $request->menu_id)->update(['logged_in_only' => $request->check]);
    })->name('logged_in_only');

    // Icon only menu
    Route::post('icon_only_menu', function (Request $request) {
        \DB::table('admin_menu_items')->where('id', $request->menu_id)->update(['icon_only_menu' => $request->check]);
    })->name('icon_only_menu');

    // Add menu icon class
    Route::post('add_menu_icon_class', function (Request $request) {
        \DB::table('admin_menu_items')->where('id', $request->menu_id)->update(['menu_icon_class' => $request->icon]);
    })->name('add_menu_icon_class');

    // Menu users
    Route::post('MenuUsers', function (Request $request) {
        \DB::table('user_admin_menu_item')->where('admin_menu_item_id', $request->menu_id)->delete();
        if ($request->users) {
            foreach ($request->users as $key => $user) {
                \DB::table('user_admin_menu_item')->insert(
                    [
                        'user_id' => $user,
                        'admin_menu_item_id' => $request->menu_id,
                    ]
                );
            }
        }
    })->name('MenuUsers');

    // Menu roles
    Route::post('MenuRoles', function (Request $request) {
        \DB::table('role_admin_menu_item')->where('admin_menu_item_id', $request->menu_id)->delete();
        if ($request->roles) {
            foreach ($request->roles as $key => $role) {
                \DB::table('role_admin_menu_item')->insert(
                    [
                        'role_id' => $role,
                        'admin_menu_item_id' => $request->menu_id,
                    ]
                );
            }
        }
    })->name('MenuRoles');

});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
