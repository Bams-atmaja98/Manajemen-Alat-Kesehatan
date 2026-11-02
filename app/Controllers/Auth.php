<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $model = new UserModel();
        $user  = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id'    => $user['id'],
                'username'   => $user['username'],
                'full_name'  => $user['full_name'],
                'logged_in'  => true,
            ]);
            return redirect()->to('/home');
        }

        return redirect()->to('/login')->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda berhasil logout.');
    }
}
