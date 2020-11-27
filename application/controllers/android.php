<?php

/**
 * Description of android
 *
 * @author Mtcy
 */
class android extends MY_Controller {
    
    // android request
    // pass in customer_id 
    // return long list all details
    public function subscription_list() {
        $customer_id = intval($this->input->post('customer_id'));
        if (!empty($customer_id)) {
                $this->load->model('model_subscriptions', 'subscriptions');
                $subscriptions = $this->subscriptions->read_subscribed($customer_id);
                die(json_encode($subscriptions));
        }
        die(json_encode(array('response'=>false)));
    }
    
    // pass in customer_id 
    // return long list all details
    public function unsubscription_list() {
        $customer_id = intval($this->input->post('customer_id'));
        if (!empty($customer_id)) {
                $this->load->model('model_subscriptions', 'subscriptions');
                $subscriptions = $this->subscriptions->read_unsubscribed($customer_id);
                die(json_encode($subscriptions));
        }
        die(json_encode(array('response'=>false)));
    }
    
    // pass in file
    // return png image file
    public function get_image() {
        $file = $this->input->post('file');
        
        header('Content-Type: image/png');
        $url = FCPATH.'assets/upload/card/'.$file;
        $fp = fopen($url, 'rb');

        header("Content-Type: image/png");
        header("Content-Length: " . filesize($url));

        fpassthru($fp);
    }
    
    // pass in customer_id and user_id
    // return response = true/false
    public function subscribe() {
        $this->load->model('model_user', 'user');
        $this->load->model('model_subscriptions', 'subscriptions');
        
        $customer_id = intval($this->input->post('customer_id'));
        $user_id = intval($this->input->post('user_id'));
        
        if (!empty($customer_id) && !empty($user_id)) {
            $user = $this->user->get_userinfo_by_uid($user_id);
            $result = $this->subscriptions->create($customer_id, $user_id, $user['card_initial_points']);
            if ($result != null)
                die(json_encode(array('response'=>true)));
        }
        die(json_encode(array('response'=>false)));
    }
    
    // pass in customer_id and user_id
    // return response = true/false
    public function unsubscribe() {
        $this->load->model('model_subscriptions', 'subscriptions');
        
        $customer_id = intval($this->input->post('customer_id'));
        $user_id = intval($this->input->post('user_id'));
        
        if (!empty($customer_id) && !empty($user_id)) {
            $result = $this->subscriptions->delete($customer_id, $user_id);
            if ($result != null)
                die(json_encode(array('response'=>true)));
        }
        die(json_encode(array('response'=>false)));
        
    }
    
    // pass in username, password, gender('male', 'female') , fullname, age(varchar), contact, address
    // return response = true/false
    public function create() {
        $this->load->model('model_customers', 'customers');
        
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $gender = $this->input->post('gender');
        $fullname = $this->input->post('fullname');
        $age = $this->input->post('age');
        $contact = $this->input->post('contact');
        $address = $this->input->post('address');
        
        if (!empty($username) && !empty($password) && !empty($gender) && !empty($fullname) && !empty($age) && !empty($contact) && !empty($address) ) {
            $result = $this->customers->create($username, sha1($password), $gender, $fullname, $age, $contact, $address);
            if ($result != null) 
                die(json_encode(array('response'=>true)));
        }
        die(json_encode(array('response'=>false)));
    }
    
    // pass in customer_id
    // return customer info or false)
    public function read() {
        $this->load->model('model_customers', 'customers');
        
        $customer_id = $this->input->post('customer_id');
        if (!empty($customer_id)) {
            $customer = $this->customers->read($customer_id);
            if ($customer!=null)
                die(json_encode($customer));
        }
        die(json_encode(array('response'=>false)));
    }
    
    // pass in customer_id, password(optional), gender('male', 'female') , fullname, age(varchar), contact, address
    // return response = true/false
    public function update() {
         $this->load->model('model_customers', 'customers');
        
        $customer_id = $this->input->post('customer_id');
        $password = $this->input->post('password');
        if (!empty($password))
            $password = sha1($this->input->post('password'));
        else 
            $password = null;
        $gender = $this->input->post('gender');
        $fullname = $this->input->post('fullname');
        $age = $this->input->post('age');
        $contact = $this->input->post('contact');
        $address = $this->input->post('address');
        
        if (!empty($customer_id) && !empty($gender) && !empty($fullname) && !empty($age) && !empty($contact) && !empty($address) ) {
            $result = $this->customers->update($customer_id, $password, $gender, $fullname, $age, $contact, $address);
            if ($result != null) 
                die(json_encode(array('response'=>true)));
        }
        die(json_encode(array('response'=>false)));
    }
    
