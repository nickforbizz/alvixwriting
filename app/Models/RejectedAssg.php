<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $revision_id
 * @property int $writer_id
 * @property int $remember_token
 * @property string $upload_comment
 * @property int $active
 * @property int $warn
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Onrevisionassignment $onrevisionassignment
 * @property Writer $writer
 */
class RejectedAssg extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'rejected_assg';

    /**
     * @var array
     */
    protected $fillable = ['revision_id', 'writer_id', 'remember_token', 'upload_comment', 'active', 'warn', 'status', 'created_at', 'updated_at', 'deleted_at'];

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
        return $this->belongsTo('App\Models\Onrevisionassignment', 'revision_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function writer()
    {
        return $this->belongsTo('App\Models\Writer');
    }
}
