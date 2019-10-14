<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $writer_id
 * @property int $admin_id
 * @property int $review_id
 * @property string $reason_revised
 * @property int $remember_token
 * @property int $warn
 * @property int $revised
 * @property int $active
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Admin $admin
 * @property Onreviewassignment $onreviewassignment
 * @property Writer $writer
 * @property RejectedAssg[] $rejectedAssgs
 * @property ReviewRevision[] $reviewRevisions
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
    protected $fillable = ['writer_id', 'admin_id', 'review_id', 'reason_revised', 'remember_token', 'warn', 'revised', 'active', 'status', 'created_at', 'updated_at', 'deleted_at'];

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
    public function writer()
    {
        return $this->belongsTo('App\Models\Writer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rejectedAssgs()
    {
        return $this->hasMany('App\Models\RejectedAssg', 'revision_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviewRevisions()
    {
        return $this->hasMany('App\Models\ReviewRevision', 'on_revision_assg_id');
    }
}
