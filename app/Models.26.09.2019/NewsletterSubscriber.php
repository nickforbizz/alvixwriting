<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $email
 * @property int $remember_token
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Newslettersubscriber extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'newslettersubscriber';

    /**
     * @var array
     */
    protected $fillable = ['email', 'remember_token', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

}
