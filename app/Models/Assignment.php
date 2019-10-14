<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $admin_id
 * @property int $lang_id
 * @property int $paper_type_id
 * @property int $order_format_id
 * @property int $category_id
 * @property string $title
 * @property string $description
 * @property string $instructions
 * @property string $notes
 * @property int $pages
 * @property int $returned
 * @property int $reasigned
 * @property int $taken
 * @property int $words
 * @property float $amount
 * @property string $deadline
 * @property int $remember_token
 * @property int $active
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Category $category
 * @property OrderFormat $orderFormat
 * @property OrderLanguage $orderLanguage
 * @property PaperType $paperType
 * @property Admin $admin
 * @property AssgPendingPayment[] $assgPendingPayments
 * @property Completedassignment[] $completedassignments
 * @property MediaFilesAssg[] $mediaFilesAssgs
 * @property Onprogressassignment[] $onprogressassignments
 * @property OrderComment[] $orderComments
 * @property ReasignedAssignment[] $reasignedAssignments
 * @property ReturnedAssignment[] $returnedAssignments
 * @property UserRating[] $userRatings
 * @property WriterMediaFilesAssg[] $writerMediaFilesAssgs
 * @property WriterMediaFilesRevision[] $writerMediaFilesRevisions
 * @property WriterRating[] $writerRatings
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
    protected $fillable = ['admin_id', 'lang_id', 'paper_type_id', 'order_format_id', 'category_id', 'title', 'description', 'instructions', 'notes', 'pages', 'returned', 'reasigned', 'taken', 'words', 'amount', 'deadline', 'remember_token', 'active', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderFormat()
    {
        return $this->belongsTo('App\Models\OrderFormat');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderLanguage()
    {
        return $this->belongsTo('App\Models\OrderLanguage', 'lang_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paperType()
    {
        return $this->belongsTo('App\Models\PaperType');
    }

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
    public function assgPendingPayments()
    {
        return $this->hasMany('App\Models\AssgPendingPayment', 'assg_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function completedassignments()
    {
        return $this->hasMany('App\Models\Completedassignment', 'assg_id');
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
    public function orderComments()
    {
        return $this->hasMany('App\Models\OrderComment', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reasignedAssignments()
    {
        return $this->hasMany('App\Models\ReasignedAssignment', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function returnedAssignments()
    {
        return $this->hasMany('App\Models\ReturnedAssignment', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userRatings()
    {
        return $this->hasMany('App\Models\UserRating', 'assg_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function writerMediaFilesAssgs()
    {
        return $this->hasMany('App\Models\WriterMediaFilesAssg', 'assg_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function writerMediaFilesRevisions()
    {
        return $this->hasMany('App\Models\WriterMediaFilesRevision', 'assg_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function writerRatings()
    {
        return $this->hasMany('App\Models\WriterRating', 'assg_id');
    }
}
