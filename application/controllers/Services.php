<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ServiceModel');
        $this->load->library('twig');
        $this->load->library('session');
    }

    public function index() {

        $services = $this->ServiceModel->getAll();

        $this->render('dashboard/Service/service', [

            'services' => $services
        ]);
    }


    public function delete() {

        if ($this->input->post('id', true)) {

            $id = (int) $this->input->post('id', true);

            $this->ServiceModel->softDelete($id);
        }
        redirect('services');
    }

    public function create() {

        $services = $this->ServiceModel->all();

        $this->render('dashboard/Service/createService', [
            'services' => $services
        ]);
    }

    public function store() {

        if ($this->input->method() !== 'post') {

            redirect('services');

            return;
        }

        $data = [
            'service_name' => $this->input->post('service_name', true),
            'price'        => $this->input->post('price', true),
            'status'       => $this->input->post('status', true)
        ];


        $this->ServiceModel->create($data);

        $this->session->set_flashdata('success', 'Service created successfully.');

        redirect('services');
    }

    public function edit() {
        $id = $this->input->get('id', true);
        if (!$id) {
            redirect('services');
            return;
        }

        $service = $this->ServiceModel->find($id);

        if (!$service) {

            redirect('services');
            return;
        }

         $this->render('dashboard/Service/editService', [
            'service' => $service
        ]);
    }

    public function update() {

        if ($this->input->method() !== 'post') {

            redirect('services');

            return;
        }

        $id = $this->input->post('id', true);

        if (!$id) {

            $this->session->set_flashdata('error', 'Service ID is required!');

            redirect('services');

            return;
        }

        $data = [
            'service_name' => $this->input->post('service_name', true),
            'price'        => $this->input->post('price', true),
            'status'       => $this->input->post('status', true)
        ];

        $this->ServiceModel->update($id, $data);

        $this->session->set_flashdata('success', 'Service updated successfully.');

        redirect('services');
    }
}
