<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class controller_editprofile extends CI_Controller {
 

    public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->model('model_viewuser');
             $this->load->model('user_model');
              $this->load->model('model_check_session');
               $this->load->helper('form');
        }

    function index() {
        $this->load->helper(array('form','html'));


        if($this->session->userdata('logged_in')){
               

       if($this->model_check_session->check_session() == TRUE){

               $data['username']= $this->session->userdata('logged_in')['username'];
                $data['start']= "true";
                //get the details of the user
               $user_details = $this->model_viewuser->get_info($data['username']);
             //  var_dump($user_details[0]['classification']);

               foreach ($user_details as $user) {
                  $data['user_details']=$user;
                  break;
               }

            $data['name']= $data['user_details']->first_name." ".$data['user_details']->middle_initial.". ". $data['user_details']->last_name;
              $data['titlepage']= $data['name'];
        }
       

      
        $this->load->view("user/view_header",$data);
        if($this->session->userdata('logged_in')){
                $this->load->view("user/view_profile",$data);
        }
        else
             redirect('index.php/user/controller_login', 'refresh');
  
        $this->load->view("user/view_footer");
    }

    else
             redirect('index.php/user/controller_login', 'refresh');

}

    public function viewInfo($number){
            //$data['title']= 'Home';
           
            $value['info'] = $this->model_viewuser->getInfo($number);
            $this->load->view('user/viewAccount',$value);
        }



/**
Editing pictures / uploading them
*/


