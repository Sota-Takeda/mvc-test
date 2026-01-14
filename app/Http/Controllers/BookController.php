<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // 共通のバリデーションルール（store/updateで重複させない）
    private function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'author'      => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:want,reading,done'],
            'memo'        => ['nullable', 'string'],
            'started_at'  => ['nullable', 'date'],
            'finished_at' => ['nullable', 'date'],
        ];
    }

    public function index()
    {
        // 新しい順に見せたいので created_at を降順にする
        $books = Book::latest()->get();

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        Book::create($validated);

        return redirect()->route('books.index');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate($this->rules());

        $book->update($validated);

        return redirect('/books');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/books');
    }
}
