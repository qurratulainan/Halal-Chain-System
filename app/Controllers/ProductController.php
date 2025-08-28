<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\CountryModel;

class ProductController extends BaseController
{
    protected $productsModel;
    protected $countryModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->productsModel = new ProductsModel();
        $this->countryModel = new CountryModel();
    }

    public function product()
    {
        
        $data['countries'] = $this->countryModel->getCountries();
        return view('ProductPage', $data);
    }

    public function store()
    {
        // $halalCertNumber = $this->request->getPost('halal_cert_number');
        // $halalExpiredDate = $this->request->getPost('halal_expired_date');

        // $halalCert = $this->productsModel->db->table('tbl_halal_certificate')
        //     ->where('halal_cert_number', $halalCertNumber)
        //     ->get()
        //     ->getRowArray();

        // if (!$halalCert) {
        //     // Insert new halal certificate
        //     $this->productsModel->db->table('tbl_halal_certificate')->insert([
        //         'halal_cert_number' => $halalCertNumber,
        //         'halal_expired_date' => $halalExpiredDate,
        //         'date_create' => date('Y-m-d H:i:s'),
        //         'date_modified' => date('Y-m-d H:i:s'),
        //         'data_status' => 1,
        //         'data_delete' => 0
        //     ]);
        //     $halalCertId = $this->productsModel->db->insertID();
        // } else {
        //     $halalCertId = $halalCert['halal_cert_id'];
        // }


        $animal_name = $this->request->getPost('animal_name');
        $animal_breed = $this->request->getPost('animal_breed');

        $animal = $this->productsModel->db->table('tbl_animal_lkp')
            ->where('animal_name', $animal_name)
            ->where('animal_breed', $animal_breed)
            ->get()
            ->getRowArray();

        if (!$animal) {
            // Insert new animal
            $this->productsModel->db->table('tbl_animal_lkp')->insert([
                'animal_name' => $animal_name,
                'animal_breed' => $animal_breed,
                'data_status' => 1,
                'data_delete' => 0,
                'date_create' => date('Y-m-d H:i:s'),
                'date_modified' => date('Y-m-d H:i:s')
            ]);
            $animalId = $this->productsModel->db->insertID();
        } else {
            $animalId = $animal['animal_id'];
        }

        $meat_name = $this->request->getPost('meat_name');
        $meat_part = $this->request->getPost('meat_part');

        $meat = $this->productsModel->db->table('tbl_meat_lkp')
            ->where('meat_name', $meat_name)
            ->where('meat_part', $meat_part)
            ->get()
            ->getRowArray();

        if (!$meat) {
            // Insert new meat
        
            $this->productsModel->db->table('tbl_meat_lkp')->insert([
                'animal_id' => $animalId,
                'meat_name' => $meat_name,
                'meat_part' => $meat_part,
                'data_status' => 1,
                'data_delete' => 0,
                'date_create' => date('Y-m-d H:i:s'),
                'date_modified' => date('Y-m-d H:i:s')
            ]);
            $meatId = $this->productsModel->db->insertID();
        } else {
            $meatId = $meat['meat_id'];
        }

        $countryName = $this->request->getPost('country_id');

        // Check if country exists
        $country = $this->productsModel->db->table('tbl_country')
            ->where('country_name', $countryName)
            ->get()
            ->getRowArray();

        if (!$country) {
            $this->productsModel->db->table('tbl_country')->insert([
                'country_name' => $countryName,
                'date_create' => date('Y-m-d H:i:s'),
                'date_modified' => date('Y-m-d H:i:s'),
                'data_status' => 1,
                'data_delete' => 0
            ]);
            $countryId = $this->productsModel->db->insertID();
        } else {
            $countryId = $country['country_id'];
        }


        // Save product
        $this->productsModel->save([
            'animal_id'         => $animalId,
            'meat_id'           => $meatId,
            // 'halal_cert_id'     => $halalCertId,
            'country_id'        => $countryId,
            'product_name'      => $this->request->getPost('product_name'),
            'product_code'      => $this->request->getPost('product_code'),
            'product_category'  => $this->request->getPost('product_category'),
            'product_price'     => $this->request->getPost('product_price'),
            // 'date_of_processing'=> $this->request->getPost('date_of_processing'),
            'org_id'            => session()->get('org_id'),
            'data_status'       => 1,
            'data_delete'       => 0,
            'date_create'       => date('Y-m-d H:i:s'),
            'date_modified'     => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('product')->with('success', 'Product added successfully!');
    }

    public function create()
    {
        helper(['form']);
        $animalModel = new \App\Models\AnimalModel();
        $meatModel = new \App\Models\MeatModel();
        $productModel = new \App\Models\ProductsModel();

        // Insert into tbl_animal_lkp
        $animal_id = $animalModel->insert([
            'animal_name' => $this->request->getPost('animal_name'),
            'animal_breed' => $this->request->getPost('animal_breed')
        ]);

        // Insert into tbl_meat_lkp
        $meat_id = $meatModel->insert([
            'meat_name' => $this->request->getPost('meat_name'),
            'meat_part' => $this->request->getPost('meat_part')
        ]);

        // Insert into product table
        $productModel->insert([
            'animal_id' => $animal_id,
            'meat_id' => $meat_id,
            'country_id' => $this->request->getPost('country_id'),
            'product_name' => $this->request->getPost('product_name'),
            'product_code' => $this->request->getPost('product_code'),
            'product_category' => $this->request->getPost('product_category'),
            'product_price' => $this->request->getPost('product_price'),
            // 'date_of_processing' => $this->request->getPost('date_of_processing')
        ]);

        return redirect()->to('/products');
    }

    public function history()
    {
        // $orgId = session()->get('org_id'); // Get logged-in org

        // $data['history'] = $this->productsModel
        //     ->where('org_id', $orgId) // filter by organisation
        //     ->findAll();

        $productModel = new \App\Models\ProductsModel();
        $data['tbl_products'] = $productModel->findAll(); // get all products

        return view('ProductHistory', $data);
    }
}