    // pass in username, password
    // return customer info or false
    public function login() {
        $this->load->model('model_customers', 'customers');
        
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (!empty($username) && !empty($password)) {
            $customer = $this->customers->login($username, sha1($password));
            if ($customer!=null)
                die(json_encode($customer));
        }
        die(json_encode(array('response'=>false)));
    }
	
	// pass in customer_id
    // return false or subscribed product list
    public function product_list() {
        $customer_id = intval($this->input->post('customer_id'));
        if (!empty($customer_id)) {
                $this->load->model('model_products', 'products');
                $products = $this->products->read_subscribed_product($customer_id);
                if ($products != null) {
					for ($i=0; $i<count($products); $i++) {
						$image = explode('.', $products[$i]['image']);
						$image = $image[0].'_thumb.'.$image[1];
						$products[$i]['image'] = asset_url().'upload/products/thumbnail/'.$image;
					}
					die(json_encode($products));
				}
        }
        die(json_encode(array('response'=>false)));
    }
	
    // get card_img
    // return card_img
    public function image_url() {
            $card_img = $this->input->post('card_img');
            if ($card_img != null) {
                    die(json_encode(array('card_img'=>asset_url().'upload/card/'.$card_img)));
            }
            die(json_encode(array('response'=>false)));
    }
    
    // pass in product_id
    // get back product and vendor list
    public function product_info() {
        $this->load->model('model_products', 'products');
        $this->load->model('model_subscriptions', 'subscription');
        $this->load->model('model_user', 'user');
        
        $product_id = $this->input->post('product_id');
		$customer_id = $this->input->post('customer_id');
        if ($product_id != null) {
            $products = $this->products->product_vendor($product_id);
			// get card name and points balance
			$subs = $this->subscription->read($products[0]['user_id'], $customer_id);
			$user = $this->user->get_userinfo_by_uid($products[0]['user_id']);
			$mixed = array_merge($subs, $user);
			
			for($i=0; $i<count($products); $i++) {
				$products[$i] = array_merge($products[$i], $mixed);
			}
			
            die(json_encode($products));
        }
        die(json_encode(array('response'=>false)));
    }
    
