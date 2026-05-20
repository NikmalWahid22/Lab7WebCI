<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ArtikelModel;

class Post extends ResourceController
{
    use ResponseTrait;

    // GET /post (Fetch all articles)
    public function index()
    {
        $model = new ArtikelModel();
        $data['artikel'] = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }

    // POST /post (Create a new article)
    public function create()
    {
        $model = new ArtikelModel();
        $data = [
            'judul' => $this->request->getVar('judul'),
            'isi'   => $this->request->getVar('isi'),
        ];
        
        $model->insert($data);
        
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data artikel berhasil ditambahkan.'
            ]
        ];
        return $this->respondCreated($response);
    }

    // GET /post/{id} (Fetch a single article)
    public function show($id = null)
    {
        $model = new ArtikelModel();
        $data = $model->find($id); // Using find() is cleaner than where()->first()
        
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }

    // PUT/PATCH /post/{id} (Update an article)
    public function update($id = null)
    {
        $model = new ArtikelModel();
        
        // Check if the article actually exists first
        $exists = $model->find($id);
        if (!$exists) {
            return $this->failNotFound('Data tidak ditemukan.');
        }

        // Get JSON or Form data dynamically
        $input = $this->request->getRawInput();
        
        $data = [
            'judul' => $input['judul'] ?? $exists['judul'],
            'isi'   => $input['isi'] ?? $exists['isi'],
        ];

        $model->update($id, $data);
        
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data artikel berhasil diubah.'
            ]
        ];
        return $this->respond($response);
    }

    // DELETE /post/{id} (Delete an article)
    public function delete($id = null)
    {
        $model = new ArtikelModel();
        $data = $model->find($id);
        
        if ($data) {
            $model->delete($id); // Delete once cleanly
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data artikel berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
}