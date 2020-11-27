<?php
/**
 * Description of model_subscriptions
 *
 * @author Mtcy
 */
class model_subscriptions extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function read($user_id, $customer_id) {
        $query = $this->db->query("SELECT * FROM `".TABLE_SUBSCRIPTIONS."` WHERE `user_id` = $user_id AND `customer_id` = $customer_id  ;");
        if ($query->num_rows())
            return $query->row_array();
        return null;
    }
    
    public function update($user_id, $customer_id, $points) {
        $this->db->query("UPDATE `".TABLE_SUBSCRIPTIONS."` SET `points` = `points` + $points WHERE `user_id` = $user_id AND `customer_id` = $customer_id ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    // android request
    public function read_subscribed($customer_id) {
        $query = $this->db->query("SELECT * FROM `".TABLE_SUBSCRIPTIONS."` s INNER JOIN `".TABLE_USER_INFO."` ui ON s.user_id = ui.user_id WHERE s.customer_id = $customer_id; ");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
    public function read_unsubscribed($customer_id) {
        $query = $this->db->query("SELECT ui.* FROM `".TABLE_USER_INFO."` ui LEFT JOIN `".TABLE_SUBSCRIPTIONS."` s ON s.user_id = ui.user_id WHERE ui.icno != '' AND s.customer_id != $customer_id  ; ");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
    public function create($customer_id, $user_id, $initial_points) {
        $this->db->query("INSERT INTO `".TABLE_SUBSCRIPTIONS."`(`customer_id`, `user_id`, `points`) VALUES($customer_id, $user_id, $initial_points)  ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function delete($customer_id, $user_id) {
        $this->db->query("DELETE FROM `".TABLE_SUBSCRIPTIONS."` WHERE `customer_id` = $customer_id && `user_id` = $user_id  ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function report($user_id, $year) {
        $query = $this->db->query("SELECT  MONTHNAME(`last_update`) as `month`, count(month(`last_update`)) as `number`  FROM `".TABLE_SUBSCRIPTIONS."` WHERE `user_id` = $user_id AND year(`last_update`) = $year group by `month` ;");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
    public function get_exist_year($user_id) {
        $query = $this->db->query("SELECT  YEAR(`last_update`) as `year` FROM `".TABLE_SUBSCRIPTIONS."` WHERE `user_id` = $user_id group by `year` ;");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
}
