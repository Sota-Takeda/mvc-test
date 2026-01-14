<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>本の詳細</title>
</head>
<body>
    <h1>本の詳細</h1>

    <p>タイトル：{{ $book->title }}</p>
    <p>著者：{{ $book->author ?? '未入力' }}</p>
    <p>ステータス：{{ $book->status }}</p>
    <p>メモ：{{ $book->memo ?? '未入力' }}</p>
    <p>読み始め：{{ $book->started_at ?? '未入力' }}</p>
    <p>読み終わり：{{ $book->finished_at ?? '未入力' }}</p>

    <a href="/books">一覧へ戻る</a>
    <a href="/books/{{ $book->id }}/edit">編集</a>

    <form action="/books/{{ $book->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
    </form>
</body>
</html>
