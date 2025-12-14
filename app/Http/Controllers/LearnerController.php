<?php

namespace App\Http\Controllers;

use App\Models\Learner;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class LearnerController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $sortOrder = $request->input('sort', 'desc');
        
        $learners = Learner::query()
            ->with('courses')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('courses', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%");
                });
            })
            ->get()
            ->map(function ($learner) {
                $learner->average_progress = $learner->courses->count() > 0 
                    ? round($learner->courses->sum('pivot.progress') / $learner->courses->count())
                    : 0;
                return $learner;
            });

        $learners = $sortOrder === 'asc' 
            ? $learners->sortBy('average_progress')->values()
            : $learners->sortByDesc('average_progress')->values();

        return view('learner-progress', [
            'learners' => $learners,
            'sortOrder' => $sortOrder,
        ]);
    }
}
