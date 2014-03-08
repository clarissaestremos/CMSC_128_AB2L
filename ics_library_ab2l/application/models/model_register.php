<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
Model for Registration
Author: Aristotle Martinez
Function: Inserts the values from view_registration
*/

class Model_register extends CI_Model {

 public function add_user()
 {

$holder = $this->input->post('classi');
 
 if($holder === 'student'){
    $data=array(
    'first_name'=>ucfirst($this->input->post('fname')),
    'middle_initial'=>ucfirst($this->input->post('minit')),
    'last_name'=>ucfirst($this->input->post('lname')),
    
    'account_number'=>$this->input->post('stdNum'),
    
    'classification'=>$this->input->post('classi'),
    'college'=>$this->input->post('college'),
    'course'=>$this->input->post('course'),

    'email'=>$this->input->post('eadd'),
    'username'=>$this->input->post('uname'),
    'status'=>'pending',
    'password'=>sha1($this->input->post('pass'))
  
  );
$this->db->insert('user_account',$data);
    
 }
 else{
   $data=array(
    'first_name'=>strtoupper($this->input->post('fname')),
    'middle_initial'=>strtoupper($this->input->post('minit')),
    'last_name'=>strtoupper($this->input->post('lname')),
    
    'account_number'=>$this->input->post('stdNum'),
    
    'classification'=>$this->input->post('classi'),
    'college'=>$this->input->post('college'),
    
    'email'=>$this->input->post('eadd'),
    'username'=>$this->input->post('uname'),
    'status'=>'pending',
    'password'=>sha1($this->input->post('pass'))
  
  );


  $this->db->insert('user_account',$data);
  echo "ADDED FACULTY!";

 }

 }

}
?>