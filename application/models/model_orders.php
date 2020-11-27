<?php
/**
 * Description of model_orders
 *
 * @author Mtcy
 */
class model_orders extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get($merchant_id, $start, $number, $condition = "") {
        $query = $this->db->query("SELECT c.fullname, c.contact, c.address, o.* FROM `".TABLE_ORDERS."` o INNER JOIN `".TABLE_CUSTOMERS."` c ON o.customer_id = c.id WHERE `user_id` = $merchant_id $condition  LIMIT $start, $number ;  ");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
    public function orders_num($merchant_id) {
        $query = $this->db->query("SELECT COUNT(*) as `total` FROM `".TABLE_ORDERS."` WHERE `user_id` = $merchant_id;  ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function paid_num($merchant_id) {
        $query = $this->db->query("SELECT COUNT(*) as `total` FROM `".TABLE_ORDERS."` WHERE `user_id` = $merchant_id AND `status` = 'paid'  ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function packaging_num($merchant_id) {
        $query = $this->db->query("SELECT COUNT(*) as `total` FROM `".TABLE_ORDERS."` WHERE `user_id` = $merchant_id AND `status` = 'packaging'  ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function ready_num($merchant_id) {
        $query = $this->db->query("SELECT COUNT(*) as `total` FROM `".TABLE_ORDERS."` WHERE `user_id` = $merchant_id AND `status` = 'ready'  ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function delivered_num($merchant_id) {
        $query = $this->db->query("SELECT COUNT(*) as `total` FROM `".TABLE_ORDERS."` WHERE `user_id` = $merchant_id AND `status` = 'delivered'  ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function search_orders_num($keyword, $merchant_id) {
        $query = $this->db->query("SELECT COUNT(*) as `total` FROM `".TABLE_ORDERS."` o INNER JOIN `".TABLE_CUSTOMERS."` c ON o.customer_id = c.id  WHERE `user_id` = $merchant_id AND ( o.id LIKE '%$keyword%' OR c.fullname LIKE '%$keyword%' ) ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function search($keyword, $merchant_id, $start, $number) {
        $query = $this->db->query("SELECT c.fullname, c.contact, c.address, o.* FROM `".TABLE_ORDERS."` o INNER JOIN `".TABLE_CUSTOMERS."` c ON o.customer_id = c.id WHERE `user_id` = $merchant_id AND ( o.id LIKE '%$keyword%' OR c.fullname LIKE '%$keyword%' ) LIMIT $start, $number ;  ");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
    public function update_paid($orderid) {
        $this->db->where('id', $orderid);
        $this->db->update(TABLE_ORDERS, array('status'=>'packaging')); 
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function update_pickup($orderid) {
        $this->db->where('id', $orderid);
        $this->db->update(TABLE_ORDERS, array('status'=>'ready')); 
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function update_delivery($orderid, $tracking_code, $courier_service) {
        $this->db->where('id', $orderid);
        $this->db->update(TABLE_ORDERS, array('status'=>'delivered', 'courier_service'=>$courier_service, 'tracking_code'=>$tracking_code)); 
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function get_all($order_id) {
        $query = $this->db->query("SELECT * FROM `".TABLE_ORDERS."` o INNER JOIN `".TABLE_PRODUCT_LINES."` pl ON o.id = pl.order_id INNER JOIN `".TABLE_PRODUCT_VENDOR."` v ON pl.product_vendor_id = v.id INNER JOIN `".TABLE_PRODUCTS."` p ON v.product_id = p.id WHERE o.id = $order_id ");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
    public function delete($order_id) {
        $this->db->query("DELETE FROM `".TABLE_ORDERS."` WHERE `id` = $order_id ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function get_by_id($order_id) {
        $query = $this->db->query("SELECT *, ui.fullname as `merchant_name`, ui.contact as `merchant_contact`, o.id as `order_id`, o.last_update as `order_date` FROM `".TABLE_ORDERS."` o INNER JOIN `".TABLE_USER_INFO."` ui ON o.user_id = ui.user_id INNER JOIN `".TABLE_CUSTOMERS."` c ON o.customer_id = c.id WHERE o.`id` = $order_id ");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function get_order_only($order_id) {
        $query = $this->db->query("SELECT * FROM `".TABLE_ORDERS."` WHERE `id` = $order_id");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
}
