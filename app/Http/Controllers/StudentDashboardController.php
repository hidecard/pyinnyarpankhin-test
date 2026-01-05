<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    /**
     * Check if student is authenticated
     */
    private function checkStudentAuth()
    {
        if (!session('student_id')) {
            return redirect()->route('login')->with('error', 'Please log in to access the student dashboard.');
        }
        return null;
    }

    /**
     * Display the student dashboard
     */
    public function dashboard(Request $request)
    {
        $authCheck = $this->checkStudentAuth();
        if ($authCheck) {
            return $authCheck;
        }

        $studentName = session('student_name');
        $search = $request->input('search');
        $searchType = $request->input('search_type');

        $query = Book::query();

        if ($search) {
            $query->search($search, $searchType);
        }

        $recentBooks = $query->latest()->take(6)->get();

        return view('student.dashboard', compact('studentName', 'recentBooks', 'search', 'searchType'));
    }

    /**
     * Display books with search functionality
     */
    public function books(Request $request)
    {
        $authCheck = $this->checkStudentAuth();
        if ($authCheck) {
            return $authCheck;
        }

        $search = $request->input('search');
        $query = Book::query();

        if ($search) {
            $query->search($search);
        }

        $books = $query->latest()->paginate(12);
        $studentName = session('student_name');

        return view('student.books', compact('books', 'search', 'studentName'));
    }

    /**
     * Display a specific book details
     */
    public function showBook(Book $book)
    {
        $authCheck = $this->checkStudentAuth();
        if ($authCheck) {
            return $authCheck;
        }

        $studentName = session('student_name');
        return view('student.book-show', compact('book', 'studentName'));
    }


}
