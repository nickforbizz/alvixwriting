<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $writer_id
 * @property int $assg_id
 * @property int $onreviewrevision_id
 * @property string $name
 * @property string $media_link
 * @property string $type
 * @property int $remember_token
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Assignment $assignment
 * @property ReviewRevision $reviewRevision
 * @property Writer $writer
 */
class WriterMediaFilesRevision extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['writer_id', 'assg_id', 'onreviewrevision_id', 'name', 'media_link', 'type', 'remember_token', 'status', 'created_at', 'updated_at', 'deleted_at'];

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
    public function reviewRevision()
    {
        return $this->belongsTo('App\Models\ReviewRevision', 'onreviewrevision_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function writer()
    {
        return $this->belongsTo('App\Models\Writer');
    }
}
