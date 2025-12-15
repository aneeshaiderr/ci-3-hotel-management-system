<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_reservations_table extends CI_Migration {

    public function up()
    {
        $this->load->dbforge();

        $this->dbforge->drop_table('reservations', TRUE);

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'hotel_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE
            ),
            'guest_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE
            ),
            'hotel_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE
            ),
            'room_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE
            ),
            'staff_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            ),
            'discount_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            ),
            'check_in' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'check_out' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'status' => array(
                'type' => "ENUM('active','cancelled','completed')",
                'default' => 'active',
                'null' => TRUE
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
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('hotel_code');

        $this->dbforge->create_table('reservations', TRUE, array('ENGINE' => 'InnoDB'));

        $this->db->query("
            ALTER TABLE `reservations`
            ADD CONSTRAINT `fk_reservations_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            ADD CONSTRAINT `fk_reservations_guest` FOREIGN KEY (`guest_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            ADD CONSTRAINT `fk_reservations_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotels`(`id`) ON DELETE CASCADE,
            ADD CONSTRAINT `fk_reservations_room` FOREIGN KEY (`room_id`) REFERENCES `rooms`(`id`) ON DELETE CASCADE,
            ADD CONSTRAINT `fk_reservations_staff` FOREIGN KEY (`staff_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
            ADD CONSTRAINT `fk_reservations_discount` FOREIGN KEY (`discount_id`) REFERENCES `discount`(`id`) ON DELETE SET NULL
        ");

        echo "Reservations table created successfully.\n";
    }

    public function down()
    {
        $this->load->dbforge();
        $this->dbforge->drop_table('reservations', TRUE);
        echo "Reservations table dropped.\n";
    }
}


