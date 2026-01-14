<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>編集</title>
    </head>
    <body>
        <h1>編集</h1>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="/posts/{{ $post->id }}">
            @csrf
            @method('PUT')

            <div>
                <label>タイトル</label><br>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}">
            </div>

            <div>
                <label>本文</label><br>
                <textarea name="body">{{ old('body', $post->body) }}</textarea>
            </div>

            <button type="submit">更新</button>
        </form>

        <p><a href="/posts">一覧へ戻る</a></p>
    </body>
</html>
