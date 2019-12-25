<?php
use App\Country;
use Illuminate\Http\Request; 

Route::get('test' , function(){
    $all = Country::all();
    return view('test.search',compact('all'));
});

Route::get('search' , 'SearchController@index')->name('search');

Route::get('/', function () {return redirect(app()->getLocale());});

Route::group(['prefix' => 'dashboard' , 'middleware' => 'auth:admin'] , function(){
    //about browes
    Route::get('/', 'Dashboard\Admin\AdminController@index')->name('admin.dashboard');
    Route::get('admins', 'Dashboard\Admin\AdminController@admin_index')->name('admins.index');
    Route::get('abouts/company','Dashboard\Admin\AboutController@index')->name('about.company');
    Route::get('abouts/contactus','Dashboard\Admin\AboutController@createContact')->name('about.contactus');
    Route::get('abouts/partner','Dashboard\Admin\AboutController@indexpartner')->name('about.partner');
    Route::get('abouts/team','Dashboard\Admin\AboutController@createTeam')->name('about.team');
    //
     Route::get('admin/pdf/{id}','Dashboard\Admin\BrowseController@pdf')->name('admin.pdf');
    //
     Route::get('price/index','Dashboard\Admin\AdvController@price_index')->name('price.index');
     Route::get('price/edit/{id}','Dashboard\Admin\AdvController@price_edit')->name('price.edit');
    //
     Route::get('partner/{id}/edit','Dashboard\Admin\AboutController@edit_partner')->name('partner.edit');
     Route::get('team/{id}/edit','Dashboard\Admin\AboutController@edit_team')->name('team.edit');
    //about store
    Route::resource('abouts','Dashboard\Admin\AboutController')->except('create');
    //Guid
    Route::resource('guids','Dashboard\Admin\GuidController')->only(['index','edit','update']);
    //Notifications Process
    // Route::get('notfy','Dashboard\Admin\NotfyController@notfyShow')->name('');
    
    Route::resource('admins','Dashboard\Admin\AdminController')->except(['delete','create','index']);
    Route::resource('companies','Dashboard\Admin\OwnerController');
    Route::resource('jobs','Dashboard\Admin\JobController')->except('create');
    Route::resource('locations','Dashboard\Admin\LocationController');
    Route::resource('roles','Dashboard\Admin\RoleController');
    Route::resource('specials','Dashboard\Admin\SpecializationController');
    Route::resource('subspecials','Dashboard\Admin\SubSpecialController');
    Route::resource('experiences','Dashboard\Admin\ExperienceController')->except('create');
    Route::get('experiences/create/{id}','Dashboard\Admin\ExperienceController@create')->name('exp.create');
    Route::resource('levels','Dashboard\Admin\LevelController');
    Route::resource('user/cv','Dashboard\Admin\UserController')->except('create');
    //cv
    Route::get('user/education/{id}','Dashboard\Admin\UserController@createEdu')->name('user.edu');
    Route::get('user/language/{id}','Dashboard\Admin\UserController@create')->name('user.lang');
    Route::get('user/ref/{id}' , 'Dashboard\Admin\UserController@createRef')->name('user.ref');
    Route::get('user/attch/{id}' , 'Dashboard\Admin\UserController@createAttch')->name('user.attch');
    //
    Route::get('refs/{id}/edit' , 'Dashboard\Admin\UserController@ref_edit')->name('refs.edit');
    Route::get('ref/index' , 'Dashboard\Admin\UserController@index_ref')->name('ref.index');
     Route::get('attchs/{id}/edit' , 'Dashboard\Admin\UserController@attch_edit')->name('attchs.edit');
    Route::get('attch/index' , 'Dashboard\Admin\UserController@index_attch')->name('attch.index');
    //
    Route::get('jobs/create/{id}','Dashboard\Admin\JobController@create')->name('jobs.create');
    Route::get('cities','Dashboard\Admin\LocationController@cityIndex')->name('cities.index');
    Route::get('cities/{id}/edit','Dashboard\Admin\LocationController@cityEdit')->name('cities.edit');
    Route::get('cities/create','Dashboard\Admin\LocationController@cityCreate')->name('cities.create');
    Route::get('delete_city/{id}','Dashboard\Admin\LocationController@cityDestroy')->name('delete_city');
    Route::get('educations/index','Dashboard\Admin\UserController@index_edu')->name('education.index');
    Route::get('languages/index','Dashboard\Admin\UserController@index_lang')->name('language.index');
    Route::get('languages/{id}/edit','Dashboard\Admin\UserController@lang_edit')->name('language.edit');
    Route::get('educations/{id}/edit','Dashboard\Admin\UserController@edu_edit')->name('education.edit');
    Route::get('request/noty/{id}/{sender_id}/{notfy}/{job_id}','Dashboard\Admin\BrowseController@noty')->name('request.noty');
    Route::get('notfy/delete/{notfy}','Dashboard\Admin\BrowseController@delete')->name('notfy.delete');
    Route::get('notfy/index','Dashboard\Admin\BrowseController@index')->name('notfy.index');
    Route::get('all/notfy','Dashboard\Admin\BrowseController@notfyAll')->name('all.notfy');
    Route::get('show/notfy/{id}','Dashboard\Admin\BrowseController@notfyShow')->name('show.notfy');
    Route::resource('advs','Dashboard\Admin\AdvController')->except('create');
    Route::resource('news','Dashboard\Admin\NewsController')->except(['create' , 'show']);
    


});

