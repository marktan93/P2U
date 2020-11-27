<?php

/**
 * Description of api
 *
 * @author Mtcy
 */
class api extends MY_Controller {
    
    public function index() {
        if ($this->isLoggedIn() == null)
            redirect('home/login'); 
        
        $this->verified();
        $this->isMember();
        
        $data = array(
            'path' => asset_url(),
            'title' => 'API',
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-api.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
        
    }
    
    public function establish() {
        $this->load->model('Model_user', 'user');
        
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        if (!empty($email) && !empty($password)) {
            $this->load->library('salt');
            
            $salt = new salt();
            $s = $this->user->get_salt_by_email($email);
            $salt->setSalt($s);
            $salted = $salt->encrypt($password);
            $user = $this->user->login($email, $salted);
            
            if ($user == true)
                die(json_encode(array('response'=>true, 'uid'=>intval($user['uid']))));
            
        }
        die(json_encode(array('response'=>false)));
    }
    
    public function generate() {
        $this->load->model('model_rules', 'rules');
        $this->load->model('model_points', 'points');
        
        $uid = $this->input->post('uid');
        $cost = $this->input->post('cost');
        if (!empty($uid) && !empty($cost)) {
            // get points redeemed from rules
            $rule = $this->rules->get($uid);
            if ($rule != null) {
                $no = floor($cost/$rule['purchase_amount']);
                $total_points = $no * $rule['points_rewarded'];
				if ($total_points > 0) { // if achieve minimum purchase
					$points_id = $this->points->insert($uid, $total_points,  date("Y-m-d H:i:s", strtotime("+1 month")));
					if ($points_id != null)
						die(json_encode(array('response'=>true, 'points_id'=>$points_id)));
				} else {
					die(json_encode(array('response'=>false, 'message'=>'Not achieve minimum purchase')));
				}
            }
        }
        die(json_encode(array('response'=>false)));
    }
    
    public function points() {
        $this->load->model('model_points', 'points');
        $this->load->model('model_subscriptions', 'subscriptions');
        $points_id = $this->uri->segment(3);
        if ($points_id != null) {
            // check redeem status (points table)
            $points = $this->points->read($points_id);
            if ($points != null) {
                // the points not yet redeem and exist
                // get customer id
                $customer_id = $this->input->post('customer_id');
                if (!empty($customer_id)) { // make sure customer id not empty
                    $subscriptions = $this->subscriptions->read($points['user_id'], $customer_id);
                    if ($subscriptions != null) { // check whether the customer subscripted to the merchant or not
                        $result = $this->subscriptions->update($points['user_id'], $customer_id, $points['points']);
                        if ($result != null) { // if update points success
                            $final_result = $this->points->update($points_id); // change redeemd points status to true
                            if ($final_result == true)
                                die(json_encode(array('response'=>true)));
                        }
                    }
                }
            }
            
        }
        die(json_encode(array('response'=>false)));
    }
	
	// return info to the customer
    public function info() {
        $this->load->model('model_points', 'points');
		$this->load->model('model_rules', 'rules');
        $points_id = $this->input->post('points_id');
        if (!empty($points_id)) {
            // start to get info 
            $points = $this->points->read($points_id);
			$rules = $this->rules->get($points['user_id']);
            if ($points != null && $rules != null) {
				// we don't need some fields
				unset($points['user_id']);
				unset($points['redeem_status']);
				unset($rules['id']);
				unset($rules['user_id']);
				unset($rules['last_update']);
				// merge 
				$points = array_merge($points, $rules);
                die(json_encode(array('response'=>true, 'points'=>$points)));
           }
        }
        die(json_encode(array('response'=>false)));
    }
	
	public function check_redeemed() {
		$this->load->model('model_points', 'points');
        $points_id = $this->input->post('points_id');
        if (!empty($points_id)) {
            // get redeem status
            $points = $this->points->read_no_restrict($points_id);
            if ($points != null) {
                die(json_encode(array('response'=>true, 'redeemed'=>$points['redeem_status'])));
            }
        }
        die(json_encode(array('response'=>false)));
	}
	
	public function check_expired() {
		$this->load->model('model_points', 'points');
        $points_id = $this->input->post('points_id');
        if (!empty($points_id)) {
            // get in date
            $points = $this->points->read_in_date($points_id);
            if ($points != null) {
                die(json_encode(array('response'=>true, 'expired'=>false)));
            } else {
				die(json_encode(array('response'=>true, 'expired'=>true)));
			}
        }
        die(json_encode(array('response'=>false)));
	}
    
}
