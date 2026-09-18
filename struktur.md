Buatkan saya sebuah website personal romantis yang ditujukan khusus untuk seorang perempuan bernama "Ismaza".

WEBSITE INI HARUS DIBUAT DENGAN LARAVEL DAN MENGGUNAKAN DATABASE MYSQL.

Target deployment:

* Website akan di-hosting di Hostinger
* Gunakan struktur Laravel yang rapi dan siap production
* Jangan membuat aplikasi mobile
* Fokus hanya pada website Laravel
* Pastikan website bisa dijalankan di localhost dan nantinya mudah dipindahkan ke Hostinger

==================================================

1. KONSEP WEBSITE
   ==================================================

Buat website personal yang elegan, modern, hangat, dan romantis.

Website ini bukan website toko atau website umum.

Website dibuat sebagai tempat khusus untuk Ismaza, berisi:

* Foto-foto
* Galeri kenangan
* Pesan-pesan personal
* Halaman pembuka yang menarik
* Animasi lembut
* Background yang indah
* Beberapa section yang terasa personal

PENTING:

* Jangan membuat website terlalu childish.
* Jangan menggunakan desain yang terlalu ramai.
* Gunakan desain modern, clean, premium, dan romantis.
* Gunakan animasi yang halus.
* Website harus tetap nyaman digunakan di HP maupun desktop.
* Jangan menggunakan terlalu banyak efek sehingga website terasa berat.
* Buat tampilannya seperti website personal yang benar-benar dibuat khusus untuk seseorang.

Jangan menampilkan identitas pembuat website secara berlebihan.
Fokus utama website adalah Ismaza.

==================================================
2. SISTEM LOGIN
===============

Website memiliki 2 akun/role:

ROLE 1: ADMIN

Admin adalah pemilik website.

Admin login menggunakan:

* Email
* Password

Admin dapat:

* Login
* Logout
* Masuk dashboard
* Upload foto
* Melihat daftar foto
* Menghapus foto
* Mengubah informasi foto
* Menambahkan pesan
* Mengubah pesan
* Menghapus pesan
* Mengelola konten website

ROLE 2: ISMAZA

Akun kedua adalah akun khusus untuk Ismaza.

Login Ismaza TIDAK menggunakan password.

Login hanya menggunakan username:

ISMAZA

Ketika username benar:
ISMAZA

maka user langsung diarahkan ke halaman utama website.

Jangan meminta password untuk akun Ismaza.

Username harus bersifat case-insensitive sehingga:
ISMAZA
Ismaza
ismaza

tetap dianggap sebagai username yang sama.

Tetapi tampilan username yang digunakan tetap:
ISMAZA

==================================================
3. KEAMANAN LOGIN
=================

Walaupun akun Ismaza tidak menggunakan password, tetap buat sistem session Laravel dengan benar.

Jangan memberikan akses admin kepada Ismaza.

Gunakan role:

* admin
* user

Buat middleware untuk memastikan:

