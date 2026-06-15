# Jejak Karya

Jejak Karya adalah platform arsip portofolio digital dan sistem pendataan riwayat perlombaan yang dirancang untuk lingkungan Himpunan Mahasiswa. Aplikasi ini menjadi jembatan antara kebutuhan mahasiswa akan ruang penyimpanan karya yang aman dengan kebutuhan organisasi akan data prestasi yang terstruktur.

## Latar Belakang Masalah

- **Arsip yang Selalu Hilang:** Mahasiswa sering membuat proposal atau karya lomba yang berkualitas, namun file tersebut hanya tersimpan di perangkat pribadi dan rawan hilang. Tidak ada tempat penyimpanan terpusat yang memudahkan mahasiswa mengakses kembali karya mereka.
- **Pendataan Manual yang Tidak Efektif:** Himpunan sering kesulitan mengumpulkan data prestasi mahasiswa untuk keperluan apresiasi atau pelacakan rekam jejak warga jurusan. Proses manual menggunakan formulir daring (seperti Google Form) sering kali tidak akurat, datanya sulit diverifikasi, dan tidak interaktif.

## Solusi yang Ditawarkan

Sistem ini memfasilitasi dua alur kepentingan:

- **Bagi Mahasiswa:** Menjadi ruang arsip portofolio pribadi yang aman. Mahasiswa bisa mengunggah dan menyimpan dokumen lomba (seperti proposal atau sertifikat) agar sewaktu-waktu bisa diakses kembali untuk keperluan magang, beasiswa, atau asisten laboratorium.
- **Bagi Himpunan:** Menjadi pusat data rekam jejak yang rapi. Himpunan secara otomatis mendapatkan akses ke data prestasi dan file karya mahasiswa yang sudah terstandarisasi, sehingga memudahkan proses publikasi apresiasi dan pelacakan talenta di dalam jurusan.

## Alur Kebijakan Sistem

- **Ekosistem Tertutup:** Untuk menjaga integritas dan kerapian data, Admin (Himpunan) memegang kendali atas daftar lomba yang tersedia. Hal ini dilakukan untuk menghindari kekacauan penulisan nama lomba oleh pengguna.
- **Integritas Master Data:** Sistem menerapkan logika *Strict Closed Ecosystem*. Mahasiswa hanya dapat memilih perlombaan dari opsi yang tersedia. Jika lomba yang diikuti tidak ada di pilihan, mahasiswa harus menghubungi Admin Himpunan agar menambahkannya ke *master data*. Hal ini bertujuan untuk menjaga kebersihan, konsistensi basis data, dan mencegah terjadinya kesalahan pengetikan (*typo*).
- **Pengelolaan Mandiri (Self-Reporting):** Mahasiswa diberikan kebebasan untuk memperbarui progres lomba mereka secara mandiri, mengurangi beban administratif pengurus himpunan.
- **Verifikasi Akhir:** Admin memiliki hak akses penuh untuk melakukan validasi terhadap sertifikat yang diunggah mahasiswa guna memastikan data yang digunakan untuk publikasi organisasi adalah data yang valid.

## Spesifikasi Teknis

Sistem ini dikembangkan secara mandiri dengan mengusung arsitektur **MVC (Model-View-Controller)** melalui *framework* **Laravel**, dipadukan dengan integrasi basis data relasional **MySQL**. Kode sumber disusun secara terstruktur dengan penamaan variabel dan fungsi yang konsisten untuk menjaga *clean code*. 

Untuk memastikan interaksi pengguna yang optimal di berbagai perangkat, antarmuka dibangun menggunakan **Bootstrap** sehingga menghasilkan desain yang *fully responsive* (berjalan baik pada *desktop* maupun *mobile*). Secara teknis, platform ini ditopang oleh beberapa fungsionalitas inti:

- **Operasi CRUD Terintegrasi:** Seluruh entitas utama (seperti pengelolaan master data lomba oleh Admin dan pelaporan arsip karya oleh Mahasiswa) mengimplementasikan operasi *Create, Read, Update,* dan *Delete* untuk penyimpanan data secara permanen.
- **Autentikasi & Hak Akses (Role-Based):** Sistem memiliki mekanisme *Login/Logout* (Authentication) yang diamankan oleh *Middleware*. Terdapat pemisahan hak akses yang ketat antara Admin (Himpunan) dan User (Mahasiswa), sehingga mahasiswa hanya dapat melihat dan memanipulasi datanya sendiri.
- **Validasi Berlapis (Client & Server-Side):** Diimplementasikan untuk menjamin keamanan web dasar dan integritas data. Validasi memastikan tidak ada isian wajib yang terlewat, serta memeriksa format spesifik dan batas ukuran file (seperti ekstensi PDF/JPG) sebelum diproses oleh server.
- **Manajemen Upload File:** Aplikasi menangani pemrosesan unggahan dokumen (berkas proposal dan bukti sertifikat) ke dalam penyimpanan lokal secara rapi. Berkas yang diunggah kemudian dapat ditinjau atau diunduh kembali sesuai dengan alur verifikasi.
- **Pagination & Halaman Statis:** Sistem memanfaatkan fitur *pagination* untuk mengatur tampilan daftar data yang panjang agar antarmuka tetap responsif. Selain itu, sistem juga menyediakan halaman statis tambahan, seperti **Pusat Bantuan (FAQ)**, guna membantu pengguna dalam memahami cara kerja portal.

## Demo Proyek

Tonton video demo Jejak Karya di sini: https://www.youtube.com/playlist?list=PL59fElv0Npv-3L8hcVFiEDJUTZ7pcQZH2