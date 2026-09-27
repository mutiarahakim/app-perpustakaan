<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanItem;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['member', 'user', 'loanItems.book'])->paginate(10);

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $members = Member::where('status', 'aktif')->get();
        $books = Book::where('stok', '>', 0)->get();

        return view('loans.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'books' => 'required|array|min:1',
            'books.*' => 'exists:books,id',
        ]);

        DB::beginTransaction();

        try {
            $loan = Loan::create([
                'member_id' => $validated['member_id'],
                'user_id' => Auth::id() ?? 1, // Default ke user ID 1 jika belum pakai autentikasi login penuh
                'tanggal_pinjam' => $validated['tanggal_pinjam'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'status' => 'dipinjam',
            ]);

            foreach ($validated['books'] as $bookId) {
                LoanItem::create([
                    'loan_id' => $loan->id,
                    'book_id' => $bookId,
                ]);

                // Kurangi stok buku
                $book = Book::findOrFail($bookId);
                $book->decrement('stok');
            }

            DB::commit();

            return redirect()->route('loans.index')
                ->with('success', 'Transaksi peminjaman berhasil dicatat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function show(string $id)
    {
        $loan = Loan::with(['member', 'user', 'loanItems.book'])->findOrFail($id);

        return view('loans.show', compact('loan'));
    }

    public function edit(string $id)
    {
        $loan = Loan::with('loanItems')->findOrFail($id);
        $members = Member::all();
        $books = Book::all();

        return view('loans.edit', compact('loan', 'members', 'books'));
    }

    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);

        $validated = $request->validate([
            'tanggal_dikembalikan' => 'nullable|date',
            'status' => 'required|in:dipinjam,dikembalikan,terlambat',
        ]);

        // Jika status diubah menjadi dikembalikan dan tanggal dikembalikan diisi
        if ($validated['status'] == 'dikembalikan' && $loan->status != 'dikembalikan') {
            foreach ($loan->loanItems as $item) {
                $item->book->increment('stok');
            }
            if (empty($validated['tanggal_dikembalikan'])) {
                $validated['tanggal_dikembalikan'] = now()->toDateString();
            }
        }

        $loan->update($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Status peminjaman berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $loan = Loan::with('loanItems')->findOrFail($id);

        DB::beginTransaction();
        try {
            // Jika status masih dipinjam saat dihapus, kembalikan stok bukunya
            if ($loan->status == 'dipinjam') {
                foreach ($loan->loanItems as $item) {
                    $item->book->increment('stok');
                }
            }

            $loan->loanItems()->delete();
            $loan->delete();

            DB::commit();

            return redirect()->route('loans.index')
                ->with('success', 'Data peminjaman berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }
}