<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_permissions_table extends CI_Migration {

    public function up()
    {
        $this->load->dbforge();

        $this->dbforge->drop_table('permissions', TRUE);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'deleted_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);


        $this->dbforge->create_table('permissions', TRUE, array('ENGINE' => 'InnoDB'));

        $this->db->query("ALTER TABLE `permissions` ADD UNIQUE KEY `name_unique` (`name`)");

        echo "Permissions table created successfully.\n";
    }


    public function down()
    {
        $this->load->dbforge();
        $this->dbforge->drop_table('permissions', TRUE);
        echo "Permissions table dropped.\n";
    }

}
