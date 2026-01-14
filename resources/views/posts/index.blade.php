<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>投稿一覧</title>
</head>
<body>
    <h1>投稿一覧表</h1>

    @forelse($posts as $post)
        <div>
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->body }}</p>
            <a href="/posts/{{ $post->id }}/edit">編集</a>

            <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </div>
    @empty
        <p>投稿がありません</p>
    @endforelse
</body>
</html>
