<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Timers extends CI_Controller {

    public $data = array();

    public function index(){
         $this->load->view('timers/main');
    }
    public function watering() {
        if ($this->input->post('intervall')) {
            $this->data['intervall'] = $this->input->post('intervall');
        }
        $this->load->view('timers/wateringtimers', $this->data);
    }
    public function lighting() {
        $this->data = null;
       
        
        $this->data = array(
            
            'lightson' => $this->input->post('lightson'),
            'lightsoff' => $this->input->post('lightsoff'),
            'su_block_start'=> $this->input->post('su_block_start'),
            'ma_block_start'=> $this->input->post('ma_block_start'),
            'ti_block_start'=> $this->input->post('ti_block_start'),
            'ke_block_start'=> $this->input->post('ke_block_start'),
            'to_block_start'=> $this->input->post('to_block_start'),
            'pe_block_start'=> $this->input->post('pe_block_start'),
            'la_block_start'=> $this->input->post('la_block_start'),
            'su_block_stop'=> $this->input->post('su_block_stop'),
            'ma_block_stop'=> $this->input->post('ma_block_stop'),
            'ti_block_stop'=> $this->input->post('ti_block_stop'),
            'ke_block_stop'=> $this->input->post('ke_block_stop'),
            'to_block_stop'=> $this->input->post('to_block_stop'),
            'pe_block_stop'=> $this->input->post('pe_block_stop'),
            'la_block_stop'=> $this->input->post('la_block_stop')
        );
        
        
        
        //remember change this one to own page (lighting)
        $this->load->view('timers/wateringtimers', $this->data);
    }

    public function calculateTimer(int $interval, String $nonotime1, String $nonotime2, String $nonotime3) {
        
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */