<?php
Route::get('/', function () { return redirect()->route('login'); });
Route::get('/login', function () { return redirect()->route('login'); });

Route::get('/home', function(){
    if(session('status')){
        return redirect()->route('admin.home')->with('status', session('status'));
    }
    return redirect()->route('admin.home');
});
Auth::routes(['register' => false]);
// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', function () { return redirect()->route('login'); })->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

     // Hospitals
    Route::delete('hospitals/destroy', 'HospitalsController@massDestroy')->name('hospitals.massDestroy');
    Route::resource('hospitals', 'HospitalsController');

    Route::resource('lookups','LookupsController');

    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
        // Change password
        if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
            Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
            Route::post('password', 'ChangePasswordController@update')->name('password.update');
        }
    });
});
