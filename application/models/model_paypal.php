<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of paypal
 *
 * @author Mtcy
 */
class model_paypal extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function insert($service_line_id, $payment_id, $hash) {
        $query = $this->db->query("INSERT INTO ".TABLE_PAYPAL."(`service_line_id`, `payment_id`, `hash`) VALUES($service_line_id, '$payment_id', '$hash') ;");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function get($hash) {
        $query = $this->db->query("SELECT * FROM `".TABLE_PAYPAL."` WHERE `hash` = '$hash' ;");
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    public function pay($payment_id) {
        $query = $this->db->query("UPDATE `".TABLE_PAYPAL."` SET `status` = 1  WHERE `payment_id` = '$payment_id' ; ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    public function delete($service_line_id) {
        $query = $this->db->query("DELETE FROM `".TABLE_PAYPAL."` WHERE `service_line_id` = $service_line_id; ");
        if ($this->db->affected_rows() > 0)
            return true;
        return null;
    }
    
    
}
