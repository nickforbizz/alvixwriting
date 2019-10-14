<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordWriter;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as authenticatable;


/**
 * @property int $id
 * @property int $national_id
 * @property string $email
 * @property string $password
 * @property string $username
 * @property string $fname
 * @property string $lname
 * @property string $sname
 * @property int $age
 * @property string $gender
 * @property string $email_verified_at
 * @property int $mobile
 * @property string $roles
 * @property string $address
 * @property string $bio
 * @property string $remember_token
 * @property int $active
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Writer extends Authenticatable implements CanResetPassword
{

    use Notifiable;
    /**
     * @var array
     */
    protected $fillable = ['national_id', 'email', 'password', 'username', 'fname', 'lname', 'sname', 'age', 'gender', 'email_verified_at', 'mobile', 'roles', 'address', 'bio', 'remember_token', 'active', 'status', 'created_at', 'updated_at', 'deleted_at'];


    protected $hidden = [
        'password', 'remember_token',
    ];

      /**
    * Send the password reset notification.
    *
    * @param  string  $token
    * @return void
    */
    public function sendPasswordResetNotification($token)
    {
      $this->notify(new ResetPasswordWriter($token));
    }
}