Route::group(['prefix' => 'admins'], function(){
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login/submit', 'Auth\AdminLoginController@adminLogin')->name('admin.login.submit');
    Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    
   // Password reset routes
  Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
  Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
  Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

});
Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setlocale'], 
function() {
    
     Route::get('/','Browse\BrowseController@home_page')->name('home');  
     Auth::routes(['verify' => true]);
     Route::get('users/logout', 'Auth\LoginController@userLogout')->name('users.logout');
     Route::post('users/register/submit', 'Auth\RegisterController@create')->name('users.register.submit');
     Route::get('my_cv','Dashboard\User\UserController@myCv')->name('web.mycv');
     Route::get('apply/{id}/notfy','Dashboard\User\UserController@apply')->name('apply.notfy');
     Route::resource('users', 'Dashboard\User\UserController');
     
     Route::get('owners/login', 'Auth\OwnerLoginController@showloginForm')->name('owner.login');
     Route::post('owners/login/submit', 'Auth\OwnerLoginController@ownerLogin')->name('owner.login.submit');
     Route::post('owners/register/submit', 'Auth\OwnerRegisterController@create')->name('owners.register.submit');
     Route::get('owners/register', 'Auth\OwnerRegisterController@showRegistrationForm')->name('owner.register');
     Route::get('owners/logout', 'Auth\OwnerLoginController@ownerLogout')->name('owners.logout');
     Route::get('job/owner','Dashboard\Owner\OwnerController@jobOwner')->name('job.owner');
     Route::resource('owners', 'Dashboard\Owner\OwnerController');
    
     Route::get('/','Browse\BrowseController@home_page')->name('home');
     Route::get('contact','Browse\BrowseController@contact')->name('web.contact');
     Route::get('company/about','Browse\BrowseController@about')->name('company.about');
     Route::get('single/{id}/job','Browse\BrowseController@jobsingle')->name('single.job');
     Route::get('expert/{id}/edit','Dashboard\User\UserController@exp_edit')->name('expert.edit');
     Route::get('lang/{id}/edit','Dashboard\User\UserController@lang_edit')->name('lang.edit');
     Route::get('search/job','Browse\BrowseController@search')->name('search.job');
     Route::get('search/cv','Dashboard\Owner\OwnerController@cvSearch')->name('search.cv');
     Route::get('noty/exp/{id}','Dashboard\Owner\OwnerController@notify')->name('nofy.cv');
     Route::get('job/{id}/setting','Dashboard\Owner\OwnerController@setting')->name('job.setting');
     Route::get('delete/owner_cv/{id}','Dashboard\Owner\OwnerController@endCv')->name('delete.owner_cv');
     Route::get('pdf/download/{id}','Dashboard\User\UserController@pdf')->name('pdf.download');
     Route::get('category/index','Browse\BrowseController@category')->name('category.index');
     Route::get('job/full','Browse\BrowseController@byFull')->name('job.full');
     Route::get('job/part','Browse\BrowseController@byPart')->name('job.part');
     Route::get('all/jobs','Browse\BrowseController@allJob')->name('all.job');
     Route::get('attch/{id}/edit','Dashboard\User\UserController@attch_edit')->name('attch.edit');
     Route::get('ref/{id}/edit','Dashboard\User\UserController@ref_edit')->name('ref.edit');
     Route::get('user/guid','Dashboard\User\UserController@guid')->name('user.guid');
     Route::get('about/footer','Browse\BrowseController@showAbout')->name('about.footer');
     Route::post('contact/send','Browse\BrowseController@contactSend')->name('contact.send');
     Route::get('search/role/{id}','Browse\BrowseController@by_role')->name('search.role');
     
     Route::get('owner/verification','Auth\VerificationController@show')->name('owner.verification.notice'); //owner.verification.resend
     Route::get('owner/verification/resend','Auth\VerificationController@resend')->name('owner.verification.resend');

      //  owners.password.request
     Route::post('/owner/password/email', 'Auth\OwnerForgotPasswordController@sendResetLinkEmail')->name('owner.password.email');
     Route::get('/owner/password/reset', 'Auth\OwnerForgotPasswordController@showLinkRequestForm')->name('owner.password.request');
     Route::post('/owner/password/reset', 'Auth\OwnerResetPasswordController@reset');
     Route::get('/owner/password/reset/{token}', 'Auth\OwnerResetPasswordController@showResetForm')->name('owner.password.reset');
     
     
});


//Auth Download file 

Route::post('/download/{id}', 'Browse\BrowseController@download' )->name('download')->middleware('auth:owner,admin,web');




Route::get('/clear-cache', function() {
       \Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/cache', function() {
       \Artisan::call('cache:clear');
    return 'DONE'; //Return anything
});

Route::get('/migrate', function() {
       \Artisan::call('migrate');
    return 'DONE'; //Return anything
});

// Route::view('test','test');