<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with(['status', 'category', 'adminUser', 'workUser'])->get();

        return response()->json([
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create([
            'name' => request('createTaskData.task_name'),
            'description' => request('createTaskData.description'),
            'work_user' => request('createTaskData.work_user'),
            'category_id' => request('createTaskData.category'),
            'status_id' => request('createTaskData.status'),
            'deadline' => request('createTaskData.deadline'),
            'admin_user' => request('admin_user'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $id = request('task.id');
        $task = Task::find($id);

        $task->name = request('task.name');
        $task->description = request('task.description');
        $task->work_user = request('task.work_user.id');
        $task->category_id = request('task.category_id');
        $task->status_id = request('task.status_id');
        $task->deadline = request('task.deadline');
        $task->progress = request('task.progress');
        $task->man_hours = request('task.man_hours');

        $task->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id = request('id');
        $user = Task::find($id);

        $user->delete();
    }
}
