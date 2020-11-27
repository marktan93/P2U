<?php
/**
 * Description of chat
 *
 * @author Mtcy
 */
class chat extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        if ($this->isLoggedIn() == null)
            die(json_encode(array('response'=>false)));
    }
    
    // read merchant details to chatbox
    public function read() {
        $this->load->model('model_user', 'user');
        $this->load->model('model_messages', 'messages');
        $merchant_id = $this->input->post('merchant_id');
        if ($merchant_id != null) {
            $merchant = $this->user->read_by_id($merchant_id);
            if ($merchant != null) {
                // get messsages from the db
                $messages = $this->messages->read($merchant_id);
                die(json_encode(array('merchant'=>$merchant, 'messages'=>$messages)));
            }
        }
        die(json_encode(array('response'=>false)));
    }
    
    public function create() {
        $this->load->model('model_messages', 'messages');
        $content = addslashes($this->input->post('content'));
        $to_user_id = $this->input->post('user_id');
        if ($content != null && $to_user_id != null) {
            $result = $this->messages->create($to_user_id, $this->uid(), $content);
            if ($result != null)
                die(json_encode(array('response'=>true)));
        }
        die(json_encode(array('response'=>false)));
    }
    
    public function load() {
        $this->load->model('model_messages', 'messages');
        $to_user_id = $this->input->post('user_id');
        $last_id = $this->input->post('last_id');
        
        if ($to_user_id != null && $last_id != null) {
            $messages = $this->messages->load($last_id, $to_user_id);
            $user = $this->messages->get_acc($this->uid());
            if ($user['role'] == 'merchant')
                $this->messages->update_merchant_notify($to_user_id);
            else if ($user['role'] == 'admin')
                $this->messages->update_admin_notify($to_user_id);
            die(json_encode(array('response'=>true, 'messages'=>$messages)));
        }
        die(json_encode(array('response'=>false)));
    }
    
    public function notification() {
        $this->load->model('model_messages', 'messages');
        $to_user_id = $this->input->post('user_id');
        if ($to_user_id != null) {
            $user = $this->messages->get_acc($this->uid());
            if ($user['role'] == 'merchant')
                $notify = $this->messages->get_merchant_notification($to_user_id);
            else 
                $notify = $this->messages->get_admin_notification($to_user_id);
   
            die(json_encode(array('response'=>true, 'notify'=>$notify['total'])));
        }
        die(json_encode(array('response'=>false)));
    }
    
    public function merchant_list_notification() {
        $this->load->model('model_messages', 'messages');
        $user = $this->messages->get_acc($this->uid());
        if ($user['role'] == 'admin')
            $notify = $this->messages->merchant_list_notification();
        if ($notify != null) 
            die(json_encode(array('response'=>true, 'notify'=>$notify)));
        die(json_encode(array('response'=>false)));
    }
    
}
