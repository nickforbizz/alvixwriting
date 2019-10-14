<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $on_revision_assg_id
 * @property int $writer_id
 * @property int $remember_token
 * @property string $upload_comment
 * @property int $active
 * @property int $topayment
 * @property int $torevision
 * @property int $toreasignment
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Onrevisionassignment $onrevisionassignment
 * @property Writer $writer
 * @property WriterMediaFilesRevision[] $writerMediaFilesRevisions
 */
class ReviewRevision extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['on_revision_assg_id', 'writer_id', 'remember_token', 'upload_comment', 'active', 'topayment', 'torevision', 'toreasignment', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function onrevisionassignment()
    {
        return $this->belongsTo('App\Models\Onrevisionassignment', 'on_revision_assg_id');
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
    public function writerMediaFilesRevisions()
    {
        return $this->hasMany('App\Models\WriterMediaFilesRevision', 'onreviewrevision_id');
    }
}
