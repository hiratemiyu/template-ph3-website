<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'text', 'supplement', 'quiz_id'];

    public function choices()
    {
        return $this->hasMany(Choice::class);
        
    }
}

// $table->id();
// $table->string('image')->comment('設問画像 ex.) /image/sample.jpg');
// $table->string('text')->comment('設問 ex.) 日本のIT人材が2030年には最大どれくらい不足すると言われているでしょうか？');
// $table->string('supplement')->nullable()->comment('設問補足');
// $table->unsignedBigInteger('quiz_id');
// $table->timestamps();

// $table->foreign('quiz_id')->references('id')->on('quizzes');