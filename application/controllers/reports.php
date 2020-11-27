<?php

/**
 * Description of reports
 *
 * @author Mtcy
 */
class reports extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        if ($this->isLoggedIn() == null)
            redirect('home/login'); 
    }
    
    // merchant view report
    public function subscriptions() {
        $this->merchantOnly('dashboard');
        $this->load->model('model_subscriptions', 'subscriptions');
        
        $year = $this->uri->segment(3);
        if ($year == null)
            $year = date("Y");
        
        
        $data = array(
            'path' => asset_url(),
            'title' => 'Report',
            'report' => $this->subscriptions->report($this->uid(), $year), 
            'years' => $this->subscriptions->get_exist_year($this->uid()),
            'preselect_year' => $year
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-reports.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    // admin view report
    public function merchant_subscriptions() {
        $this->adminOnly('dashboard');
        $this->load->model('model_service_lines', 'service_lines');
        
        $year = $this->uri->segment(3);
        if ($year == null)
            $year = date("Y");
        
        
        $data = array(
            'path' => asset_url(),
            'title' => 'Report',
            'report' => $this->service_lines->report($year), 
            'years' => $this->service_lines->get_exist_year(),
            'preselect_year' => $year
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-reports-merchant.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
}
