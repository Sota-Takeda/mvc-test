<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required', 'string'],
        ];
    }

    public function index()
    {
        // 新しい順に並べる
        $posts = Post::orderBy('created_at', 'desc')->get();

        // 一覧画面(view)に渡す
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        //新規投稿フォームを表示する
        return view('posts.create');
    }

    public function store(Request $request)
    {
    Post::create($request->validate($this->rules()));
    return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));

    }
    public function update(Request $request, Post $post)
    {
        $post->update($request->validate($this->rules()));
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
