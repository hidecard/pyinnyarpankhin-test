<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:10240',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'author' => $request->author,
        ];

        // Handle file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('books/files', 'public');
            $data['file_path'] = $filePath;
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('books/covers', 'public');
            $data['cover_image_path'] = $imagePath;
        }

        Book::create($data);

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:204800',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'author' => $request->author,
        ];

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file
            if ($book->file_path) {
                Storage::disk('public')->delete($book->file_path);
            }
            $filePath = $request->file('file')->store('books/files', 'public');
            $data['file_path'] = $filePath;
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old image
            if ($book->cover_image_path) {
                Storage::disk('public')->delete($book->cover_image_path);
            }
            $imagePath = $request->file('cover_image')->store('books/covers', 'public');
            $data['cover_image_path'] = $imagePath;
        }

        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Delete associated files
        if ($book->file_path) {
            Storage::disk('public')->delete($book->file_path);
        }
        if ($book->cover_image_path) {
            Storage::disk('public')->delete($book->cover_image_path);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }
}

