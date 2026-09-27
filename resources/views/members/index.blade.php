{{-- File: resources/views/members/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
    <h1>Daftar Anggota</h1>

    <p><a href="{{ route('members.create') }}" class="btn">+ Tambah Anggota</a></p>

    {{-- Form Pencarian Anggota --}}
    <form action="{{ route('members.index') }}" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama anggota...">
        <button type="submit" class="btn">Cari</button>
        @if(request('search'))
            <a href="{{ route('members.index') }}">Reset</a>
        @endif
    </form>

    @if (session('success'))
        <div class="alert alert-success" style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->nama }}</td>
                    <td>{{ $member->nim }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->nomor_telepon }}</td>
                    <td>
                        <span style="text-transform: uppercase; font-weight: bold;">
                            {{ $member->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('members.show', $member->id) }}">Detail</a>
                        |
                        <a href="{{ route('members.edit', $member->id) }}">Edit</a>
                        |
                        <form class="inline" action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus anggota ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data anggota.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination dengan mempertahankan parameter search --}}
    <div style="margin-top: 20px;">
        {{ $members->appends(request()->query())->links() }}
    </div>
@endsection