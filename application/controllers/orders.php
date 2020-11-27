<?php

/**
 * Description of orders
 *
 * @author Mtcy
 */
class orders extends MY_Controller {
    
    /// check orders 
        // update order stauts 
        // view the orders by customer
        // udpate delivery status
        // show order receipt
        // searching /// search by name or id 
    
    public function __construct() {
        parent::__construct();
        if ($this->isLoggedIn() == null)
            redirect('home/login'); # redirect ltr maybe
        
        $this->verified();
        $this->isMember();
    }
    
    public function index() {
        
        $this->load->model('model_orders', 'orders');
        
        // get total num of orders
        $orders = $this->orders->orders_num($this->uid());

        // orders per page
        $per_page = 10;
        
        // total pages
        $total_pages = ceil($orders['total']/$per_page);
        
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
            'title' => 'Orders',
            'orders' => $this->orders->get($this->uid(), $current_page, $per_page),
            'badges_paid' => $this->orders->paid_num($this->uid()),
            'badges_packaging' => $this->orders->packaging_num($this->uid()),
            'total_pages' =>$total_pages,
            'current_page' => ($this->uri->segment(3) == null)?1:$this->uri->segment(3),
            'page_name' => 'index'
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-orders.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function search() {
        
        $this->load->model('model_orders', 'orders');
        
        $keyword = $this->input->post('keyword');
        if ($keyword != null) {
            $this->session->set_userdata('keyword', $keyword);
        } else {
            $keyword = $this->session->userdata('keyword');
        }
        
        
        // get total num of orders
        $orders = $this->orders->search_orders_num($keyword, $this->uid());

        // orders per page
        $per_page = 10;
        
        // total pages
        $total_pages = ceil($orders['total']/$per_page);
        
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
            'title' => 'Orders',
            'orders' => $this->orders->search($keyword, $this->uid(), $current_page, $per_page),
            'badges_paid' => $this->orders->paid_num($this->uid()),
            'badges_packaging' => $this->orders->packaging_num($this->uid()),
            'total_pages' =>$total_pages,
            'current_page' => ($this->uri->segment(3) == null)?1:$this->uri->segment(3),
            'page_name' => 'search'
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-orders.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function paid() {
        
        $this->load->model('model_orders', 'orders');
        
        // get total num of orders
        $orders = $this->orders->paid_num($this->uid());

        // orders per page
        $per_page = 10;
        
        // total pages
        $total_pages = ceil($orders['total']/$per_page);
        
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
            'title' => 'Orders',
            'orders' => $this->orders->get($this->uid(), $current_page, $per_page, 'AND `status` = "paid" '),
            'badges_paid' => $this->orders->paid_num($this->uid()),
            'badges_packaging' => $this->orders->packaging_num($this->uid()),
            'total_pages' =>$total_pages,
            'current_page' => ($this->uri->segment(3) == null)?1:$this->uri->segment(3),
            'page_name' => 'paid'
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-orders.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function packaging() {
        
        $this->load->model('model_orders', 'orders');
        
        // get total num of orders
        $orders = $this->orders->packaging_num($this->uid());

        // orders per page
        $per_page = 10;
        
        // total pages
        $total_pages = ceil($orders['total']/$per_page);
        
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
            'title' => 'Orders',
            'orders' => $this->orders->get($this->uid(), $current_page, $per_page, 'AND `status` = "packaging" '),
            'badges_paid' => $this->orders->paid_num($this->uid()),
            'badges_packaging' => $this->orders->packaging_num($this->uid()),
            'total_pages' =>$total_pages,
            'current_page' => ($this->uri->segment(3) == null)?1:$this->uri->segment(3),
            'page_name' => 'packaging'
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-orders.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function ready() {
        
        $this->load->model('model_orders', 'orders');
        
        // get total num of orders
        $orders = $this->orders->ready_num($this->uid());

        // orders per page
        $per_page = 10;
        
        // total pages
        $total_pages = ceil($orders['total']/$per_page);
        
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
            'title' => 'Orders',
            'orders' => $this->orders->get($this->uid(), $current_page, $per_page, 'AND `status` = "ready" '),
            'badges_paid' => $this->orders->paid_num($this->uid()),
            'badges_packaging' => $this->orders->packaging_num($this->uid()),
            'total_pages' =>$total_pages,
            'current_page' => ($this->uri->segment(3) == null)?1:$this->uri->segment(3),
            'page_name' => 'ready'
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-orders.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function delivered() {
        
        $this->load->model('model_orders', 'orders');
        
        // get total num of orders
        $orders = $this->orders->delivered_num($this->uid());

        // orders per page
        $per_page = 10;
        
        // total pages
        $total_pages = ceil($orders['total']/$per_page);
        
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
            'title' => 'Orders',
            'orders' => $this->orders->get($this->uid(), $current_page, $per_page, 'AND `status` = "delivered" '),
            'badges_paid' => $this->orders->paid_num($this->uid()),
            'badges_packaging' => $this->orders->packaging_num($this->uid()),
            'total_pages' =>$total_pages,
            'current_page' => ($this->uri->segment(3) == null)?1:$this->uri->segment(3),
            'page_name' => 'delivered'
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-orders.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function info() {
        $this->load->model('model_orders', 'orders');
        $this->load->model('model_products', 'products');
        
        $order_id = $this->uri->segment(3);
        if ($order_id != null) {
            
            // user info 
            // customer info 
            //  order status
            $order = $this->orders->get_by_id($order_id);
            // product list with vendor
            $products = $this->products->get_by_order_id($order_id);
            if ($order == null || $products == null)
                redirect($_SERVER['HTTP_REFERER']);
            
            $data = array(
                'path' => asset_url(),
                'title' => 'Order Info',
                'order' => $order,
                'products' => $products
            );
            $this->parser->parse('includes/back/header.inc.php', $data);
            $this->parser->parse('dashboard-orders-info.php', $data);
            $this->parser->parse('includes/back/footer.inc.php', $data);
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function delete() {
        $this->load->model('model_orders', 'orders');
        $this->load->model('model_subscriptions', 'subscriptions');
        $order_id = $this->uri->segment(3);
        if ($order_id != null) {
            $products = $this->orders->get_all($order_id);
            // point rollback to customer
            $total = 0;
            $customer_id;
            $user_id;
            
            foreach ($products as $product) {
                $customer_id = $product['customer_id'];
                $user_id = $product['user_id'];
                $total += $product['cost_points'];
            }
            
            // start add points back to customer
            $result = $this->subscriptions->update($user_id, $customer_id, $total);
            
            // delete the order
            if ($result != null) {
                // delete record
                $this->orders->delete($order_id);
            }
            
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    // ajax
    
    public function update_paid() {
        $this->load->model('model_orders', 'orders');
        $order_id = $this->input->post('order_id');
        if ($order_id != null) {
            $result = $this->orders->update_paid($order_id);
            if ($result != null) {
                die('success');
            }
        }
        die('failed');
    }
    
    public function update_pickup() {
        $this->load->model('model_orders', 'orders');
        
        $order_id = $this->input->post('order_id');
        if ($order_id != null) {
            $result = $this->orders->update_pickup($order_id);
            if ($result != null){
                die('success');
            }
        }
        die('failed');
    }
    
    public function update_delivery() {
        $this->load->model('model_orders', 'orders');
        
        $order_id = $this->input->post('order_id');
        $tracking_code = $this->input->post('tracking_code');
        $courier_service = $this->input->post('courier_service');
        if ($order_id != null && $tracking_code != null && $courier_service != null) {
            $result = $this->orders->update_delivery($order_id, $tracking_code, $courier_service);
            if ($result != null) {
                die('success');
            }
        }
        die('failed');
    }
    
    
    
}
