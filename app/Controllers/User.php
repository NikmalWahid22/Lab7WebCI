<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $title = 'Daftar User';
        $model = new UserModel();
        $users = $model->findAll();

        return view('user/index', compact('users', 'title'));
    }

    public function login()
    {
        helper(['form']);

        $session = session();

        // kalau belum submit form → tampilkan halaman login
        if (!$this->request->getPost()) {
            return view('login');
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $model = new UserModel();
        $user = $model->where('useremail', $email)->first();

        if ($user) {
            if (password_verify($password, $user['userpassword'])) {

                $session->set([
                    'user_id'    => $user['id'],
                    'user_name'  => $user['username'],
                    'user_email' => $user['useremail'],
                    'logged_in'  => true,
                ]);

                return redirect()->to('/admin/artikel');
            } else {
                $session->setFlashdata('flash_msg', 'Password salah.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('flash_msg', 'Email tidak terdaftar.');
            return redirect()->to('/login'); // ✅ FIX
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}