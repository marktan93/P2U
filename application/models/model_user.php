<?php
/**
 * Description of Model_user
 *
 * @author Mtcy
 */
class model_user extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function insert_users($email, $password, $salt, $role) {
        $sql = "INSERT INTO ".TABLE_USERS."(`email`, `password`, `salt`, `role`, `last_update`) VALUES('$email', '$password', '$salt', '$role', NOW());  ";
        return $this->db->query($sql);
    }
    
    public function insert_user_info($fullname, $icno, $contact, $security_answer, $security_question) {
        $last_id = $this->db->insert_id();
        $sql = "INSERT INTO ".TABLE_USER_INFO."(`user_id`, `fullname`, `icno`, `contact`, `security_answer`, `security_question`) "
                . "VALUES($last_id, '$fullname', '$icno', '$contact', '$security_answer', '$security_question')";
        $this->db->query($sql);
        return $last_id;
    }
    
    public function get_salt_by_email($email) {
        $query = $this->db->query("SELECT `salt` FROM `".TABLE_USERS."` WHERE `email` = '$email' ;");

        if ($query->num_rows() > 0)
        {
           $row = $query->row(); 
           return $row->salt;
        }
        return null;
    }
    
    public function login($email, $salted) {
        $query = $this->db->query("SELECT `id`, `role` FROM `".TABLE_USERS."` WHERE `email` = '$email' AND `password` = '$salted' ;");
        if ($query->num_rows() > 0)
        {
           $row = $query->row(); 
           return array('uid'=>$row->id, 'role'=>$row->role);
        }
        return null;
    }
    
    public function get_email_by_uid($uid) {
        $query = $this->db->query("SELECT `email` FROM `".TABLE_USERS."` WHERE `id` = '$uid';");
        if ($query->num_rows() > 0)
        {
           $row = $query->row(); 
           return $row->email;
        }
        return null;
    }
    
    public function get_salt_by_uid($uid) {
        $query = $this->db->query("SELECT `salt` FROM `".TABLE_USERS."` WHERE `id` = '$uid';");
        if ($query->num_rows() > 0)
        {
           $row = $query->row(); 
           return $row->salt;
        }
        return null;
    }
    
    public function update_acc_activation($uid, $boolean) {
        $query = $this->db->query("UPDATE `".TABLE_USER_INFO."` SET `acc_activation` = '$boolean' WHERE `user_id` = $uid;");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function get_activation_status($uid) {
        $query = $this->db->query("SELECT `acc_activation` FROM `".TABLE_USER_INFO."` WHERE `user_id` = '$uid';");
        if ($query->num_rows() > 0)
        {
           $row = $query->row(); 
           return $row->acc_activation;
        }
        return null;
    }
    
    # get uid by security answer and question
    public function get_uid_by_sec($sec_q, $sec_a) {
        $query = $this->db->query("SELECT `user_id` FROM `".TABLE_USER_INFO."` WHERE `security_question` = $sec_q AND `security_answer` = '$sec_a' LIMIT 1;");
        if ($query->num_rows() > 0)
        {
           $row = $query->row(); 
           return $row->user_id;
        }
        return null;
    }
    
    public function update_password($uid, $password) {
        $query = $this->db->query("UPDATE `".TABLE_USERS."` SET `password` = '$password' WHERE `id` = '$uid'; ");
        if ($this->db->affected_rows() > 0) 
            return true;
        return null;
    }
    
    public function get_user_by_uid($uid) {
        $query = $this->db->query("SELECT `email` FROM `".TABLE_USERS."` WHERE `id` = $uid ; ");
        if ($query->num_rows() > 0)
        {
           $row = $query->row_array(); 
           return $row;
        }
        return null;
    }
    
    public function get_userinfo_by_uid($uid) {
        $query = $this->db->query("SELECT * FROM `".TABLE_USER_INFO."` WHERE `user_id` = $uid ; ");
        if ($query->num_rows() > 0)
        {
           $row = $query->row_array(); 
           return $row;
        }
        return null;
    }
    
    public function update_company($uid, $company_name, $company_regno, $company_code, $website, $company_logo, $user_ic) {
        $query = $this->db->query("UPDATE `".TABLE_USER_INFO."` SET `company_name` = '$company_name', "
                . "`company_reg_no` = '$company_regno', `company_code` = '$company_code', `website` = '$website', `company_logo` = '$company_logo', `ic_img` = '$user_ic' WHERE `user_id` = $uid; ");
        if ($this->db->affected_rows() > 0) 
            return true;
        return nulls;
    }
    
    public function company_info($uid) {
        $query = $this->db->query("SELECT `company_name`, `company_reg_no`, `company_logo`, `company_verification`, `company_code`, `website`, `ic_img` FROM `".TABLE_USER_INFO."` WHERE `user_id` = $uid ; ");
        if ($query->num_rows() > 0)
        {
           $row = $query->row_array(); 
           return $row;
        }
        return null;
    }
    
    public function read() {
        $query = $this->db->query("SELECT `fullname`, `user_id` FROM `".TABLE_USER_INFO."` ui INNER JOIN `".TABLE_USERS."` u ON ui.user_id = u.id WHERE u.role = 'merchant';  ");
        if ($query->num_rows() > 0)
        {
           $row = $query->result_array(); 
           return $row;
        }
        return null;
    }
    
    public function read_by_id($user_id) {
        $query = $this->db->query("SELECT * FROM `".TABLE_USER_INFO."` WHERE `user_id` = $user_id; ");
        if ($query->num_rows() > 0)
           return $query->row_array(); 
        return null;
    }
    
    public function get_merchant($current, $per) {
        $query = $this->db->query("SELECT * FROM `".TABLE_USERS."` u INNER JOIN `".TABLE_USER_INFO."` ui ON u.id = ui.user_id WHERE u.role = 'merchant' ORDER BY ui.company_verification ASC LIMIT $current, $per ");
        if ($query->num_rows() > 0)
           return $query->result_array(); 
        return null;
    }
    
    public function get_merchants_num() {
        $query = $this->db->query("SELECT COUNT(u.id) as `total` FROM `".TABLE_USERS."` u INNER JOIN `".TABLE_USER_INFO."` ui ON u.id = ui.user_id WHERE u.role = 'merchant' ");
        if ($query->num_rows() > 0)
           return $query->row_array(); 
        return null;
    }
    
    public function get_search_merchants_num($keyword) {
        $query = $this->db->query("SELECT COUNT(u.id) as `total` FROM `".TABLE_USERS."` u INNER JOIN `".TABLE_USER_INFO."` ui ON u.id = ui.user_id WHERE u.role = 'merchant' AND (ui.company_name LIKE '%$keyword%' OR ui.fullname LIKE '%$keyword%') ");
        if ($query->num_rows() > 0)
           return $query->row_array(); 
        return null;
    }
    
    public function search_merchant($keyword, $current, $per) {
        $query = $this->db->query("SELECT * FROM `".TABLE_USERS."` u INNER JOIN `".TABLE_USER_INFO."` ui ON u.id = ui.user_id WHERE u.role = 'merchant' AND (ui.company_name LIKE '%$keyword%' OR ui.fullname LIKE '%$keyword%')  ORDER BY ui.company_verification ASC LIMIT $current, $per ");
        if ($query->num_rows() > 0)
           return $query->result_array(); 
        return null;
    }
    
    public function approve_company($merchant_id) {
        $query = $this->db->query("UPDATE `".TABLE_USER_INFO."` SET `company_verification` = 1 WHERE `user_id` = $merchant_id ");
        if ($this->db->affected_rows() > 0) 
            return true;
        return null;
    }
    
    
    
}
