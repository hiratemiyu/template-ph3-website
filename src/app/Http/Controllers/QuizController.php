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
        $quizzes = Quiz::paginate(20);
        $deletedQuizzes = Quiz::onlyTrashed()->get();
        return view('quizzes', ['quizzes' => $quizzes, 'deletedQuizzes' => $deletedQuizzes]);
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
        // 論理削除
        // 孫レコード（choices）を削除
        $questions = Question::where('quiz_id', $id)->get();
        foreach ($questions as $question) {
            Choice::where('question_id', $question->id)->delete();
        }

        // 子レコードを削除
        Question::where('quiz_id', $id)->delete();
    
        // 親レコードを削除
        Quiz::find($id)->delete();
        return redirect()->route('quizzes')->with('status', '削除しました！');

        // // モデルを物理削除
        // $user = Quiz::find($id);
        // $user->delete();
        // return redirect()->route('quizzes');
    }

    public function create()
    {
        return view('quizzes.create'); // quizzes.create は新規作成フォームのビュー名
    }

    public function store(Request $request)
    {
        // バリデーションを最初に行う
        $request->validate([
        'title' => 'required|max:200',  // タイトルは必須で、最大200文字まで
        'question' => 'required',        // 問題文も必須
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 画像は必須ではない
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/images', $imageName);
        }
        
        // quizzesテーブルに保存
        $quiz = Quiz::create([
        'name' => $request->title,
        'image' => $imageName,
        ]);
    
        // questionsテーブルに保存
        $question = Question::create([
            'quiz_id' => $quiz->id,
            'text' => $request->question,
        ]);
    
        // choicesテーブルに保存
        $choices = $request->choices;
        $is_correct = $request->is_correct;
        foreach ($choices as $index => $choice_text) {
            Choice::create([
                'question_id' => $question->id,
                'text' => $choice_text,
                'is_correct' => in_array($index, $is_correct) ? 1 : 0,  // 正解なら1、そうでなければ0
            ]);
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/images', $imageName);
        }
        
        return redirect()->route('quizzes');
        }

        public function indexWithTrashed()
        {
            // QuizzesController.php の適切なメソッドに以下を追加
            $quizzes = Quiz::withTrashed()->get();
            $deletedQuizzes = Quiz::onlyTrashed()->get();
            return view('quizzes', compact('quizzes', 'deletedQuizzes'));
        }
}

