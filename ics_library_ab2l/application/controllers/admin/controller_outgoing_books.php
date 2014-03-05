<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once("controller_log.php");
class Controller_outgoing_books extends Controller_log{
 
    function index() {
        $this->load->model('model_reservation');
        $data['parent'] = "Books";
        $data['current'] = "Outgoing Books";
        $data['query'] = $this->model_reservation->show_all_user_book_reservation("reserved");   
        
            $this->load->view("admin/view_header",$data);
            $this->load->view("admin/view_aside");
            $this->load->view('admin/view_outgoing_books', $data);
            $this->load->view("admin/view_footer");
    }

    /*The function send_email is to send the email to the borrower with overdue materials*/
    public function send_email(){
        if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
        if(isset($_POST['notify_all'])){
			include("./application/controllers/admin/controller_retrieve_email.php");
            $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465, //25
            'smtp_user' => $email,
            'smtp_pass' => $password,
            'mailtype'  => 'html', 
            'charset'   => 'utf-8',
            'wordwrap'  => true,
            'newline'   => "\r\n",
            'crlf'      => "\n"
            );//config for the email
            //$account_number=$_POST['account_number'];
            //$to=$_POST['email'];
            $subject='Re: ICS e-Lib Overdue Materials';
            $from_email = $email;
            $from_name='ICS e-Lib';
            
            $this->load->model('model_reservation');
            //Get user account in database
            $data['result'] = $this->model_reservation->get_overdue_accounts();
            foreach($data['result'] as $recipients){
                $to = $recipients->email;
                $account_number = $recipients->account_number;
                $data['query'] = $this->model_reservation->get_overdue_user_info($to);
                foreach($data['query'] as $row){
                    $first_name = $row->first_name;
                    $middle_initial = $row->middle_initial;
                    $last_name = $row->last_name;
                }
                
                //This will construct the body of the message to be sent to the borrower with overdue materials.
                $message = "Dear {$first_name} {$middle_initial}. {$last_name},<br /><br />Please settle your library accountabilities as soon as possible.<br />Overdue Materials<br />";
                foreach($data['query'] as $row){
                    $message .= "Title: {$row->title}<br />";
                    $data['query1'] = $this->model_reservation->get_book_authors($row->id);
                    $authors ="";
                    foreach($data['query1'] as $authors_list){
                        $authors .= "{$authors_list->author}; ";
                    }
                    $message .= "Author(s): {$authors}<br />";
                    $message .= "Date Borrowed: {$row->date_borrowed}<br />";
                    $message .= "Due Date: {$row->due_date}<br /><br />";
                }
                $message .= "If you've already settled your accountabilities, please ignore this message.<br />";
                $message .= "For inquiries, please contact the ICS Library librarian.<br /><br />";
                $message .= "Thank you!<br />ICS Library Administrator<hr />";
				$message .= "The ICS e-Lib will never ask or provide confidential account details such as your password. In case you've received messages from us asking for your password, please report them immediately to our administrators. Thank you!<br />Mag-aral ng mabuti!";

                //Composing the email
                $this->load->library('email', $config);
				$this->email->initialize($config);
                $this->email->set_newline("\r\n");
                $this->email->from($from_email, $from_name);
                $this->email->to($to); 
                $this->email->subject($subject);
                $this->email->message($message);
                //Send the email
                if($this->email->send()){
                    $this->model_reservation->update_user_date_notif($account_number);
                }	
            }
            unset($_POST['notify_all']);
            $date = date("Y-m-d");
			$session_user = $this->session->userdata('logged_in')['username'];
            $this->add_log("Admin $session_user sent notification email to all borrowers with overdue materials for $date", "Notify Users");
			redirect('index.php/admin/controller_reservation','refresh');
        }//END OF notify_all
    }
    
    public function extend(){
        $res_number=$_POST['res_number'];
        $this->load->model('model_reservation');
        $this->model_reservation->update_book_reservation($res_number, "extend");
        redirect('index.php/admin/controller_reservation','refresh');
    }//END OF extend()
    
    public function return_book(){
        $res_number=$_POST['res_number'];
        $this->load->model('model_reservation');
        $this->model_reservation->update_book_reservation($res_number, "returned");
        redirect('index.php/admin/controller_reservation','refresh');
    }//END OF return_book()
    
    public function reserve(){
        $res_number=$_POST['res_number'];
        $this->load->model('model_reservation');
        $this->model_reservation->update_book_reservation($res_number, "reserved");
		redirect('index.php/admin/controller_reservation','refresh');
    }//END OF reserve()
    
    public function cancel(){
        $res_number=$_POST['res_number'];
        $this->load->model('model_reservation');
        $this->model_reservation->delete_book_reservation($res_number);
        redirect('index.php/admin/controller_outgoing_books','refresh');
    }//END OF cancel()
    

}
/* End of file controller_outgoing_books.php*/
/* Location: ./application/controllers/admin/controller_outgoing_books.php */