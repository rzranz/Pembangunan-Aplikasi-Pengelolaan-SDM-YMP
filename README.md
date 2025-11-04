# Talent Hub YukMari

Talent Hub YukMari adalah platform web yang berfungsi sebagai direktori talenta (anggota) yang dapat diakses oleh publik, misalnya perusahaan yang mencari kandidat. Anggota dapat mendaftar melalui Super Admin dan mengelola profil portofolio mereka secara detail, sementara Super Admin memiliki kontrol penuh atas manajemen anggota dan kategori. Aplikasi ini dibangun menggunakan **Laravel Framework** dengan antarmuka modern menggunakan **Tailwind CSS**.

---

## Fitur Utama

### Untuk Pengunjung Publik (Perusahaan, dll.)

* **Direktori Talenta**

  * Menampilkan daftar semua anggota terdaftar dalam format tabel yang bersih.
  * Menampilkan foto profil kecil, nama, kategori, dan headline.
  * Fitur pencarian berdasarkan nama anggota.
  * Fitur filter berdasarkan kategori anggota.
  * Paginasi (8 anggota per halaman).
  * Tombol "Lihat Profil" untuk melihat detail setiap anggota.

* **Halaman Profil Publik**

  * Menampilkan detail lengkap portofolio anggota, termasuk:

    * Informasi dasar (foto, nama, headline, bio, kontak)
    * Daftar proyek portofolio (dengan deskripsi, skill, link proyek)
    * Riwayat pengalaman kerja
    * Riwayat pendidikan
    * Daftar lisensi dan sertifikat (dengan pratinjau file jika tersedia)

### Untuk Anggota (Talenta)

* **Login**: Akses aman ke akun pribadi.
* **Kelola Profil & Portofolio**

  * Update bio & kontak (headline, bio, nomor telepon, LinkedIn, GitHub, portofolio pribadi)
  * Update foto profil (unggah file atau link eksternal dengan pratinjau)
  * Manajemen proyek portofolio
  * Manajemen pengalaman kerja
  * Manajemen pendidikan
  * Manajemen sertifikat (unggah file bukti PDF/gambar)

### Untuk Super Admin

* **Login**: Akses aman ke area admin.
* **Dashboard Interaktif**

  * Statistik total anggota
  * Statistik jumlah anggota per kategori
  * Galeri anggota terbaru/acak
  * Pencarian nama anggota
  * Paginasi galeri (8 anggota per halaman)
* **Manajemen Anggota**

  * CRUD penuh (Create, Read, Update, Delete)
  * Pencarian dan filter berdasarkan kategori
  * Paginasi daftar anggota (10 anggota per halaman)
* **Manajemen Kategori**

  * CRUD penuh
  * Sistem mencegah penghapusan kategori jika masih digunakan anggota

---

## Teknologi yang Digunakan

* **Backend:** PHP 8.3.16 / Laravel Framework 12.33.0
* **Frontend:** Blade Templating Engine, Tailwind CSS, Alpine.js
* **Database:** MySQL
* **Server Development:** `php artisan serve`
* **Asset Bundling:** Vite

---
## Link Mockup
    https://www.figma.com/design/ih7WzR8DN5mZBZxyoVjkoM/Untitled?node-id=1-2&t=hxjBlrURKw56L7gK-1
    


---

## Instalasi & Setup

1. **Clone Repository**

```bash
git clone [URL_REPOSITORY_ANDA]
cd talent_hub_YukMari
```

2. **Install Dependencies**

```bash
composer install
npm install
```

3. **Setup Environment**

```bash
    ubah .env sesuai dengan kebutuhan
```

* Konfigurasi koneksi database di `.env`
* Jalankan:

```bash
php artisan key:generate
```

4. **Migrasi Database**

```bash
php artisan migrate
```

5. **(Opsional) Seeding Data Awal**

```bash
php artisan db:seed
```

6. **Storage Link**

```bash
php artisan storage:link
```

7. **Compile Assets**

```bash
npm run build  # Produksi
npm run dev    # Pengembangan
```

---

## Menjalankan Aplikasi

```bash
php artisan serve
```

Buka browser dan akses: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Struktur Folder Utama (Contoh)

```
/app
├── Console/Commands/
├── Http/Controllers/
├── Models/
├── Providers/
├── Services/
└── View/Components/
/config/
/database
├── factories/
├── migrations/
└── seeders/
/public/
/resources
├── css/
├── js/
└── views/
/routes/
/storage/
/tests/
```

---

## Lisensi

MIT License
