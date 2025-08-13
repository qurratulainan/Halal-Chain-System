<?php

namespace App\Models;

use CodeIgniter\Model;

class RegisterModels extends Model
{
    protected $table = 'tbl_register'; 
    protected $primaryKey = 'registration_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'profile_id',
        'role_id',
        'organisation_id',
        'halal_cert_id', 
        'full_name',
        'email',
        'password',
        'phone_number',
        'address',
        'data_status',
        'data_delete',
        'date_create',
        'date_modified'
    ];

    protected $useTimestamps = false;

    // Fetch roles from tbl_role_lkp
    public function getRoles()
    {
        return $this->db->table('tbl_role_lkp')
            ->select('role_id, role_name')
            ->get()
            ->getResultArray();
    }

}
