<?php

namespace App\Actions;

use App\Models\Learner;
use Illuminate\Database\Eloquent\Collection;

class GetFilteredLearnersAction
{
    /**
     * @return Collection<Learner> $learners
     */
    public function run(?string $search, string $sortOrder = 'desc'): Collection
    {
        $learners = Learner::query()
            ->with('courses')
            ->searchCourses($search)
            ->get();

        $learners = $sortOrder === 'asc'
            ? $learners->sortBy('average_progress')->values()
            : $learners->sortByDesc('average_progress')->values();

        return $learners;
    }
}
