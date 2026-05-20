<?php 

namespace App\Controllers; 

use App\Models\ArtikelModel;   
use App\Models\KategoriModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Artikel extends BaseController 
{
    public function index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();

        $artikel = $model
            ->select('artikel.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
            ->findAll();

        return view('artikel/index', compact('artikel', 'title'));
    }

    public function view($slug)
    {
        $model = new ArtikelModel();

        $artikel = $model
            ->select('artikel.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
            ->where('slug', $slug)
            ->first();

        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $title = $artikel['judul'];

        return view('artikel/detail', compact('artikel', 'title'));
    }

  public function admin_index()
    {
        $model = new ArtikelModel();
        $kategoriModel = new KategoriModel();

        $q = $this->request->getVar('q') ?? '';
        $kategori_id = $this->request->getVar('kategori_id') ?? '';
        $page = $this->request->getVar('page') ?? 1;

        $builder = $model->select('artikel.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');

        if ($q) {
            $builder->like('artikel.judul', $q);
        }

        if ($kategori_id) {
            $builder->where('artikel.id_kategori', $kategori_id);
        }

        // SORTING (TAMBAHAN)
        $sort = $this->request->getVar('sort') ?? 'id';
        $order = $this->request->getVar('order') ?? 'DESC';
        $builder->orderBy($sort, $order);

        $artikel = $builder->paginate(5, 'default', $page);
        $pager = $model->pager->links('default', 'default_full');

        $data = [
            'artikel'     => $artikel,
            'pager'       => $model->pager->links('default', 'default_full'),
            'q'           => $q,
            'kategori_id' => $kategori_id,
        ];

        // 🔥 INI KUNCI PRAKTIKUM
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($data);
        }

        return view('artikel/admin_index', [
            'title'    => 'Daftar Artikel',
            'kategori' => $kategoriModel->findAll()
        ]);
    }
    public function add()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'judul'       => 'required',
            'id_kategori' => 'required',
            'gambar'      => 'uploaded[gambar]|is_image[gambar]'
        ]);

        $isDataValid = $validation
            ->withRequest($this->request)
            ->run();

        $kategoriModel = new KategoriModel();

        if ($isDataValid)
        {
            $file = $this->request->getFile('gambar');

            if ($file->isValid() && !$file->hasMoved()) {
                $file->move(ROOTPATH . 'public/gambar');
            }

            $artikel = new ArtikelModel();

            $artikel->insert([
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'slug'        => url_title(
                    $this->request->getPost('judul'),
                    '-',
                    true
                ),
                'gambar'      => $file->getName(),
                'id_kategori' => $this->request->getPost('id_kategori')
            ]);

            return redirect()->to('/admin/artikel');
        }

        $title = "Tambah Artikel";

        return view('artikel/form_add', [
            'title'      => $title,
            'kategori'   => $kategoriModel->findAll(),
            'validation' => $validation
        ]);
    }

    public function edit($id)
    {
        $model = new ArtikelModel();
        $kategoriModel = new KategoriModel();

        $artikel = $model->find($id);

        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data tidak ditemukan");
        }

        $validation = \Config\Services::validation();

        $validation->setRules([
            'judul' => 'required'
        ]);

        $isDataValid = $validation
            ->withRequest($this->request)
            ->run();

        if ($isDataValid)
        {
            $file = $this->request->getFile('gambar');

            // default gambar lama
            $namaGambar = $artikel['gambar'];

            // kalau upload gambar baru
            if ($file && $file->isValid() && !$file->hasMoved()) {

                $namaGambar = $file->getRandomName();
                $file->move(ROOTPATH . 'public/gambar', $namaGambar);

                // hapus gambar lama
                if (!empty($artikel['gambar']) &&
                    file_exists(ROOTPATH . 'public/gambar/' . $artikel['gambar'])) {
                    unlink(ROOTPATH . 'public/gambar/' . $artikel['gambar']);
                }
            }

            $model->update($id, [
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'gambar'      => $namaGambar,
                'slug'        => url_title(
                    $this->request->getPost('judul'),
                    '-',
                    true
                ),
            ]);

            return redirect()->to('/admin/artikel');
        }

        return view('artikel/form_edit', [
            'title'    => 'Edit Artikel',
            'artikel'  => $artikel,
            'kategori' => $kategoriModel->findAll()
        ]);
    }

    public function delete($id)
    {
        $model = new ArtikelModel();
        $model->delete($id);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'OK']);
        }

        return redirect()->to('/admin/artikel');
    }

    public function render(string $kategori = null)
    {
        $model = new ArtikelModel();

        $query = $model
            ->select('artikel.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
            ->orderBy('artikel.id', 'DESC'); // aman

        if ($kategori) {
            $query->where('kategori.nama_kategori', $kategori);
        }

        $artikel = $query->limit(5)->findAll();


        return view('components/artikel_terkini', [
            'artikel'  => $artikel,
            'kategori' => $kategori 
        ]);
    }
}
