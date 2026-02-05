<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgressController extends Controller
{
    public function index(): View
    {
        $project = Project::latest()->first();

        return view('progress.index', [
            'project' => $project,
            'entries' => $project?->progressEntries()->latest('created_at')->get() ?? collect(),
        ]);
    }

    public function createProject(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'goal' => 'required|integer|min:1',
        ]);

        Project::create($validated);

        return redirect()->route('progress.index');
    }

    public function storeProgress(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'value' => 'required|integer|min:0',
        ]);

        $project->progressEntries()->create([
            'value' => $validated['value'],
            'created_at' => now(),
        ]);

        return redirect()->route('progress.index');
    }

    public function calculate(int $a, int $b): int
    {
        return $b * ($a + $b) + 400;
    }

    public function danishHorse(): string
    {
        return 'hest';
    }
}
