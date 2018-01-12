<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CheckrReport
 *
 * @property int $id
 * @property string $report_id
 * @property string $package
 * @property string $status
 * @property string|null $checkr_created_at
 * @property string|null $checkr_completed_at
 * @property string|null $due_time
 * @property int $turnaround_time
 * @property string|null $candidate_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\CheckrCandidate|null $candidate
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CheckrEvent[] $events
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrReport whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrReport whereCheckrCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrReport whereCheckrCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrReport whereDueTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrReport wherePackage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrReport whereReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrReport whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrReport whereTurnaroundTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CheckrReport whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CheckrReport extends Model
{
    /**
     * Create relationship with CheckrCandidate [One-to-Many (inverse)]
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function candidate() {
        return $this->belongsTo(CheckrCandidate::class);
    }

    /**
     * Create relationship with CheckrEvent using MorphMany
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function events() {
        return $this->morphMany(CheckrEvent::class, 'eventable');
    }
}
