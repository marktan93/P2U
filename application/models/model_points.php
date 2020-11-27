<?php
/**
 * Description of model_points
 *
 * @author Mtcy
 */
class model_points extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function insert($uid, $points, $due_date) {
        $this->db->query("INSERT INTO `".TABLE_POINTS."`(`user_id`, `points`, `due_date`) VALUES($uid, $points, '$due_date') ");
        if($this->db->affected_rows() > 0)
            return $this->db->insert_id();
        return null;
    }
    
    public function read($points_id) {
        $query = $this->db->query("SELECT * FROM `".TABLE_POINTS."` WHERE `id` = $points_id AND `redeem_status` = 0 ; ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function update($points_id) {
        $this->db->query("UPDATE `".TABLE_POINTS."` SET `redeem_status` = 1 WHERE `id` = $points_id ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
	
	public function read_no_restrict($points_id) {
        $query = $this->db->query("SELECT * FROM `".TABLE_POINTS."` WHERE `id` = $points_id ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
	
	public function read_in_date($points_id) {
		$query = $this->db->query("SELECT * FROM `points` WHERE `id` = $points_id AND CURDATE() BETWEEN `last_update` AND `due_date`; ");
		if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
	}
    
}
