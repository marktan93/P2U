<?php

/**
 * Description of customers
 *
 * @author Mtcy
 */
class customers extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        if ($this->isLoggedIn() == null)
            redirect('home/login'); # redirect ltr maybe
        
        $this->verified();
        $this->isMember();
    }
    
    public function index() {
        $this->load->model('model_customers', 'customers');
        
        // get total num of products
        $customers = $this->customers->get_customers_num($this->uid());

        // product per page
        $per_page = 10;
        
        // total pages
        $total_pages = ceil($customers['total']/$per_page);
        
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
            'title' => 'Products',
            'customers' => $this->customers->get($this->uid(), $current_page, $per_page),
            'total_pages' =>$total_pages,
            'current_page' => ($this->uri->segment(3) == null)?1:$this->uri->segment(3),
            'page_name' => 'index'
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-customers.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function search() {
        $this->load->model('model_customers', 'customers');
        
        $keyword = $this->input->post('keyword');
        if ($keyword != null) {
            $this->session->set_userdata('cust_keyword', $keyword);
        } else {
            $keyword = $this->session->userdata('cust_keyword');
        }
        
        // get total num of customers
        $customers = $this->customers->get_search_customers_num($keyword, $this->uid());

        // customer per page
        $per_page = 10;
        
        // total pages
        $total_pages = ceil($customers['total']/$per_page);
        
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
            'title' => 'Products',
            'customers' => $this->customers->get_search($keyword, $this->uid(), $current_page, $per_page),
            'total_pages' =>$total_pages,
            'current_page' => ($this->uri->segment(3) == null)?1:$this->uri->segment(3),
            'page_name' => 'search'
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-customers.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
}
