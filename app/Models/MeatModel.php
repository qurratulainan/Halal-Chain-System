<?php

namespace App\Models;
use CodeIgniter\Model;

class MeatModel extends Model
{
    protected $table = 'tbl_meat_lkp';
    protected $primaryKey = 'meat_id';
    protected $allowedFields = [
        'meat_name',
        'meat_part',
        'date_of_slaughter',
        'data_status',
        'data_delete',
        'date_create',
        'date_modified'
    ];
    
    public $timestamps = false;
}