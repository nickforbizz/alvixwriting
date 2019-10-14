<?php

Route::group(['prefix'=>'admin','namespace'=>'Admin','as'=>"Admin.", 'middleware'=>'AdminWriter'], function () {
    //

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


    Route::post('/orderComment', 'chatsUserController@orderComments')->name('orderComments');


    

    // dashboard routes for returning view pages 
    Route::get('/viewassg', 'DashboardController@viewAssgn')->name('viewAssg');
    Route::get('/underReview', 'DashboardController@underReview')->name('underReview');
    Route::get('/uploadAssg', 'DashboardController@uploadAssg')->name('uploadAssg');
    Route::get('/paidAssg', 'DashboardController@paidAssg')->name('pendingPay');
    Route::get('/onProgress', 'DashboardController@onProgress')->name('onProgress');
    Route::get('/onRevision', 'DashboardController@onRevision')->name('onRevision');
    Route::get('/revisionreview', 'DashboardController@revisionReview')->name('revisionreview');
    Route::post('/payOrder', 'DashboardGetDataController@payOrder')->name('payOrder');
    Route::get('/order/{id}', 'DashboardController@order')->name('order');
    Route::get('/addfiles/{id}', 'DashboardController@addfiles')->name('addfiles');
    
    Route::get('/orderReasign/{type}/{id}', 'DashboardController@orderReasign')->name('orderReasign');
    Route::post('/reasignOrder', 'DashboardGetDataController@reasignOrder')->name('reasignOrder');

    //    users
    Route::get('/viewUsers', 'DashboardController@viewUsers')->name('viewUsers'); 
    Route::get('/editUsers', 'DashboardController@editUsers')->name('editUsers');
    Route::get('/addAdmins', 'DashboardController@addAdmins')->name('addAdmins');
    Route::get('/viewAdmins', 'DashboardController@viewAdmins')->name('viewAdmins');
    Route::get('/editAdmins', 'DashboardController@editAdmins')->name('editAdmins');

    Route::get('/roles', 'DashboardController@roles')->name('roles');
    Route::get('/getRole/{id}', 'DashboardGetDataController@getRole')->name('getRole');
    Route::get('/delRole/{id}', 'DashboardGetDataController@delRole')->name('delRole');
    Route::post('/editRole', 'DashboardGetDataController@editRole')->name('editRole');


    Route::get('/categories', 'DashboardController@categories')->name('categories');
    Route::get('/delCategories/{id}', 'DashboardGetDataController@delCategories')->name('delCategories');
    Route::get('/getCategories/{id}', 'DashboardGetDataController@getCategories')->name('getCategories');
    Route::post('/editCategories', 'DashboardGetDataController@editCategories')->name('editCategories');
    Route::post('/addCategories', 'DashboardGetDataController@addCategories')->name('addCategories');


    Route::get('/settings', 'DashboardController@settings')->name('settings');

    // dashboard routes for processing data approveWriters
    // GET Request
    Route::get('/getUser/{id}', 'DashboardGetDataController@getUser')->name('getUser');
    Route::get('/getAdmin/{id}', 'DashboardGetDataController@getAdmin')->name('getAdmin');

    // new writers
    Route::get('/approveWriters', 'ApproveWritersController@viewWriters')->name('approveWriters');
    Route::get('/veiwWritersTest', 'ApproveWritersController@veiwWritersTest')->name('veiwWritersTest');

    // POST Requests
    Route::post('adminUpdate/{id}', 'DashboardGetDataController@updateAdmin')->name('updateAdmin');
    Route::post('/updateAdminImgs', 'DashboardGetDataController@saveAdminImg')->name('updateAdminImg');

    Route::post('/registerAdmin', 'DashboardGetDataController@registerAdmin')->name('registerAdmin');
    Route::post('/createOrder', 'DashboardGetDataController@createOrder')->name('createOrder');
    Route::post('/orderPrerequests', 'DashboardGetDataController@orderPrerequests')->name('orderPrerequests');
    Route::post('/updateAssg/{id}', 'DashboardGetDataController@updateAssg')->name('updateAssg');
    Route::post('/editUser', 'DashboardGetDataController@editUser')->name('editUser'); 
    Route::post('/editAdmin', 'DashboardGetDataController@editAdmin')->name('editAdmin');
    Route::post('/addRole', 'DashboardGetDataController@addRole')->name('addRole');

    // confirm or reject order
    Route::get('/confirmOrder/{id}/{writer_id}', 'confirmRejectOrderController@confirmOrder')->name('confirmOrder');
    Route::post('/rejectOrder', 'confirmRejectOrderController@rejectOrder')->name('rejectOrder');

    // download files
    Route::get('/download/{file}', 'DownloadsController@download')->name('download');
    Route::get('/downloadable/{file}', 'DownloadsController@downloadable')->name('downloadable');
    Route::get('/previewdoc/{file}', 'DownloadsController@previewDoc')->name('preview');

    Route::get('/pagedownload/{id}', function($id){ 

        return view('Admin.filedownload.assgfile', compact('id'));
    })->name('pagedownload');


    Route::get('/webMsg/{id}', 'chatsController@adminMsg')->name('webMsg');
    Route::get('/AdminMsg', 'chatsController@adminChart')->name('AdminMsg');
    Route::post('/orderAdminComment', 'chatsController@orderComments')->name('orderAdminComments');



    // other
    Route::get('/home', 'HomeController@index')->name('home');


    Route::get('/test', function () {
        return "_GET some test in admin area";
    })->name('test');

    Route::post('/test', function () {
        return "_POST some test";
    })->name('testp');
    // Auth::routes();

});


//Password reset routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('user_password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('user_password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('user_password/reset', 'Auth\ResetPasswordController@reset');



?>