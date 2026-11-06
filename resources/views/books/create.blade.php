<!-- File: resources/views/books/create.blade.php -->
@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <h1>Tambah Buku Baru</h1>

    {{-- WAJIB ada enctype="multipart/form-data" karena ada upload file sampul --}}
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="judul">Judul Buku:</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required>
            @error('judul')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="category_id">Kategori:</label>
            <select id="category_id" name="category_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="penulis">Penulis:</label>
            <input type="text" id="penulis" name="penulis" value="{{ old('penulis') }}" required>
            @error('penulis')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="penerbit">Penerbit:</label>
            <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit') }}" required>
            @error('penerbit')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="tahun_terbit">Tahun Terbit (4 digit):</label>
            <input type="number" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}" required>
            @error('tahun_terbit')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="isbn">ISBN (Opsional):</label>
            <input type="text" id="isbn" name="isbn" value="{{ old('isbn') }}">
            @error('isbn')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="stok">Stok:</label>
            <input type="number" id="stok" name="stok" value="{{ old('stok', 0) }}" min="0" required>
            @error('stok')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="sampul">Sampul Buku (Opsional):</label>
            <input type="file" id="sampul" name="sampul" accept="image/png, image/jpeg, image/jpg">
            @error('sampul')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-top: 15px;">
            <button type="submit">Simpan Buku</button>
            <a href="{{ route('books.index') }}">Batal</a>
        </div>
    </form>
@endsection