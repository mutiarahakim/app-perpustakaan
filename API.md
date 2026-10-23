# Dokumentasi REST API - Aplikasi Perpustakaan

Dokumentasi ini mencakup daftar endpoint REST API yang dibangun menggunakan Laravel 12 untuk pengelolaan data buku, anggota, peminjaman, dan statistik perpustakaan.

---

## Base URL
## Daftar Endpoint API

### 1. Buku (`/api/books`)

| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET` | `/api/books` | Mengambil daftar seluruh buku (dengan pagination & filter pencarian). |
| `GET` | `/api/books/{id}` | Mengambil detail data buku berdasarkan ID. |
| `POST` | `/api/books` | Menambah data buku baru. |
| `PUT` | `/api/books/{id}` | Memperbarui data buku berdasarkan ID. |
| `DELETE`| `/api/books/{id}` | Menghapus data buku berdasarkan ID. |

---

### 2. Anggota (`/api/members`)

| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET` | `/api/members` | Mengambil daftar seluruh anggota perpustakaan (dengan pagination). |
| `GET` | `/api/members/{id}` | Mengambil detail data anggota berdasarkan ID. |

---

### 3. Peminjaman (`/api/loans`)

| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET` | `/api/loans` | Mengambil daftar riwayat peminjaman buku. |
| `POST` | `/api/loans` | Mencatat transaksi peminjaman buku baru. |
| `PUT` | `/api/loans/{id}/kembalikan` | Mengubah status peminjaman menjadi dikembalikan. |

---

### 4. Statistik (`/api/stats`)

| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET` | `/api/stats` | Mengambil ringkasan statistik (total buku, anggota, & peminjaman aktif). |

---

## Contoh Response JSON

### Contoh Response Statistik (`GET /api/stats`)
```json
{
    "total_buku": 15,
    "total_anggota": 8,
    "peminjaman_aktif": 3
}
Contoh Response Daftar Anggota (GET /api/members)
JSON
{
    "data": [
        {
            "id": 1,
            "nama": "Ahmad Fauzi",
            "nim": "3125600001",
            "email": "fauzi@student.pens.ac.id",
            "nomor_telepon": "081234567890",
            "alamat": "Surabaya",
            "status": "aktif",
            "created_at": "2026-10-23T10:00:00.000000Z",
            "updated_at": "2026-10-23T10:00:00.000000Z"
        }
    ],
    "links": {
        "first": "[http://127.0.0.1:8000/api/members?page=1](http://127.0.0.1:8000/api/members?page=1)",
        "last": "[http://127.0.0.1:8000/api/members?page=1](http://127.0.0.1:8000/api/members?page=1)",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}