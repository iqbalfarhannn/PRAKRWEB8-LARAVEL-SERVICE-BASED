<div align="center">

# 🧑‍💼 Pegawai CRUD API

### RESTful API Manajemen Data Pegawai dengan Laravel Service Pattern

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)
[![Postman](https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=postman&logoColor=white)](https://www.postman.com)

Tugas Mata Kuliah **Rekayasa Web** — Implementasi CRUD dengan Service Layer Pattern

</div>

---

## 📋 Daftar Isi

- [Tentang Project](#-tentang-project)
- [Struktur Database](#-struktur-database)
- [Arsitektur](#-arsitektur)
- [Aturan Validasi](#-aturan-validasi)
- [Instalasi](#-instalasi)
- [Dokumentasi API](#-dokumentasi-api)
- [Contoh Request & Response](#-contoh-request--response)
- [Pengujian](#-pengujian)
- [Tech Stack](#-tech-stack)
- [Identitas](#-identitas)

---

## 📖 Tentang Project

Project ini merupakan implementasi **RESTful API CRUD (Create, Read, Update, Delete)** untuk manajemen data pegawai, dibangun menggunakan **Laravel** dengan pola **Service Layer** — memisahkan logika bisnis (Service) dari logika HTTP (Controller) agar kode lebih rapi, mudah diuji, dan mudah dikembangkan.

Setiap data pegawai melewati validasi ketat sebelum disimpan ke database, memastikan integritas data seperti format NIP, panjang nama, dan keunikan email.

---

## 🗄 Struktur Database

Tabel `pegawai` terdiri dari kolom-kolom berikut:

| Kolom | Tipe Data | Keterangan |
|---|---|---|
| `id` | bigint, primary key | Auto increment |
| `nip` | string(18), unique | Nomor Induk Pegawai |
| `nama_lengkap` | string(100) | Nama lengkap pegawai |
| `jabatan` | string(50) | Jabatan/posisi pegawai |
| `email` | string, unique | Alamat email pegawai |
| `created_at` | timestamp | Waktu data dibuat |
| `updated_at` | timestamp | Waktu data terakhir diubah |

---

## 🏗 Arsitektur

Project ini mengikuti pola **Service Layer**, di mana Controller tidak langsung berinteraksi dengan Model, melainkan melalui Service:

```
Request  →  Controller (validasi & response)  →  Service (logika bisnis)  →  Model  →  Database
```

```
app/
├── Http/Controllers/API/
│   └── PegawaiController.php   # Menangani request HTTP & validasi
├── Models/
│   └── Pegawai.php             # Representasi tabel pegawai
├── Services/
│   └── PegawaiService.php      # Logika CRUD ke database
database/
└── migrations/
    └── xxxx_create_pegawai_table.php
routes/
└── api.php                     # Routing endpoint API
```

---

## ✅ Aturan Validasi

| Field | Aturan |
|---|---|
| **NIP** | Wajib diisi, hanya berupa angka, panjang 8–18 digit, unik |
| **Nama Lengkap** | Wajib diisi, teks, minimal 3 karakter, maksimal 100 karakter |
| **Jabatan** | Wajib diisi, teks, minimal 3 karakter, maksimal 50 karakter |
| **Email** | Wajib diisi, format email valid, unik |

> 💡 Saat update data, validasi `unique` pada NIP dan email mengecualikan data milik pegawai itu sendiri, sehingga pegawai tetap bisa mengubah data lain tanpa ditolak karena "memakai NIP/email miliknya sendiri".

---

## ⚙️ Instalasi

```bash
# 1. Clone repository
git clone https://github.com/iqbalfarhannn/PRAKRWEB8-LARAVEL-SERVICE-BASED.git
cd PRAKRWEB8-LARAVEL-SERVICE-BASED

# 2. Install dependencies
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Atur koneksi database di file .env, lalu jalankan migration
php artisan migrate

# 6. Jalankan server lokal
php artisan serve
```

Server akan berjalan di `http://127.0.0.1:8000`.

---

## 📡 Dokumentasi API

Base URL: `http://127.0.0.1:8000/api/pegawai`

| Method | Endpoint | Keterangan |
|---|---|---|
| `GET` | `/api/pegawai` | Menampilkan seluruh data pegawai |
| `GET` | `/api/pegawai/{id}` | Menampilkan satu data pegawai berdasarkan ID |
| `POST` | `/api/pegawai` | Menambahkan data pegawai baru |
| `PUT` | `/api/pegawai/{id}` | Memperbarui data pegawai berdasarkan ID |
| `DELETE` | `/api/pegawai/{id}` | Menghapus data pegawai berdasarkan ID |

---

## 🔍 Contoh Request & Response

### ➕ Create Pegawai — Sukses

**Request**
```http
POST /api/pegawai
Content-Type: application/json
```
```json
{
  "nip": "198501012010011001",
  "nama_lengkap": "Budi Santoso",
  "jabatan": "Staff IT",
  "email": "budi.santoso@example.com"
}
```

**Response** `201 Created`
```json
{
  "id": 1,
  "nip": "198501012010011001",
  "nama_lengkap": "Budi Santoso",
  "jabatan": "Staff IT",
  "email": "budi.santoso@example.com",
  "created_at": "2026-06-18T12:00:00.000000Z",
  "updated_at": "2026-06-18T12:00:00.000000Z"
}
```

### ❌ Create Pegawai — Gagal Validasi

**Request**
```json
{
  "nip": "12ab",
  "nama_lengkap": "Bu",
  "jabatan": "IT",
  "email": "bukanemail"
}
```

**Response** `422 Unprocessable Entity`
```json
{
  "message": "The nip field must be between 8 and 18 digits. (and 3 more errors)",
  "errors": {
    "nip": ["The nip field must be between 8 and 18 digits."],
    "nama_lengkap": ["The nama lengkap field must be at least 3 characters."],
    "jabatan": ["The jabatan field must be at least 3 characters."],
    "email": ["The email field must be a valid email address."]
  }
}
```

---

## 🧪 Pengujian

Pengujian API dilakukan menggunakan **Postman**, mencakup skenario berhasil (CRUD normal) maupun skenario gagal validasi (NIP tidak valid, email duplikat, field kosong, dll).

📁 Koleksi Postman dapat ditemukan di: [`/postman/pegawai-crud.postman_collection.json`](./postman/pegawai-crud.postman_collection.json)

📸 Screenshot hasil pengujian dapat ditemukan di folder [`/docs/screenshots`](./docs/screenshots)

---

## 🛠 Tech Stack

| Teknologi | Fungsi |
|---|---|
| Laravel | Framework backend & routing API |
| MySQL | Database relasional |
| Postman | Pengujian endpoint API |
| Git & GitHub | Version control & kolaborasi |

---

## 👤 Identitas

| | |
|---|---|
| **Nama** | _[Farhan Muhammad Iqbal]_ |
| **NIM** | _[2300018164]_ |
| **Kelas** | _[A]_ |
| **Mata Kuliah** | Rekayasa Web |

---

<div align="center">

Dibuat sebagai pemenuhan tugas praktikum Rekayasa Web

</div>
