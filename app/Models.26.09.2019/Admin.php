<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;


/**
 * @property int $id
 * @property int $role_id
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
 * @property string $remember_token
 * @property string $bio
 * @property int $active
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Role $role
 * @property Assignment[] $assignments
 * @property ChatsAdmin[] $chatsAdmins
 * @property MediaFilesAssg[] $mediaFilesAssgs
 * @property Onrevisionassignment[] $onrevisionassignments
 */
class Admin extends authenticatable implements CanResetPassword
{

    use AuthenticableTrait, Notifiable;
    /**
     * @var array
     */
    protected $fillable = ['role_id', 'national_id', 'email', 'password', 'username', 'fname', 'lname', 'sname', 'age', 'gender', 'email_verified_at', 'mobile', 'roles', 'address', 'remember_token', 'bio', 'active', 'status', 'created_at', 'updated_at', 'deleted_at'];
    
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignments()
    {
        return $this->hasMany('App\Models\Assignment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatsAdmins()
    {
        return $this->hasMany('App\Models\ChatsAdmin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mediaFilesAssgs()
    {
        return $this->hasMany('App\Models\MediaFilesAssg');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function onrevisionassignments()
    {
        return $this->hasMany('App\Models\Onrevisionassignment');
    }



     /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    } 
}
