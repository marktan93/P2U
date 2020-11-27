<?php
/**
 * Description of model_customers
 *
 * @author Mtcy
 */
class model_customers extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function create($username, $password, $gender, $fullname, $age, $contact, $address) {
        $this->db->query("INSERT INTO `".TABLE_CUSTOMERS."`(`username`, `password`, `gender`, `fullname`, `age`, `contact`, `address`) VALUES('$username', '$password', '$gender', '$fullname', '$age', '$contact', '$address') ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function read($customer_id){
        $query = $this->db->query("SELECT * FROM `".TABLE_CUSTOMERS."` WHERE `id` = $customer_id ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function update($customer_id, $password = null, $gender, $fullname, $age, $contact, $address) {
        if ($password == null || empty($password)) {
            // skip update password
            $data = array(
               'gender' => $gender,
               'fullname' => $fullname,
               'age' => $age,
               'contact' => $contact,
               'address' => $address
            );
        } else {
            $data = array(
               'password' => $password,
               'gender' => $gender,
               'fullname' => $fullname,
               'age' => $age,
               'contact' => $contact,
               'address' => $address
            );
        }
        $this->db->where('id', $customer_id);
        $this->db->update(TABLE_CUSTOMERS, $data); 
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function login($username, $password) {
        $query = $this->db->query("SELECT * FROM `".TABLE_CUSTOMERS."` WHERE `username` = '$username' && `password` = '$password' ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function get_customers_num($merchant_id) {
        $query = $this->db->query("SELECT COUNT(*) AS `total` FROM `".TABLE_SUBSCRIPTIONS."` WHERE `user_id` = $merchant_id ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function get($merchant_id, $start = null, $number = null) {
        $sql = "SELECT * FROM `".TABLE_SUBSCRIPTIONS."` s INNER JOIN `".TABLE_CUSTOMERS."` c ON s.customer_id = c.id WHERE s.`user_id` = $merchant_id LIMIT $start, $number ;";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
        
    }
    
    public function get_search_customers_num($keyword, $merchant_id) {
        $sql = "SELECT COUNT(*) as `total` FROM `".TABLE_SUBSCRIPTIONS."` s INNER JOIN `".TABLE_CUSTOMERS."` c ON s.customer_id = c.id WHERE s.`user_id` = $merchant_id AND c.fullname LIKE '%$keyword%' ;";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function get_search($keyword, $merchant_id, $start = null, $number = null) {
        $sql = "SELECT * FROM `".TABLE_SUBSCRIPTIONS."` s INNER JOIN `".TABLE_CUSTOMERS."` c ON s.customer_id = c.id WHERE s.`user_id` = $merchant_id AND c.fullname LIKE '%$keyword%' LIMIT $start, $number ;";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
}
