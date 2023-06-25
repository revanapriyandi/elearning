# Elearning

Ini adalah proyek Laravel yang dibuat untuk [Elearning].

## Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut sebelum menjalankan proyek ini:

-   PHP versi 8.1 atau yang lebih baru
-   Composer
-   MySQL Database
-   NodeJs

## Instalasi

1. Salin file `.env.example` menjadi `.env`:

    ```shell
    cp .env.example .env
    ```

2. Buatlah kunci aplikasi:

    ```shell
    php artisan key:generate
    ```

3. Edit file `.env` dan sesuaikan pengaturan database dengan informasi yang sesuai:

    ```shell
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=[nama_database]
    DB_USERNAME=[username_database]
    DB_PASSWORD=[password_database]
    ```

4. Install semua dependensi yang diperlukan menggunakan Composer:

    ```shell
    composer install
    ```

5. Jalankan migrasi database untuk membuat tabel yang diperlukan:

    ```shell
    php artisan migrate --seed
    ```

## Menjalankan Aplikasi

Untuk menjalankan aplikasi Laravel, jalankan perintah berikut:

```shell
php artisan serve
```

Aplikasi sekarang dapat diakses di `http://localhost:8000` pada browser Anda.

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan buat _pull request_ dengan perubahan yang diusulkan.

## Lisensi

[Sebutkan lisensi yang digunakan, misalnya: MIT License]
