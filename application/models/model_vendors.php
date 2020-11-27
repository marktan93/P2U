<?php

/**
 * Description of model_vendors
 *
 * @author Mtcy
 */
class model_vendors extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function set($uid, $name) {
        $this->db->query("INSERT INTO `".TABLE_VENDORS."`(`user_id`, `name`) VALUES($uid, '$name')  ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function get($uid) {
        $query = $this->db->query("SELECT * FROM `".TABLE_VENDORS."` WHERE `user_id` = $uid ");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
    public function delete($uid, $name) {
        $this->db->query("DELETE FROM `".TABLE_VENDORS."` WHERE `user_id` = $uid AND `name` = '$name' ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
}
