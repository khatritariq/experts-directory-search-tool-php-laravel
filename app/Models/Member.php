<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 * @property Friendship[] $friendships
 * @property Friendship[] $friendships
 * @property Website[] $websites
 */
class Member extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function friendshipsMember()
    {
        return $this->hasMany('App\Models\Friendship', 'member_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function friendshipsFriend()
    {
        return $this->hasMany('ApApp\Models\Friendship', 'friend_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function websites()
    {
        return $this->hasMany('App\Models\Website');
    }
}
