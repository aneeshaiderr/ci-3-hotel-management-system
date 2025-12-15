<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seeder extends CI_Controller {

    public function run($seederName = null) {

        if (!$seederName) {
            echo "Please provide seeder name!";
            return;
        }


               $this->load->library('SeederRunner');

        $this->seederrunner->run($seederName);

        echo "Seeder execution completed.";
    }
}
