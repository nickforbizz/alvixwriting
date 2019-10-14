<?php 

Route::get('writer_password/resetrequest', 'web\Auth\ForgotPasswordController@showLinkRequestForm')->name('writer.password.getemail');
Route::post('writer_password/email', 'web\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.reset');


Route::get('writer_password/reset/', 'web\Auth\ResetPasswordController@showResetForm')->name('writer.password.reset');
Route::post('writer_password/postreset', 'web\Auth\ResetPasswordController@reset')->name('web.password.update');

?>  