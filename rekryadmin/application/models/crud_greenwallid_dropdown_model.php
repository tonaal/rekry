<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class crud_greenwallid_dropdown_model extends CI_Model {
     
    public function __construct ()
    {
        parent::__construct();
        $this->load->database();
    }
     
    
     
    public function getJSON ()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
        $order = isset ( $_POST [ 'order' ])? strval ( $_POST [ 'order' ]): 'asc' ;
        $offset = ($page-1) * $rows;
        
        $result = array();
        $result['total'] = $this->db->get('greenwall')->num_rows();
        $row = array();
        
        $this->db->limit($rows,$offset);
        $this->db->order_by($sort,$order);
        $criteria = $this->db->get('greenwall');
        
        foreach($criteria->result_array() as $data)
        {  
            $row[] = array(
                "id" => $data[ "id" ],
                "wallId" => $data[ "wallId" ],
               
                
                
                
                
                
            );
        }
        $result=array_merge($result,array('rows'=>$row));
       
        return json_encode($row);
    }
}
 
/* End of file crud_model.php */
/* Location: ./application/controllers/crud_model.php */