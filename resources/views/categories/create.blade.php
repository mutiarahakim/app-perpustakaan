{{-- File: resources/views/categories/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Kategori Baru')

@section('content')
    <p><a href="{{ route('categories.index') }}">&larr; Kembali ke daftar kategori</a></p>

    <h1>Tambah Kategori Baru</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div>
            <label>Nama Kategori:</label><br>
            <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}">
            @error('nama_kategori')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <div>
            <label>Deskripsi:</label><br>
            <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <button type="submit" class="btn">Simpan Kategori</button>
    </form>
@endsection