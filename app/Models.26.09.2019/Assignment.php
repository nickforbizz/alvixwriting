<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $admin_id
 * @property string $title
 * @property string $category
 * @property string $description
 * @property int $pages
 * @property int $words
 * @property float $amount
 * @property string $deadline
 * @property int $remember_token
 * @property int $active
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Admin $admin
 * @property MediaFilesAssg[] $mediaFilesAssgs
 * @property Onprogressassignment[] $onprogressassignments
 * @property UserRating[] $userRatings
 */
class Assignment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'assignment';

    /**
     * @var array
     */
    protected $fillable = ['admin_id', 'title', 'category', 'description', 'pages', 'words', 'amount', 'deadline', 'remember_token', 'active', 'status', 'created_at', 'updated_at', 'deleted_at'];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mediaFilesAssgs()
    {
        return $this->hasMany('App\Models\MediaFilesAssg', 'assg_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function onprogressassignments()
    {
        return $this->hasMany('App\Models\Onprogressassignment', 'assg_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userRatings()
    {
        return $this->hasMany('App\Models\UserRating', 'assg_id');
    }
}
