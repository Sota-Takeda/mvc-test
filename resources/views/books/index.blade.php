<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>読書ログ</title>
        <style>
            /* pagination領域を横並びにする（入れ子構造でも確実） */
            .pagination,
            .pagination * {
            display: inline-block;
            }

            /* 余白だけ整える */
            .pagination a,
            .pagination span {
            margin-right: 12px;
            }
        </style>
    </head>
    <body>
        <h1>読書ログ一覧</h1>

        <a href="/books/create">新規登録</a>

        <form method="GET" action="{{ route('books.index') }}">
            <input
                type="text"
                name="title"
                value="{{ request('title') }}"
                placeholder="タイトルで検索"
            >

            <input
                type="text"
                name="author"
                value="{{ request('author') }}"
                placeholder="著者で検索"
            >

            <button type="submit">検索</button>
        </form>

        @forelse ($books as $book)
            <div style="margin-top: 16px; padding: 12px; border: 1px solid #ccc;">
                <h2>{{ $book->title }}</h2>
                <p>著者：{{ $book->author ?? '未入力' }}</p>
                <p>ステータス：{{ $book->status }}</p>
                <a href="/books/{{ $book->id }}/edit">編集</a>
                <a href="/books/{{ $book->id }}">詳細</a>

                <form action="/books/{{ $book->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </div>
        @empty
            <p>まだ本が登録されていません</p>
        @endforelse

        <div class="pagination">
            {{ $books->links('pagination::simple-default') }}
        </div>

    </body>
</html>

