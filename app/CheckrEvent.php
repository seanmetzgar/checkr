<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CheckrEvent
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $eventable
 * @mixin \Eloquent
 */
class CheckrEvent extends Model
{
    protected $fillable = [
        'event_id',
        'object',
        'type',
        'data',
        'checkr_created_at',
        'checkr_object_id',
        'checkr_object_type'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'checkr_created_at'
    ];
    protected $casts = [
        'data' => 'array',
    ];
    /**
     * Create morphable relationship
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function eventable() {
        return $this->morphTo();
    }
}
