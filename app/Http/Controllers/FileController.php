<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taskId = $request->get('taskId');

        $files = File::where('task_id', $taskId)->orderBy('updated_at', 'asc')->get();

        return response()->json([
            'files' => $files,
        ]);
    }

    public function downLoad(Request $request){

        $fileId = $request->get('file_id');
        $file = File::find($fileId);

/*
        $original_name = $file->original_name;

        $filePath = 'public/file/' . $file->file_name;
        $mimeType = Storage::mimeType($filePath);
        $headers = [['Content-Type' => $mimeType]];

        return Storage::download($filePath, $original_name, $headers);
 */


        $pathToFile = 'http://vue-laravel-separately-tasksystem.localdomain/storage/file/'.$file->file_name;

        $filePath = 'public/file/' . $file->file_name;
        $mimeType = Storage::mimeType($filePath);
        //$headers = [['Content-Type' => $mimeType]];

        $image = Storage::get('public/file/'.$file->file_name);
        $imageText = base64_encode($image);

        return response()->json([
            'pathToFile' => $pathToFile,
            'file' => $file,
            'mimeType' => $mimeType,
            'imageText' => $imageText,
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
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
