<?php

/**
 * Description of salt
 *
 * @author Mtcy
 */
class salt {
    
    private $salt;
    
    public function generate() {
        $this->salt = sha1(uniqid());
    }
    
    public function encrypt($str) {
        return sha1($this->salt.$str.$this->salt);
    }
    
    public function getSalt() {
        return $this->salt;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    
}



