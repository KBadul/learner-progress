<?php

use App\Http\Controllers\LearnerController;
use Illuminate\Support\Facades\Route;

Route::get('/learner-progress', [LearnerController::class, 'index'])->name('learners.index');
