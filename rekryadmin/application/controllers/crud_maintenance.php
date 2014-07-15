<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_maintenance extends CI_Controller {
 public function __construct ()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('crud_maintenance_model');
        $this->load->model('crud_greenwallid_dropdown_model');
    }
	public function index()
	{
		$this->load->view('maintenance/maintenance');
	}
           public function index2 ()
    {
        
            echo $this->crud_maintenance_model->getJson();
        
    }
         public function getGreenwallIdList ()
    {
        
            echo $this->crud_greenwallid_dropdown_model->getJson();
        
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */