<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     * If no tasks exist, redirect to the create task form.
     */
    public function index()
    {
        $tasks = Task::all();
        if ($tasks->isEmpty()) {
            // Redirect to the task creation form if there are no tasks.
            return redirect()->route('tasks.create');
        }
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'title'       => 'required|max:255',
            'description' => 'nullable',
        ]);

        Task::create([
            'title'        => $request->input('title'),
            'description'  => $request->input('description'),
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('tasks.index')
                         ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified task.
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'description' => 'nullable',
        ]);

        $task = Task::findOrFail($id);
        $task->update([
            'title'        => $request->input('title'),
            'description'  => $request->input('description'),
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('tasks.index')
                         ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')
                         ->with('success', 'Task deleted successfully.');
    }
}
