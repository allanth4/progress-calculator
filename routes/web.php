<?php

use App\Http\Controllers\ProgressController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProgressController::class, 'index'])->name('progress.index');
Route::post('/projects', [ProgressController::class, 'createProject'])->name('projects.store');
Route::post('/projects/{project}/progress', [ProgressController::class, 'storeProgress'])->name('progress.store');
