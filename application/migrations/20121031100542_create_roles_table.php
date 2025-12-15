<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_roles_table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => FALSE
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
        ));

     
        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('roles', TRUE, array('ENGINE' => 'InnoDB'));

        $this->db->query('ALTER TABLE roles ADD UNIQUE KEY name_unique (name)');


        $this->db->query("
            ALTER TABLE roles
            MODIFY created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            MODIFY updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ");

        echo "Roles table created successfully.\n";
    }

    public function down()
    {
        $this->dbforge->drop_table('roles', TRUE);
        echo "Roles table dropped.\n";
    }
}
