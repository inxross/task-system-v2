<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //Modelで扱うカラム名（カラムに対応する変数名）を設定します。このプロパティに無い変数名は無視されるようになります。
    protected $fillable = [
        'id', 'user_id', 'task_id', 'comment_id', 'file_name', 'original_name'
    ];

    //リレーション設定
    public function task()
    {
    return $this->belongsTo('App\Task');
    }

    public function comment()
    {
    return $this->belongsTo('App\Comment');
    }

    public function user()
    {
    return $this->belongsTo('App\User');
    }

}
