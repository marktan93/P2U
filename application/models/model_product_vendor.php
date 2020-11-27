<?php
/**
 * Description of model_product_vendor
 *
 * @author Mtcy
 */
class model_product_vendor extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function set($product_id, $vendor_id) {
        $sql = sprintf("INSERT INTO `".TABLE_PRODUCT_VENDOR."`(`product_id`, `vendor_id`) VALUES ");
        foreach ($vendor_id as $id) {
            $sql .= "($product_id, $id), "; 
        }
        $sql = substr($sql, 0, strlen($sql)-2);
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function get($product_id) {
        $query = $this->db->query("SELECT v.name, v.id FROM `".TABLE_PRODUCT_VENDOR."` pv INNER JOIN `".TABLE_VENDORS."` v ON pv.vendor_id = v.id WHERE pv.product_id = $product_id ");
        if ($query->num_rows() > 0)
            return $query->result_array();
        return null;
    }
    
    public function delete_by_product($product_id) {
        $query = $this->db->query("DELETE FROM `".TABLE_PRODUCT_VENDOR."` WHERE `product_id` = $product_id ");
        if($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
}
