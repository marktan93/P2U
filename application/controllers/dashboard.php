<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class dashboard extends MY_Controller {
    
    private $api = null;
    
    public function __construct() {
        parent::__construct();
        if ($this->isLoggedIn() == null)
            redirect('home/login'); # redirect ltr maybe
    }
    
    public function index() {
        $uid = $this->uid();
        if ($uid) {
            $this->load->model('Model_user', 'user');
            $status = $this->user->get_activation_status($uid);
            
            if ($status) {
                // all ok
                $error = '';
                if ($this->uri->segment(3) == 'error')
                    $error = 'Failed to notify admin, you may contact for customer support via email. Thanks.';
                
                $user_info = $this->user->get_userinfo_by_uid($uid);
                $this->load->library('parser');
                $data = array(
                    'path' => asset_url(),
                    'title' => 'Home',
                    'user' => $user_info,
                    'error' => $error,
                    'role' => $this->role()
                );
                $this->parser->parse('includes/back/header.inc.php', $data);
                $this->parser->parse('dashboard-index', $data);
                $this->parser->parse('includes/back/footer.inc.php', $data);
                
            } else {
                // Email not yet be activated
                // add error message
                redirect("home/success");
            }
        } else {
            redirect('home');
        }
    }
    
    public function userprofile() {
        $this->load->model('Model_user', 'user');
        $user = $this->user->get_user_by_uid($this->uid());
        $user_info = $this->user->get_userinfo_by_uid($this->uid());
        $user_array = array_merge($user, $user_info);
        $data = array(
            'path' => asset_url(),
            'title' => 'User Profile',
            'user' => $user_array
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('user-profile', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function companyprofile() {
        # load user details
        $this->load->model('Model_user', 'user');
        $user = $this->user->get_user_by_uid($this->session->userdata('uid'));
        $user_info = $this->user->get_userinfo_by_uid($this->session->userdata('uid'));
        $user_array = array_merge($user, $user_info);
        
        $data = array(
            'path' => asset_url(),
            'title' => 'Company Profile',
            'user' => $user_array
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('company-profile', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function company_update() {
        $this->load->model('Model_user', 'user');
        $company_name = $this->input->post('company_name');
        $company_regno = $this->input->post('company_regno');
        $company_code = $this->input->post('company_code');
        $website = $this->input->post('website');
        $term_condition = $this->input->post('term_condition');
        if (!empty($company_name) && !empty($company_regno) && !empty($term_condition) && !empty($company_code) && !empty($website)) {
            $user_ic = "";
			$company_logo = "";
			$user_info = $this->user->get_userinfo_by_uid($this->session->userdata('uid'));
			if ($_FILES['user_ic']['tmp_name'] != "") {
				if ($user_info['ic_img'] != "") {
					$ic_img = explode('.', $user_info['ic_img']);
					//unlink(FCPATH.'assets/upload/ic/'.$ic_img[0].'_thumb.'.$ic_img[1]);
				}
				$user_ic = $this->user_ic();
			} else {
				$user_ic = $user_info['ic_img'];
			}
			
			if ($_FILES['company_logo']['tmp_name'] != "") {
				if ($user_info['company_logo'] != "") {
					//unlink(FCPATH.'assets/upload/logo/'.$user_info['company_logo']);
				}
				$company_logo = $this->company_logo();
			} else {
				$company_logo = $user_info['company_logo'];
			}
            
                $this->load->model('Model_user', 'user');
                $result = $this->user->update_company($this->uid(), $company_name, $company_regno, $company_code, $website, $company_logo, $user_ic);
                if ($result) {
                    redirect('dashboard/companyprofile/success');
                }
            
        }
        
         redirect('dashboard/companyprofile/error');
        
    }
    
    private function user_ic() {
        // upload
        $config['upload_path'] = './assets/upload/ic/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '1000';
        $config['file_name']	= uniqid();
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config); 
        if ( ! $this->upload->do_upload('user_ic'))
        {
                $error = array('error' => $this->upload->display_errors());

                print_r($error);
                return null;
        }
        
        $data = array('upload_data' => $this->upload->data());
        /// watermark
        $watermark['image_library'] = 'gd2';   
        $watermark['source_image'] = $config['upload_path'].$config['file_name'].$data['upload_data']['file_ext'];
        $watermark['wm_type'] = 'overlay';
        $watermark['wm_overlay_path'] = './assets/images/useonly.png';//the overlay image
        $watermark['wm_opacity']=50;
        $watermark['create_thumb'] = TRUE;
        $watermark['wm_vrt_alignment'] = 'middle';
        $watermark['wm_hor_alignment'] = 'middle';
        $this->load->library('image_lib');
        $this->image_lib->initialize($watermark);
        
        if(!$this->image_lib->watermark())
        {
           echo $this->image_lib->display_errors(); 
           return null;
        } 
        
        //unlink($watermark['source_image']);
        $this->image_lib->clear();
        /// resize
        $config['image_library'] = 'gd2';
        $config['source_image']	= $config['upload_path'].$config['file_name'].'_thumb'.$data['upload_data']['file_ext'];
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']	= 320;
        $config['height']	= 205;
        $config['file_name']	= $config['file_name'];
        $config['new_image'] = $config['upload_path'].'thumbnail/'.$config['file_name'].$data['upload_data']['file_ext'];

        $this->load->library('image_lib'); 
        $this->image_lib->initialize($config);
        
        if ( ! $this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
            return null;
        }
        
        return $config['file_name'].$data['upload_data']['file_ext'];
        
    }
    
    private function company_logo() {
        // upload
        $config['upload_path'] = './assets/upload/logo/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '1000';
        $config['file_name']	= uniqid();
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config); 
        if ( ! $this->upload->do_upload('company_logo'))
        {
                $error = array('error' => $this->upload->display_errors());

                print_r($error);
                return null;
        }
        else
        {
                $data = array('upload_data' => $this->upload->data());

                //print_r($data);
        }
        /// resize
        $config['image_library'] = 'gd2';
        $config['source_image']	= $config['upload_path'].$config['file_name'].$data['upload_data']['file_ext'];
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']	= 100;
        $config['height']	= 100;
        $config['new_image'] = $config['upload_path'].'thumbnail/'.$config['file_name'].$data['upload_data']['file_ext'];

        $this->load->library('image_lib'); 
        $this->image_lib->initialize($config);
        
        if ( ! $this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
            return null;
        }
        $this->image_lib->clear();
        
        return $config['file_name'].$data['upload_data']['file_ext'];
        
    }
    
}

?>
