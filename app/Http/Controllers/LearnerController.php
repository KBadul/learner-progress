<?php

namespace App\Http\Controllers;

use App\Actions\GetFilteredLearnersAction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LearnerController extends Controller
{
    public function index(
        Request $request,
        GetFilteredLearnersAction $action
    ): View {
        $learners = $action->run(
            $request->input('search'),
            $request->input('sort', 'desc')
        );

        return view('learner-progress', [
            'learners' => $learners,
        ]);
    }
}
