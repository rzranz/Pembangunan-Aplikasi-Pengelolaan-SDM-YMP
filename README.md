Talent Hub YukMari

Deskripsi

Talent Hub YukMari adalah sebuah platform web yang berfungsi sebagai direktori talenta (anggota) yang dapat diakses oleh publik (misalnya perusahaan yang mencari kandidat). Anggota dapat mendaftar (melalui Super Admin), mengelola profil portofolio mereka secara detail, sementara Super Admin memiliki kontrol penuh atas manajemen anggota dan kategori. Aplikasi ini dibangun menggunakan Laravel Framework dengan antarmuka pengguna yang modern menggunakan Tailwind CSS.

Fitur Utama

Untuk Pengunjung Publik (Perusahaan, dll.)

Direktori Talenta: Menampilkan daftar semua anggota terdaftar dalam format tabel yang bersih.

Menampilkan foto profil kecil, nama, kategori, dan headline.

Fitur pencarian berdasarkan nama anggota.

Fitur filter berdasarkan kategori anggota.

Paginasi (8 anggota per halaman).

Tombol "Lihat Profil" untuk melihat detail setiap anggota.

Halaman Profil Publik: Menampilkan detail lengkap portofolio anggota, termasuk:

Informasi dasar (foto, nama, headline, bio, kontak).

Daftar proyek portofolio (dengan deskripsi, skill, link proyek).

Riwayat pengalaman kerja.

Riwayat pendidikan.

Daftar lisensi dan sertifikat (dengan kemungkinan pratinjau file).

Untuk Anggota (Talenta)

Login: Akses aman ke akun pribadi.

Halaman Kelola Profil & Portofolio: Antarmuka terpusat untuk mengelola semua aspek profil:

Update Bio & Kontak: Mengedit headline, bio, nomor telepon, URL LinkedIn, GitHub, dan portofolio pribadi.

Update Foto Profil: Fleksibilitas untuk mengunggah file gambar atau menggunakan link URL eksternal (seperti Google Drive, dengan konversi otomatis untuk link sharing). Pratinjau foto saat ini ditampilkan.

Manajemen Portofolio: Menambah dan menghapus proyek-proyek yang pernah dikerjakan.

Manajemen Pengalaman Kerja: Menambah dan menghapus riwayat pekerjaan.

Manajemen Pendidikan: Menambah dan menghapus riwayat pendidikan formal.

Manajemen Sertifikat: Menambah dan menghapus sertifikat (mendukung unggah file bukti seperti PDF/gambar).

Untuk Super Admin

Login: Akses aman ke area admin.

Dashboard Interaktif:

Menampilkan statistik total anggota.

Menampilkan statistik jumlah anggota per kategori (misalnya, Mahasiswa, Umum, Alumni YMP). Kartu statistik ini bisa diklik untuk langsung memfilter di halaman Manajemen Anggota.

Menampilkan galeri anggota terbaru/acak dengan foto, nama, dan kategori.

Fitur pencarian nama anggota langsung di dashboard.

Paginasi untuk galeri anggota (8 anggota per halaman).

Manajemen Anggota:

CRUD (Create, Read, Update, Delete) penuh untuk data anggota (nama, email, password, kategori).

Menampilkan daftar anggota dalam tabel.

Fitur pencarian berdasarkan nama anggota.

Fitur filter berdasarkan kategori anggota (menggunakan dropdown).

Paginasi untuk daftar anggota (10 anggota per halaman).

Manajemen Kategori:

CRUD (Create, Read, Update, Delete) penuh untuk kategori anggota.

Sistem mencegah penghapusan kategori jika masih digunakan oleh anggota.

Teknologi yang Digunakan

Backend: PHP 8.3.16 / Laravel Framework 12.33.0

Frontend: Blade Templating Engine, Tailwind CSS, Alpine.js (untuk interaktivitas kecil)

Database: MySQL (atau database lain yang didukung Laravel)

Server Development: php artisan serve (PHP Built-in server)

Asset Bundling: Vite

Instalasi & Setup

Clone Repository:

    git clone [https://www.fda.gov/drugs/types-applications/abbreviated-new-drug-application-anda](https://www.fda.gov/drugs/types-applications/abbreviated-new-drug-application-anda)
    cd talent_hub_YukMari 


Install Dependencies:

    composer install
    npm install


Setup Environment:

Salin file .env.example menjadi .env.

Konfigurasi koneksi database (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD) di file .env.

Jalankan

    php artisan key:generate.

Migrasi Database:

    php artisan migrate


(Opsional) Seeding Data Awal: Jika Anda membuat Seeder untuk kategori atau data lainnya:

    php artisan db:seed 


Storage Link: Buat tautan simbolik agar file yang diunggah (foto profil, sertifikat) dapat diakses publik:

    php artisan storage:link


Compile Assets:

    npm run build 


(Atau npm run dev untuk pengembangan)

Menjalankan Aplikasi

Jalankan Server Development:

    php artisan serve


Buka browser Anda dan kunjungi http://127.0.0.1:8000 (atau alamat lain yang ditampilkan oleh serve).

Struktur Folder Utama (Contoh)

/app
├── Console/Commands/       # Perintah Artisan kustom (MigrateCategoryData)
├── Http/Controllers/       # Controller (Public, Admin, Auth)
├── Models/                 # Model Eloquent (User, Profile, Category, dll.)
├── Providers/
├── Services/               # Service Class (ProfileService)
└── View/Components/        # Komponen Blade (ProfileImage)
/config/                    # File Konfigurasi
/database
├── factories/
├── migrations/             # File Migrasi Database
└── seeders/                # File Seeder Database
/public/                    # Document Root (index.php, assets)
/resources
├── css/                    # File CSS (app.css)
├── js/                     # File JavaScript (app.js)
└── views/                  # File Blade Views (layouts, auth, public, admin, portfolio, components)
/routes/                    # Definisi Rute (web.php, console.php)
/storage/                   # File Storage (logs, cache, public uploads)
/tests/                     # File Unit & Feature Tests
