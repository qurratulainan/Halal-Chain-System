<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModels extends Model
{
    protected $table = 'tbl_login'; 
    protected $primaryKey = 'login_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    // Fields allowed for insert/update
    protected $allowedFields = [
        'registration_id',  //FK from tbl_registration
        'role_id',          //FK from tbl_role_lkp
        'email',
        'password',
        'last_login',
        'failed_attempts',
        'account_blocked',
        'is_active'
    ];

    protected $useTimestamps = false;


    protected $attributes = [
        'failed_attempts' => 0,
        'account_blocked' => 0,
        'is_active'       => 1
    ];

    public function getRoles()
    {
        // Change table name if yours is different
        return $this->db->table('tbl_role_lkp')
            ->select('role_id, role_name')
            ->get()
            ->getResultArray();
    }
}
