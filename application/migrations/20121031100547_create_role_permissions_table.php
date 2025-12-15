<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_role_permissions_table extends CI_Migration {

    public function up()
    {
        $this->load->dbforge();

        $this->dbforge->drop_table('role_permissions', TRUE);


        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE
            ],
            'permission_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE
            ]
        ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('role_permissions', TRUE, ['ENGINE' => 'InnoDB']);

        $index = $this->db->query("SHOW INDEX FROM `role_permissions` WHERE Key_name = 'role_perm_unique'");
        if ($index->num_rows() == 0) {
            $this->db->query("ALTER TABLE `role_permissions` ADD UNIQUE KEY `role_perm_unique` (`role_id`,`permission_id`)");
        }


        $idx_role = $this->db->query("SHOW INDEX FROM `role_permissions` WHERE Key_name = 'idx_role_id'");
        if ($idx_role->num_rows() == 0) {
            $this->db->query("ALTER TABLE `role_permissions` ADD INDEX `idx_role_id` (`role_id`)");
        }

        $idx_perm = $this->db->query("SHOW INDEX FROM `role_permissions` WHERE Key_name = 'idx_permission_id'");
        if ($idx_perm->num_rows() == 0) {
            $this->db->query("ALTER TABLE `role_permissions` ADD INDEX `idx_permission_id` (`permission_id`)");
        }


        $this->db->query("
            ALTER TABLE `role_permissions`
            ADD CONSTRAINT `fk_role_permissions_role` FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE CASCADE,
            ADD CONSTRAINT `fk_role_permissions_permission` FOREIGN KEY (`permission_id`) REFERENCES `permissions`(`id`) ON DELETE CASCADE
        ");

        echo "Role_permissions table created successfully.\n";
    }

    public function down()
    {
        $this->load->dbforge();
        $this->dbforge->drop_table('role_permissions', TRUE);
        echo "Role_permissions table dropped.\n";
    }
}
