<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wateringtimers extends CI_Controller {

    public $data = array();

    public function index() {
        if ($this->input->post('intervall')) {
            $this->data['intervall'] = $this->input->post('intervall');
        }
        $this->load->view('timers/wateringtimers', $this->data);
    }

    public function calculateTimer(int $interval, String $nonotime1, String $nonotime2, String $nonotime3) {
        
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */