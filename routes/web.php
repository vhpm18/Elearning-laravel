<?php
Route::get('/images/{path}/{attachment}', function ($path, $attachment) {
    $file = sprintf('storage/%s/%s', $path, $attachment);
    if (File::exists($file)) {
        return Image::make($file)->response();
    }
});

Route::get('/set_language/{lang}', 'Controller@setLanguage')->name('set_language');
Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')->name('social_auth');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'courses'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/subscribed', 'CourseController@subscribed')->name('courses.subscribed');
        Route::get('/{course}/inscribe', 'CourseController@inscribe')->name('courses.inscribe');
        Route::post('/add_review', 'CourseController@addReview')->name('courses.add_review');

        Route::group(['middleware' => [sprintf("role:%s", \App\Entities\Role::TEACHER)]], function () {
            Route::get('/create', 'CourseController@create')->name('courses.create');
            Route::post('/store', 'CourseController@store')->name('courses.store');
            Route::put('/{course}/update', 'CourseController@update')->name('courses.update');
            Route::get('/{slug}/edit', 'CourseController@edit')->name('courses.edit');
            //Route::put('/{course}/update', 'CourseController@update')->name('courses.update');
            Route::delete('/{course}/destroy', 'CourseController@destroy')->name('courses.destroy');
        });
    });
    Route::get('/{course}', 'CourseController@show')->name('courses.detail');
});
Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'subscriptions'], function () {
        Route::get('/plans', 'SubscriptionController@plans')->name('subscriptions.plans');
        Route::get('/admin', 'SubscriptionController@admin')->name('subscriptions.admin');
        Route::post('/proccess_subscription', 'SubscriptionController@proccessSubscription')->name('subscriptions.proccess_subscription');
        Route::post('/resume', 'SubscriptionController@resume')->name('subscriptions.resume');
        Route::post('/cancel', 'SubscriptionController@cancel')->name('subscriptions.cancel');
    });
    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/admin', 'InvoiceContoller@admin')->name('invoices.admin');
        Route::get('/{invoice}/download', 'InvoiceContoller@download')->name('invoices.download');
    });
});

Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function () {
    Route::get('/', 'ProfileControlle@index')->name('profile.index');
    Route::put('/', 'ProfileControlle@update')->name('profile.update');
});

Route::group(['prefix' => 'solicitude'], function () {
    Route::post('/teacher', 'SolicitudeController@teacher')->name('solicitude.teacher');
});
Route::group(['prefix' => 'teacher', 'middleware' => 'auth'], function () {
    Route::get('/courses', 'TeacherController@courses')->name('teacher.courses');
    Route::get('/students', 'TeacherController@students')->name('teacher.students');
    Route::post('/send_to_message_to_student', 'TeacherController@sendMessageToStudent')->name('teacher.send_to_message_to_student');
});

Route::group([
    'prefix'     => 'admin',
    'middleware' => ['auth', sprintf("role:%s", \App\Entities\Role::ADMIN)]], function () {
    Route::get('/courses', 'AdminController@courses')->name('admin.courses');
    Route::get('/courses_json', 'AdminController@coursesJson')->name('admin.courses_json');
    Route::post('/courses/updateStatus', 'AdminController@updateCourseStatus');

    Route::get('/students', 'AdminController@students')->name('admin.students');
    Route::get('/students_json', 'AdminController@studentsJson')->name('admin.students_json');
    //Route::get('/students', 'AdminController@students')->name('admin.students');
    Route::get('/teachers', 'AdminController@teachers')->name('admin.teachers');
    Route::get('/teachers_json', 'AdminController@teachersJson')->name('admin.teachers_json');

    Route::post('/sendMessage', 'AdminController@sendMessageUser');
});