/*PROFILE PICTUREEEEEEEEEEEES src: http://jamshidhashimi.com/2011/06/14/image-upload-with-codeigniter-2/*/
  function uploadImage()
    {
     $this->load->model('user_model');
     $username= $this->session->userdata('logged_in')['username'];
      //  echo "Uploading";
       $config['upload_path']   =   "imgs/";
       $config['allowed_types'] =   "gif|jpg|jpeg|png"; 
       $config['max_size']      =   "6000";
       $config['max_width']     =   "4000";
       $config['max_height']    =   "4000";

       $this->load->library('upload',$config);
       $this->upload->overwrite = true;

       if(!$this->upload->do_upload())
       {
           $error = $this->upload->display_errors();
           $base = base_url();

           echo "<div id='mysuccess' title='Delete Book Success'>
            <h5>We found some error while upload your file:</h5>
            <p style='color:red;'>$error</p>
            </div>
            <script src='$base/js/jquery-1.10.2.min.js'></script>
            <script src='$base/js/jquery-ui.js'></script>
            <link rel='stylesheet' href='$base/style/jquery-ui.css'/>
            <script>
                $('#mysuccess').dialog({
                        modal: true,
                        closeOnEscape: true,
                        closeText: 'show',
                        show: {
                          effect: 'fadeIn',
                          duration: 200
                        },
                        draggable: false,
                        close: function(event, ui){
                            window.location.replace('$base/index.php/user/controller_editprofile');
                        },
                        buttons : {
                          'Ok': function() {
                              window.location.replace('$base/index.php/user/controller_editprofile');
                          },
                        }
             
                    });
            </script>";
       }
       else
       {
       $data = array('upload_data' => $this->upload->data()); 
           $file = $data['upload_data']['file_name'];
           //$ext = $data['upload_data']['file_ext'];
        $file_name = $this->user_model->getAccntNum($username);//['account_number'].'.'.'jpg';
        $file_name = $file_name[0]->account_number.'.'.'jpg'; 
    //echo $file;
    //echo $file_name[0]->account_number;
          rename(  $config['upload_path'] . $file,   $config['upload_path'] .  $file_name);        
           /* You can view content of the $finfo with the code block below
           echo '<pre>';
           print_r($finfo);
           echo '</pre>';*/

           if($this->session->userdata('logged_in_type')=="user"){
          if($this->session->userdata('id')){
            redirect('index.php/user/controller_reserve_book');
          }
          else{
              $this->session->set_flashdata('success_username', 'Successfully Uploaded your picture.');
              redirect('index.php/user/controller_editprofile', 'refresh');         
              }
          }
          else redirect('index.php/admin/controller_admin_home', 'refresh'); // */
         }
       //Go to private area
       
}


      /**
        functions for editing username
    */
    public function check_username( $username){
            $this->db->where('username',$username);
            $query = $this->db->get('user_account')->num_rows();
            if($query == 0 ){
                    $this->db->where('username',$username);
                    $query = $this->db->get('admin_account')->num_rows();
                     if($query == 0 )
                       echo 'userOk';
                     else echo 'userNo';
              }
            else echo 'userNo';
            
    }

    public function edit_username(){
        $this->load->library('form_validation');
        $old_username= $this->session->userdata('logged_in')['username'];
        $this->form_validation->set_rules('new_username', 'Username', 'trim|required|min_length[3]|callback_usernameRegex|xss_clean');
        $this->form_validation->set_rules('pword_for_username', 'Password', 'trim|required|min_length[5]|max_length[32]|alpha_numeric|callback_check_database');
       
        //check if the password is right
        if($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('<div class="isa_error">', '</div>');
            $var = validation_errors();
            $this->session->set_flashdata('error_username1', $var);
             $this->session->set_flashdata('error_username','error');
            redirect('index.php/user/controller_editprofile', 'refresh');

            
            } 
        else {
                //Go to private area
            //update username

            $username= $this->session->userdata('logged_in')['username'];
            $new_username = $this->input->post('new_username');
            $update_result=$this->user_model->update_username($username, $new_username); 
            if($update_result){
                $old_session =  $this->session->userdata('logged_in');
                unset($old_session['username']);
                $new_array = array('username'=> $new_username);
                $old_session=array_merge($old_session, $new_array);
                $this->session->set_userdata('logged_in', $old_session);
               
            }
            else{
                $this->form_validation->set_message('check_database', 'Username already taken.');
                
            }


           if($this->session->userdata('logged_in_type')=="user"){
            if($this->session->userdata('id')){
              redirect('index.php/user/controller_reserve_book');
            }
            else{ 
                $this->session->set_flashdata('success_username', 'Successfully edited your username.');
                redirect('index.php/user/controller_editprofile', 'refresh');
                
                }
            }
           else redirect('index.php/admin/controller_admin_home', 'refresh');
        }   

    }

    public function check_database($password){
        $this->load->model("user_model");
        $username= $this->session->userdata('logged_in')['username'];
        $new_username = $this->input->post('new_username');
        $result= $this->check_password($username,$password);
        if($result== true){
           return true;
            
        }
        else{

            $this->form_validation->set_message('check_database', 'Wrong password.');
            return false;
        }

    }

    public function check_password($username, $password){
        $this->db->select('username, password');
        $this->db->from('user_account');
        $this->db->where('username', $username);
        $this->db->where('password', sha1($password));
        $this->db->limit(1);
         
        //get query and processing
        $query = $this->db->get();
        if($query->num_rows() == 1) { 
            return true; //if data is true
        } else {
            return false; //if data is wrong
        }
    }

    public function username_Regex($username){
        if (preg_match('/^[A-Za-z][A-Za-z0-9._]{2,20}$/', $username) ) {
            return TRUE;
          } else {
            return FALSE;
            $this->form_validation->set_message('username_Regex', 'Invalid input.');
          }
    }


    /**
    functions for editing email
    */


    public function edit_email(){
        $this->load->library('form_validation');
        $old_username= $this->session->userdata('logged_in')['username'];
        $this->form_validation->set_rules('new_email', 'email', 'trim|required|min_length[5]|max_length[30]|callback_emailRegex|xss_clean');
        $this->form_validation->set_rules('pword_for_email', 'password', 'trim|required|min_length[5]|max_length[32]|alpha_numeric|callback_check_database1');
       
        //check if the password is right
        if($this->form_validation->run() == FALSE) {
           $this->form_validation->set_error_delimiters('<div class="isa_error">', '</div>');
            $var = validation_errors();
            $this->session->set_flashdata('error_email1', $var);
             $this->session->set_flashdata('error_email','error');
            redirect('index.php/user/controller_editprofile', 'refresh');

            
            } 
        else {
              
            //update email

            $username= $this->session->userdata('logged_in')['username'];
            $new_email = $this->input->post('new_email');
            $update_email=$this->user_model->update_email($new_email, $username); 
          

           if($this->session->userdata('logged_in_type')=="user"){
            if($this->session->userdata('id')){
              redirect('index.php/user/controller_reserve_book');
            }
            else{ 
                $this->session->set_flashdata('success_username', 'Successfully edited your email.');
                redirect('index.php/user/controller_editprofile', 'refresh');
                
                }
            }
           else redirect('index.php/admin/controller_admin_home', 'refresh');
        }   

    }

    public function check_database1($password){
        $this->load->model("user_model");
        $username= $this->session->userdata('logged_in')['username'];
        
        $result= $this->check_password($username,$password);
        if($result== true){
           return true;
            
        }
        else{

            $this->form_validation->set_message('check_database1', 'Wrong password.');
            return false;
        }

    }

    public function email_Regex($email){
        if (preg_match('/^(\w|\.){6,30}\@([0,9]|[a-z]|[A-Z]){3,}(\\.[A-Za-z]{2,})$/', $email) ) {
            return TRUE;
          } else {
            return FALSE;
            $this->form_validation->set_message('email_Regex', 'Invalid email.');
          }
    }


    /**
    Edit password
    */

    public function edit_password(){
        $this->load->library('form_validation');
        $username= $this->session->userdata('logged_in')['username'];
        $this->form_validation->set_rules('current_password', 'password', 'trim|required|min_length[5]|max_length[32]|alpha_numeric|callback_check_database1');
        $this->form_validation->set_rules('new_password', 'password', 'trim|required|min_length[5]|max_length[32]|alpha_numeric|callback_check_new');
        $this->form_validation->set_rules('confirm_password', 'password', 'trim|required|min_length[5]|max_length[32]|alpha_numeric|callback_check_match');
       
        if($this->form_validation->run() == FALSE) {
           
            $this->form_validation->set_error_delimiters('<div class="isa_error">', '</div>');
            $var = validation_errors();
            $this->session->set_flashdata('error_password1', $var);
             $this->session->set_flashdata('error_password','error');
              redirect('index.php/user/controller_editprofile', 'refresh');
            
            } 
        else {
              
            //update email

            $username= $this->session->userdata('logged_in')['username'];
            $new_password = $this->input->post('new_password');
            $update_password=$this->user_model->update_password($new_password, $username); 
          

           if($this->session->userdata('logged_in_type')=="user"){
           
                $this->session->set_flashdata('success_username', 'Successfully updated password.');
                redirect('index.php/user/controller_editprofile', 'refresh');
                
                
            }
           else redirect('index.php/admin/controller_admin_home', 'refresh');
        }   

    }

    public function check_new($new_password){
         $username= $this->session->userdata('logged_in')['username'];

         //check if the new password is the same with the previous password

         $check_password=$this->user_model->check_password( $username,$new_password); 

         if($check_password){
            $this->form_validation->set_message('check_new', 'Enter new password.');
            return false;
         }
         else{
            return true;
         }
    }

    public function check_match($confirm_password){
        $new= $this->input->post('new_password');

        if($new == $confirm_password){
            return true;
        }
        else{
            $this->form_validation->set_message('check_match', 'Password mismatch.');
            return false;
        }
    }

}
/* End of file controller_editprofile.php */
/* Location: ./application/controllers/user/controller_editprofile.php */