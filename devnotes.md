1. Architecture Design:
NOT using MVP, because following principle of modern Livewire

<!-- Menggunakan Laravolt/Indonesia untuk generate lokasi di area indonesia -->
php artisan vendor:publish --provider="Laravolt\Indonesia\ServiceProvider"

<!-- Hasil yang seharusnya keluar adalah -->
<!-- 
1. MIGRATIONS FILES: Copying Dir vendor to dir project di database/migrations/ yang berisi 4 file, provinces, cities, districts, villages :  
2. Copying file vendor to file project on config/laravolt/indonesia.php
-->

<!-- konfigurasi secara otomatis melakukan seeding dari vendor -->
<!-- 
Seharusnya, harus masukkan prompt 
php artisan laravolt:indonesia:seed

Namun, ada cara otomatis supaya tidak perlu, jadi dimasukkan ke DatabaseSeeder
-->
