<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $assg_id
 * @property int $user_id
 * @property int $remember_token
 * @property int $returned
 * @property int $active
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Assignment $assignment
 * @property User $user
 * @property Onreviewassignment[] $onreviewassignments
 */
class Onprogressassignment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'onprogressassignment';

    /**
     * @var array
     */
    protected $fillable = ['assg_id', 'user_id', 'remember_token', 'returned', 'active', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment', 'assg_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function onreviewassignments()
    {
        return $this->hasMany('App\Models\Onreviewassignment', 'on_progress_assg_id');
    }
}
