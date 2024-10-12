<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $books = Book::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->get();

        return inertia('Books/Index', ['books' => $books]);
    }


    public function show(Book $book)
    {
        return inertia('Books/Show', ['book' => $book]);
    }

    public function create()
    {
        return inertia('Books/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required',
            'published_year' => 'required|integer|digits:4',
            'status' => 'required|in:available,borrowed,reserved'
        ]);

        Book::create($request->all());

        return redirect()->route('books.index');
    }

    public function edit(Book $book)
    {
        return inertia('Books/Edit', ['book' => $book]);
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required',
            'published_year' => 'required|integer|digits:4',
            'status' => 'required|in:available,borrowed,reserved'
        ]);

        $book->update($request->all());

        return redirect()->route('books.index', [], 303);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index', [], 303);

    }
}
