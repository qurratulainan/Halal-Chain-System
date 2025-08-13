<?php

namespace App\Controllers;

use App\Models\LoginModels;

class LoginController extends BaseController
{
    protected $session;
    protected $LoginModel;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->session = session();
        $this->LoginModel = new LoginModels();
        $this->db = \Config\Database::connect();
    }

    public function login()
    {
        $data['roles'] = $this->LoginModel->getRoles(); // Fetch role list
        return view('LoginPage',  $data);
    }

    public function loginSubmit()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role_id');
        

        // Fetch user
        $user = $this->db->table('tbl_login')
            ->where('email', $email)
            ->get()
            ->getRow();

        if ($user && password_verify($password, $user->password)) {
            if (password_verify($password, $user['password'])) {
                // Fetch org_id from tbl_register using the same email
                $registerData = $this->db->table('tbl_register')
                    ->where('email', $email)
                    ->get()
                    ->getRow();

                if ($registerData) {
                    session()->set([
                        'user_id' => $user->user_id,
                        'email'   => $user->email,
                        'password' => $user->password,
                        'org_id'  => $registerData->org_id, // ✅ store org_id in session
                        'isLoggedIn' => true
                    ]);

                    if ($registerData->role === 'admin') {
                        return redirect()->to('AdminDashboard');
                    } elseif (in_array($registerData->role, ['slaughterhouse', 'supplier', 'manufacturer'])) {
                        return redirect()->to('Dashboard');
                    } else {
                        return redirect()->to('/')->with('error', 'Invalid role');
                    }
                }

                return redirect()->to('DashboardPage');
            } else {
                // Wrong password — increase failed attempts
                $this->LoginModel->update($user['login_id'], [
                    'failed_attempts' => $user['failed_attempts'] + 1
                ]);

                return redirect()->back()->with('error', 'Invalid password.');
            }
        } else {
            return redirect()->back()->with('error', 'Email not found.');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
