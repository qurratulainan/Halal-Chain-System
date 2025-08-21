<?php

namespace App\Controllers;

use App\Models\RegisterModels;
use App\Models\RoleModel;

class RegisterPageController extends BaseController
{
    protected $session;
    protected $RegisterModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->session = session();
        $this->RegisterModel = new RegisterModels();
    }

    // Show login form
    public function login()
    {
        $data['roles'] = $this->RegisterModel->getRoles();
        return view('login', $data);
    }

    // Handle login request
    public function loginSubmit()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        $user = $this->RegisterModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Wrong password.');
        }

        if ($user['role'] !== $role) {
            return redirect()->back()->with('error', 'Incorrect role selected.');
        }

        $this->session->set([
            'user_id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'isLoggedIn' => true,
        ]);

        if ($role === 'admin') {
            return redirect()->to('AdminDashboard');
        } elseif ($role === 'manufacturer') {
            return redirect()->to('Dashboard');
        } elseif ($role === 'supplier') {
            return redirect()->to('Dashboard');
        } elseif ($role === 'slaughterhouse') {
            return redirect()->to('Dashboard');
        } else {
            return redirect()->to('/');
        }
    }


    public function ajaxLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role_id = $this->request->getPost('role_id');

        $user = $this->RegisterModel
            ->where('email', $email)
            ->first();

        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not found']);
        }

        if (!password_verify($password, $user['password'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Wrong password']);
        }

        if ($user['role_id'] != $role_id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Incorrect role selected']);
        }

        // Save session
        $this->session->set([
            'user_id'    => $user['profile_id'],
            'name'       => $user['full_name'],
            'email'      => $user['email'],
            'role_id'    => $user['role_id'],
            'isLoggedIn' => true,
        ]);

        // Decide redirect URL based on role
        $redirectUrl = '';
        switch ($role_id) {
            case 1: // Admin
                $redirectUrl = base_url('AdminDashboard');
                break;
            case 2: // Manufacturer
            case 3: // Supplier
            case 4: // Slaughterhouse
                $redirectUrl = base_url('Dashboard');
                break;
            default:
                $redirectUrl = base_url('/');
                break;
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Login successful',
            'redirect' => $redirectUrl
        ]);
    }

    

    // Show register form
    public function register()
    {
        $data['roles'] = $this->RegisterModel->getRoles(); // Fetch role list
        return view('RegisterPage', $data);
    }

    // Handle register request
    public function registerSubmit()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'pass_confirm' => 'required|matches[password]',
            'role' => 'required|in_list[admin,staff]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $validation->getErrors()));
        }

        $organisationName = $this->request->getPost('organisation_name');

        // Check if organisation exists
        $organisation = $this->RegisterModel->db->table('tbl_organisation')
            ->where('organisation_name', $organisationName)
            ->get()
            ->getRowArray();

        if (!$organisation) {
            $this->RegisterModel->db->table('tbl_organisation')->insert([
                'organisation_name' => $organisationName,
                'date_create' => date('Y-m-d H:i:s'),
                'date_modified' => date('Y-m-d H:i:s'),
                'data_status' => 1,
                'data_delete' => 0
            ]);
            $organisationId = $this->RegisterModel->db->insertID();
        } else {
            $organisationId = $organisation['organisation_id'];
        }

        $halalCertNumber = $this->request->getPost('halal_cert_number');
        $halalExpiredDate = $this->request->getPost('halal_expired_date');

        $halalCert = $this->RegisterModel->db->table('tbl_halal_certificate')
            ->where('halal_cert_number', $halalCertNumber)
            ->where('halal_expired_date', $halalExpiredDate)
            ->get()
            ->getRowArray();

        if (!$halalCert) {
            // Insert new halal certificate
            $this->RegisterModel->db->table('tbl_halal_certificate')->insert([
                'organisation_id' => $organisationId,
                'halal_cert_number' => $halalCertNumber,
                'halal_expired_date' => $halalExpiredDate,
                'date_create' => date('Y-m-d H:i:s'),
                'date_modified' => date('Y-m-d H:i:s'),
                'data_status' => 1,
                'data_delete' => 0
            ]);
            $halalCertId = $this->RegisterModel->db->insertID();
        } else {
            $halalCertId = $halalCert['halal_cert_id'];
        }

        $this->RegisterModel->save([
            'profile_id'        => null,
            'role_id'           => $this->request->getPost('role_id'),
            'organisation_id'   => $organisationId,
            'halal_cert_id'     => $halalCertId,
            'full_name'         => $this->request->getPost('full_name'),
            'email'             => $this->request->getPost('email'),
            'password'          => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'phone_number'      => $this->request->getPost('phone_number'),
            'address'           => $this->request->getPost('address'),
            'data_status'       => 1,
            'data_delete'       => 0,
            'date_create'       => date('Y-m-d H:i:s'),
            'date_modified'     => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/register')->with('success', 'Account created. Please login.');
    }

    // Logout
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
