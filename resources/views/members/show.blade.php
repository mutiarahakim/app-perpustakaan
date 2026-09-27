{{-- File: resources/views/members/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Anggota')

@section('content')
    <p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar anggota</a></p>

    <h1>Detail Anggota: {{ $member->nama }}</h1>

    <ul>
        <li><strong>ID:</strong> {{ $member->id }}</li>
        <li><strong>Nama:</strong> {{ $member->nama }}</li>
        <li><strong>NIM:</strong> {{ $member->nim }}</li>
        <li><strong>Email:</strong> {{ $member->email }}</li>
        <li><strong>Nomor Telepon:</strong> {{ $member->nomor_telepon }}</li>
        <li><strong>Alamat:</strong> {{ $member->alamat }}</li>
        <li><strong>Status:</strong> <span style="text-transform: uppercase; font-weight: bold;">{{ $member->status }}</span></li>
        <li><strong>Terdaftar Pada:</strong> {{ $member->created_at }}</li>
    </ul>

    <p>
        <a href="{{ route('members.edit', $member->id) }}" class="btn">Edit Anggota Ini</a>
    </p>
@endsection