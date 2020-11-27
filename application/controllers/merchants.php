<?php
/**
 * Description of merchants
 *
 * @author Mtcy
 */
class merchants extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        if ($this->isLoggedIn() == null)
            redirect('home/login'); 
    }
    
    // merchant list, can activate or deactivate 
    // verify merchant
    // search
    public function index() {
        $this->load->model('model_user', 'user');
        
        
        // get total num of merchants
        $merchants = $this->user->get_merchants_num();

        // product per page
        $per_page = 10;
        
        // total pages
        $total_pages = ceil($merchants['total']/$per_page);
        
        // get current page
        $current_page = intval($this->uri->segment(3));
        if ($current_page == null)
            $current_page = 0;
        else if ($current_page < 1 || $current_page > $total_pages) // prevent visit error page
            $current_page = 0;
        else if ($current_page > 1 && $current_page <= $total_pages)
            $current_page = ($current_page-1)*$per_page;
        else if ($current_page == 1)
            $current_page--;
        
        $data = array(
            'path' => asset_url(),
            'title' => 'Merchant Management',
            'merchants' => $this->user->get_merchant($current_page, $per_page),
            'total_pages' =>$total_pages,
            'current_page' => ($this->uri->segment(3) == null)?1:$this->uri->segment(3)
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-merchant-list', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function search() {
        $this->load->model('model_user', 'user');
        
        $keyword = $this->input->post('search');
        // get total num of merchants
        $merchants = $this->user->get_search_merchants_num($keyword);

        // product per page
        $per_page = 10;
        
        // total pages
        $total_pages = ceil($merchants['total']/$per_page);
        
        // get current page
        $current_page = intval($this->uri->segment(3));
        if ($current_page == null)
            $current_page = 0;
        else if ($current_page < 1 || $current_page > $total_pages) // prevent visit error page
            $current_page = 0;
        else if ($current_page > 1 && $current_page <= $total_pages)
            $current_page = ($current_page-1)*$per_page;
        else if ($current_page == 1)
            $current_page--;
        
        $data = array(
            'path' => asset_url(),
            'title' => 'Merchant Management',
            'merchants' => $this->user->search_merchant($keyword, $current_page, $per_page),
            'total_pages' =>$total_pages,
            'current_page' => ($this->uri->segment(3) == null)?1:$this->uri->segment(3)
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-merchant-search', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function details() {
        $merchant_id = $this->uri->segment(3);
        if ($merchant_id != null) {
            
            $this->load->model('Model_user', 'user');
            $user = $this->user->get_user_by_uid($merchant_id);
            $user_info = $this->user->get_userinfo_by_uid($merchant_id);
            $user_array = array_merge($user, $user_info);
            $data = array(
                'path' => asset_url(),
                'title' => 'Merchant profile',
                'user' => $user_array
            );
            $this->parser->parse('includes/back/header.inc.php', $data);
            $this->parser->parse('dashboard-merchant-details', $data);
            $this->parser->parse('includes/back/footer.inc.php', $data);
            
        } else {
            redirect($_SERVER["HTTP_REFERRER"]);
        }
    }
    
    public function approve() {
        $this->load->model('model_user', 'user');
        if ($this->input->post('approve')) {
            // apporve the company verification
            $merchant_id = $this->input->post('merchant_id');
            if (!empty($merchant_id)) {
                $result = $this->user->approve_company($merchant_id);
                $bool = "success";
                if ($result == null)
                    $bool = "failed";
                redirect('merchants/details/'.$merchant_id.'/'.$bool);
            }
        } else {
            redirect('merchants');
        }
    }
    
}
