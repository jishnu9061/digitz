<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/08/08
 * Time: 23:23:10
 * Description: TaskController.php
 */

namespace App\Http\Controllers;

use App\Models\Task;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * @return [type]
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function store(TaskStoreRequest $request)
    {
        Task::create($request->all());
        return redirect()->route('user.tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * @param Task $task
     *
     * @return [type]
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * @param Request $request
     * @param Task $task
     *
     * @return [type]
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $task->update($request->all());
        return redirect()->route('user.tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * @param Task $task
     *
     * @return [type]
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return Response::json(['success' => 'Task Deleted Successfully']);
    }

    /**
     * @param Task $task
     *
     * @return [type]
     */
    public function markAsCompleted(Task $task)
    {
        $task->update(['status' => 'completed']);
        return redirect()->route('user.tasks.index')->with('success', 'Task marked as completed.');
    }
}
