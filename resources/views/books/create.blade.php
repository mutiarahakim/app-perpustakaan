{{-- File: resources/views/books/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Buku Baru')

@section('content')
    <p><a href="{{ route('books.index') }}">&larr; Kembali ke daftar buku</a></p>

    <h1>Tambah Buku Baru</h1>

    {{-- Pastikan form, input, dan error validasi yang sudah ada sebelumnya tetap di sini --}}
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        
        <div>
            <label>Judul Buku:</label><br>
            <input type="text" name="judul" value="{{ old('judul') }}">
            @error('judul')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <div>
            <label>Penulis:</label><br>
            <input type="text" name="penulis" value="{{ old('penulis') }}">
            @error('penulis')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <div>
            <label>Penerbit:</label><br>
            <input type="text" name="penerbit" value="{{ old('penerbit') }}">
            @error('penerbit')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <div>
            <label>Tahun Terbit:</label><br>
            <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit') }}">
            @error('tahun_terbit')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <div>
            <label>Stok:</label><br>
            <input type="number" name="stok" value="{{ old('stok') }}">
            @error('stok')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <div>
            <label>Kategori:</label><br>
            <input type="text" name="kategori" value="{{ old('kategori') }}">
            @error('kategori')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <button type="submit" class="btn">Simpan Buku</button>
    </form>
@endsection