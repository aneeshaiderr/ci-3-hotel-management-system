<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users_table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array('type'=>'BIGINT','constraint'=>20,'unsigned'=>TRUE,'auto_increment'=>TRUE),
            'role_id' => array('type'=>'INT','constraint'=>11,'unsigned'=>TRUE,'null'=>TRUE),
            'first_name' => array('type'=>'VARCHAR','constraint'=>100),
            'last_name' => array('type'=>'VARCHAR','constraint'=>100),
            'user_email' => array('type'=>'VARCHAR','constraint'=>255),
            'password' => array('type'=>'VARCHAR','constraint'=>255),
            'contact_no' => array('type'=>'VARCHAR','constraint'=>50,'null'=>TRUE),
            'address' => array('type'=>'TEXT','null'=>TRUE),
            'status' => array('type'=>'VARCHAR','constraint'=>20,'default'=>'active'),
            'created_at' => array('type'=>'DATETIME','null'=>FALSE),
            'updated_at' => array('type'=>'DATETIME','null'=>FALSE),
            'deleted_at' => array('type'=>'DATETIME','null'=>TRUE)
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down() {
        $this->dbforge->drop_table('users');
    }
}