* /admin/* hanya bisa diakses admin
* halaman user hanya bisa diakses user
* user tidak dapat membuka dashboard admin secara langsung melalui URL

Jika user mencoba membuka:
/admin/dashboard

tanpa role admin, arahkan kembali ke halaman yang sesuai.

Admin juga harus memiliki logout.

User Ismaza juga harus memiliki logout.

==================================================
4. DATABASE
===========

Gunakan MySQL.

Gunakan migration Laravel.

Minimal buat tabel:

users

* id
* name
* email
* password
* role
* created_at
* updated_at

photos

* id
* title
* description
* image_path
* created_at
* updated_at

messages

* id
* title
* content
* created_at
* updated_at

Jika diperlukan, tambahkan tabel lain untuk membuat sistem lebih rapi.

==================================================
5. AKUN DEFAULT
===============

Buat seeder untuk akun admin.

Admin:
Email:
[admin@example.com](mailto:admin@example.com)

Password:
Admin123!

Role:
admin

Untuk user Ismaza:

Username:
ISMAZA

Role:
user

Karena user Ismaza login tanpa password, desain autentikasinya harus menyesuaikan kebutuhan tersebut.

Jangan menyimpan password palsu yang kemudian digunakan untuk login.

==================================================
6. DASHBOARD ADMIN
==================

Buat dashboard admin dengan desain modern.

Menu:

Dashboard
Foto
Pesan
Logout

Dashboard menampilkan statistik sederhana:

* Total Foto
* Total Pesan

Tambahkan tampilan yang rapi dan mudah digunakan.

==================================================
7. FITUR UPLOAD FOTO
====================

Admin dapat mengupload foto melalui dashboard.

Form:

Judul Foto
Deskripsi
Pilih Foto

Setelah upload berhasil:

* Simpan file menggunakan Laravel Storage
* Simpan path file ke database
* Tampilkan foto di dashboard
* Foto otomatis tersedia di galeri user

Validasi:

* File harus berupa gambar
* jpg
* jpeg
* png
* webp
* ukuran file maksimal yang wajar

Jika upload gagal, tampilkan pesan error yang jelas.

Admin juga dapat:

* Edit judul
* Edit deskripsi
* Mengganti foto
* Menghapus foto

Ketika foto dihapus dari database, file fisiknya juga harus dihapus dari storage.

==================================================
8. GALERI UNTUK ISMAZA
======================

Buat halaman galeri khusus.

Tampilkan foto dalam layout yang menarik.

Contohnya:

* masonry gallery
* card gallery
* grid modern

Ketika foto diklik:

* buka modal/lightbox
* tampilkan foto lebih besar
* tampilkan judul
* tampilkan deskripsi

Galeri harus responsive.

Di mobile:
2 kolom atau layout yang tetap nyaman.

Di desktop:
3 sampai 4 kolom sesuai ukuran layar.

==================================================
9. HALAMAN UTAMA ISMAZA
=======================

Setelah login sebagai ISMAZA, tampilkan halaman utama khusus.

Contoh struktur:

Hero Section
↓
Pesan pembuka
↓
Galeri
↓
Pesan-pesan khusus
↓
Closing Section

Hero jangan terlalu berlebihan.

Gunakan teks yang bisa saya ubah nanti melalui database/admin.

Jangan membuat seluruh tulisan hard-coded jika konten tersebut seharusnya bisa dikelola admin.

==================================================
10. PESAN KHUSUS
================

Admin dapat membuat pesan.

Contoh data:

Judul:
"Untuk Ismaza"

Isi:
"Terima kasih sudah menjadi bagian dari cerita yang begitu berarti."

Tetapi jangan terlalu banyak membuat kalimat romantis secara otomatis.

Sediakan sistem CRUD agar saya sendiri yang menentukan isi pesannya.

User Ismaza hanya dapat membaca pesan.

User tidak dapat:

* menambah pesan
* mengedit pesan
* menghapus pesan

==================================================
11. DESAIN UI
=============

Gunakan desain:

* Modern
* Elegant
* Romantic
* Minimal
* Clean
* Premium
* Responsive

Warna jangan terlalu mencolok.

Gunakan kombinasi warna lembut dan elegan.

Gunakan typography yang bagus.

Tambahkan animasi:

* fade in
* smooth transition
* hover effect
* scroll animation

Tetapi jangan menggunakan animasi berlebihan.

Pastikan performa tetap baik.

==================================================
12. RESPONSIVE
==============

Website wajib responsive untuk:

* Desktop
* Laptop
* Tablet
* Android
* iPhone

Pastikan:

* Navbar tidak rusak
* Galeri tidak overflow
* Foto tidak gepeng
* Modal foto nyaman digunakan di HP
* Tombol mudah ditekan
* Text tidak keluar layar

==================================================
13. FOTO
========

Saya sendiri yang akan menyediakan foto.

JANGAN membuat foto dummy menggunakan URL internet.

Sediakan fitur upload dari dashboard admin.

Gunakan placeholder sederhana jika belum ada foto.

Saya nantinya hanya perlu login sebagai admin lalu upload foto dari komputer.

==================================================
14. STRUKTUR KODE
=================

Gunakan struktur Laravel yang jelas.

Pisahkan:

Models
Controllers
Middleware
Requests
Views
Routes
Migrations
Seeders

Gunakan Blade untuk frontend.

Gunakan Tailwind CSS atau CSS modern yang cocok dengan Laravel.

Jangan membuat kode terlalu kompleks.

Kode harus mudah saya pahami dan mudah saya edit.

==================================================
15. ROUTING
===========

Buat route yang jelas.

Contoh:

/login

/admin/dashboard

/admin/photos

/admin/photos/create

/admin/messages

/home

/gallery

/messages

/logout

Sesuaikan route jika diperlukan.

==================================================
16. AUTHENTICATION
==================

Buat sistem authentication sendiri menggunakan Laravel session jika diperlukan.

Login admin:

Email + Password

Login Ismaza:

Username saja.

Contoh:

Username:
ISMAZA

Jika benar:
redirect ke /home

Jika salah:
tampilkan:

"Username tidak ditemukan."

Jangan meminta password kepada Ismaza.

==================================================
17. ERROR HANDLING
==================

Semua form harus memiliki validasi.

Tampilkan:

* success message
* error message
* validation error

Jangan menampilkan error Laravel mentah kepada user biasa.

==================================================
18. HOSTINGER
=============

Website nantinya akan di-deploy ke Hostinger.

Pastikan:

* APP_ENV dapat diubah menjadi production
* APP_DEBUG=false untuk production
* database menggunakan environment variable
* APP_URL menggunakan domain
* storage Laravel dapat digunakan
* migration dapat dijalankan di server
* tidak bergantung pada localhost
* tidak menggunakan absolute path Windows
* tidak menggunakan file lokal yang hanya tersedia di komputer saya

Buat dokumentasi deployment singkat:

1. Upload project
2. Set .env
3. Buat database MySQL
4. Jalankan migration
5. Jalankan seeder
6. Hubungkan storage
7. Set document root/public
8. Clear cache
9. Test website

==================================================
19. DATA YANG MUDAH DIUBAH
==========================

Saya ingin nanti bisa mengubah:

* Foto
* Judul foto
* Deskripsi foto
* Pesan
* Judul halaman
* Nama Ismaza
* Konten halaman

sebisa mungkin melalui dashboard admin.

Jangan membuat saya harus mengedit source code hanya untuk mengganti foto atau pesan.

==================================================
20. HASIL AKHIR
===============

Saya ingin hasil akhirnya berupa website Laravel yang benar-benar bisa dijalankan.

Jangan hanya memberikan desain atau mockup.

Buat:

* Migration
* Model
* Controller
* Middleware
* Seeder
* Routes
* Blade views
* CSS
* JavaScript jika diperlukan
* Authentication
* CRUD foto
* CRUD pesan
* Upload foto
* Galeri
* Dashboard admin
* Halaman Ismaza
* Logout
* Validation

Setelah selesai, berikan saya:

1. Struktur folder project
2. Semua command instalasi yang diperlukan
3. Command migration
4. Command seeder
5. Cara menjalankan Laravel
6. Akun login admin
7. Cara login sebagai ISMAZA
8. Cara upload foto
9. Cara deployment ke Hostinger

PENTING:
Jangan berhenti hanya pada penjelasan konsep.
Implementasikan fitur sampai dapat dijalankan.

Jika ada bagian yang belum dibuat, lanjutkan membuatnya sampai sistem lengkap.
