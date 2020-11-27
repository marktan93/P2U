<?php

class model_service_lines extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function insert($uid, $service_id) {
        
        $query = $this->db->query("INSERT INTO ".TABLE_SERVICE_LINES."(`user_id`, `service_id`) VALUES($uid, $service_id) ;");
        
        if ($this->db->affected_rows() > 0) 
            return true;
        return null;
        
    }
    
    
    // get unpaid order
    public function get($uid) {
        $query = $this->db->query("SELECT * FROM `".TABLE_SERVICE_LINES."` WHERE `user_id` = $uid AND `service_status` = 1 AND `payment_status` = 0 ; ");
        if ($query->num_rows() > 0) 
            return $query->row_array();
        return null;
    }
    
    // get current services
    // before expired and activated
    public function get_service($uid) {
        $query = $this->db->query("SELECT * FROM `".TABLE_SERVICE_LINES."` WHERE `user_id` = $uid "
                . "AND `service_status` = 1 AND `payment_status` = 1 AND datediff(expiry_date, last_update) > 0  ; ");
        if ($query->num_rows() > 0) 
            return $query->row_array();
        return null;
    }
    
    /// update service line table to paid and expiry date
    public function pay($service_line_id, $service_duration) {
        $expiry_date = date("Y-m-d H:i:s", strtotime("+$service_duration year"));
        $query = $this->db->query("UPDATE `".TABLE_SERVICE_LINES."` SET `payment_status` = 1, `last_update` = '".date('Y-m-d H:i:s')."', `expiry_date` = '".$expiry_date."'  WHERE `id` = $service_line_id ; ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function get_payment_status($uid) {
        $query = $this->db->query("SELECT * FROM `".TABLE_SERVICE_LINES."` WHERE `user_id` = $uid AND `service_status` = 1  && `payment_status` = 1; ");
        if ($query->num_rows() > 0) 
            $data = $query->row_array();
            if (@$data != null) {
                $query = $this->db->query("SELECT * FROM `".TABLE_PAYPAL."` WHERE `service_line_id` = {$data['id']} ;");
                if ($query->num_rows() > 0)
                    return true;
            }
        return null;
    }
    
    public function delete($service_line_id) {
        $query = $this->db->query("DELETE FROM `".TABLE_SERVICE_LINES."` WHERE `id` = $service_line_id; ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function freeze($service_line_id) {
        $query = $this->db->query("UPDATE `".TABLE_SERVICE_LINES."` SET `service_status` = 0 WHERE `id` = $service_line_id ; ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    // get all user expired date <= 10 && reminder = false
    public function user_near_expiry() {
        $query = $this->db->query("SELECT sl.id as service_id, sl.user_id, u.email, datediff(sl.expiry_date, sl.last_update) as days FROM `".TABLE_SERVICE_LINES."` sl "
                . " INNER JOIN `".TABLE_USERS."` u ON sl.user_id = u.id WHERE datediff(sl.expiry_date, sl.last_update) <= 10 AND sl.reminder = 0  ;");
        
        if ($query->num_rows())
            return $query->result_array();
        return null;
    }
    
    public function update_reminder($service_id) {
        $query = $this->db->query("UPDATE `".TABLE_SERVICE_LINES."` SET `reminder` = 1 WHERE `id` = $service_id; ");
        if ($this->db->affected_rows())
            return true;
        return null;
    }
    
    public function report($year) {
        $query = $this->db->query("SELECT  MONTHNAME(`last_update`) as `month`, count(month(`last_update`)) as `number`  FROM `".TABLE_SERVICE_LINES."` WHERE `service_status` = 1 AND `payment_status` = 1 AND year(`last_update`) = $year group by `month` ;");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
    public function get_exist_year() {
        $query = $this->db->query("SELECT  YEAR(`last_update`) as `year` FROM `".TABLE_SERVICE_LINES."` WHERE `service_status` = 1 AND `payment_status` = 1 group by `year` ;");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
}

?>