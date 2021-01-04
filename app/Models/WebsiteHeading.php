<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $website_id
 * @property string $header_type
 * @property string $header_content
 * @property string $created_at
 * @property string $updated_at
 * @property Website $website
 */
class WebsiteHeading extends Model
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
    protected $fillable = ['website_id', 'header_type', 'header_content', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function website()
    {
        return $this->belongsTo('App\Models\Website');
    }
}
