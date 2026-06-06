# Demo Scenario Skripsi - Nad's Kitchen

Dokumen ini membantu demo alur end-to-end tanpa memperluas scope skripsi.

## A. Customer Pesan Catering
1. Buka dashboard public (`/`).
2. Pilih menu yang tersedia.
3. Tambahkan menu ke keranjang.
4. Buka checkout dan isi data pemesanan.
5. Submit pesanan.
6. Sistem menampilkan invoice.
7. Simpan nomor invoice untuk pelacakan status.

## B. Admin Konfirmasi Pesanan
1. Login admin (`admin@nadskitchen.test`).
2. Buka daftar pesanan admin.
3. Filter/cek pesanan dengan status `Baru`.
4. Buka detail pesanan.
5. Ubah status dari `Baru` ke `Dikonfirmasi`.

## C. Dapur Melihat Produksi
1. Login dapur (`dapur@nadskitchen.test`).
2. Buka menu `Pesanan Produksi`.
3. Pastikan hanya pesanan `Dikonfirmasi`/`Diproses` yang tampil.
4. Buka detail produksi.
5. Cek kebutuhan bahan per pesanan.

## D. Dapur Melihat Rekap Bahan
1. Buka menu `Rekap Bahan`.
2. Pilih `Tanggal Acara`.
3. Lihat total bahan gabungan.
4. Gunakan fitur print bila diperlukan.

## Data Demo yang Tersedia
Seeder aktif saat `php artisan migrate:fresh --seed`:
- `AdminUserSeeder` (user admin)
- `KitchenUserSeeder` (user dapur)
- `MenuCategorySeeder` (kategori menu)
- `MenuSeeder` (menu aktif)
- `IngredientSeeder` (bahan)
- `MenuIngredientSeeder` (komposisi bahan/BOM)
- `DemoOrderSeeder` (pesanan contoh dengan status `new`, `confirmed`, `processing`, `completed`, `cancelled`)

Implikasi untuk demo:
- Ada minimal satu pesanan `new`.
- Ada minimal satu pesanan `confirmed`/`processing`.
- Rekap bahan dapat muncul untuk tanggal acara yang sesuai.

## Checklist Black-box Test Manual
- [ ] Customer dapat melihat menu.
- [ ] Customer dapat tambah menu ke cart.
- [ ] Customer tidak bisa checkout jika cart kosong.
- [ ] Customer mendapat invoice setelah checkout.
- [ ] Customer bisa cek status dengan nomor invoice.
- [ ] Admin bisa login.
- [ ] Admin bisa mengubah status pesanan.
- [ ] Dapur hanya melihat pesanan `confirmed/processing`.
- [ ] Rekap bahan muncul untuk tanggal acara yang sesuai.
- [ ] Menu tanpa BOM diberi warning di area admin/kitchen.
- [ ] Format bahan `potong/pcs` tidak tampil desimal saat bulat.
- [ ] Print rekap bahan rapi.
- [ ] Print detail produksi rapi.

## Catatan Batas Scope
Demo ini tetap dalam ruang lingkup skripsi:
- Tidak menambah payment gateway baru.
- Tidak menambah login customer.
- Tidak menambah stok real-time kompleks.
- Tidak menambah mobile app.
- Tidak menambah prediksi/peramalan bahan.
- Tidak mengubah schema database.
