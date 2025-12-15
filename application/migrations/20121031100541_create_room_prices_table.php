<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_room_prices_table extends CI_Migration {

    public function up()
    {
      
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'hotel_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'null' => FALSE
            ),
            'room_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'null' => FALSE
            ),
            'rate' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE
            ),
            'start_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'end_date' => array(
                'type' => 'DATE',
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
        ));


        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('room_prices', TRUE, array('ENGINE' => 'InnoDB'));

        $this->db->query('CREATE INDEX idx_hotel_id ON room_prices(hotel_id)');
        $this->db->query('CREATE INDEX idx_room_id ON room_prices(room_id)');
        $this->db->query('CREATE INDEX idx_start_date ON room_prices(start_date)');
        $this->db->query('CREATE INDEX idx_end_date ON room_prices(end_date)');

        $this->db->query('
            ALTER TABLE room_prices
            ADD CONSTRAINT fk_room_prices_hotel
            FOREIGN KEY (hotel_id) REFERENCES hotels(id)
            ON DELETE CASCADE
        ');

        $this->db->query('
            ALTER TABLE room_prices
            ADD CONSTRAINT fk_room_prices_room
            FOREIGN KEY (room_id) REFERENCES rooms(id)
            ON DELETE CASCADE
        ');


        $this->db->query("
            ALTER TABLE room_prices
            MODIFY created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            MODIFY updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
        ");

        echo "Room prices table created successfully.\n";
    }

    public function down()
    {
        $this->dbforge->drop_table('room_prices', TRUE);
        echo "Room prices table dropped.\n";
    }
}
