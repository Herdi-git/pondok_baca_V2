<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminBookController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));
        $books = Book::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'ilike', "%{$search}%")
                        ->orWhere('author', 'ilike', "%{$search}%")
                        ->orWhere('category', 'ilike', "%{$search}%");
                });
            })
            ->orderBy('title')
            ->paginate(20)
            ->withQueryString();

        return view('admin.books.index', compact('books', 'search'));
    }

    public function create(): View
    {
        return view('admin.books.form', ['book' => new Book(), 'formAction' => route('admin.books.store', absolute: false)]);
    }

    public function store(Request $request): RedirectResponse
    {
        Book::create($this->validated($request));

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book): View
    {
        return view('admin.books.form', ['book' => $book, 'formAction' => route('admin.books.update', [$book], absolute: false)]);
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $book->update($this->validated($request, $book));

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }

    private function validated(Request $request, ?Book $book = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('books', 'title')->ignore($book)],
            'author' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:fiksi,non-fiksi,sains,anak,sejarah'],
            'status' => ['required', 'in:available,borrowed'],
            'spine_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);
    }
}