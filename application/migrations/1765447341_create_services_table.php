<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_services_table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'service_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => FALSE
            ),
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => 'active',
                'null' => FALSE
            ),
            'price' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'null' => TRUE
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'deleted_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            )
        ));


        $this->dbforge->add_key('id', TRUE);


        $this->dbforge->create_table('services');

        $this->db->query('ALTER TABLE services ADD UNIQUE (service_name)');
    }

    public function down() {

        $this->dbforge->drop_table('services');
    }
}
