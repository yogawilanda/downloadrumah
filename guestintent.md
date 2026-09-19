Notes untuk guest intent Response

Gunakan demand capture (naming convention dari CMO).
Proses menangkap intensi pengguna, jika tidak ada, maka berikan solusi seperti akan menyimpan permintaan itu untuk sisi lawan.

Penerapan Fitur pengembangan lanjutannya:
Menggunakan user intent di hero, terlepas user sudah login atau belum.
Contoh implementasinya:
1. User Klik "Bantu Saya Mencari" | "Bantu Saya Menjual" | "Bantu Saya Menganalisa" -> sistem mencatat ini dengan cara menangkap intensi per pilihan. Terlepas apapun intensi

Contoh di mvp sebelumnya:
Jika user masuk ke laman lalu menggunakan fitur pencarian search bar seperti "Kabupaten Sidoarjo" route yang dihasilkan
http://localhost:8000/listings?city=kabupaten-bengkulu-tengah, nah ini sudah dicatat menggunakan fitur insight.
Maka jika itu dipakai, harusnya sudah bisa dianggap orang sedang mencari properti daerah itu terlepas tujuan dia beli atau tidak. Sistem mencatat bahwa sistem menerima pemberitahuan bahwa visitor ada yang mencari di daerah Sidoarjo.

Kedepannya, ini akan dianggap sebagai count alih alih selalu di spam secara singular notif. jadi strateginya setelah implementasi ini.

Per 1 jam akan ada pencatatan yang di publikasi oleh sistem dalam bentuk notifikasi untuk super admin dari sisi penjual.

Search ->
