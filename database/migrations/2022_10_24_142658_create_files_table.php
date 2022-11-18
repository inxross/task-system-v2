<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->string('file_name')->comment('保存用ファイル名');
            $table->string('original_name')->comment('オリジナルファイル名');
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('登録日時');

            //外部キー制約
            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('comment_id')
                ->references('id')
                ->on('comments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
