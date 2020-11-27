<?php
/**
 * Description of auth
 *
 * @author Mtcy
 */
class MY_Controller extends CI_Controller {
    
    private $uid = null;
    private $role = null;
    
    public function __construct() {
        parent::__construct();
        $this->uid = $this->session->userdata('uid');
        $this->role = $this->session->userdata('role');
        date_default_timezone_set('Asia/Kuala_Lumpur');
    }
    
    # only allow logged in user, else redirect
    protected function isLoggedIn($url = null) {
        if ($this->uid != null && $this->role != null) {
            return true;
        }
        if ($url != null) 
            redirect($url);
        return null;
    }
    
    # only allow not logged in user, else redirect
    protected function notLoggedIn($url = null) {
        if ($this->uid == null && $this->role == null) {
            return true;
        }
        if ($url != null) 
            redirect($url);
        return null;
    }
    
    # only allow merchant, else redirect
    protected function merchantOnly($url = null) {
        if ($this->role === 'merchant')
            return true;
        if ($url != null) 
            redirect($url);
        return null;
    }
    
    # only allow admin, else redirect
    protected function adminOnly($url = null) {
        if ($this->role == 'admin')
            return true;
        if ($url != null) 
            redirect($url);
        return null;
    }
    
    protected function uid() {
        return intval($this->session->userdata('uid'));
    }
    
    protected function role() {
        return $this->role;
    }
    
    protected function verified() {
        $this->load->model('model_user', 'user');
        $user = $this->user->get_userinfo_by_uid($this->uid());
        if ($user['company_verification'] == false)
            redirect('dashboard');
    }
    
    protected function isMember() {
        $this->load->model('model_service_lines', 'service_lines');
        $result = $this->service_lines->get_payment_status($this->uid());
        if ($result == null)
            redirect('services');
    }
    
    protected function smtp_mail($to, $title, $message) {
        $email_config = Array(
                    'protocol'  => 'smtp',
                        'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => '465',
                    'smtp_user' => 'mtcy.9012@gmail.com',
                    'smtp_pass' => 'mark015299',
                    'mailtype'  => 'html',
                    'starttls'  => true,
                    'newline'   => "\r\n"
                );

                $this->load->library('email', $email_config);

                $this->email->from('mtcy.9012@gmail.com', 'P2U');
                $this->email->to($to);
                $this->email->subject($title);
                $this->email->message($message);

                if ($this->email->send()) {
                    return true;
                } else {
                    return false;
                }
    }
    
}
