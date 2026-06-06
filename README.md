# Nad's Kitchen Order System

Aplikasi web untuk pemesanan catering, pengelolaan pesanan, invoice, perhitungan kebutuhan bahan berdasarkan BOM, dan dashboard dapur.

## Tech Stack
- Laravel
- Laravel Blade
- MySQL
- Docker
- Tailwind CSS
- Eloquent ORM

## Fitur Utama

### Customer
- Melihat menu
- Cart
- Checkout tanpa login
- Invoice
- Cek status pesanan

### Admin
- Login
- Dashboard
- Kelola menu
- Kelola kategori
- Kelola bahan
- Kelola BOM
- Kelola pesanan
- Update status
- Invoice admin
- Laporan sederhana

### Dapur
- Login
- Dashboard dapur
- Pesanan produksi
- Detail produksi
- Rekap bahan per tanggal

## Cara Menjalankan Lokal

### Dengan Docker
```bash
docker compose up -d --build
docker compose exec app composer install
docker compose exec app cp .env.example .env
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate:fresh --seed
```

### Frontend Assets
Jika Node dijalankan dari host:
```bash
npm install
npm run dev
```

Jika Node dijalankan dari container, sesuaikan dengan environment Docker Anda.

## Credential Demo

### Admin
- email: `admin@nadskitchen.test`
- password: `password`

### Dapur
- email: `dapur@nadskitchen.test`
- password: `password`

## URL
- Public: http://localhost:8000
- Login: http://localhost:8000/login
- Admin Dashboard: http://localhost:8000/admin/dashboard
- Kitchen Dashboard: http://localhost:8000/kitchen/dashboard
- phpMyAdmin/Adminer: http://localhost:8080

## Alur Singkat
1. Customer pesan.
2. Admin konfirmasi.
3. Sistem hitung bahan.
4. Dapur produksi.
5. Admin lihat laporan.

## Panduan Demo Skripsi
Lihat skenario demo lengkap dan checklist black-box di:
- `docs/demo-scenario.md`

## Seeder Demo Final
Seeder berikut dipanggil otomatis saat `migrate:fresh --seed`:
- `AdminUserSeeder`
- `KitchenUserSeeder`
- `MenuCategorySeeder`
- `MenuSeeder`
- `IngredientSeeder`
- `MenuIngredientSeeder`
- `DemoOrderSeeder`
