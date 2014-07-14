<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_greenwalls extends CI_Controller {
 public function __construct ()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('crud_greenwall_model');
    }
	public function index()
	{
		$this->load->view('greenwalls/greenwalls');
	}
           public function index2 ()
    {
        
            echo $this->crud_greenwall_model->getJson();
        
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */