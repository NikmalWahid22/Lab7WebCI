<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table            = 'artikel';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'judul',
        'isi',
        'status',
        'slug',
        'gambar',
        'id_kategori'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Ambil data untuk AJAX
    public function getArtikelAjax()
    {
        return $this->select('id, judul, status')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    // Ambil dengan kategori
    public function getArtikelDenganKategori()
    {
        return $this->select('artikel.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id_kategori = artikel.id_kategori')
                    ->findAll();
    }
}