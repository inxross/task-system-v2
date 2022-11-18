<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'オーダーチーズEC-CUBE',
            ],
            [
                'name' => 'オールドビンテージ',
            ],
            [
                'name' => 'コーヒー頒布会',
            ],
            [
                'name' => 'フーディライト',
            ],
            [
                'name' => 'ペットフード',
            ],
        ]);
    }
}
