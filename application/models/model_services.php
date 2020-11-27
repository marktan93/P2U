<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_services
 *
 * @author Mtcy
 */
class model_services extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get() {
        $query = $this->db->query("SELECT * FROM `".TABLE_SERVICES."` ;");
        
        if ($query->num_rows() > 0) 
            return $query->result_array();
        return null;
    }
    
    public function get_by_id($service_id) {
        $query = $this->db->query("SELECT * FROM `".TABLE_SERVICES."` WHERE `id` = $service_id ;");
        
        if ($query->num_rows() > 0)
            return $query->row_array();
        return null;
    }
    
    
}
