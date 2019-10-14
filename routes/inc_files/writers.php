<?php




Route::group(['prefix' => 'web', 'namespace'=>'Web', 'as'=>'Web.', 'middleware'=>'writer'], function () {

    // Route::get('/', function () {            , 'middleware'=>'auth'
    //     return view('web.welcome');
    // });

     Route::get('/ChatTest', 'ChatController@ChatView');
     Route::post('/ChatSend', 'ChatController@send');

    Route::get('notificationTest', function (){


        $user = \App\Models\User::where('id',1)->notify(new AssignmentChat);



    });



    Route::get('/orderDetails/{id}', 'writersAssgController@orderDetails')->name('orderDetails/{id}');
    Route::post('/webMsg', 'chatsUserController@webMsg')->name('webMsg');
    Route::post('/orderComment', 'chatsUserController@orderComments')->name('orderComments');


    Route::get('/klove/{toString}', "KloveController@index");

    Route::post('/anonymousMsg', 'webController@anonymousMsg')->name('anonymousMsg');

    // writer pages
    Route::get('/dashboard', 'webController@webDashboard')->name('home');
    Route::get('/getordercount', 'webController@getordersCount')->name('getordercount');

    Route::get('/progressAssg', 'writersAssgController@onProgressAssg')->name('progressAssg');
    Route::get('/uploadAssg/{type}/{id}', 'writersAssgController@uploadAssg')->name('uploadAssg'); 
    Route::get('/order/{id}', 'writersAssgController@order')->name('order');
    Route::get('/reviewAssg', 'writersAssgController@reviewAssg')->name('reviewAssg');
    Route::get('/revisionreviewAssg', 'writersAssgController@revisionreviewAssg')->name('revisionreviewAssg');
    Route::get('/rejectedAssg', 'writersAssgController@rejectedAssg')->name('rejectedAssg');
    Route::get('/revision', 'writersAssgController@revision')->name('revision');

    Route::get('/pendingAssg', 'writersAssgController@pendingAssg')->name('pendingAssg'); 
    Route::get('/paidAssg', 'writersAssgController@completedAssg')->name('paidAssg');

    Route::get('/completedAssg', 'writersAssgController@completedAssg')->name('completedAssg');
    Route::get('/settings', 'writersAssgController@settings')->name('settings');
    Route::get('/orders', 'writersAssgController@viewOrders')->name('orders');
    Route::get('/orderfile/{id}', 'writersAssgController@viewOrderFile')->name('orderfile');

    Route::get('/takeOrder/{id}/{writer_id}', 'writersAssgController@takeOrder')->name('takeOrder');
    Route::get('/cancelOrder/{id}', 'writersAssgController@cancelOrder')->name('cancelOrder'); 
    Route::get('/logout', 'writersAssgController@theLogout')->name('logout');

    Route::post('/submitAssg', 'writersAssgController@submitAssg')->name('submitAssg');
    Route::post('/updateWriterImgs', 'webController@saveWriterImg')->name('updateWriterImg');
    // Route::get('/home', 'HomeController@index')->name('home'); 


    Route::get('/downloadOrder/{order_id}', 'DownloadsController@downloadOrderFile')->name('downloadOrder');


});

?>