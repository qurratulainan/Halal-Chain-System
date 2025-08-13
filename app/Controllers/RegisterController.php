<?php

namespace App\Controllers;

use App\Models\RegisterModels;


class RegisterController extends BaseController
{
    protected $registerModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->registerModel = new RegisterModels();
    }

    public function register()
    {

        $data['roles'] = $this->registerModel->getRoles(); // Fetch role list
        return view('RegisterPage', $data);
    }

    public function store()
    {
        $organisationName = $this->request->getPost('organisation_name');

        // Check if organisation exists
        $organisation = $this->registerModel->db->table('tbl_organisation')
            ->where('organisation_name', $organisationName)
            ->get()
            ->getRowArray();

        if (!$organisation) {
            $this->registerModel->db->table('tbl_organisation')->insert([
                'organisation_name' => $organisationName,
                'date_create' => date('Y-m-d H:i:s'),
                'date_modified' => date('Y-m-d H:i:s'),
                'data_status' => 1,
                'data_delete' => 0
            ]);
            $organisationId = $this->registerModel->db->insertID();
        } else {
            $organisationId = $organisation['organisation_id'];
        }

        $halalCertNumber = $this->request->getPost('halal_cert_number');
        $halalExpiredDate = $this->request->getPost('halal_expired_date');

        $halalCert = $this->registerModel->db->table('tbl_halal_certificate')
            ->where('halal_cert_number', $halalCertNumber)
            ->where('halal_expired_date', $halalExpiredDate)
            ->get()
            ->getRowArray();

        if (!$halalCert) {
            // Insert new halal certificate
            $this->registerModel->db->table('tbl_halal_certificate')->insert([
                'organisation_id' => $organisationId,
                'halal_cert_number' => $halalCertNumber,
                'halal_expired_date' => $halalExpiredDate,
                'date_create' => date('Y-m-d H:i:s'),
                'date_modified' => date('Y-m-d H:i:s'),
                'data_status' => 1,
                'data_delete' => 0
            ]);
            $halalCertId = $this->registerModel->db->insertID();
        } else {
            $halalCertId = $halalCert['halal_cert_id'];
        }

        $this->registerModel->save([
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

        return redirect()->to('/register')->with('success', 'Registration successful!');    
    }
}
