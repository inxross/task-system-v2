<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DetailProcess;
use App\Task;
use App\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\StoreTaskForm;
use App\Http\Requests\UpdateTaskForm;

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
    public function store(StoreTaskForm $request)
    {
        $task = Task::create([
            'name' => $request->get('task_name'),
            'description' => $request->get('description'),
            'work_user' => $request->get('work_user'),
            'category_id' => $request->get('category'),
            'status_id' => $request->get('status'),
            'deadline' => $request->get('deadline'),
            'admin_user' => $request->get('admin_user'),
        ]);

        return response()->json([
            'task' => $task,
        ]);
    }

    public function fileUpload(Request $request)
    {
        $data = $request->all();
        $commentId = $data['commentId'];
        DetailProcess::fileStore($request, $commentId);   //ファイル保存処理

/*
        $files = request()->file('files');

        if (!is_null($files)) {
            foreach($files as $file){
                $originalName = $file->getClientOriginalName();

                $fileName = Str::random(30);
                $extension = $file->extension(); //拡張子を取得する。取得した画像にextension()とすれば拡張子を取得できる。
                $fileNameToStore = $fileName . '.' . $extension; //作成したファイル名と拡張子を付ける。

                $data = $request->all();
                $taskId = $data['taskId'];
                $admin_user = $data['admin_user'];
                //$taskId = json_decode($data['taskId']);
                //$admin_user = json_decode($data['admin_user']);

                $fileInstance = File::create([          //DBに保存
                    'task_id' => $taskId,   //サンプル
                    'user_id' => $admin_user,   //サンプル
                    'file_name' => $fileNameToStore,
                    'original_name' => $originalName,
                ]);

                // /storage/appディレクトリの該当フォルダに保存
                Storage::putFileAs('public/file/', $file, $fileNameToStore);
            }
        }

        return response()->json([
            'files' => $files,
        ]);
 */
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
    public function update(UpdateTaskForm $request)
    {
        $id = $request->get('id');
        $task = Task::find($id);

        $task->name = $request->get('task_name');
        $task->description = $request->get('description');
        $task->work_user = $request->get('work_user');
        $task->category_id = $request->get('category');
        $task->status_id = $request->get('status');
        $task->deadline = $request->get('deadline');
        $task->progress = $request->get('progress');
        $task->man_hours = $request->get('man_hours');

        $task->save();

        return response()->json([
            'task' => $task,
        ]);
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
