<?php

namespace App\Models;
use CodeIgniter\Model;

class AnimalModel extends Model
{
    protected $table = 'tbl_animal_lkp';
    protected $primaryKey = 'animal_id';
    protected $allowedFields = [
        'animal_name',
        'animal_breed',
        'data_status',
        'data_delete',
        'date_create',
        'date_modified'
    ];
    
    public $timestamps = false;
}