<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $on_progress_assg_id
 * @property int $user_id
 * @property int $remember_token
 * @property string $upload_comment
 * @property int $active
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Onprogressassignment $onprogressassignment
 * @property User $user
 * @property AssgPendingPayment[] $assgPendingPayments
 * @property Onrevisionassignment[] $onrevisionassignments
 * @property WriterMediaFilesAssg[] $writerMediaFilesAssgs
 */
class Onreviewassignment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'onreviewassignment';

    /**
     * @var array
     */
    protected $fillable = ['on_progress_assg_id', 'user_id', 'remember_token', 'upload_comment', 'active', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function onprogressassignment()
    {
        return $this->belongsTo('App\Models\Onprogressassignment', 'on_progress_assg_id');
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
    public function assgPendingPayments()
    {
        return $this->hasMany('App\Models\AssgPendingPayment', 'review_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function onrevisionassignments()
    {
        return $this->hasMany('App\Models\Onrevisionassignment', 'review_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function writerMediaFilesAssgs()
    {
        return $this->hasMany('App\Models\WriterMediaFilesAssg', 'onreview_id');
    }
}
