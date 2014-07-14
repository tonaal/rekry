<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class crud_greenwall_model extends CI_Model {
     
    public function __construct ()
    {
        parent::__construct();
        $this->load->database();
    }
     
    public function create()
    {
        return $this->db->insert('g',array(
            'type'=>$this->input->post('type',true),
            'Products' => $this -> input-> post ( 'item' , true),
            'harga'=>$this->input->post('harga',true)
        ));
    }
     
    public function update($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('mobil',array(
            'type'=>$this->input->post('type',true),
            'Products' => $this -> input-> post ( 'item' , true),
            'harga'=>$this->input->post('harga',true)
        ));
    }
     
    public function delete($id)
    {
        return $this->db->delete('mobil', array('id' => $id));
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
                'groupid'=>$data['groupid'],
                'address' => $data[ 'address' ],
                'roominfo' => $data[ 'roominfo' ],
                'timezone' => $data[ 'timezone' ],
                'installationdate' => $data[ 'installationdate' ],
                'wateringtimer1' => $data[ 'wateringtimer1' ],
                'wateringtimer2' => $data[ 'wateringtimer2' ],
                'wateringtimer3' => $data[ 'wateringtimer3' ],
                'lighttimer1' => $data[ 'lighttimer1' ],
                'lighttimer2' => $data[ 'lighttimer2' ],
                'ventilationtimer1' => $data[ 'ventilationtimer1' ],
                'ventilationtimer2' => $data[ 'ventilationtimer2' ],
                'ventilationtimer3' => $data[ 'ventilationtimer3' ],
                   'other' => $data[ 'other' ]
                
                
                
                
                
            );
        }
        $result=array_merge($result,array('rows'=>$row));
       
        return json_encode($result);
    }
}
 
/* End of file crud_model.php */
/* Location: ./application/controllers/crud_model.php */