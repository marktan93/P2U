<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends MY_Controller {
    
    public function index() {
        
        $data = array(
            'path' => asset_url(),
            'title' => 'Home',
            'loggedIn' => $this->isLoggedIn()
        );
        $this->parser->parse('includes/front/header.inc.php', $data);
        $this->parser->parse('index', $data);
        $this->parser->parse('includes/front/footer.inc.php', $data);
    }
    
    public function about() {
        
        $data = array(
            'path' => asset_url(),
            'title' => 'About'
        );
        $this->parser->parse('includes/front/header.inc.php', $data);
        $this->parser->parse('about', $data);
        $this->parser->parse('includes/front/footer.inc.php', $data);
    }
    
    public function signup() {
        $this->notLoggedIn('home');
        session_start();
        
        $email = $this->input->post('email');
        $highlight = '';
        if ($email != '')
            $highlight = 'highlight';
        $data = array(
            'path' => asset_url(),
            'email' => $email,
            'highlight' => $highlight,
            'title' => 'Signup'
        );
        $this->parser->parse('includes/front/header.inc.php', $data);
        $this->parser->parse('signup', $data);
        $this->parser->parse('includes/front/footer.inc.php', $data);
    }
    
    public function signup_process() {
        $this->notLoggedIn('home');
        session_start();
        
        $this->form_validation->set_rules('fullname', 'fullname', 'required|alpha_dash_space|xss_clean');
        $this->form_validation->set_rules('icno', 'IC No', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'required|matches[repassword]');
        $this->form_validation->set_rules('repassword', 'retype password', 'required');
        $this->form_validation->set_rules('contact', 'mobile contact', 'required|xss_clean');
        $this->form_validation->set_rules('sec_a', 'security answer', 'required|xss_clean');
        $this->form_validation->set_rules('captcha_code', 'captcha code', 'required|xss_clean');
        
        if ($this->form_validation->run() == FALSE)
        {
            $data = array(
                'path' => asset_url(),
                'title' => 'Signup',
                'email' => ''
            );
            $this->parser->parse('includes/front/header.inc.php', $data);
            $this->parser->parse('signup', $data);
            $this->parser->parse('includes/front/footer.inc.php', $data);
        }
        else
        {
            $_errors = array();
            $_POST = array_values($_POST);
            list($fullname, $icno, $email, $password, $repassword, $contact, $security_question, $security_answer, $captcha_code) = $_POST;
                
            $this->load->library('securimage');
            $securimage = new Securimage();

            if ($securimage->check($captcha_code) == false) {
                // the code was incorrect
                // you should handle the error so that the form processor doesn't continue
                array_push($_errors, 'Error: Captcha code error.');
            } else {
                // start register merchant

                /***** Generate salt and encrypt password ****/
                $this->load->library('salt');
                $salt = new salt();
                $salt->generate();

                $this->load->model('model_user', 'user');
                $this->user->insert_users($email, $salt->encrypt($password), $salt->getSalt(), 'merchant');
                $uid = $this->user->insert_user_info($fullname, $icno, $contact, $security_answer, $security_question);
                
                $this->session->set_userdata('uid', $uid);
                $this->session->set_userdata('role', 'merchant');
                
                
                if ($this->activate_mail()) {
                    redirect('home/success');
                    die();
                }
                
                
            }
        }
        redirect('home/signup/error');
    }
    
    public function api() {
        
        $data = array(
            'path' => asset_url(),
            'title' => 'API'
        );
        $this->parser->parse('includes/front/header.inc.php', $data);
        $this->parser->parse('api', $data);
        $this->parser->parse('includes/front/footer.inc.php', $data);
    }
    
    public function success() {
        $this->isLoggedIn('home');
        
        $data = array(
            'path' => asset_url(),
            'title' => 'Success'
        );
        $this->parser->parse('includes/front/header.inc.php', $data);
        $this->parser->parse('signup-success', $data);
        $this->parser->parse('includes/front/footer.inc.php', $data);
    }
    
    
    /// resend activation mail
    public function activate_mail() {
        $this->isLoggedIn('home');
        $uid = $this->session->userdata('uid');
        
        if ($uid!=null) {
            $this->load->model('Model_user', 'user');
            $email = $this->user->get_email_by_uid($uid);
            if ($email) {
                $message = '<a href="'.site_url().'home/activate/'.$this->generate_activation_code().'">Click here to verify your email.</a>';
                if ($this->smtp_mail($email, 'P2U Email Activation', $message)) {
                    //echo 'Successfully sent mail';
                    redirect('dashboard');
                } else {
                    //echo 'failed to send mail';
                }
            } else {
                //echo 'Failed to send email';
            }
        } else {
            ///echo 'Failed to send email';
        }
        redirect('home/success');
        //echo $this->email->print_debugger();
    }
    
    public function activate() {
        $this->isLoggedIn('home');
        $uid = $this->session->userdata('uid');
        if ($uid) {
            $code = $this->uri->segment(3);
            if ($code) {

                if ($code == $this->generate_activation_code()) {
                    // code match, activate email

                    $this->load->model('Model_user', 'user');
                    $result = $this->user->update_acc_activation($uid, true);

                    if ($result) {
                        redirect('home/login');
                    } else {
                        echo 'failed to activate ';
                    }

                } else {
                    echo 'Code error';
                }

            } else {
                echo 'Code error';
            }
        }
        
    }
    
    # generate activate code by using the salt value and algorithm
    private function generate_activation_code() {
        $this->isLoggedIn('home');
        $uid = $this->session->userdata('uid');
        
        if ($uid) {
            
            $this->load->model('Model_user', 'user');
            $salt = $this->user->get_salt_by_uid($uid);
            if ($salt) {
                return $newsalt = sha1(substr($salt, 0, 10));
            }
            
        }
        
    }
    
    public function logout() {
        $this->isLoggedIn('home');
        $this->session->unset_userdata('uid');
        $this->session->unset_userdata('role');
        redirect("home/index");
    }
    
    public function login() {
        $this->notLoggedIn('home');
        
        $segment = $this->uri->segment(3);
        $error = null;
        $recover = null;
        if ($segment == 'error') 
            $error = 'Failed to login, please enter correct email and password.';
        else if ($segment == 'recover') 
            $recover = 'Successfully reset the password, please check the email.';
        $data = array(
            'path' => asset_url(),
            'error' => $error,
            'recover' => $recover
                /// don't need title, hardcoded
        );
        $this->parser->parse('login', $data);
    }
    
    public function forgot() {
        $this->notLoggedIn('home');
        
        $segment = $this->uri->segment(3);
        $error = null;
        if ($segment == 'error') 
            $error = 'Failed to reset password, wrong information.';
        $data = array(
            'path' => asset_url(),
            'error' => $error
        );
        $this->parser->parse('forgot', $data);
    }
    
    public function forgot_progress() {
        $this->notLoggedIn('home');
        $sec_q = $this->input->post('sec_q');
        $sec_a = $this->input->post('sec_a');
        $email = $this->input->post('email');
        if (!empty($sec_a) && !empty($sec_q)  && !empty($email)) {
            $this->load->model('Model_user', 'user');
            $uid = $this->user->get_uid_by_sec($sec_q, $sec_a);
            if ($uid != null) {
                // match
                $new_pass = substr(str_shuffle("abcdefgh1234556"), 0, 8);
                
                $this->load->library('salt');
                $salt = new salt;
                
                $s = $this->user->get_salt_by_uid($uid);
                $salt->setSalt($s);
                $encrypted_pass = $salt->encrypt($new_pass);
                
                
                
                // update database
                if ($this->user->update_password($uid, $encrypted_pass) != null) {
                    // send mail
                    if ($this->smtp_mail($email, 'P2U Password Recovery', 'New password: '.$new_pass)) {
                        redirect('home/login/recover');
                    }
                }
                
            }
            
        }
        redirect('home/forgot/error');
    }
    
    public function password_update() {
        $password = $this->input->post('password');
        $repassword = $this->input->post('repassword');
        if (!empty($password) && !empty($repassword)) {
            if ($password == $repassword) {
                $this->load->model('Model_user', 'user');
                $this->load->library('salt');
                $uid = $this->session->userdata('uid');
                $salt = new salt;
                $s = $this->user->get_salt_by_uid($uid);
                $salt->setSalt($s);
                $encrypted_pass = $salt->encrypt($password);
                if ($this->user->update_password($uid, $encrypted_pass)) {
                    redirect('dashboard/userprofile/success');
                }
            }
        }
        redirect('dashboard/userprofile/error');
    }
    
    public function login_progress() {
        $this->notLoggedIn('home');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->load->library('salt');
        $this->load->model('Model_user', 'user');
        
        $salt = new salt();
        $s = $this->user->get_salt_by_email($email);
        $salt->setSalt($s);
        $salted = $salt->encrypt($password);
        $user = $this->user->login($email, $salted);
        if ($user == null) {
            // login unsuccessful
            // ltr add in error message
            redirect('home/login/error');
        } else {
            $this->session->set_userdata('uid', $user['uid']);
            $this->session->set_userdata('role', $user['role']);
            redirect('dashboard');
        }
        
    }
    
     public function contact() {
        $success = $this->uri->segment(3);
        $data = array(
            'path' => asset_url(),
            'title' => 'Contact',
            'success' => $success
        );
        $this->parser->parse('includes/front/header.inc.php', $data);
        $this->parser->parse('contact', $data);
        $this->parser->parse('includes/front/footer.inc.php', $data);
    }
    
    public function contact_process() {
        $fullname = $this->input->post('fullname');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $content = $this->input->post('content');
        
        $this->form_validation->set_rules('fullname', 'fullname', 'required|alpha_dash_space|xss_clean');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean');
        $this->form_validation->set_rules('mobile', 'mobile contact', 'required|xss_clean');
        $this->form_validation->set_rules('content', 'content', 'required|xss_clean');
        
        if ($this->form_validation->run() == FALSE)
        {
            $data = array(
                'path' => asset_url(),
                'title' => 'Contact'
            );
            $this->parser->parse('includes/front/header.inc.php', $data);
            $this->parser->parse('contact', $data);
            $this->parser->parse('includes/front/footer.inc.php', $data);
        }
        else
        {
            $str = "<table border='0'>"
                    ."<tr><td>Fullname</td><td>$fullname</td></tr>"
                    ."<tr><td>Email</td><td>$email</td></tr>"
                    ."<tr><td>Mobile</td><td>$mobile</td></tr>"
                    ."<tr><td>Content</td><td>$content</td></tr>"
                    . "</table>";
            $this->smtp_mail('admin@7shocks.com', 'Support - Enquiry', $str);
            $data = array(
                'path' => asset_url(),
                'title' => 'Contact'
            );
            $this->parser->parse('includes/front/header.inc.php', $data);
            $this->parser->parse('contact-success', $data);
            $this->parser->parse('includes/front/footer.inc.php', $data);
        }
        
        
    }
    
    
    // validation rules
    public function alpha_dash_space($str) {
        return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    } 
    
}

?>
