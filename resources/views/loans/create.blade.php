{{-- Contoh struktur dalam form di resources/views/loans/create.blade.php --}}
<form action="{{ route('loans.store') }}" method="POST">
    @csrf

    <!-- Input Anggota / Member -->
    <div class="mb-4">
        <label for="member_id" class="block text-gray-700 font-semibold mb-2">Anggota</label>
        <select name="member_id" id="member_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
            <option value="">Pilih Anggota</option>
            @foreach($members as $member)
                <option value="{{ $member->id }}">{{ $member->nama }}</option>
            @endforeach
        </select>
    </div>

    <!-- Informasi Petugas (Otomatis dari user yang login sesuai Langkah 7) -->
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Petugas Pencatat</label>
        <p class="text-gray-600 bg-gray-100 p-2 rounded border">
            <em>{{ auth()->user()->name }} (otomatis dari akun yang login).</em>
        </p>
    </div>

    <!-- Input Tanggal, Buku, dll -->
    <!-- ... -->

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Peminjaman</button>
</form>