<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>本を登録</title>
</head>
<body>
    <h1>本を登録</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/books" method="POST">
        @csrf

        <div>
            <label>タイトル</label><br>
            <input type="text" name="title" value="{{ old('title') }}">
        </div>

        <div>
            <label>著者</label><br>
            <input type="text" name="author" value="{{ old('author') }}">
        </div>

        <div>
            <label>ステータス</label><br>
            <select name="status">
                <option value="want">読みたい</option>
                <option value="reading">読書中</option>
                <option value="done">読了</option>
            </select>
        </div>

        <div>
            <label>メモ</label><br>
            <textarea name="memo">{{ old('memo') }}</textarea>
        </div>

        <div>
            <label>読み始め</label><br>
            <input type="date" name="started_at" value="{{ old('started_at') }}">
        </div>

        <div>
            <label>読み終わり</label><br>
            <input type="date" name="finished_at" value="{{ old('finished_at') }}">
        </div>

        <button type="submit">登録</button>
    </form>

    <p><a href="/books">一覧へ戻る</a></p>
</body>
</html>
