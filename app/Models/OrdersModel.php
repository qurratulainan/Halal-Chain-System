<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'tbl_order';
    protected $primaryKey = 'order_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        	'organisation_id', 
            'product_id', 
            'order_tracking_number',  // auto generate
            'quantity',  // in kg
            'order_date',  // based on the purchased date
            'expected_delivery_date',  
            'order_status', 
            'origin_address', // where the daging delivered from
            'destination_address',  // where daging should sampai
            'origin_port_shipment', // port mana yg dia depart
            'depart_date_from_port',
            'port_of_shipment', // port mana yg dia stop or pergi
            'port_arrival_date', // date sampai kat shipment port 
            'port_leave_date', // date kena gerak dari port tu
            'remarks', 
            'data_status', 
            'data_delete', 
            'date_create', 
            'date_modified'
    ];

    protected $useTimestamps = false;


    public function getHistoryByOrg($orgId)
    {
        return $this->db->table($this->table)
            ->where('organisation_id', $orgId)
            ->orderBy('date_create', 'DESC')
            ->get()
            ->getResultArray();
    }
}
