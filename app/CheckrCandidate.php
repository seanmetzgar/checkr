<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CheckrCandidate
 *
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property mixed $user
 * @property mixed $reports
 * @property mixed $events
 * @property string $candidate_id
 * @property string $first_name
 * @property string $middle_name
 * @property int $no_middle_name
 * @property string $last_name
 * @property string $dob
 * @property string $zipcode
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrCandidate whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrCandidate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrCandidate whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrCandidate whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrCandidate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrCandidate whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrCandidate whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrCandidate whereNoMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrCandidate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrCandidate whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrCandidate whereZipcode($value)
 * @mixin \Eloquent
 */
class CheckrCandidate extends Model
{
    protected $fillable = [
        'user_id',
        'candidate_id',
        'checkr_created_at',
        'object'
    ];

    protected $dates = [
        'checkr_created_at',
        'created_at',
        'updated_at'
    ];
    /**
     * Create relationship with User [One-to-Many (inverse)]
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reports() {
        return $this->hasMany(CheckrReport::class);
    }

    /**
     * Create relationship with CheckrEvent using MorphMany
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function events() {
        return $this->morphMany(CheckrEvent::class, 'eventable');
    }
}
