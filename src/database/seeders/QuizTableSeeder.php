<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;

class QuizTableSeeder extends Seeder
{
    /**
     * データベースに対するデータ設定の実行
     */
    public function run(): void
    {
        DB::table('quizzes')->insert([
            [
                'id'=>1,
                'name'=> 'ITクイズ',
            ],
            [
                'id'=>2,
                'name'=> '自己紹介クイズ',
            ],
        ]);
    }
}

