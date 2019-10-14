<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $onreview_id
 * @property string $name
 * @property string $media_link
 * @property string $type
 * @property int $remember_token
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Onreviewassignment $onreviewassignment
 * @property User $user
 */
class WriterMediaFilesAssg extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'writer_media_files_assg';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'onreview_id', 'name', 'media_link', 'type', 'remember_token', 'status', 'created_at', 'updated_at', 'deleted_at'];

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
        return $this->belongsTo('App\Models\Onreviewassignment', 'onreview_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
