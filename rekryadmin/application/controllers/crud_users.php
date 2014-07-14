<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Crud_users extends CI_Controller {
     
    public function __construct ()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('crud_users_model');
    }
 
    public function index ()
    {
        
            $this->load->view('users/users');
//            echo $this->crud_model->getJson();
    }
      public function index2 ()
    {
        
            echo $this->crud_users_model->getJson();
        
    }
}