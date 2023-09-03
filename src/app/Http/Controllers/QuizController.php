<?php

namespace App\Http\Controllers;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function quiz()
    {
        $quizzes = Quiz::all();
        return view('quizzes', ['quizzes' => $quizzes]);
    }
    public function show ($id)
    {
        // Eagerロードを使用して特定のクイズに関連する質問とそれらの選択肢を取得
        $quiz = Question::with('choices')->where('quiz_id', $id)->get();
        // $quiz = Question::where('quiz_id', $id)->get();
        // dd($quiz);
        return view('quizzes.show', ['quiz' => $quiz]);
    }

    public function edit($id)
    {
        $quiz = Quiz::with('questions.choices')->find($id);
        return view('quizzes.edit', ['quiz' => $quiz]);
    }
    
    public function update(Request $request, $id)
    {
        $quiz = Quiz::with('questions.choices')->find($id);
        $quiz->name = $request->name;
        $quiz->save();

        foreach ($quiz->questions as $question) {
            $question->text = $request->questions[$question->id]['text'];
            $question->save();

            foreach ($question->choices as $choice) {
                $choice->text = $request->questions[$question->id]['choices'][$choice->id]['text'];
                $choice->save();
            }
        }

        $request->session()->flash('message', '更新されました！');

        return redirect()->route('quizzes');
    }

    public function destroy($id)
    {
        Quiz::find($id)->delete();
        return redirect()->route('quizzes')->with('status', '削除しました！');
    }
}
