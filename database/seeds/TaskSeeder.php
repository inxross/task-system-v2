<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            [
                'name' => 'Task1',
                'description' => 'Task1の説明文です。',
                'admin_user' => 1,
                'work_user' => 1,
                'category_id' => 1,
                'status_id' => 1,
            ],
            [
                'name' => 'Task2',
                'description' => 'Task2の説明文です。',
                'admin_user' => 2,
                'work_user' => 2,
                'category_id' => 2,
                'status_id' => 1,
            ],
            [
                'name' => 'Task3',
                'description' => 'Task3の説明文です。',
                'admin_user' => 3,
                'work_user' => 3,
                'category_id' => 3,
                'status_id' => 1,
            ],
            [
                'name' => 'Task4',
                'description' => 'Task4の説明文です。',
                'admin_user' => 4,
                'work_user' => 4,
                'category_id' => 4,
                'status_id' => 1,
            ],
            [
                'name' => 'Task5',
                'description' => 'Task5の説明文です。',
                'admin_user' => 5,
                'work_user' => 5,
                'category_id' => 5,
                'status_id' => 1,
            ],
        ]);
    }
}
