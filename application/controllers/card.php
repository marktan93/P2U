<?php
/**
 * Description of card
 *
 * @author Mtcy
 */
class card extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        if ($this->isLoggedIn() == null)
            redirect('home/login'); # redirect ltr maybe
        
        $this->verified();
        $this->isMember();
    }
    
    public function index() {
        $this->load->model('model_card', 'card');
        $this->load->model('model_rules', 'rules');
        
        $uid = $this->uid();
        
        $card = $this->card->get($uid);
        
        $rules = $this->rules->get($this->uid());

        $data = array(
            'path' => asset_url(),
            'title' => 'Card',
            //'loggedIn' => $this->isLoggedIn(),
            'card' => $card,
            'rules' => $rules
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-card.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function edit() {
        $data = array(
            'path' => asset_url(),
            'title' => 'Card'
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-card-edit.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function rules() {
        $this->load->model('model_rules', 'rules');
        $this->load->model('model_user', 'user');
        $data = array(
            'path' => asset_url(),
            'title' => 'Card',
            'rule' => $this->rules->get($this->uid()),
            'user' => $this->user->get_userinfo_by_uid($this->uid())
        );
        $this->parser->parse('includes/back/header.inc.php', $data);
        $this->parser->parse('dashboard-card-rules.php', $data);
        $this->parser->parse('includes/back/footer.inc.php', $data);
    }
    
    public function upload() {
        error_reporting(E_ALL | E_STRICT);
        $this->load->library('uploadhandler');
        $upload_handler = new UploadHandler();
    }
    
    // used by ajax, update card info
    public function save() {
        $image = $this->input->post('image');
        $name = $this->input->post('name');
        $this->load->model('model_card', 'card');
        
        if (!empty($image) && !empty($name)) {
            // check card exist
            // if does, delete previous card
            $card = $this->card->get($this->uid());
            $path = FCPATH.'assets/upload/card/'.$card['card_img'];
            if (file_exists($path))
                unlink($path);
            
            // decode base64 encode and create the image file
            $data = explode(',', $image);
            $decoded = base64_decode($data[1]);
            $filename = uniqid().'.png';
            $url = FCPATH.'assets/upload/card/'.$filename;

            $handler = fopen($url, "w+");
            fwrite($handler, $decoded);
            fclose($handler);
            
            // update card name and image
            
            $result = $this->card->set($this->uid(), $name, $filename);
            
            die($result);
        }
        
        die('null');
        
    }
    
    // ajax update initial points
    public function initial_points() {
        $this->load->model('model_card', 'card');
        $points = $this->input->post('points');
        if (!empty($points)) {
            $result = $this->card->update_initial_points($this->uid(), $points);
            die($result);
        }
        die('null');
    }
    
    // ajax add rule
    public function add_rule() {
        $this->load->model('model_rules', 'rules');
        
        $amount = $this->input->post('amount');
        $points_awarded = $this->input->post('points_awarded');
        
        if (!empty($amount) && !empty($points_awarded)) {
            $result = $this->rules->set($this->uid(), $amount, $points_awarded);
            die($result);
        }
        die('null');
    }
    
    public function delete() {
        $this->load->model('model_rules', 'rules');
        
        $ruleid = $this->input->post('ruleid');
        if (!empty($ruleid)) {
            $result = $this->rules->delete($ruleid);
            die($result);
        }
        die('null');
    }
    

    
}
