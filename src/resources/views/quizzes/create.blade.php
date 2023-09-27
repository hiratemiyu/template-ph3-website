<h1>新規クイズ作成</h1>
<form method="post" action="{{ route('quizzes.store') }}"  enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">クイズのタイトル</label>
        <input type="text" id="title" name="title" class="form-control" required>
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group">
        <label for="question">問題文</label>
        <textarea id="question" name="question" class="form-control" rows="4" required></textarea>
    </div>
    <div class="form-group">
        <label for="image">画像アップロード</label>
        <input type="file" id="image" name="image" class="form-control-file">
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="choice1">選択肢 1</label>
        <input type="text" id="choice1" name="choices[]" class="form-control" required>
        <input type="checkbox" id="is_correct1" name="is_correct[]" value="0"> 正解
    </div>
    <div class="form-group">
        <label for="choice2">選択肢 2</label>
        <input type="text" id="choice2" name="choices[]" class="form-control" required>
        <input type="checkbox" id="is_correct2" name="is_correct[]" value="1"> 正解
    </div>
    <div class="form-group">
        <label for="choice3">選択肢 3</label>
        <input type="text" id="choice3" name="choices[]" class="form-control" required>
        <input type="checkbox" id="is_correct3" name="is_correct[]" value="2"> 正解
    </div>
    <button type="submit" class="btn btn-primary">作成</button>
</form>
