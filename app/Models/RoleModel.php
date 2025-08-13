<?php

namespace App\Models;
use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'tbl_roles';
    protected $primaryKey = 'role_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'role_name',
        'role_code',
        'data_status',
        'data_delete',
        'date_create',
        'date_modified'
    ];

    protected $useTimestamps = false;


    public function getRoles()
    {
        return $this->db->table('tbl_role_lkp')
            ->select('role_id, role_name')
            ->get()
            ->getResultArray();
    }
}