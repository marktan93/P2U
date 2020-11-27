<?php
/**
 * Description of model_products
 *
 * @author Mtcy
 */
class model_products extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    // insert product, return last insert id
    public function set($uid, $product_name, $image, $cost_points, $balance, $receive_mode, $start_date, $due_date) {
        
        $this->db->query("INSERT INTO `".TABLE_PRODUCTS."`(`user_id`, `product_name`, `image`, `cost_points`, `balance`, `receive_mode`, `start_date`, `due_date`)"
                . " VALUES($uid, '$product_name', '$image', $cost_points, $balance, '$receive_mode', '$start_date', '$due_date') ");
        
        if ($this->db->affected_rows() > 0)
            return $this->db->insert_id();
        return null;
    }
    
    public function update($product_id, $product_name, $image, $cost_points, $balance, $receive_mode, $start_date, $due_date) {
        if ($image == null) {
            // skip image update
            $this->db->query("UPDATE `".TABLE_PRODUCTS."` SET `product_name` = '$product_name', `cost_points` = $cost_points, `balance` = $balance, `receive_mode` = '$receive_mode', `start_date` = '$start_date', `due_date` = '$due_date' "
                    . " WHERE `id` = $product_id ");
        } else {
            $this->db->query("UPDATE `".TABLE_PRODUCTS."` SET `product_name` = '$product_name', `image` = '$image', `cost_points` = $cost_points, `balance` = $balance, `receive_mode` = '$receive_mode', `start_date` = '$start_date', `due_date` = '$due_date' "
                . " WHERE `id` = $product_id ");
        }
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function get($uid, $start = null, $number = null) {
        if ($number != null) {
            $sql = "SELECT * FROM `".TABLE_PRODUCTS."` WHERE `user_id` = $uid LIMIT $start, $number ;";
        } else {
            $sql = "SELECT * FROM `".TABLE_PRODUCTS."` WHERE `user_id` = $uid ";
        }
        
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
        
    }
    
    public function set_activation($product_id, $activation) {
        $this->db->query("UPDATE `".TABLE_PRODUCTS."` SET `activation` = '$activation' WHERE `id` = $product_id ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function get_products_num($uid) {
        $query = $this->db->query("SELECT COUNT(id) as `total` FROM `".TABLE_PRODUCTS."` WHERE `user_id` = $uid ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function get_product_by_id($product_id) {
        $query = $this->db->query("SELECT * FROM `".TABLE_PRODUCTS."` WHERE `id` = $product_id ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function get_image($product_id) {
        $query = $this->db->query("SELECT `image` FROM `".TABLE_PRODUCTS."` WHERE `id` = $product_id; ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function delete($product_id) {
        $query = $this->db->query("DELETE FROM `".TABLE_PRODUCTS."` WHERE `id` = $product_id; ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
	
    public function read_subscribed_product($customer_id) {
		$query = $this->db->query("SELECT * FROM `".TABLE_SUBSCRIPTIONS."` s INNER JOIN `".TABLE_PRODUCTS."` p ON s.user_id = p.user_id INNER JOIN `".TABLE_USER_INFO."` ui ON s.user_id = ui.user_id WHERE s.customer_id = $customer_id AND p.balance > 0 ORDER BY ui.company_name ASC ; ");
		if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
    public function product_vendor($product_id) {
        $query = $this->db->query("SELECT *, pv.id as product_vendor_id FROM `".TABLE_PRODUCT_VENDOR."` pv INNER JOIN `".TABLE_PRODUCTS."` p ON pv.product_id = p.id INNER JOIN `".TABLE_VENDORS."` v ON v.id = pv.vendor_id WHERE p.id = $product_id ");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
    public function get_by_order_id($order_id) {
        $query = $this->db->query("SELECT * FROM `".TABLE_PRODUCT_LINES."` pl INNER JOIN `".TABLE_PRODUCT_VENDOR."` pv ON pl.product_vendor_id = pv.id INNER JOIN `".TABLE_VENDORS."` v ON pv.vendor_id = v.id INNER JOIN `".TABLE_PRODUCTS."` p ON pv.product_Id = p.id WHERE pl.order_id = $order_id ");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
    public function get_search_products_num($keyword, $uid) {
        $query = $this->db->query("SELECT COUNT(*) as `total` FROM `".TABLE_PRODUCTS."` WHERE `user_id` = $uid AND ( `id` LIKE '%$keyword%' OR `product_name` LIKE '%$keyword%' ) ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function get_search($keyword, $uid, $start = null, $number = null) {
        $sql = "SELECT * FROM `".TABLE_PRODUCTS."` WHERE `user_id` = $uid AND (`id` LIKE '%$keyword%' OR `product_name` LIKE '%$keyword%') LIMIT $start, $number ;";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
        
    }
    
}
