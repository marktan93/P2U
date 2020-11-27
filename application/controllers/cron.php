<?php

/**
 * Description of cron
 *
 * @author Mtcy
 */
class cron extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        if ($this->isLoggedIn() == null)
            redirect('home/login'); # redirect ltr maybe
    }
    
    // check each of the merchant's service
    // if 10 days before expiry, will email to them for extend the subsciption
    public function user_near_expiry() {
        $this->load->model('model_service_lines', 'service_lines');
        
        $users = $this->service_lines->user_near_expiry();
        if ($users != null)
            foreach ($users as $user) {
                $this->smtp_mail($user['email'], 'Expired of service reminder', 'Your service near expiry. Prevent the service not working please extends the service.');
                $this->service_lines->update_reminder($user['service_id']);
            }
        
    }
    
    
    
}
