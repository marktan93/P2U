<?php
/**
 * Description of model_messages
 *
 * @author Mtcy
 */
class model_messages extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function create($to_user_id, $from_user_id, $content) {
        $this->db->query("INSERT INTO `".TABLE_MESSAGES."`(`from_user_id`, `to_user_id`, `content`) VALUES($from_user_id, $to_user_id, '$content') ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function read($user_id) {
        $query = $this->db->query("SELECT * FROM `".TABLE_MESSAGES."` m WHERE m.to_user_id = $user_id OR m.from_user_id = $user_id");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
    public function load($last_id, $user_id) {
        $query = $this->db->query("SELECT * FROM `".TABLE_MESSAGES."` m WHERE m.id > $last_id AND (m.to_user_id = $user_id OR m.from_user_id = $user_id)");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
    public function update_merchant_notify($user_id) {
        $this->db->query("UPDATE `".TABLE_MESSAGES."` SET `merchant_notify` = 1 WHERE `to_user_id` = $user_id OR `from_user_id` = $user_id");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function update_admin_notify($user_id) {
        $this->db->query("UPDATE `".TABLE_MESSAGES."` SET `admin_notify` = 1 WHERE `to_user_id` = $user_id OR `from_user_id` = $user_id");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function get_acc($user_id) {
        $query = $this->db->query("SELECT `role` FROM  `".TABLE_USERS."` WHERE `id` = $user_id ");
        if ($query->num_rows() > 0)
           return $query->row_array(); 
        return null;
    }
    
    public function get_admin_notification($user_id) {
         $query = $this->db->query("SELECT COUNT(*) as `total` FROM `".TABLE_MESSAGES."` m WHERE m.admin_notify = 0 AND (m.to_user_id = $user_id OR m.from_user_id = $user_id)");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function get_merchant_notification($user_id) {
        $query = $this->db->query("SELECT COUNT(*) as `total` FROM `".TABLE_MESSAGES."` m WHERE m.merchant_notify = 0 AND (m.to_user_id = $user_id OR m.from_user_id = $user_id)");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function merchant_list_notification() {
        $query = $this->db->query("SELECT to_user_id as `merchant_id`, COUNT(*) as total FROM messages WHERE admin_notify = 0 group by `to_user_id`");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
}
