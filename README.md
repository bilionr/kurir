# Kurir API - Manual Instruction

## Cara Menjalankan Aplikasi
Jangan lupa untuk melakukan langkah-langkah berikut sebelum menjalankan aplikasi:

1. Buat file `.env`  
   Salin (copy) file contoh environment:
   ```bash
   cp .env.example .env
   ```
   
2. Setup database

Buka file .env dan atur kredensial database Anda (contoh: DB_DATABASE=kurir_db, DB_USERNAME=root, dll). Pastikan database tersebut sudah Anda buat sebelumnya di MySQL/DBMS Anda.

3. Generate App Key

```bash
php artisan key:generate
```
4. Jalankan Migrasi

Buat tabel di dalam database Anda:

```bash
php artisan migrate
```
5. Cara Menguji CRUD:

Test Tambah Data (Create)

```bash
php artisan test --filter test_tambah
```
Catatan: Setelah menjalankan perintah ini, cek database client untuk memverifikasi apakah data baru berhasil ditambahkan.

Test Ubah Data (Update)

```bash
php artisan test --filter test_update
```

Test Hapus Data (Delete)

```bash
php artisan test --filter test_hapus
```
Catatan: Setelah menjalankan perintah ini, cek database untuk terakhir kalinya guna memverifikasi apakah data tersebut benar-benar telah hilang/dihapus.

6. Cara Menguji Pencarian (Search) & Filter
Untuk menguji fitur pencarian dan filter pada API, Anda perlu mengisi database dengan data dummy terlebih dahulu.

Jalankan Seeder database

Masukkan puluhan data dummy secara acak:

```bash
php artisan db:seed
```
Nyalakan server lokal

```bash
php artisan serve
```
Lihat semua data

Buka browser Anda (atau gunakan aplikasi seperti Postman) dan akses URL:

```bash
http://127.0.0.1:8000/kurirs
```

Test Pencarian Nama

Pilih salah satu nama dari hasil yang muncul di layar, lalu coba lakukan pencarian menggunakan parameter ?search (atau sesuai dengan kode Anda, misal ?nama):

```bash
http://127.0.0.1:8000/kurirs?search=budi (ganti 'budi' dengan sebagian nama yang ingin dicari)
```

Test Filter Level

Coba panggil hanya data kurir yang berada di level tertentu (misalnya level 1) dengan menambahkan parameter ?level:

```
http://127.0.0.1:8000/kurirs?level=1
```
