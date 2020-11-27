<?php

/**
 * Description of model_card
 *
 * @author Mtcy
 */
class model_card extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function get($uid) {
        $query = $this->db->query("SELECT `card_initial_points`, `card_img`, `card_name` FROM `".TABLE_USER_INFO."` WHERE `user_id` = $uid; ");
        
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function set($uid, $name, $image) {
        $query = $this->db->query("UPDATE `".TABLE_USER_INFO."` SET `card_name` = '$name', `card_img` = '$image' WHERE `user_id` = $uid;  ");
        if ($this->db->affected_rows()) {
            return true;
        }
        return null;
    }
    
    public function update_initial_points($uid, $points) {
        $query = $this->db->query("UPDATE `".TABLE_USER_INFO."` SET `card_initial_points` = $points WHERE `user_id` = $uid; ");
        if ($this->db->affected_rows())
            return true;
        return null;
    }
    
}
