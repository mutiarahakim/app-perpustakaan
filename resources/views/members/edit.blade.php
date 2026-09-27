{{-- File: resources/views/members/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')
    <p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar anggota</a></p>

    <h1>Edit Data Anggota</h1>

    <form action="{{ route('members.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nama:</label><br>
            <input type="text" name="nama" value="{{ old('nama', $member->nama) }}">
            @error('nama')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <div>
            <label>NIM:</label><br>
            <input type="text" name="nim" value="{{ old('nim', $member->nim) }}">
            @error('nim')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <div>
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email', $member->email) }}">
            @error('email')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <div>
            <label>Nomor Telepon:</label><br>
            <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $member->nomor_telepon) }}">
            @error('nomor_telepon')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <div>
            <label>Alamat:</label><br>
            <textarea name="alamat">{{ old('alamat', $member->alamat) }}</textarea>
            @error('alamat')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <div>
            <label>Status:</label><br>
            <select name="status">
                <option value="aktif" {{ old('status', $member->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status', $member->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            @error('status')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <button type="submit" class="btn">Perbarui Anggota</button>
    </form>
@endsection