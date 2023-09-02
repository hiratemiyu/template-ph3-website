<!DOCTYPE html>
<html>
<head>
    <title>クイズ編集</title>
</head>
<body>
    <h1>クイズ編集</h1>
    <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="name">タイトル:</label>
        <input type="text" id="name" name="name" value="{{ $quiz->name }}">
        
        @foreach($quiz->questions as $question)
            <label for="question_{{ $question->id }}">問題文:</label>
            <input type="text" id="question_{{ $question->id }}" name="questions[{{ $question->id }}][text]" value="{{ $question->text }}">
            
            @foreach($question->choices as $choice)
                <label for="choice_{{ $choice->id }}">選択肢:</label>
                <input type="text" id="choice_{{ $choice->id }}" name="questions[{{ $question->id }}][choices][{{ $choice->id }}][text]" value="{{ $choice->text }}">
            @endforeach
        @endforeach
        
        <input type="submit" value="更新">
    </form>
</body>
</html>
