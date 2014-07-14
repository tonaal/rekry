<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auth
 *
 * @author HP
 */
class Auth extends CI_Controller {
    
    public function index()
	{
        // if user is authenticated ok, load main view
		$this->load->view('menu');
	}
    
    
}

?>
