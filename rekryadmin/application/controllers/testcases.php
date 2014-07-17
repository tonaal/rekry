<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testcases extends CI_Controller {

    public $data = array();

    public function index() {

        $this->load->view('testcases/shrinker', $this->data);
    }

// reduces image size on the fly
    public function shrinker() {

        $this->load->view('testcases/shrinker', $this->data);
    }

//testpage to show upped smaller image
    public function show() {

        $this->load->view('testcases/show', $this->data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */