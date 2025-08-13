<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table = 'tbl_products'; 
    protected $primaryKey = 'product_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'animal_id', 
        'meat_id', 
        'country_id', 
        'product_name',
        'product_code',
        'product_category',
        'date_of_processing',
        'data_status',
        'data_delete',
        'date_create',
        'date_modified'
    ];

    protected $useTimestamps = false;


    // Fetch country names from tbl_origin_country_lkp
    public function getCountry()
    {
        return $this->db->table('tbl_origin_country_lkp')
            ->select('country_id, country_name')
            ->get()
            ->getResultArray();
    }

    public function getHistoryByOrg($orgId)
    {
        return $this->db->table($this->table)
            ->where('organisation_id', $orgId)
            ->orderBy('date_create', 'DESC')
            ->get()
            ->getResultArray();
    }

   
}
