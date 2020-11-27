<?php
/**
 * Description of products
 *
 * @author Mtcy
 */
class products extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->isLoggedIn() == null)
            redirect('home/login'); # redirect ltr maybe
        
        $this->verified();
        $this->isMember();
    }
    
    public function index() {
        $this->load->model('model_products', 'products');
        
        // get total num of products
        $products = $this->products->get_products_num($this->uid());

        // product per page
        $per_page = 10;
        
        // total pages
        $total_pages = ceil($products['total']/$per_page);
        
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
            'products' => $this->products->get($this->uid(), $current_page, $per_page),
            'total_pages' =>$total_pages,
            'current_page' => ($this->uri->segment(3) == null)?1:$this->uri->segment(3),
            'page_name' => 'index'
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-products.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function search() {
        $this->load->model('model_products', 'products');
        
        $keyword = $this->input->post('keyword');
        if ($keyword != null) {
            $this->session->set_userdata('prod_keyword', $keyword);
        } else {
            $keyword = $this->session->userdata('prod_keyword');
        }
        
        // get total num of products
        $products = $this->products->get_search_products_num($keyword, $this->uid());

        // product per page
        $per_page = 10;
        
        // total pages
        $total_pages = ceil($products['total']/$per_page);
        
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
            'products' => $this->products->get_search($keyword, $this->uid(), $current_page, $per_page),
            'total_pages' =>$total_pages,
            'current_page' => ($this->uri->segment(3) == null)?1:$this->uri->segment(3),
            'page_name' => 'search'
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-products.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function add() {
        $this->load->model('model_vendors', 'vendors');
        
        $data = array(
            'path' => asset_url(),
            'title' => 'Products',
            'vendors' => $this->vendors->get($this->uid()) // load existing vendors
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-products-add.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    // delete product
    public function delete() {
        
        $this->load->model("model_products", "products");
        
        $product_id = $this->uri->segment(3);
        if ($product_id != null) {
            // start delete
            // unlink image file
            $product = $this->products->get_image($product_id);
            if ($product != null) {
                unlink(FCPATH.'assets/upload/products/'.$product['image']);
                $array = explode('.', $product['image']);
                unlink(FCPATH.'assets/upload/products/thumbnail/'.$array[0].'_thumb.'.$array[1]);
                
                // delete records in products, CASCADE delete records in product_vendor
                $this->products->delete($product_id);
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function edit() {
        $this->load->model('model_products', 'products');
        $this->load->model('model_vendors', 'vendors');
        $this->load->model('model_product_vendor', 'product_vendor');
        
        $product_id = $this->uri->segment(3);
        if ($product_id == null)
            redirect($_SERVER['HTTP_REFERER']);
        $product = $this->products->get_product_by_id($product_id);
        $vendors = $this->product_vendor->get($product_id);
        if ($product != null) {
            $vendor_id = array();
            foreach ($vendors as $vendor)
                $vendor_id[] = $vendor['id'];
            $data = array(
                'path' => asset_url(),
                'title' => 'Products',
                'product' => $product,
                'vendors' =>  $this->vendors->get($this->uid()), // load existing vendors
                'vendor_id' => $vendor_id
            );
            $this->parser->parse('includes/back/header.inc.php', $data);
            $this->parser->parse('dashboard-products-edit.php', $data);
            $this->parser->parse('includes/back/footer.inc.php', $data);
            
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function edit_process() {
        $product_id = $this->uri->segment(3);
        if ($product_id == null)
            redirect($_SERVER['HTTP_REFERER']);
        $this->load->model('model_products', 'products');
        $this->load->model('model_vendors', 'vendors');
        $this->load->model('model_product_vendor', 'product_vendor');
        
        $product_id = $this->uri->segment(3);
        if ($product_id != null) {
            $product_image = null;
            // process upload image
            if (!empty($_FILES["product_image"]["tmp_name"])) {
                $product_image = $this->product_image();
            }
            $product_name = $this->input->post('product_name');
            $cost_points = $this->input->post('cost_points');
            $balance = $this->input->post('balance');
            $receive_mode = $this->input->post('receive_mode');
            // convert to right date format
            $start_date = date('Y-m-d', strtotime($this->input->post('start_date')));
            $due_date = date('Y-m-d', strtotime($this->input->post('due_date')));
            $vendors = $this->input->post('vendors');
            
            $this->form_validation->set_rules('product_name', 'product name', 'required|xss_clean');
            $this->form_validation->set_rules('cost_points', 'cost points', 'required|numeric|xss_clean');
            $this->form_validation->set_rules('balance', 'balance', 'required|integer|xss_clean');
            $this->form_validation->set_rules('receive_mode', 'receive_mode', 'required|xss_clean');
            $this->form_validation->set_rules('start_date', 'start date', 'required|xss_clean');
            $this->form_validation->set_rules('due_date', 'due date', 'required|xss_clean');
            $this->form_validation->set_rules('vendors', 'vendors', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {
               $product_id = $this->uri->segment(3);
                if ($product_id == null)
                    redirect($_SERVER['HTTP_REFERER']);
                $product = $this->products->get_product_by_id($product_id);
                $vendors = $this->product_vendor->get($product_id);
                if ($product != null) {
                    $vendor_id = array();
                    foreach ($vendors as $vendor)
                        $vendor_id[] = $vendor['id'];
                    $data = array(
                        'path' => asset_url(),
                        'title' => 'Products',
                        'product' => $product,
                        'vendors' =>  $this->vendors->get($this->uid()), // load existing vendors
                        'vendor_id' => $vendor_id
                    );
                    $this->parser->parse('includes/back/header.inc.php', $data);
                    $this->parser->parse('dashboard-products-edit.php', $data);
                    $this->parser->parse('includes/back/footer.inc.php', $data);

                } else {
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
            else
            {
                // process image upload
                 if (!empty($_FILES["product_image"]["tmp_name"])) {
                // unlink previous image
                    $product = $this->products->get_image($product_id);
                    unlink(FCPATH.'assets/upload/products/'.$product['image']);
                    $array = explode('.', $product['image']);
                    unlink(FCPATH.'assets/upload/products/thumbnail/'.$array[0].'_thumb.'.$array[1]);
                }
                // update product
                $update = $this->products->update($product_id, $product_name, $product_image, $cost_points, $balance, $receive_mode, $start_date, $due_date);
                // delete all vendors 
                $delete = $this->product_vendor->delete_by_product($product_id);
                // re-insert all vendors
                $result = $this->product_vendor->set($product_id, $vendors);
                if ($result != null)
                    redirect('products/edit/'.$product_id);
            }
        }
    }
    
    public function add_process() {
        $this->load->model('model_vendors', 'vendors');
        $this->load->model('model_products', 'products');
        $this->load->model('model_product_vendor', 'product_vendor');
        
        $product_name = $this->input->post('product_name');
        $cost_points = $this->input->post('cost_points');
        $balance = $this->input->post('balance');
        $receive_mode = $this->input->post('receive_mode');
        // convert to right date format
        $start_date = date('Y-m-d', strtotime($this->input->post('start_date')));
        $due_date = date('Y-m-d', strtotime($this->input->post('due_date')));
        $vendors = $this->input->post('vendors');
        
        $this->form_validation->set_rules('product_name', 'product name', 'required|xss_clean');
        $this->form_validation->set_rules('cost_points', 'cost points', 'required|numeric|xss_clean');
        $this->form_validation->set_rules('balance', 'balance', 'required|integer|xss_clean');
        $this->form_validation->set_rules('receive_mode', 'receive_mode', 'required|xss_clean');
        $this->form_validation->set_rules('start_date', 'start date', 'required|xss_clean');
        $this->form_validation->set_rules('due_date', 'due date', 'required|xss_clean');
        $this->form_validation->set_rules('vendors', 'vendors', 'required|xss_clean');
        //$this->form_validation->set_rules('product_image', 'product image', 'required|xss_clean');
        
        if ($this->form_validation->run() == FALSE)
        {
            $data = array(
                'path' => asset_url(),
                'title' => 'Products',
                'vendors' => $this->vendors->get($this->uid()) // load existing vendors
            );
            $this->parser->parse('includes/back/header.inc.php', $data);
            $this->parser->parse('dashboard-products-add', $data);
            $this->parser->parse('includes/back/footer.inc.php', $data);
        }
        else
        {
            // process image upload
            $product_image = $this->product_image();
            $product_id = $this->products->set($this->uid(), $product_name, $product_image, $cost_points, $balance, $receive_mode, $start_date, $due_date);
            if ($product_id != null){
                $result = $this->product_vendor->set($product_id, $vendors);
                if ($result != null)
                    redirect('products/add');
            }
        }
        
    }
    
    // process product image upload
    private function product_image() {
        // upload
        $config['upload_path'] = './assets/upload/products/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '1000';
        $config['file_name']	= uniqid();
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config); 
        if ( ! $this->upload->do_upload('product_image'))
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
    
    #### ajax ####
    
    // add vender
    // return updated list
    public function add_vendor() {
        $this->load->model('model_vendors', 'vendors');
        $name = $this->input->post('name');
        if (!empty($name)) {
            $result = $this->vendors->set($this->uid(), $name);
            if ($result == true) {
                $vendors = $this->vendors->get($this->uid());
                if ($vendors == true )
                    die(json_encode($vendors));
            }
        }
        die('null');
    }
    
    // delete vendor
    // return updated list
    public function delete_vendor() {
        $this->load->model('model_vendors', 'vendors');
        $name = $this->input->post('name');
        if (!empty($name)) {
            $result = $this->vendors->delete($this->uid(), $name);
            if ($result == true) {
                $vendors = $this->vendors->get($this->uid());
                if ($vendors == true )
                    die(json_encode($vendors));
                else 
                    die(json_encode(array('data'=>'error', 'message'=>'not found')));
            }
        }
        die('null');
    }
  
    // get vendor for specific product ajax 
    public function get_vendor() {
        $this->load->model('model_product_vendor', 'product_vendor');
        $product_id = $this->input->post('product_id');
        if (!empty($product_id)) {
            $vendors = $this->product_vendor->get($product_id);
            if ($vendors != null) {
            $str = "";
            foreach($vendors as $vendor) {
                $str .= $vendor['name'].', ';
            }
             die(substr($str, 0, strlen($str)-2));
            }
        }
        die('Error: No vendor found');
    }
    
    public function activate() {
        $this->load->model('model_products', 'products');
        
        $product_id = $this->input->post('product_id');
        $activation = strval(!$this->input->post('activation'));
        if (!empty($product_id) ) {
            $result = $this->products->set_activation($product_id, $activation);
            if ($result != null) 
                die($activation);
            
        }
        die('null');
    }
    
}
