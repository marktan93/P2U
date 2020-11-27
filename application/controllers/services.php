<?php
/**
 * Description of services
 *
 * @author Mtcy
 */
class services extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        if ($this->isLoggedIn() == null)
            redirect('home/login'); # redirect ltr maybe
        $this->merchantOnly('dashboard');
    }
    
    # need to be verified 
    public function index() {
        $this->verified();
        
        $this->load->model('model_services', 'services');
        // pricing table of services
        $services = $this->services->get();
        
        $this->load->model('model_service_lines', 'service_lines');
        $status = $this->service_lines->get_payment_status($this->uid());
        
        /// not done payment
        $order = $this->service_lines->get($this->uid());
        
        // get paid service info 
        $service = $this->service_lines->get_service($this->uid());
        
        if ($service != null) 
            $service = array_merge($this->services->get_by_id($service['service_id']), $service);
        
        if ($order != null) {
            redirect('services/order/'.$order['service_id']);
            die();
        }
        
        $data = array(
            'path' => asset_url(),
            'title' => 'Services',
            'services' => $services,
            'payment' => $status,
            'service' => $service
        );
        
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-services', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
        
    }
    
    public function payment_process() {
        $this->verified();
        $this->paypal_setup();
        session_start();
        
        $status = $this->uri->segment(3);
        if ($status == 'success') {
            $payerId = $_GET['PayerID'];
            
            $this->load->model('model_paypal', 'paypal');
            // get payment_id from database
            $paypal = $this->paypal->get($_SESSION['paypal_hash']);
            
            // get the paypal payment
            $payment = \PayPal\Api\Payment::get($paypal['payment_id'], $this->api);
            
            $execution = new PayPal\Api\PaymentExecution();
            $execution->setPayerId($payerId);
            
            // execute paypal payment (charge)
            $payment->execute($execution, $this->api);
            
            // update transaction
            $this->paypal->pay($paypal['payment_id']);
            
            // set the user as member
            $this->load->model('model_service_lines', 'service_lines');
            $this->service_lines->pay($paypal['service_line_id'], $_SESSION['service_duration']);
            
            // unset paypal hash
            unset($_SESSION['paypal_hash']);
            unset($_SESSION['service_duration']);
            
            redirect('card');
        } else {
            redirect('services/index/error');
        }
    }
    
    public function payment_info() {
        $this->verified();
        $service_id = $this->uri->segment(3);
        
        // if have the previous unpaid order, delete it
        $this->delete();
        
        $this->load->model('model_services', 'services');
        $service = $this->services->get_by_id($service_id);
        
        if ($service != null) {
            # insert to service line
            $this->load->model('model_service_lines', 'service_lines');
            $result = $this->service_lines->insert($this->uid(), $service_id);
            
            session_start();
            // used to track the expiry date
            $_SESSION['service_duration'] = $service['service_duration'];
            $this->paypal_setup();
            
            $payer           = new \PayPal\Api\Payer;
            $details         = new PayPal\Api\Details;
            $amount          = new PayPal\Api\Amount;
            $transaction     = new PayPal\Api\Transaction;
            $payment         = new \PayPal\Api\Payment;
            $redirectUrls    = new \PayPal\Api\RedirectUrls;

            // Payer
            $payer->setPaymentMethod('paypal');
            
            // Details
            $details->setShipping('0.00')
                    ->setTax('0.00')
                    ->setSubtotal($service['cost']);

            // Amount
            $amount->setCurrency('MYR')
                    ->setTotal($service['cost'])
                    ->setDetails($details);

            // Transaction 
            $transaction->setAmount($amount)
                    ->setDescription('To become a membershop at P2U');
            
            // Payment
            $payment->setIntent('sale')
                    ->setPayer($payer)
                    ->setTransactions(array($transaction));

            // Redirect URLs
            $redirectUrls->setReturnUrl(site_url('services/payment_process/success'))
                    ->setCancelUrl(site_url('services/payment_process/failed'));


            $payment->setRedirectUrls($redirectUrls);

            try {

                $payment->create($this->api);
                
                $this->load->model('model_service_lines', 'service_lines');
                $service_line = $this->service_lines->get($this->uid());

                $hash = md5($payment->getId());
                $_SESSION['paypal_hash'] = $hash;

                $this->load->model('model_paypal', 'paypal');
                $this->paypal->insert($service_line['id'], $payment->getId(), $hash);

            } catch (\PayPal\Exception\PPConnectionException $e) {
                redirect('dashboard/payment_process/failed');
            }

            foreach($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $redirectUrl = $link->getHref();
                }
            }

            redirect($redirectUrl);
        } else {
            redirect('services/index');
        }
    }
    
    public function paypal_setup() {
        $this->verified();
        $path = __DIR__ . '/../libraries/paypal/vendor/autoload.php';
        require $path;
        
        
        // API
        $this->api = new PayPal\Rest\ApiContext(
                new PayPal\Auth\OAuthTokenCredential(
                        'AQsyBBBieEgRa7bh5KRbM90NpIjV35rHEppWJFM6mdlNMmBh1s9MPx-JMPLx',
                        'ECNj7xAh1HF2wiJ2aahLiMUKRXe-SpaoO7FjYd_gxPHQZ80gbIFPn_WVfFee'
                )
        );
        
        $this->api->setConfig(array(
            'mode' => 'sandbox',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled'         => false,
            'log.FileName'           => '',
            'log.LogLevel'           => 'FINE',
            'validation.level'       => 'log'
        ));
        
    }
    
    public function order() {
        $this->verified();
        
        $service_id = $this->uri->segment(3);
        $this->load->model('model_services', 'services');
        $service = $this->services->get_by_id($service_id);
        if ($service == null)
            redirect('services/index');
        
        $data = array(
            'path' => asset_url(),
            'title' => 'Order',
            'service' => $service
        );
        
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-order', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function cancel() {
        $this->verified();
        
        $result = $this->delete();
        
        redirect('services/index');
    }
    
    
    private function delete() {
        $this->load->model('model_service_lines', 'service_lines');
        $this->load->model('model_paypal', 'paypal');
        
        
        /// not done payment
        $order = $this->service_lines->get($this->uid());
        // make sure paypal and service line not empty
        if ($order != null) {
            // delete both paypal and service line records
            if ($this->paypal->delete($order['id']) &&
                $this->service_lines->delete($order['id'])) {
                return true;
            }
        
        }
        return false;
    }
    
    // freeze the service (deactivate)
    public function freeze() {
        $this->verified();
        $this->load->model('model_service_lines', 'service_lines');
        
        $service_line_id = $this->uri->segment(3);
        $this->service_lines->freeze($service_line_id);
        
        redirect('services/index');
    }
    
    
}
