<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $review_id
 * @property int $remember_token
 * @property int $active
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Onreviewassignment $onreviewassignment
 * @property User $user
 * @property Completedassignment[] $completedassignments
 */
class AssgPendingPayment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'assg_pending_payment';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'review_id', 'remember_token', 'active', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function onreviewassignment()
    {
        return $this->belongsTo('App\Models\Onreviewassignment', 'review_id');
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
    public function completedassignments()
    {
        return $this->hasMany('App\Models\Completedassignment', 'pending_pay_id');
    }
}
