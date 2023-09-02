<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;
use Faker\Factory as Faker;


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

        // Fakerインスタンスの生成
        $faker = Faker::create();

        // 100件のダミーデータの生成と挿入
        foreach (range(3, 100) as $index) {
            Quiz::create([
                'name' => $faker->sentence(3),  // 3単語からなる名前をランダムに生成
            ]);
        }
    }
}

