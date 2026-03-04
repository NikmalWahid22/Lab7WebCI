# Pratikum 1 - Pemrograman Web 2 (Instalasi Code Igniter)

Nama : Muhamad Nikmal Wahid 
NIM : 312410372 
Kelas : I241C 
Mata Kuliah : Pemrograman Web 2 

# Instalasi CodeIgniter 4 

- Unduh CodeIgniter dari website https://codeigniter.com/download
- Extrak file zip Codeigniter ke direktori htdocs/lab11_ci.
- Ubah nama direktory framework-4.x.xx menjadi ci4.
- Buka browser dengan alamat http://localhost/lab11_ci/ci4/public/


## Menjalankan CLI (Command Line Interface) 
Codeigniter 4 menyediakan CLI untuk mempermudah proses development. Untuk mengakses
CLI buka terminal/command prompt. Arahkan lokasi direktori sesuai dengan direktori kerja project dibuat 

Perintah yang dapat dijalankan untuk memanggil CLI CodeIgniter adalah: 

```
php spark
```

## Mengakftikan Mode Debugging 

![Gambar Debug]()

Untuk menampikan jenis error maka kita perlu mengaktikan mode debugging dengan mengubah nilai konfigurasi pada environment variable CI_ENVIRINMENT menjadi development. 

Ubah nama File env menjadi .env kemudian buka file tersebut dan ubah nilai variable  CI_ENVIRINMENT menjadi development. 

## Router dan Controller 

Router terletak pada file app/config/Routes.php 

Pada file tersebut kita dapat mendefinisikan route untuk aplikasi yang kita buat.
```
$routes->get('/', 'Home::index');
```

### Membuat Route Baru 

Tambahkan kode ini diddalam routes.php 
```
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
```

Untuk mengetahui route yg ditambakan sudah benar atau belum, buka CLI dan jalankan perintah berikut 

```
php spark routes
```

## Membuat Controller 

```

```

## Membuat View 




