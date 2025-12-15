<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_discount_table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'discount_type' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ],
            'discount_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ],
            'value' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE
            ],
            'start_date' => [
                'type' => 'DATE',
                'null' => FALSE
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => FALSE
            ],
            'status' => [
                'type' => "ENUM('active','pending','expired')",
                'null' => TRUE
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => FALSE
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('discount', TRUE);

        echo "Discount table created successfully.\n";
    }

    public function down()
    {
        $this->dbforge->drop_table('discount', TRUE);
    }
}
