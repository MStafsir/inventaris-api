# Inventaris API — Praktikum Pemrograman Berorientasi Objek (OOP)

Proyek RESTful API Sistem Manajemen Inventaris Barang menggunakan PHP 8.2+ OOP, PSR-4, MVC, Service & Repository Pattern, SOLID (SRP & DIP), OpenAPI 3.1, dan Swagger UI.

## Cara Menjalankan Proyek

1. **Import Database MySQL**:
   Jalankan file `database/schema.sql` di MySQL/phpMyAdmin atau melalui terminal:
   ```bash
   mysql -u root -p < database/schema.sql
   ```
2. **Konfigurasi Environment**:
   Sesuaikan kredensial database pada file `.env` (default `DB_USER=root` dan `DB_PASS=` kosong).
3. **Install Dependency Composer (Opsional — Autoloader sudah disertakan)**:
   ```bash
   composer install
   composer dump-autoload
   ```
4. **Jalankan Server PHP**:
   ```bash
   php -S localhost:8000 -t public public/router.php
   ```
5. **Akses Endpoint & Dokumentasi Swagger UI**:
   - Swagger UI: `http://localhost:8000/swagger/`
   - Produk: `http://localhost:8000/api/v1/products`
   - Kategori: `http://localhost:8000/api/v1/categories`
