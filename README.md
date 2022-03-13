## Information

Langkah - langkah instalasi development server

1. Pertamaa clone terlebih dahulu -> git clone https://github.com/maulana5599/dhealth-test.git
2. Lakukan composer install pada terminal, apabila tidak mempunyai composer silahkan install terlebih dahulu
3. Ketik perintah php artisan optimize, untuk clear cache
4. lakukan php artisan migrate, untuk migrasi terlebih dahulu
5. jangan lupa juga untuk upload master obat dan master signa, tersedia di folder database.
6. lakukan php artisan serve untuk menjalan development server.

Framework LARAVE 8, PHP 7.4

Note: Jangan lupa setting ENV, karena setiap database mempunyai username dan kata sandi yang berbeda beda.
