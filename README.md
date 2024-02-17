# Service Tools

Sebuah website untuk
Service Tools adalah platform layanan servis alat elektronik yang dapat Anda andalkan. Aplikasi ini dirancang untuk memudahkan pelanggan dalam mereservasi servis alat elektronik, menjadwalkan kunjungan teknisi, dan mengelola permintaan servis.

## Fitur

-   Membuat permintaan servis
-   Menjadwalkan reservasi
-   Notifikasi Teknisi

## Jalankan Secara Lokal

-   Pastikan sudah terinstall php 8.2+ untuk menjalankan laravel 10

**Clone**

```shell
git clone https://github.com/khmalz/ServiceTools.git
```

**Go to Directory**

```shell
cd ServiceTools
```

**Install Dependencies**

```shell
composer install
```

```shell
npm install
```

**Config Environment**

```shell
cp .env.example .env
```

**Generate Key**

```shell
php artisan key:generate
```

**Setting Database Config in Env**

```
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

**Migrate Database**

```shell
php artisan migrate --seed
```

**Link Storage**

```shell
php artisan storage:link
```

**Run Local Server**

```shell
php artisan serve
```

## Environment Variables

Untuk memastikan gambar yang terupload akan muncul, Anda perlu mengkonfigurasi pada file .env. Sesuaikan dengan url dan host yang dijalankan di browser anda saat menjalankan project ini.

contoh: `http://127.0.0.1:8000`

```
APP_URL
```

## Developer

-   [@khmalz](https://github.com/khmalz)
