<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
Controller for the "Contact Us" page of the library
*/
class Controller_contact extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('user_model','',TRUE);
        $this->load->helper('url');
        $this->load->library(array('form_validation','session'));
        $this->load->helper('email');
        $this->load->helper('form'); 
    }

 
    function index() {
        $this->load->helper('email');
        $this->load->helper('form'); 
        $this->load->helper(array('form','html'));
       
        $data['titlepage']= "Contact Us";
        $this->load->view("user/view_header", $data);   //displays the header for the page
        $this->load->view("user/view_contact");         //displays the contact details of the library
        $this->load->view("user/view_footer");          //displays the page footer

    }
    
    function emailsender(){
        $base = base_url();
        echo "
                     <div id='mysuccess' title='Email Sending Failed'>
                         <h6>Unable to send email.</h6>
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
                                   window.location.replace('$base/index.php/user/controller_contact');
                                 },
                                 buttons : {
                                      'Ok': function() {
                                       window.location.replace('$base/index.php/user/controller_contact');
                                   },
                                 }
                     
                             });
                        </script>";

        // $this->load->library('form_validation');
        // $this->form_validation->set_rules('sender_name', 'trim|xss_clean|required');                   //form validation
        // $this->form_validation->set_rules('sender_email', 'trim|required|valid_email|xss_clean');
        // $this->form_validation->set_rules('contactnum', 'min_length[10]|max_length[10]|numeric|required|xss_clean');
        // $this->form_validation->set_rules('subject', 'required|xss_clean');
        // $this->form_validation->set_rules('message', 'required|xss_clean');
        // if ($this->form_validation->run() == FALSE)
        // {

        //     $this->load->view('user/view_contact');
        // }

        // else {
        // include("./application/controllers/admin/controller_retrieve_email.php");
        //     //echo "<script>alert('karacute');</script>";
        //     $config = Array(
        //        'protocol' => 'smtp',
        //        'smtp_host' => 'ssl://smtp.googlemail.com',
        //        'smtp_port' => 465,
        //        'smtp_user' => $email,
        //        'smtp_pass' => "$password",
        //        'mailtype'  => 'text', 
        //         'charset'   => 'iso-8859-1'
        //     ); 
        //     $this->load->library('email',$config);
        //     $this->email->initialize($config);
        //     $this->email->set_newline("\r\n");
        //     $this->load->library('form_validation'); 
        
        //     $this->email->from($this->input->post('sender_email'), $this->input->post('sender_name'));      // set email data
        //     $this->email->to($email);
        //     $this->email->reply_to($this->input->post('sender_email'), $this->input->post('sender_name'));
        //     $this->email->subject($this->input->post('subject'));
        //     $this->email->message($this->input->post('message')."\n\nContact Number: ".$this->input->post('contactnum'));
            
    //         if(! $this->email->send()){
    //            echo "
    //                 <div id='mysuccess' title='Email Sending Failed'>
    //                     <h6>Sending email failed.</h6>
    //                 </div>
    //                 <script src='$base/js/jquery-1.10.2.min.js'></script>
    //                 <script src='$base/js/jquery-ui.js'></script>
    //                 <link rel='stylesheet' href='$base/style/jquery-ui.css'/>
    //                 <script>
    //                         $('#mysuccess').dialog({
    //                             modal: true,
    //                             closeOnEscape: true,
    //                             closeText: 'show',
    //                             show: {
    //                               effect: 'fadeIn',
    //                               duration: 200
    //                             },
    //                             draggable: false,
    //                             close: function(event, ui){
    //                                 window.location.replace('$base/index.php/user/controller_contact');
    //                             },
    //                             buttons : {
    //                               'Ok': function() {
    //                                   window.location.replace('$base/index.php/user/controller_contact');
    //                               },
    //                             }
                     
    //                         });
    //                     </script>";
    //             redirect('index.php/user/controller_contact', 'refresh');
    //         }
    //         else{
    //              echo "
    //                 <div id='mysuccess_true' title='Email Sent'>
    //                     <h6>Succesfully sent</h6>
    //                 </div>
    //                 <script src='$base/js/jquery-1.10.2.min.js'></script>
    //                 <script src='$base/js/jquery-ui.js'></script>
    //                 <link rel='stylesheet' href='$base/style/jquery-ui.css'/>
    //                 <script>
    //                         $('#mysuccess_true').dialog({
    //                             modal: true,
    //                             closeOnEscape: true,
    //                             closeText: 'show',
    //                             show: {
    //                               effect: 'fadeIn',
    //                               duration: 200
    //                             },
    //                             draggable: false,
    //                             close: function(event, ui){
    //                                 window.location.replace('$base/index.php/user/controller_contact');
    //                             },
    //                             buttons : {
    //                               'Ok': function() {
    //                                   window.location.replace('$base/index.php/user/controller_contact');
    //                               },
    //                             }
                     
    //                         });
    //                     </script>";
    //             redirect('index.php/user/controller_contact', 'refresh');
    //         } 
    } 
}
/* End of file home_controller.php */
/* Location: ./application/controllers/user/controller_home.php */
