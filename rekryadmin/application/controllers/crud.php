<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class crud extends CI_Controller {
     
    public function __construct ()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('crud_model');
    }
 
    public function index ()
    {
        if(isset($_GET['grid']))
            echo $this->crud_model->getJson();
        else
            $this->load->view('crud');
//            echo $this->crud_model->getJson();
    }
      public function index2 ()
    {
        
            echo $this->crud_model->getJson();
        
    }
     
    public function create()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->crud_model->create())
            echo json_encode(array('success'=>true));
        else
            echo json_encode ( array ( 'msg' => 'Failed to insert data' ));
    }
     
    public function update($id=null)
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->crud_model->update($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode ( array ( 'msg' => 'Failed to change the data' ));
    }
     
    public function delete()
    {
        if(!isset($_POST))  
            show_404();
        
        $id = intval(addslashes($_POST['id']));
        if($this->crud_model->delete($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode ( array ( 'msg' => 'Failed to delete data' ));
    }
}
 
/* End of file crud.php */
/* Location: ./application/controllers/crud.php */