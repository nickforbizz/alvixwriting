<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
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
 * @property AssgPendingPayment[] $assgPendingPayments
 * @property ChatsAdmin[] $chatsAdmins
 * @property ChatsUser[] $chatsUsers
 * @property Completedassignment[] $completedassignments
 * @property Onprogressassignment[] $onprogressassignments
 * @property Onreviewassignment[] $onreviewassignments
 * @property Onrevisionassignment[] $onrevisionassignments
 * @property RejectedAssg[] $rejectedAssgs
 * @property Smse[] $smses
 * @property WriterFeedback[] $writerFeedbacks
 * @property WriterMediaFilesAssg[] $writerMediaFilesAssgs
 * @property WriterMediaProfile[] $writerMediaProfiles
 * @property WriterRating[] $writerRatings
 */
class Writer extends authenticatable implements CanResetPassword
{
    use Notifiable;
    /**
     * @var array
     */
    protected $fillable = ['national_id', 'email', 'password', 'username', 'fname', 'lname', 'sname', 'age', 'gender', 'email_verified_at', 'mobile', 'roles', 'address', 'bio', 'remember_token', 'active', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assgPendingPayments()
    {
        return $this->hasMany('App\Models\AssgPendingPayment');
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
    public function chatsUsers()
    {
        return $this->hasMany('App\Models\ChatsUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function completedassignments()
    {
        return $this->hasMany('App\Models\Completedassignment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function onprogressassignments()
    {
        return $this->hasMany('App\Models\Onprogressassignment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function onreviewassignments()
    {
        return $this->hasMany('App\Models\Onreviewassignment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function onrevisionassignments()
    {
        return $this->hasMany('App\Models\Onrevisionassignment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rejectedAssgs()
    {
        return $this->hasMany('App\Models\RejectedAssg');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function smses()
    {
        return $this->hasMany('App\Models\Smse');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function writerFeedbacks()
    {
        return $this->hasMany('App\Models\WriterFeedback');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function writerMediaFilesAssgs()
    {
        return $this->hasMany('App\Models\WriterMediaFilesAssg');
    }

        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userRatings()
    {
        return $this->hasMany('App\Models\UserRating');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function writerMediaProfiles()
    {
        return $this->hasMany('App\Models\WriterMediaProfile');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function writerRatings()
    {
        return $this->hasMany('App\Models\WriterRating');
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
