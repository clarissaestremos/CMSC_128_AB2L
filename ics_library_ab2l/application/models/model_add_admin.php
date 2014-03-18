<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_add_admin extends CI_Model {

 public function __construct(){
    $this->load->database();
 }

public function add_admin()
  {
    $parent_key = $this->input->post('parent_key');
    $data['query'] = $this->model_add_admin->get_adminkey($parent_key);

    $fname=$this->input->post('fname');
    $fname=ucfirst($fname);

    $lname=$this->input->post('lname');
    $lname=ucfirst($lname);
    
    $data=array(
    'admin_key'=>sha1($this->input->post('adminkey')),
    'first_name'=>$fname,
    'middle_name'=>$this->input->post('minit'),
    'last_name'=>$lname,

    'email'=>$this->input->post('eadd'),
    'username'=>$this->input->post('uname'),

    'password'=>sha1($this->input->post('pass')), 
    'parent_key' => $data['query']['admin_key']
    );

    $this->db->insert('admin_account',$data);
  }
  
  function get_adminkey($username){
    $query = $this->db->get_where('admin_account', array('username' => $username));
    return $query->row_array();
  }
  
  public function change_password($username, $password){
  $data=array(
    'password'=>$password 
    );
  $query = $this->db->where('username', $username);
  $this->db->update('admin_account', $data);
  }
  
  public function check_password($username){
  $query = $this->db->get_where('admin_account', array('username' => $username));
    return $query->row_array();
  }
}
?>