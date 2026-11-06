{{-- File: resources/views/loans/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')
    <h1>Tambah Peminjaman</h1>

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf

        <div>
            <label for="member_id">Anggota</label>
            <select name="member_id" id="member_id" required>
                <option value="">Pilih Anggota</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                        {{ $member->nama }}
                    </option>
                @endforeach
            </select>
            @error('member_id')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label>Petugas Pencatat</label>
            <em>{{ auth()->user()->name }} (otomatis dari akun yang login)</em>
        </div>

        <div>
            <label for="tanggal_pinjam">Tanggal Pinjam</label>
            <input type="date" id="tanggal_pinjam" name="tanggal_pinjam"
                   value="{{ old('tanggal_pinjam', now()->toDateString()) }}" required>
            @error('tanggal_pinjam')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="tanggal_kembali">Tanggal Kembali</label>
            <input type="date" id="tanggal_kembali" name="tanggal_kembali"
                   value="{{ old('tanggal_kembali', now()->addDays(7)->toDateString()) }}" required>
            @error('tanggal_kembali')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="book_ids">Buku (tahan Ctrl untuk memilih lebih dari satu)</label>
            <select name="book_ids[]" id="book_ids" multiple size="6" required>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}"
                        {{ in_array($book->id, old('book_ids', [])) ? 'selected' : '' }}>
                        {{ $book->judul }}
                    </option>
                @endforeach
            </select>
            @error('book_ids')
                <small style="color: red;">{{ $message }}</small>
            @enderror
            @error('book_ids.*')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-top: 15px;">
            <button type="submit">Simpan Peminjaman</button>
            <a href="{{ route('loans.index') }}">Batal</a>
        </div>
    </form>
@endsection