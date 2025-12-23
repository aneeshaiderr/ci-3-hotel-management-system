<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discount extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('discountModel');

        $this->load->library('twig');
    }


    public function index()
    {
        $data['discounts'] = $this->discountModel->getAll();

        $this->render('dashboard/Discount/discount', $data);
    }


    public function create()
    {
         $this->render('dashboard/Discount/createDiscount');
    }


    public function store()
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $data = [
            'discount_type' => $this->input->post('discount_type', true),
            'discount_name' => $this->input->post('discount_name', true),
            'value'         => $this->input->post('value', true),
            'start_date'    => $this->input->post('start_date', true),
            'end_date'      => $this->input->post('end_date', true),
            'status'        => $this->input->post('status', true),
            'created_at'    => date('Y-m-d H:i:s')
        ];

        $this->discountModel->create($data);

        redirect('discount');
    }


    public function editDiscount($id = null)
    {
        if (!$id) {
            show_404();
        }

        $discount = $this->discountModel->find($id);
        if (!$discount) {
            show_404();
        }

         $this->render('dashboard/Discount/editDiscount', [
            'discount' => $discount
        ]);
    }


   public function update()
   {

    if ($this->input->method() !== 'post') {
        show_404();
    }

    $id = $this->input->post('id', true);

    if (empty($id)) {
        show_error('Discount ID missing');
    }

    $data = [
        'discount_type' => $this->input->post('discount_type', true),
        'discount_name' => $this->input->post('discount_name', true),
        'value'         => $this->input->post('value', true),
        'start_date'    => $this->input->post('start_date', true),
        'end_date'      => $this->input->post('end_date', true),
        'status'        => $this->input->post('status', true),
    ];

    $this->discountModel->update($id, $data);

    redirect('discount');
}

}
