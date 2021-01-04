<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $memberId
 * @property integer $friendId
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 * @property Member $member
 * @property Member $member
 */
class Friendship extends Model
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
    protected $fillable = ['member_id', 'friend_id', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'member_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function friend()
    {
        return $this->belongsTo('App\Models\Member', 'friend_id');
    }
}
