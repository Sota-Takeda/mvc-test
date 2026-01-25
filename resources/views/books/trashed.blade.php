<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>削除済み一覧</title>
</head>
<body>
    <h1>削除済み一覧</h1>

    <a href="{{ route('books.index') }}">一覧に戻る</a>

    @forelse ($books as $book)
        <div style="margin-top: 16px; padding: 12px; border: 1px solid #ccc;">
            <h2>{{ $book->title }}</h2>
            <p>削除日時：{{ $book->deleted_at }}</p>

            <form method="POST" action="{{ route('books.restore', $book->id) }}">
                @csrf
                @method('PATCH')
                <button type="submit">復元</button>
            </form>
        </div>
    @empty
        <p>削除済みの本はありません</p>
    @endforelse

    {{ $books->links('pagination::simple-default') }}
</body>
</html>
