<?php

namespace App\Models;

use CodeIgniter\Model;

class CountryModel extends Model
{
    protected $table = 'tbl_origin_country_lkp';
    protected $primaryKey = 'country_id';
    
    protected $allowedFields = [
        'country_name',
        'data_status',
        'data_delete',
        'date_create',
        'date_modified'
    ]; 

    public $useTimestamps = false;

    // Fetch all countries for dropdown
    public function getCountries()
    {
        return $this->select('country_id, country_name')
            ->orderBy('country_name', 'ASC')
            ->findAll();
    }
}
