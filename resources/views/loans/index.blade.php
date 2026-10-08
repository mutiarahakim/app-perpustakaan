@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
    <h1>Daftar Peminjaman Buku</h1>

    <p><a href="{{ route('loans.create') }}" class="btn">+ Tambah Peminjaman</a></p>

    @if (session('success'))
        <div class="alert alert-success" style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Anggota</th>
                <th>Petugas</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Harus Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($loans as $loan)
                <tr>
                    <td>{{ $loan->id }}</td>
                    <td>{{ $loan->member->nama ?? '-' }}</td>
                    <td>{{ $loan->user->name ?? '-' }}</td>
                    <td>{{ $loan->tanggal_pinjam }}</td>
                    <td>{{ $loan->tanggal_kembali }}</td>
                    <td>
                        {{-- Badge status berwarna sesuai instruksi tugas --}}
                        @if ($loan->status === 'dikembalikan')
                            <span class="badge-success">Dikembalikan</span>
                        @elseif ($loan->status === 'dipinjam')
                            <span class="badge-warning">Dipinjam</span>
                        @else
                            <span class="badge-danger">Terlambat</span>
                        @endif
                    </td>
                    <td>
                        {{-- Tombol Kembalikan khusus jika status dipinjam --}}
                        @if ($loan->status === 'dipinjam')
                            <form action="{{ route('loans.kembalikan', $loan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" onclick="return confirm('Kembalikan buku ini?')" style="margin-right: 4px;">Kembalikan</button>
                            </form>
                        @endif

                        <a href="{{ route('loans.show', $loan->id) }}">Detail</a>
                        |
                        <a href="{{ route('loans.edit', $loan->id) }}">Edit</a>
                        |
                        <form class="inline" action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus data peminjaman ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data peminjaman buku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination links yang sudah diperbaiki --}}
    <div style="margin-top: 20px;">
        {{ $loans->links() }}
    </div>
@endsection