# Tugas 5 - Aplikasi To-Do List Berbasis PHP

## Deskripsi
Norbertus Wempy Junior Keraf/225314043
Ini adalah proyek aplikasi to-do list berbasis PHP dan MySQL. Pengguna dapat melakukan login dan mengelola daftar kegiatan mereka sendiri. Data pengguna dan kegiatan disimpan di database MySQL, dengan autentikasi sederhana.

---

## Struktur Direktori

```
Kumpulkan/
├── php_files/
│   ├── database.php
│   ├── kegiatan.php
│   ├── login.php
│   └── process.php
├── db_schema/
│   └── platform.sql
├── screenshots/
│   ├── 1.png
│   ├── 2.png
│   ├── 3.png
│   ├── 4.png
│   ├── 5.png
│   ├── 6.png
│   ├── 7.png
│   └── 8.png
│   └── 9.png 
└── README.md
```

---

## File PHP

Berada dalam folder `php_files/`:

- `database.php` — Koneksi ke database MySQL.
- `kegiatan.php` — Halaman utama setelah login, menampilkan dan mengelola kegiatan.
- `login.php` — Form dan logika login user.
- `process.php` — Menangani proses tambah/hapus/update kegiatan.

---

## Skema Database

File `platform.sql` di folder `db_schema/` berisi dump database `Platform`, terdiri dari dua tabel:

### Tabel `User`
- `id` INT PRIMARY KEY AUTO_INCREMENT
- `username` VARCHAR(50)
- `password` VARCHAR(50) (dalam format hash MD5)

### Tabel `ToDoList`
- `id_kegiatan` INT PRIMARY KEY AUTO_INCREMENT
- `kegiatan` VARCHAR(30)
- `status` VARCHAR(30) DEFAULT 'belum selesai'
- `user_id` INT (relasi ke `User.id`)

---

## Screenshot

Berada dalam folder `screenshots/`:

- `1.png` hingga `8.png` — Menampilkan tahapan penggunaan aplikasi (login, tampilan kegiatan, tambah/hapus kegiatan, dsb).

---

## Cara Menjalankan

1. Import `platform.sql` ke MySQL melalui phpMyAdmin.
2. Tempatkan semua file PHP ke dalam folder `htdocs/` jika menggunakan XAMPP.
3. Jalankan Apache dan MySQL.
4. Akses aplikasi melalui `http://localhost/php_files/login.php`.
5. Login dengan akun yang tersedia atau tambahkan sendiri melalui database.

---

## Catatan

- Password disimpan dalam format MD5.
- Session digunakan untuk menjaga autentikasi user.
- Fitur: login, tambah kegiatan, tandai selesai, hapus kegiatan.
