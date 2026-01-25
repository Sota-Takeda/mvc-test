<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $query = Book::query()
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc');

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('author')) {
            $query->where('author', 'like', '%' . $request->author . '%');
        }

        $books = $query->paginate(10)->withQueryString();

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(StoreBookRequest $request)
    {
        Book::create([
            'user_id' => Auth::id(),
            ...$request->validated(),
        ]);

        return redirect()->route('books.index');
    }

    /**
     * IDでBookを取得（権限チェックはPolicyでやる）
     */
    private function findBookOrFail(int $id): Book
    {
        return Book::findOrFail($id);
    }

    public function show(int $id)
    {
        $book = $this->findBookOrFail($id);
        $this->authorize('view', $book); // ここでダメなら403

        return view('books.show', compact('book'));
    }

    public function edit(int $id)
    {
        $book = $this->findBookOrFail($id);
        $this->authorize('update', $book); // ここでダメなら403

        return view('books.edit', compact('book'));
    }

    public function update(UpdateBookRequest $request, int $id)
    {
        $book = $this->findBookOrFail($id);
        $this->authorize('update', $book); // ここでダメなら403

        $book->update($request->validated());

        return redirect()->route('books.index');
    }

    public function destroy(int $id)
    {
        $book = $this->findBookOrFail($id);
        $this->authorize('delete', $book); // ここでダメなら403

        $book->delete();

        return redirect()->route('books.index');
    }
}
