<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->filled('judul')) {
            $query->where('judul', 'like', '%'.$request->query('judul').'%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->query('category_id'));
        }

        $books = $query->paginate(10);

        return BookResource::collection($books);
    }

    // ... method lainnya (store, show, update, destroy)
}