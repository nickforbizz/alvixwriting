<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $admin_id
 * @property int $review_id
 * @property string $reason_revised
 * @property int $remember_token
 * @property int $active
 * @property int $warn
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Admin $admin
 * @property Onreviewassignment $onreviewassignment
 * @property User $user
 * @property RejectedAssg[] $rejectedAssgs
 */
class Onrevisionassignment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'onrevisionassignment';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'admin_id', 'review_id', 'reason_revised', 'remember_token', 'active', 'warn', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }

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
    public function rejectedAssgs()
    {
        return $this->hasMany('App\Models\RejectedAssg', 'revision_id');
    }
}
