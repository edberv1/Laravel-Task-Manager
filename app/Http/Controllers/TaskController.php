<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
{
    $query = auth()->user()->tasks();

    if ($request->has('priority') && $request->priority != '') {
        $query->where('priority', $request->priority);
    }

    $tasks = $query->get();

    return view('tasks.index', compact('tasks'));
}

    public function create()
    {
        return view('tasks.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'priority' => 'required|integer|in:1,2,3',
    ]);

    try {
        auth()->user()->tasks()->create($request->all());
        session()->flash('success', 'Task created successfully.');
    } catch (\Exception $e) {
        session()->flash('error', 'There was a problem creating the task.');
    }

    return redirect()->route('tasks.index');
}

    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {
            $task->update($request->all());
            session()->flash('success', 'Task updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'There was a problem updating the task.');
        }

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            $task->delete();
            session()->flash('success', 'Task deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'There was a problem deleting the task.');
        }

        return redirect()->route('tasks.index');
    }

    public function toggleCompletion(Task $task)
{
    if ($task->user_id !== auth()->id()) {
        abort(403);
    }

    try {
        $task->status = !$task->status;
        $task->save();
        session()->flash('success', 'Task status updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', 'There was a problem updating the task status.');
    }

    return redirect()->route('tasks.index');
}
}