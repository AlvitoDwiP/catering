# USER GUIDE - Nad's Kitchen Order System

## 1. Panduan Customer
1. Buka dashboard public di `http://localhost:8000`.
2. Lihat daftar menu rekomendasi atau buka halaman menu.
3. Buka detail menu, lalu tambahkan ke keranjang sesuai minimum order.
4. Buka halaman keranjang untuk update jumlah atau hapus item.
5. Lanjut ke checkout dan isi data customer + data acara.
6. Review pesanan, lalu submit order.
7. Sistem menampilkan halaman invoice setelah order berhasil dibuat.
8. Untuk cek status pesanan kapan pun, gunakan menu cek pesanan dan masukkan nomor invoice.

## 2. Panduan Admin
1. Login admin di `http://localhost:8000/login`.
2. Buka dashboard admin untuk melihat ringkasan pesanan.
3. Kelola kategori menu pada menu **Kategori Menu**.
4. Kelola menu pada menu **Menu**.
5. Kelola bahan pada menu **Bahan**.
6. Kelola komposisi menu (BOM) dari aksi **Komposisi** di daftar menu.
7. Buka menu **Pesanan** untuk melihat daftar order customer.
8. Buka detail order dan ubah status pesanan sesuai proses operasional.
9. Buka invoice admin dari detail order jika diperlukan.
10. Buka menu **Laporan** untuk melihat ringkasan laporan pesanan.

## 3. Panduan Dapur
1. Login dapur di `http://localhost:8000/login`.
2. Buka dashboard dapur di `http://localhost:8000/kitchen/dashboard`.
3. Lihat daftar pesanan produksi (status Dikonfirmasi dan Diproses).
4. Buka detail produksi untuk melihat data acara, item menu, dan kebutuhan bahan.
5. Buka rekap bahan per tanggal untuk melihat total kebutuhan bahan gabungan.
6. Gunakan tombol print pada halaman rekap bahan untuk cetak daftar produksi.

## 4. Catatan Status Pesanan
- **Baru**: Pesanan baru masuk dan menunggu tindakan admin.
- **Dikonfirmasi**: Pesanan sudah disetujui admin untuk diproses.
- **Diproses**: Pesanan sedang diproduksi oleh tim dapur.
- **Selesai**: Pesanan sudah selesai diproses.
- **Dibatalkan**: Pesanan dibatalkan.

## 5. Catatan BOM
Kebutuhan bahan dihitung berdasarkan rumus:

`jumlah bahan per porsi x jumlah pesanan`

Contoh:
- Beras 100 gram per porsi
- Pesanan 20 porsi
- Total beras = 2.000 gram

Sistem BOM hanya menghitung kebutuhan produksi, bukan stok inventory real-time.
