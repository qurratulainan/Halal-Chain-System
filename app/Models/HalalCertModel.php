<?php

namespace App\Models;

use CodeIgniter\Model;

class HalalCertModel extends Model
{
    protected $table = 'tbl_halal_certificate';
    protected $primaryKey = 'halal_cert_id';
    protected $allowedFields = [
        'halal_cert_id',
        'organisation_id',
        'halal_cert_number',
        'halal_expired_date',
        'data_status',
        'data_delete',
        'date_create',
        'date_modified'
    ];

    public $timestamps = false;
}
