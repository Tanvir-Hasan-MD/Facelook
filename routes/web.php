<?php
Route::get('sub-menu/demo', 'Frontend\FrontController@demo');

Route::get('/cache_clear', function(){
	try {
		Artisan::call('config:cache');
		Artisan::call('config:clear');
		Artisan::call('view:clear');
		Artisan::call('route:clear');
		Artisan::call('cache:clear');
	} catch(\Exception $e) {
		dd($e);
	}
});

// Frontend
// Route::get('/','Frontend\FrontController@home')->name('home');
// Social
Route::get('/registration','UserController@registration')->name('registration');
Route::post('/create/user','UserController@createUser')->name('create.user');


Route::get('sub-menu/{menu_url}', 'Frontend\FrontController@MenuUrl')->name('menu_url')->where('menu_url', '.*');

Route::get('/',function(){
	return redirect()->route('login');
});
//Reset Password
Route::get('reset/password','Backend\PasswordResetController@resetPassword')->name('reset.password');
Route::post('check/email','Backend\PasswordResetController@checkEmail')->name('check.email');
Route::get('check/name','Backend\PasswordResetController@checkName')->name('check.name');
Route::get('check/code','Backend\PasswordResetController@checkCode')->name('check.code');
Route::post('submit/check/code','Backend\PasswordResetController@submitCode')->name('submit.check.code');
Route::get('new/password','Backend\PasswordResetController@newPassword')->name('new.password');
Route::post('store/new/password','Backend\PasswordResetController@newPasswordStore')->name('store.new.password');


Auth::routes();

Route::middleware(['auth'])->group(function(){

	Route::get('/home', 'Backend\HomeController@index')->name('dashboard');
	Route::post('/post/add', 'Backend\HomeController@postAdd')->name('post.add');
	Route::get('/post/delete', 'Backend\HomeController@postDelete')->name('post.delete');

	Route::group(['middleware'=>['permission']],function(){
		Route::prefix('profile-management')->group(function(){
			//Change Password
			Route::get('change/password','Backend\PasswordChangeController@changePassword')->name('profile-management.change.password');
			Route::post('store/password','Backend\PasswordChangeController@storePassword')->name('profile-management.store.password');
			// Profile Edit
			Route::get('profile','UserController@profile')->name('profile-management.profile');
			Route::get('profile/edit/{id}','UserController@profileEdit')->name('profile-management.profile.edit');
			Route::post('profile/update','UserController@profileUpdate')->name('profile-management.profile.update');
		});

	});
});
