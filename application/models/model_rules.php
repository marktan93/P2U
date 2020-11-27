<?php
/**
 * Description of model_rules
 *
 * @author Mtcy
 */
class model_rules extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function get($uid = null) {
        if ($uid == null) {
            $query = $this->db->query("SELECT * FROM `".TABLE_RULES."` ;");
            if ($query->num_rows() > 0)
                return $query->result_array();
        } else {
            $query = $this->db->query("SELECT * FROM `".TABLE_RULES."` WHERE `user_id` = $uid ;");
            if ($query->num_rows() > 0)
                return $query->row_array();
        }
        return null;
    }
    
    public function set($uid, $amount, $points_awarded) {
        $query = $this->db->query("INSERT INTO `".TABLE_RULES."`(`user_id`, `purchase_amount`, `points_rewarded`) VALUES($uid, $amount, $points_awarded) ");
        if ($this->db->affected_rows()) 
            return true;
        return null;
    }
    
    public function delete($id) {
        $this->db->query("DELETE FROM `".TABLE_RULES."` WHERE `id` = $id ");
        if ($this->db->affected_rows())
            return true;
        return null;
    }
    
}
