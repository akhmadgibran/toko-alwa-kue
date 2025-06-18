# Proyek Toko Kue Alwa (`toko-alwa-kue`)

Selamat datang di repository Toko Kue Alwa! Ini adalah aplikasi web pemesanan kue online yang dibangun menggunakan framework Laravel. Dokumen ini akan memandu Anda melalui proses instalasi, struktur project, dan cara berkontribusi.

## 1. Struktur Repository
Struktur folder dan file pada project ini mengikuti standar framework Laravel. Berikut adalah deskripsi singkat dari beberapa direktori dan file yang paling penting:

* `/app` - Berisi semua logika inti aplikasi, termasuk Models, Controllers, dan Providers.
* `/config` - Berisi semua file konfigurasi aplikasi (database, email, service pihak ketiga).
* `/database` - Berisi file-file migrasi (skema tabel) dan seeder (data awal).
* `/public` - *Document root* untuk aplikasi. Aset seperti CSS, JS, dan gambar yang sudah di-compile juga diletakkan di sini.
* `/resources` - Berisi file-file "mentah" seperti Blade templates (`/views`), file JavaScript (`/js`), dan file CSS/SCSS (`/css`).
* `/routes` - Berisi semua definisi rute URL aplikasi (`web.php` dan `api.php`).
* `/storage` - Berisi file-file yang di-generate oleh framework, seperti logs, cache, dan file yang di-upload oleh pengguna (melalui *symlink*).
* `.env` - File konfigurasi *environment* lokal yang berisi kredensial dan variabel sensitif.
* `artisan` - Command-line interface (CLI) yang disertakan dengan Laravel.
* `composer.json` - Mendefinisikan semua *dependency* PHP.
* `package.json` - Mendefinisikan semua *dependency* JavaScript/CSS.
* `vite.config.js` - File konfigurasi untuk Vite, *build tool* front-end.

## 2. Panduan Setup Lokal

Berikut adalah panduan untuk melakukan instalasi dan menjalankan project ini di lingkungan lokal.

**Prasyarat:**
* PHP: **8.4**
* MySQL: **8.0.30** (atau yang kompatibel)
* Composer
* Node.js & NPM

**Langkah-langkah Instalasi:**

1.  **Clone Repository**
    Buka terminal dan jalankan perintah berikut:
    ```bash
    git clone [https://github.com/akhmadgibran/toko-alwa-kue.git](https://github.com/akhmadgibran/toko-alwa-kue.git)
    cd toko-alwa-kue
    ```

2.  **Install Dependencies**
    Install semua paket PHP (via Composer) dan JavaScript (via NPM).
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment File (.env)**
    Salin file contoh menjadi file environment lokalmu.
    ```bash
    cp .env.example .env
    ```

4.  **Generate Application Key**
    Setiap aplikasi Laravel membutuhkan kunci enkripsi yang unik.
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi Environment (.env)**
    Buka file `.env` yang baru dibuat dan sesuaikan konfigurasinya.

    **a. Koneksi Database:**
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=alwa_kue_website
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    > Pastikan kamu sudah membuat database dengan nama `alwa_kue_website` di MySQL lokalmu.

    **b. Konfigurasi Email (Mailer):**
    Untuk pengembangan lokal, disarankan menggunakan layanan seperti [Mailtrap](https://mailtrap.io/) agar tidak mengirim email sungguhan.
    ```env
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=mailtrap_user_kamu
    MAIL_PASSWORD=mailtrap_pass_kamu
    MAIL_FROM_ADDRESS="hello@example.com"
    MAIL_FROM_NAME="${APP_NAME}"
    ```

    **c. Konfigurasi Midtrans (Payment Gateway):**
    Gunakan *key* dari akun Sandbox Midtrans-mu untuk pengujian.
    > **PENTING:** Set `MIDTRANS_IS_PRODUCTION` ke `false` untuk lingkungan development!
    ```env
    MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxx
    MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxx
    MIDTRANS_IS_PRODUCTION=false
    ```

6.  **Jalankan Migrasi Database**
    Perintah ini akan membuat semua tabel di database. Tambahkan `--seed` jika kamu ingin mengisi data awal dari Seeder.
    ```bash
    php artisan migrate --seed
    ```

7.  **Buat Storage Link**
    Perintah ini penting agar file yang di-upload (misal: gambar produk kue) bisa diakses dari web.
    ```bash
    php artisan storage:link
    ```

8.  **Jalankan Aplikasi**
    Kamu perlu menjalankan dua perintah di dua terminal terpisah:
    * **Terminal 1: Jalankan Vite Dev Server** (untuk compile CSS/JS secara otomatis)
        ```bash
        npm run dev
        ```
    * **Terminal 2: Jalankan Laravel Server**
        ```bash
        php artisan serve
        ```

    Sekarang aplikasi sudah bisa diakses di **http://127.0.0.1:8000**.

## 3. Branching Strategy
Project ini menggunakan strategi percabangan **Git Flow** untuk mengelola kode.

* `main`: Menyimpan kode produksi yang stabil. Hanya menerima *merge* dari `release` atau `hotfix`.
* `develop`: *Branch* utama untuk pengembangan. Semua fitur baru diintegrasikan ke sini.
* `feature/*`: Dibuat dari `develop` untuk mengerjakan fitur baru (misal: `feature/payment-report`). Di-*merge* kembali ke `develop` setelah selesai.
* `release/*`: Dibuat dari `develop` untuk persiapan rilis. Setelah siap, di-*merge* ke `main` dan `develop`.
* `hotfix/*`: Dibuat dari `main` untuk perbaikan *bug* darurat di produksi. Di-*merge* kembali ke `main` dan `develop`.

![image](https://github.com/user-attachments/assets/5b7c573e-f2f2-47f3-90fe-16c0d136eb26)


## 4. Contributing Guidelines

**Alur Kontribusi:**
1.  Selalu mulai dari *branch* `develop` yang paling baru (`git pull origin develop`).
2.  Buat *branch* baru untuk fitumu: `git checkout -b feature/nama-fitur-kamu`.
3.  Kerjakan kodemu dan buat *commit* dengan pesan yang jelas (misal: `feat: Add cake discount functionality`).
4.  Setelah selesai, dorong (*push*) *branch*-mu ke remote: `git push origin feature/nama-fitur-kamu`.
5.  Buat *Pull Request* (PR) dari *branch* `feature` kamu ke *branch* `develop`.
6.  Tunggu proses *code review*. Jika ada revisi, lakukan di *branch* yang sama.
7.  Setelah disetujui, PR akan di-*merge* ke `develop`.

> ### PERINGATAN KEAMANAN!
> Jangan pernah melakukan *commit* untuk file `.env` ke dalam repository. File ini berisi informasi sensitif seperti *password* email dan *API key*. File `.gitignore` sudah dikonfigurasi untuk mengabaikan file `.env`.

