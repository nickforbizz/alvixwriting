<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $order_id
 * @property int $admin_id
 * @property int $writer_id
 * @property string $name
 * @property string $posted_by
 * @property string $comment
 * @property string $remember_token
 * @property int $active
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Admin $admin
 * @property Assignment $assignment
 * @property Writer $writer
 */
class OrderComment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['order_id', 'admin_id', 'writer_id', 'name', 'posted_by', 'comment', 'remember_token', 'active', 'status', 'created_at', 'updated_at', 'deleted_at'];

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
    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function writer()
    {
        return $this->belongsTo('App\Models\Writer');
    }
}
