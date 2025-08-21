<?php

namespace App\Controllers;

use App\Models\OrdersModel;
use App\Models\ProductsModel;

class OrdersController extends BaseController
{
    protected $ordersModel;
    protected $productsModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->ordersModel = new OrdersModel();
        $this->productsModel = new ProductsModel();
    }

    public function orders()
    {
        $data['tbl_products'] = $this->productsModel->findAll();
        return view('orders/create', $data);
    }

    // Handle form submission
    public function store()
    {
        $nextId = $this->ordersModel->selectMax('order_id')->get()->getRow()->order_id + 1;
        $orderTrackingNumber = 'ORD-' . str_pad($nextId, 6, '0', STR_PAD_LEFT);


        $this->ordersModel->save([
            'organisation_id'       => session()->get('org_id'), // from login session
            'product_id'            => $this->request->getPost('product_id'),
            'order_tracking_number' => $orderTrackingNumber,
            'quantity'              => $this->request->getPost('quantity'),
            'order_date'            => date('Y-m-d'),
            'expected_delivery_date' => $this->request->getPost('expected_delivery_date'),
            'order_status'          => $this->request->getPost('order_status'),
            'origin_address'       => $this->request->getPost('origin_address'),
            'destination_address'  => $this->request->getPost('destination_address'),
            'origin_port_shipment' => $this->request->getPost('origin_port_shipment'),
            'depart_date_from_port'  => $this->request->getPost('depart_date_from_port'),  
            'port_of_shipment'       => $this->request->getPost('port_of_shipment'), 
            'port_arrival_date'      => $this->request->getPost('port_arrival_date'), 
            'port_leave_date'       => $this->request->getPost('port_leave_date'), 
            'remarks'               => $this->request->getPost('remarks'),
            'data_status'           => 1,
            'data_delete'           => 0,
            'date_create'           => date('Y-m-d H:i:s'),
            'date_modified'         => date('Y-m-d H:i:s')
        ]);

        // $quantity   = $this->request->getPost('quantity');

        $data = [
            'product_id'   => $this->request->getPost('product_id'),
        ];

        // return redirect()->to('/orders/create')->with('success', 'Order placed successfully!');
    }

    // Show history of orders for logged in org
    public function history()
    {
        $orgId = session()->get('org_id');
        $data['tbl_orders'] = $this->ordersModel->getHistoryByOrg($orgId);

        return view('OrderHistory', $data);
    }

    /* how to make these not compulsory to fill in? 
            'origin_port_shipment', // port mana yg dia depart
            'depart_date_from_port',
            'port_of_shipment', // port mana yg dia stop or pergi
            'port_arrival_date', // date sampai kat shipment port 
            'port_leave_date', // date kena gerak dari port tu
    */

}
