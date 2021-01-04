<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $member_id
 * @property string $url
 * @property string $short_url
 * @property string $created_at
 * @property string $updated_at
 * @property Member $member
 * @property WebsiteHeading[] $websiteHeadings
 */
class Website extends Model
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
    protected $fillable = ['member_id', 'url', 'short_url', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function websiteHeadings()
    {
        return $this->hasMany('App\Models\WebsiteHeading');
    }
}
