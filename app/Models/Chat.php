<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $body
 * @property int $remember_token
 * @property int $active
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property ChatsAdmin[] $chatsAdmins
 * @property ChatsUser[] $chatsUsers
 */
class Chat extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['body', 'remember_token', 'active', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatsAdmins()
    {
        return $this->hasMany('App\Models\ChatsAdmin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatsUsers()
    {
        return $this->hasMany('App\Models\ChatsUser');
    }
}
