<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $twigData = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->library(['session', 'twig']);
        $this->load->helper('url');


        $this->twigData['session'] = [
            'user_id'   => $this->session->userdata('user_id'),
            'role_id'   => $this->session->userdata('role_id'),
            'role_name' => $this->session->userdata('role_name'),
            'name'      => $this->session->userdata('name'),
            'logged_in' => $this->session->userdata('logged_in'),
            'permissions' => $this->session->userdata('permissions'),
        ];
    }

    protected function render($view, $data = [])
    {
        $data = array_merge($this->twigData, $data);

        echo $this->twig->render($view, $data);
        exit;
    }

}
