<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>新規投稿</title>
</head>
<body>
    <h1>新規投稿</h1>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('posts.store') }}">>
        @csrf

        <div>
            <label>タイトル</label><br>
            <input type="text" name="title" value="{{ old('title') }}">
        </div>

        <div>
            <label>本文</label><br>
            <textarea name="body"{{ old('body') }}></textarea>
        </div>

        <button type="submit">投稿</button>
    </form>
</body>
</html>
