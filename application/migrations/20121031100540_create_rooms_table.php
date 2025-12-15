<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_rooms_table extends CI_Migration {

    public function up()
    {

        $this->dbforge->add_field([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
            ],
            'hotel_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => TRUE,
                'null'       => FALSE,
            ],
            'room_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => FALSE,
            ],
            'floor' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => FALSE,
            ],
            'status' => [
                'type' => 'ENUM("available","booked","maintenance")',
                'default' => 'available'
            ],
            'beds' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => TRUE,
            ],
            'max_guests' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => TRUE,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => FALSE,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => FALSE,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('hotel_id');

 
        $this->dbforge->create_table('rooms', TRUE);

        $this->db->query("
            ALTER TABLE rooms
            ADD CONSTRAINT fk_rooms_hotel
            FOREIGN KEY (hotel_id)
            REFERENCES hotels(id)
            ON DELETE CASCADE
            ON UPDATE CASCADE
        ");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE rooms DROP FOREIGN KEY fk_rooms_hotel");
        $this->dbforge->drop_table('rooms', TRUE);
    }
}


