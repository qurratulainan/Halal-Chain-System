<?php

namespace App\Controllers;

use App\Models\RegisterModels;

class LoginController extends BaseController
{
    protected $session;
    protected $RegisterModel;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->session = session();
        $this->RegisterModel = new RegisterModels();
        $this->db = \Config\Database::connect();
    }

    public function login()
    {
        $data['roles'] = $this->RegisterModel->getRoles(); // Fetch roles for dropdown
        return view('LoginPage', $data);
    }

    public function loginSubmit()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role_id  = $this->request->getPost('role_id');

        // Fetch user
        $user = $this->db->table('tbl_register')
            ->where('email', $email)
            ->where('role_id', $role_id) // also check role
            ->get()
            ->getRow();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found for this role.');
        }

        if (!password_verify($password, $user->password)) {
            return redirect()->back()->with('error', 'Invalid password.');
        }

        // Save session
        $this->session->set([
            'user_id'   => $user->user_id,
            'email'     => $user->email,
            'org_id'    => $user->organisation_id,
            'role_id'   => $user->role_id,
            'isLoggedIn' => true
        ]);

        // Redirect based on role_id
        switch ($user->role_id) {
            case 1: // admin
                return redirect()->to('/AdminDashboard');
            case 2: // slaughterhouse
            case 3: // supplier
            case 4: // manufacturer
                return redirect()->to('/Dashboard');
            default:
                return redirect()->to('/')->with('error', 'Invalid role.');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
