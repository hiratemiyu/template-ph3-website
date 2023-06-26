<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('questions')->insert([
            [
                'id' => 1,
                'image' => 'img-quiz01.img',
                'text' => '日本のIT人材が2030年には最大どれくらい不足すると言われているでしょうか？',
                'supplement' =>'',
                'quiz_id' => 1,
            ],
            [
                'id' => 2,
                'image' => 'img-quiz02.img',
                'text' => '既存業界のビジネスと、先進的なテクノロジーを結びつけて生まれた、新しいビジネスのことをなんと言うでしょう？',
                'supplement' =>'',
                'quiz_id' => 1,
            ],
            [
                'id' => 3,
                'image' => 'img-quiz03.img',
                'text' => 'IoTとは何の略でしょう？',
                'supplement' =>'',
                'quiz_id' => 1,
            ],
            [
                'id' => 4,
                'image' => 'img-quiz04.img',
                'text' => '出身地はどこでしょうか？',
                'supplement' =>'',
                'quiz_id' => 2,
            ],
            [
                'id' => 5,
                'image' => 'img-quiz05.img',
                'text' => '在籍中の大学はどこでしょう？',
                'supplement' =>'',
                'quiz_id' => 2,
            ],
            [
                'id' => 6,
                'image' => 'img-quiz06.img',
                'text' => '動物に例えるとなんと言われることが多いでしょう？',
                'supplement' =>'',
                'quiz_id' => 2,
            ],
        ]);
    }
}
