<?php

namespace App\Services;

use App\File;
use App\Comment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * 詳細処理クラス
 */
class DetailProcess
{
    /**
     * ファイル保存処理
     */
    public static function fileStore($request, $commentId, $fromComment)
    {
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

                if ($commentId) {
                    $fileInstance = File::create([          //DBに保存
                        'task_id' => $taskId,
                        'user_id' => $admin_user,
                        'file_name' => $fileNameToStore,
                        'original_name' => $originalName,
                        'comment_id' => $commentId
                    ]);
                } else {
                    if($fromComment) {
                        $comment = Comment::create([
                            'task_id' => $taskId,
                            'user_id' => $admin_user,
                            'text' => 'ファイルアップロードしました。'
                        ]);
                        $fileInstance = File::create([          //DBに保存
                            'task_id' => $taskId,
                            'user_id' => $admin_user,
                            'file_name' => $fileNameToStore,
                            'original_name' => $originalName,
                            'comment_id' => $comment->id
                        ]);
                    } else {
                        $fileInstance = File::create([          //DBに保存
                            'task_id' => $taskId,
                            'user_id' => $admin_user,
                            'file_name' => $fileNameToStore,
                            'original_name' => $originalName,
                        ]);
                    }

                }

                // /storage/appディレクトリの該当フォルダに保存
                Storage::putFileAs('public/file/', $file, $fileNameToStore);
            }
        }

        return response()->json([
            'files' => $files,
        ]);

    }

}
