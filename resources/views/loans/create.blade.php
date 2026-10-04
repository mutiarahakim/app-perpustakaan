@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')
    <h1>Tambah Peminjaman Buku</h1>

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label for="member_id"><strong>Anggota:</strong></label><br>
            <select name="member_id" id="member_id" required style="width: 100%; padding: 8px; margin-top: 5px;">
                <option value="">-- Pilih Anggota --</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}">{{ $member->nama }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="tanggal_pinjam"><strong>Tanggal Pinjam:</strong></label><br>
            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ date('Y-m-d') }}" required style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="tanggal_kembali"><strong>Tanggal Harus Kembali:</strong></label><br>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali" required style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="book_id"><strong>Pilih Buku:</strong></label><br>
            <select name="book_id" id="book_id" required style="width: 100%; padding: 8px; margin-top: 5px;">
                <option value="">-- Pilih Buku --</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->judul }} (Stok: {{ $book->stok }})</option>
                @endforeach
            </select>
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn">Simpan Peminjaman</button>
            <a href="{{ route('loans.index') }}" style="margin-left: 10px;">Batal</a>
        </div>
    </form>
@endsection