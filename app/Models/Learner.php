<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Learner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
    ];

    public function scopeSearchCourses(Builder $query, ?string $search): Builder
    {
        if (! $search) {
            return $query;
        }

        return $query->whereHas('courses', function ($q) use ($search) {
            $q->where('name', 'LIKE', "%$search%");
        });
    }

    protected function averageProgress(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->courses->count() > 0
                ? round($this->courses->sum('pivot.progress') / $this->courses->count())
                : 0
        );
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(
            Course::class,
            'enrolments',
            'learner_id',
            'course_id'
        )->withPivot('progress');
    }
}
