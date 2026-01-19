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
    $books = Book::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $validated['user_id'] = auth()->id();

        Book::create($validated);

        return redirect()->route('books.index');
    }

    private function myBookOrFail(int $id): Book
    {
    return Book::where('user_id', auth()->id())
        ->where('id', $id)
        ->firstOrFail();
    }

    public function show(int $id)
    {
        $book = $this->myBookOrFail($id);
        return view('books.show', compact('book'));
    }

    public function edit(int $id)
    {
        $book = $this->myBookOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, int $id)
    {
        $book = $this->myBookOrFail($id);

        $validated = $request->validate($this->rules());
        $book->update($validated);

        return redirect('/books');
    }

    public function destroy(int $id)
    {
        $book = $this->myBookOrFail($id);
        $book->delete();

        return redirect('/books');
    }
}
