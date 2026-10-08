<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Book;

class LoanController extends Controller
{
    public function index()
    {
        // Mengambil data peminjaman beserta relasi member dan user (petugas) dengan pagination
        $loans = Loan::with(['member', 'user'])->paginate(10);

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $members = Member::all();
        $books = Book::all();

        return view('loans.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|integer|exists:members,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'integer|exists:books,id',
        ]);

        $loan = Loan::create([
            'member_id' => $validated['member_id'],
            'user_id' => auth()->id(),
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
        ]);

        // Jika ada relasi buku (sync), tambahkan di sini jika diperlukan
        // $loan->books()->sync($validated['book_ids']);

        return redirect()->route('loans.index')->with('success', 'Data peminjaman berhasil ditambahkan.');
    }
}