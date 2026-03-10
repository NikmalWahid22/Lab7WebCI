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

![Gambar Contact](Pict/Instalasi.png)


## Menjalankan CLI (Command Line Interface) 
Codeigniter 4 menyediakan CLI untuk mempermudah proses development. Untuk mengakses
CLI buka terminal/command prompt. Arahkan lokasi direktori sesuai dengan direktori kerja project dibuat 

Perintah yang dapat dijalankan untuk memanggil CLI CodeIgniter adalah: 

```
php spark
```

## Mengakftikan Mode Debugging 

![Gambar Contact](Pict/environment.png)

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

![Gambar Contact](page.png)


## Membuat Controller 

```
<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function about()
    {
        echo "Ini halaman About";
    }

    public function contact()
    {
        echo "Ini halaman Contact";
    }

    public function faqs()
    {
        echo "Ini halaman FAQ";
    }
}
```

## Membuat View 

Buat File baru dengan nama about.php pada direktori (app/view/about.php)
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('styles.css'); ?>">
</head>
<body>

<?= $this->include('template/header.php'); ?>

<h1><?= esc($title); ?></h1>
<hr>
<p><?= esc($content); ?></p>

<?= $this->include('template/footer.php'); ?>

</body>
</html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('styles.css'); ?>">
</head>
<body>


<h1><?= esc($title); ?></h1>
<hr>
<p><?= esc($content); ?></p>


</body>
</html>
```

Ubah method pada abut di dalam class Controller page seperti berikut: 

```
 public function about()
    {
        return view('about', [
            'title' => 'Halaman About',
            'content' => 'Ini adalah halaman about yang menjelaskan tentang isi halaman ini.'
        ]);
    }
```

## Membuat Layout Header dan Footer 

![Gambar View](view.png)

### Header 
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('styles.css');?>">
</head>
<body>
    <div id="container">
        <header>
            <h1>Layout Sederhana</h1>
        </header>
        <nav>
            <a href="<?= base_url('/');?>" class="active">Home</a>
            <a href="<?= base_url('/artikel');?>">Artikel</a>
            <a href="<?= base_url('/about');?>">About</a>
            <a href="<?= base_url('/contact');?>">Kontak</a>
        </nav>
<section id="wrapper">
<section id="main">
```

### Footer 
```
</section>

<aside id="sidebar">
    <div class="widget-box">
        <h3 class="title">Widget Header</h3>
        <ul>
            <li><a href="#">Widget Link</a></li>
            <li><a href="#">Widget Link</a></li>
        </ul>
    </div>

    <div class="widget-box">
        <h3 class="title">Widget Text</h3>
        <p>
            Vestibulum lorem elit, iaculis in nisl volutpat,
            malesuada tincidunt arcu.
        </p>
    </div>
</aside>

</section>

<footer>
    <p>&copy; 2021 - Universitas Pelita Bangsa</p>
</footer>

</div>
</body>
</html>
```

## Pertanyaan dan Tugas 

Lengkapi kode program untuk menu lainnya yang ada pada Controller Page, sehingga semua
link pada navigasi header dapat menampilkan tampilan dengan layout yang sama.

Jawaban: 

![Gambar Contact](Pict/contact.png)

- Buat File baru di dalam direktori (app/view) buat beberapa file yg dibutuhkan misalnya contact.php dan kemudian isi dengan berikut:

```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('styles.css'); ?>">
</head>
<body>

<?= $this->include('template/header.php'); ?>

<h1><?= esc($title); ?></h1>
<hr>
<p><?= esc($content); ?></p>

<?= $this->include('template/footer.php'); ?>

</body>
</html>
```

Kemudian ubah kode pada Controller Page

```
<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function about()
    {
        return view('about', [
            'title' => 'Halaman About',
            'content' => 'Ini adalah halaman about yang menjelaskan tentang isi halaman ini.'
        ]);
    }

    public function contact()
    {
        return view('contact', [
            'title' => 'Halaman Contact',
            'content' => 'Ini adalah halaman contact.'
        ]);
    }

    public function artikel()
    {
        return view('artikel', [
            'title' => 'Halaman Artikel',
            'content' => 'Ini adalah halaman artikel.'
        ]);
    }

    public function faqs()
    {
        return view('faqs', [
            'title' => 'Halaman FAQ',
            'content' => 'Ini adalah halaman FAQ.'
        ]);
    }

    public function tos()
    {
        return view('tos', [
            'title' => 'Halaman Term of Services',
            'content' => 'Ini adalah halaman Term of Services.'
        ]);
    }
}
```
# Pratikum 2 - Pemrograman Web 2 (Framework Lanjutan CRUD) 

## Persiapan 
Untuk memulai pratikum membuat aplikasi CRUD sederhana, yang perlu disiapkan adalah database srver menggunakan MySQL. Pastikan MySQL dan apache sudah aktif 

## Membuat Database 
Setelah membuat itu kita membuat database dengan nama lab_ci4 setelah itu kita membat tabel 

## Koneksi Database 
Selanjutnya membuat konfigurasi database untuk menghubungkan dengan database server. Konfigurasi dapat dilakukan menggunakan file .env 

## Membuat Model 
Selanjutnya adalah membuat model untuk memproses data Artikel. Buat File baru pada direktori app/Models dengan nama ArtikelModel.php 


<?php
namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'isi', 'status', 'slug',
    'gambar'];
}


