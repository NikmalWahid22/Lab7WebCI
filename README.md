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

```
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
```

## Membuat Controller 
Buatlah Controller baru dengan nama Artikel.php pada direktori app/Controllers

```
<?php 

namespace App\Controllers; 

use App\Models\ArtikelModel;

class Artikel extends BaseController 
{
    public function index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $artikel = $model -> findAll();
        return view('artikel/index', compact('artikel', "title"));
    }
}
```

# Membuat view 
Membuat direktori baru dengan nama artikel pada direktori app/views, kemudian buat file baru dengan nama index.php.

```
<?= $this->include('template/header'); ?>

<?php if ($artikel): ?>
    
    <?php foreach ($artikel as $row): ?>
        
        <article class="entry">
            <h2>
                <a href="<?= base_url('/artikel/' . $row['slug']); ?>">
                    <?= $row['judul']; ?>
                </a>
            </h2>

            <img 
                src="<?= base_url('/gambar/' . $row['gambar']); ?>" 
                alt="<?= $row['judul']; ?>"
            >

            <p>
                <?= substr($row['isi'], 0, 200); ?>
            </p>
        </article>

        <hr class="divider" />

    <?php endforeach; ?>

<?php else: ?>

    <article class="entry">
        <h2>Belum ada data.</h2>
    </article>

<?php endif; ?>

<?= $this->include('template/footer'); ?>
```
Selanjutnya kita akan menambah beberapa data pada database agar dapat ditampilkan datanya. 

## Membuat Tampilan detail Artikel 

Tampilan pada saat judul berita di klik maka akan diarahkan ke halaman yg berbeda. 
```
  public function view($slug)
    {
        $model = new ArtikelModel();
        $artikel = $model ->where([
            'slug' => $slug
        ])->first();

        // error apabila tidak ada data 

        if (!$artikel)
            {
                throw PageNotFoundException:: forPageNotFound();
            }

            $title = $artikel['judul'];
            return view('artikel/detail', compact('artikel', 'title'));
    }
```

## Membuat View Detail 

```
<?= $this->include('template/header'); ?> 

<article class="entry">
    <h2><?= $artikel['judul']; ?></h2>
    <img src="<?= base_url('/gambar/' . $artikel['gambar']);?>" alt="<?=$artikel['judul']; ?>">
    <p><?= $artikel['isi']; ?></p>
</article>

<?= $this->include('template/footer'); ?> 
```

## Membuat Routing untuk artikel detail 
Membuat routing tambahan untuk artikel detail 
```
$routes->get('/artikel/(:any)', 'Artikel::view/$1');
```

## Membuat Menu Admin 
Menu Admin adalah untuk proses CRUD data. buat method baru pada COntroller artikel denngan nama method admin_index()
```
  public function admin_index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $artikel = $model->findAll();
        return view('artikel/admin_index', compact('artikel', 'title'));
    }
```
Langkah selanjutnya adalah membuat tampilan admin dengan nama file admin_index.php
```
<?= $this->include('template/admin_header'); ?>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($artikel)) : ?>
            <?php foreach ($artikel as $row) : ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td>
                        <b><?= esc($row['judul']); ?></b>
                        <p>
                            <small><?= esc(substr($row['isi'], 0, 50)); ?>...</small>
                        </p>
                    </td>
                    <td><?= esc($row['status']); ?></td>
                    <td>
                        <a class="btn" href="<?= base_url('admin/artikel/edit/' . $row['id']); ?>">
                            Ubah
                        </a>

                        <a class="btn btn-danger"
                           onclick="return confirm('Yakin menghapus data?');"
                           href="<?= base_url('admin/artikel/delete/' . $row['id']); ?>">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="4" class="text-center">Belum ada data.</td>
            </tr>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
</table>

<?= $this->include('template/admin_footer'); ?>
```

kemudian tambah routing untuk menu admin 
```
$routes->group('admin', function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});
```

## Menambah Data Artikel 

```
public function add()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required'
        ]);

        $isDataValid = $validation
            ->withRequest($this->request)
            ->run();

        if ($isDataValid)
        {
            $model = new ArtikelModel();

            $model->insert([
                'judul' => $this->request->getPost('judul'),
                'isi'   => $this->request->getPost('isi'),
                'slug'  => url_title(
                    $this->request->getPost('judul'),
                    '-', 
                    true
                ),
            ]);

            return redirect()->to('/admin/artikel');
        }

        $title = "Tambah Artikel";
        return view('artikel/form_add', compact('title'));
    }
```
Kemudian agar bisa melihat form tambah kita harus membuat file baru bernama form_add.php 

```
<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>
<form action="" method="post">
    <p>
    <input type="text" name="judul">
    </p>

    <p>
    <textarea name="isi" cols="50" rows="10"></textarea>
    </p>
    <p><input type="submit" value="Kirim" class="btn btn-large"></p>
</form>
<?= $this->include('template/admin_footer'); ?>
```

## Mengubah Data 
Tambahkan method baru pada controller dengan nama edit()
```
 public function edit($id)
    {
        $model = new ArtikelModel();

        // Ambil data lama terlebih dahulu
        $data = $model->find($id);

        if (!$data) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data tidak ditemukan");
        }

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required'
        ]);

        $isDataValid = $validation
            ->withRequest($this->request)
            ->run();

        if ($isDataValid)
        {
            $model->update($id, [
                'judul' => $this->request->getPost('judul'),
                'isi'   => $this->request->getPost('isi'),
                'slug'  => url_title(
                    $this->request->getPost('judul'),
                    '-', 
                    true
                ),
            ]);

            return redirect()->to('/admin/artikel');
        }

        $title = "Edit Artikel";
        return view('artikel/form_edit', compact('title', 'data'));
    }
```





