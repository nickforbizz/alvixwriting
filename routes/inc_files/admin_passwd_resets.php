<?php 

use Illuminate\Support\Facades\Route;



// Route::get('admin/password/reset', function ()
// {
//     return 'sdfsdj';
// })->name('admin.password.reset');

Route::get('admin/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.reset');
Route::post('admin/user_password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail');


Route::get('admin_password/resetview/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');

Route::post('admin/admin_password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('admin.password.update');


 

?>