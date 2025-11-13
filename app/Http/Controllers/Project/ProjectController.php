<?php
namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectStage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $stages = ProjectStage::with('projects')->orderBy('order')->get();
        return view('projects.index', compact('stages'));
    }

    public function storeStage(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|size:7'
        ]);

        $stage = ProjectStage::create([
            'name' => $request->name,
            'color' => $request->color,
            'order' => ProjectStage::max('order') + 1
        ]);

        return response()->json($stage);
    }

    public function updateProjectStage(Request $request, Project $project): JsonResponse
    {
        $request->validate(['stage_id' => 'required|exists:project_stages,id']);
        
        $project->update(['stage_id' => $request->stage_id]);
        
        return response()->json(['success' => true]);
    }

    public function create(): View
    {
        return view('projects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        return back()->with('success', 'Project saved');
    }

    public function show(int $id): View
    {
        return view('projects.show', compact('id'));
    }

    public function edit(int $id): View
    {
        return view('projects.edit', compact('id'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        return back()->with('success', 'Project updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        return back()->with('success', 'Project deleted');
    }
}
