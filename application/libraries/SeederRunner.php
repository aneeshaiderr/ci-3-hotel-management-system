<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SeederRunner {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function run($seederName) {

        $file = APPPATH . 'seeds/' . $seederName . '.php';

        if (!file_exists($file)) {
            throw new Exception("Seeder file does not exist!");
        }


        require_once($file);

        if (!class_exists($seederName)) {
            throw new Exception("Seeder class $seederName does not exist!");
        }

        $seeder = new $seederName();

        if (!method_exists($seeder, 'run')) {
            throw new Exception("Seeder $seederName does not have run method!");
        }

        $seeder->run();
    }
}