    // order
    public function order() {
        // wait see jason pass what format back
        // seperate on pick and delivery to insert into different order records
        //$customer_id = $this->input->post('customer_od');
        //$product_vendor_id = $this->input->post('product_vendor_id');
        //$quantity = $this->input->post('quantity');
        
        if ($customer_id != null && $product_vendor_id != null && $quantity != null) {
            $this->load->model("model_product_vendor", "product_vendor");
            $this->load->model("model_subscriptions", "subscriptions");
            $this->load->model("model_orders", "orders");
            $this->load->model("model_product_lines", "product_lines");
            $this->load->model("model_products", "products");
           
            $product_id = $this->input->post("product_id");
            $merchant_id = $this->input->post("merchant_id");
            $quantity = $this->input->post("quantity");
            $branch = $this->input->post("branch"); // name
            $customer_id = $this->input->post("customer_id");
     
            if ($product_id != null && $merchant_id != null && $quantity != null && $branch != null && $customer_id != null) {
                $p_id_array = $this->process_data($product_id);
                $product_id = $this->process_data($product_id);
                $merchant_id = $this->process_data($merchant_id);
                $quantity = $this->process_data($quantity);
                $branch = $this->process_data($branch);
               
                // get product_vendor_id
                // group by receive mode
                $product_id = implode(",", $product_id);
                for($i=0; $i<count($branch); $i++) {
                    $branch[$i] = "'".$branch[$i]."'";
                }
                $branch = implode(",", $branch);
               
                $result = $this->product_vendor->get_id($product_id, $branch);
                $data = array();
                //seperate to different merchant
                for($i=0; $i<count($merchant_id); $i++) {
                    $data[$i]['merchant_id'] = $merchant_id[$i];
                    $data[$i]['customer_id'] = $customer_id;
                    $data[$i]['quantity'] = $quantity[$i];
                    $data[$i]['product_id'] = $p_id_array[$i];
                    $data[$i]['product_vendor_id'] = $result[$i]['id'];
                    $data[$i]['receive_mode'] = $result[$i]['receive_mode'];
                    $data[$i]['cost'] = $result[$i]['cost_points'];
                }
               
                $merge = array();
               
                // merging same merchant
                for ($i=0; $i<count($data); $i++) {
                    $index = $data[$i]['merchant_id'];
                    $merge[$index]['customer_id'] = $customer_id;
                    $merge[$index]['merchant_id'] = $data[$i]['merchant_id'];
                    $merge[$index]['product_vendor'][$i]['quantity'] = $data[$i]['quantity'];
                    $merge[$index]['product_vendor'][$i]['id'] = $data[$i]['product_vendor_id'];
                    $merge[$index]['product_vendor'][$i]['mode'] = $data[$i]['receive_mode'];
                    $merge[$index]['product_vendor'][$i]['cost'] = $data[$i]['cost'];
                    $merge[$index]['product_vendor'][$i]['product_id'] = $data[$i]['product_id'];
                }
               
                // reset index
                $merge = array_values($merge);
                           
                // seperate receive_mode
                $order = array();
                for ($i=0; $i<count($merge); $i++) {
                    $order[$i]['customer_id'] = $customer_id;
                    $order[$i]['merchant_id'] = $merge[$i]['merchant_id'];
                    $total_cost = 0;
                    for ($r=0; $r<count($merge[$i]['product_vendor']); $r++) {
                        // reset index
                        $merge[$i]['product_vendor'] = array_values($merge[$i]['product_vendor']);
                       
                        $total_cost += $merge[$i]['product_vendor'][$r]['cost'] * $merge[$i]['product_vendor'][$r]['quantity'];
                        // put in group
                        $order[$i]['total_cost'] = $total_cost;
                        $order[$i][$merge[$i]['product_vendor'][$r]['mode']][$r]['product_vendor_id'] = $merge[$i]['product_vendor'][$r]['id'];
                        $order[$i][$merge[$i]['product_vendor'][$r]['mode']][$r]['qty'] = $merge[$i]['product_vendor'][$r]['quantity'];
                        $order[$i][$merge[$i]['product_vendor'][$r]['mode']][$r]['mode'] = $merge[$i]['product_vendor'][$r]['mode'];
                        $order[$i][$merge[$i]['product_vendor'][$r]['mode']][$r]['product_id'] = $merge[$i]['product_vendor'][$r]['product_id'];
                       
                        // deduct product balance
                        $this->products->deduct_balance($merge[$i]['product_vendor'][$r]['product_id'], $merge[$i]['product_vendor'][$r]['quantity']);
                    }
                   
                }
                           
                // deduct score of each subscriptions
                foreach ($order as $o) {
                    $this->subscriptions->deduct_points($o['merchant_id'], $o['customer_id'], $o['total_cost']);
                }
               
               
               
                // insert into order table
                $last_id = array();
                foreach ($order as $o) {
                    if (isset($o['delivery']))
                        $last_id[$o['merchant_id']]['delivery'] = $this->orders->create($o['customer_id'], $o['merchant_id'], 'delivery');
                    if (isset($o['onpick']))
                        $last_id[$o['merchant_id']]['onpick'] = $this->orders->create($o['customer_id'], $o['merchant_id'], 'onpick');
                }
                // insert into product lines
                foreach ($order as $o) {
                    if (isset($o['delivery'])) {
                        foreach ($o['delivery'] as $d) {
                            $this->product_lines->create($last_id[$o['merchant_id']]['delivery'], $d['product_vendor_id'], $d['qty']);
                        }
                    }
                    if (isset($o['onpick'])) {
                        foreach ($o['onpick'] as $d) {
                            $this->product_lines->create($last_id[$o['merchant_id']]['onpick'], $d['product_vendor_id'], $d['qty']);
                        }
                    }
                }
                die(json_encode(array('response'=>true)));
            } else {
                die(json_encode(array('response'=>false)));
            }
        }
        
    }
    
    // do return vendor list with product info

	
}
?>