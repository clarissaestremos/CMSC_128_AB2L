
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_admin_home extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin_model','',TRUE);
        $this->load->helper('url');
        $this->load->library(array('form_validation','session'));
        $this->load->model('model_check_session');
        $this->load->model("model_reservation");
        $this->load->model('model_users');
        $this->load->library("Jquery_pagination");
    }

 
    function index() {
        $this->load->helper(array('form','html'));
        if($this->model_check_session->check_admin_session() == TRUE){
            $data['parent'] = "Admin";
            $data['current'] = "Home";
            $data['reserved'] = $this->model_reservation->show_all_user_book_reservation("reserved",0,0);
            $data['overdue'] = $this->model_reservation->show_all_user_book_reservation('overdue',0,0);
            $this->load->model("model_stat");
            $data['stat'] = $this->model_stat->get_stat();
            //$this->load->model('model_users');
            $data['users']=$this->model_users->getPendingUsers();
            
            $this->load->view("admin/view_header",$data);
            $this->load->view("admin/view_aside");
            $this->load->view('admin/view_admin_home', $data);
            $this->load->view("admin/view_footer");
        }
    }
    function get_book_data(){
       $row_number=$this->model_reservation->countRows("overdue");
        //echo "<h1>$row_number<h1>";
        $config['base_url'] = base_url().'index.php/admin/controller_admin_home/get_book_data';     //EDIT THIS BASE_URL IF YOU ARE USING A DIFFERENT URL. 
        $config['total_rows'] = $row_number;
        $config['per_page'] = 5;
        $config['div'] = '#displayBook';
        $page=$this->uri->segment(4);       // splits the URI segment by /
        //fetches data from database.
        $row = $this->model_reservation->show_all_user_book_reservation('overdue',$config['per_page'],$page);
        $this->jquery_pagination->initialize($config);
        //create links for pagination
        $data['links'] = $this->jquery_pagination->create_links();
         echo "<table class='body'>
                                <thead>
                                    <tr>
                                        <th style='width: 2%;'>#</th>
                                        <th style='width: 17%;'>Borrower</th>
                                        <th style='width: 40%;'>Material</th>
                                        <th style='width: 12%;'>Date Borrowed</th>
                                        <th style='width: 11%;'>Due Date</th>
                                        <th style='width: 9%;'></th>
                                        <th style='width: 10%;'></th>
                                    </tr>
                                </thead>";
        echo "<tbody>";
        $this->print_books($row, $data['links'],"overdue");
    }
    function get_book_data2(){
       $row_number=$this->model_reservation->countRows("reserved");
        //echo "<h1>$row_number<h1>";
        $config['base_url'] = base_url().'index.php/admin/controller_admin_home/get_book_data2';     //EDIT THIS BASE_URL IF YOU ARE USING A DIFFERENT URL. 
        $config['total_rows'] = $row_number;
        $config['per_page'] = 5;
        $config['div'] = '#displayOutgoing';
        $page=$this->uri->segment(4);       // splits the URI segment by /
        //fetches data from database.
        $row = $this->model_reservation->show_all_user_book_reservation('reserved',$config['per_page'],$page);
        $this->jquery_pagination->initialize($config);
        //create links for pagination
        $data['links'] = $this->jquery_pagination->create_links();
         echo "<table class='body'>
                                <thead>
                                    <tr>
                                        <th style='width: 2%;'>#</th>
                                        <th style='width: 17%;'>Borrower</th>
                                        <th style='width: 40%;'>Material</th>
                                        <th style='width: 12%;'>Date Borrowed</th>
                                        <th style='width: 11%;'>Due Date</th>
                                        <th style='width: 9%;'></th>
                                        <th style='width: 10%;'></th>
                                    </tr>
                                </thead>";
        echo "<tbody>";
        $this->print_books($row, $data['links'],"outgoing");
    }
    function print_books($overdue,$link,$out){
        $base=base_url();
        $date = date("Y-m-d");
        $count = 1;
        foreach($overdue as $row){
            echo "<tr>
            <td>$count</td>
            <td><b>{$row->first_name} {$row->middle_initial}. {$row->last_name} </b><br/>{$row->account_number}</td>
            <td><b>{$row->title}</b><br/>";

            $data['multi_valued'] = $this->model_reservation->get_book_authors($row->id);
            $authors="";
                                                    foreach($data['multi_valued'] as $authors_list){
                                                        $authors = $authors."{$authors_list->author},";
                                                    }
                                                    echo "$authors ($row->year_of_pub)<br/>
                                                    Call Number: {$row->call_number}</td>";

                                                echo "</td>
                                                <td>{$row->date_borrowed}</td>
                                                <td>{$row->due_date}</td>";
                                            if($out=="outgoing"){
                                            echo "<td><form action='controller_outgoing_books/reserve/' id='confirm$count' method='post'>
                                                <input type='hidden' name='res_number' value='{$row->res_number}' />
                                                <input type='submit' class='background-red' name='reserve' onclick='return confirmBookReserve(confirm$count);' value='Confirm' />
                                            </form></td>";              //button to be clicked if the reservation will be approved; functionality of this not included
                                            echo "<td><form action='controller_outgoing_books/cancel/' id='cancel$count' method='post'>
                                                <input type='hidden' name='res_number' value='{$row->res_number}' />
                                                <input type='submit' class='background-red' name='cancel' onclick='return confirmDeleteReserve(cancel$count);' value='Cancel' />
                                            </form></td>";              //button to be clicked if the reservation will be cancelled; functionality of this not included
                                            }else if($out=="overdue"){
                                            echo "<td><form action='$base/index.php/admin/controller_reservation/extend' id='overext$count' method='post'>
                                                    <input type='hidden' name='res_number' value='{$row->res_number}' />
                                                    <input type='submit' class='background-red' name='extend' value='Extend' />
                                                </form></td>";
                                        echo "<td><form action='$base/index.php/admin/controller_outgoing_books/return_book/' id='overret$count' method='post'>
                                                <input type='hidden' name='res_number' value='{$row->res_number}' />
                                                <input type='submit' class='background-red' name='return' value='Return' />
                                            </form></td>";
                                        }
                                        echo "</tr>";
                                        $count++;
    }
    echo "</tbody></table><div id='footer pagination'>";
    echo $link."</div>";
}
 function print_books2($overdue,$link){
        $base=base_url();
        $date = date("Y-m-d");
        $count = 1;
        foreach($overdue as $row){
            echo "<tr>
            <td>$count</td>
            <td><b>{$row->first_name} {$row->middle_initial}. {$row->last_name} </b><br/>{$row->account_number}</td>
            <td><b>{$row->title}</b><br/>";

            $data['multi_valued'] = $this->model_reservation->get_book_authors($row->id);
            $authors="";
                                                    foreach($data['multi_valued'] as $authors_list){
                                                        $authors = $authors."{$authors_list->author},";
                                                    }
                                                    echo "$authors ($row->year_of_pub)<br/>
                                                    Call Number: {$row->call_number}</td>";

                                                echo "</td>
                                                <td>{$row->date_borrowed}</td>
                                                <td>{$row->due_date}</td>";
                                        echo "<td><form action='$base/index.php/admin/controller_reservation/extend' id='overext$count' method='post'>
                                                <input type='hidden' name='res_number' value='{$row->res_number}' />
                                                <input type='submit' class='background-red' name='extend' value='Extend' />
                                                </form></td>";
                                        echo "<td><form action='$base/index.php/admin/controller_outgoing_books/return_book/' id='overret$count' method='post'>
                                                <input type='hidden' name='res_number' value='{$row->res_number}' />
                                                <input type='submit' class='background-red' name='return' value='Return' />
                                            </form></td>";
                                        echo "</tr>";
                                        $count++;
    }
    echo "</tbody></table><div id='footer pagination'>";
    echo $link."</div>";
}
  public function get_users(){
        $row_number=$this->model_users->countPendingUsers();
        $config['base_url'] = base_url().'index.php/admin/controller_reservation/get_users';     //EDIT THIS BASE_URL IF YOU ARE USING A DIFFERENT URL. 
        $config['total_rows'] = $row_number;
        $config['per_page'] = 5;
        $config['div'] = '#displayUsers';
        $page=$this->uri->segment(4);       // splits the URI segment by /
        //fetches data from database.
        $row = $this->model_users->getPendingUsers();
        $this->jquery_pagination->initialize($config);
        //create links for pagination
        $data['links'] = $this->jquery_pagination->create_links();
        echo "<table class='body'>
                                <thead>
                                    <tr>
                                        <th style='width: 2%;'>#</th>
                                        <th style='width: 8%;'>ID Number</th>
                                        <th style='width: 20%;'>Name</th>
                                        <th style='width: 5%;'>Course</th>
                                        <th style='width: 20%;'>Email</th>
                                        <th style='width: 8%;'>Classification</th>
                                        <th style='width: 10%;'>Status</th>
                                    </tr>
                                </thead>
                                <tbody>";
    $this->print_users($row, $data['links']);
    }
    function print_users($users,$links){
            $base=base_url();
            $count = 1;
                                        foreach ($users as $row) {
                                            echo "<tr>";
                                            echo "<td>$count</td>";
                                            echo "<td>".$row->account_number."</td>";
                                            $fullName = $row->first_name." ".$row->middle_initial.". ".$row->last_name;
                                            echo "<td>".$fullName."</td>";
                                            echo "<td>".$row->course."</td>";
                                            echo "<td>".$row->email."</td>";
                                            echo "<td>".$row->classification."</td>";
                                            $stat = $row->status;

                                            /*
                                                If status not yet 'approve', meaning the account was not yet validated,
                                                a button with a value 'Validate' will be seen in the status column.
                                                If status is already 'approve', meaning the account was already validated,
                                                'Registered' will be displayed on the said column. 
                                            */

                                            if($stat === "approve"){
                                            echo "<td><a href='".base_url()."index.php/admin/controller_view_users/borrow/$row->account_number'>Click to borrow</a></td>";
                                            }
                                            else{
                                                echo "<form action='$base/index.php/admin/controller_view_users/approve_user' id='accountconfirm$count' method='POST'>";
                                                echo "<input type='hidden' name='account_number1' value='$row->account_number'/>";
                                                 echo "<input type='hidden' name='approve' value='approve'/>";
                                                echo "<td>"."<input type ='submit' class='background-red' name='approve' onclick='return confirmUser(accountconfirm$count);' value = 'Confirm'>"."</td>";   //'Validate' button. Functionality not included here.
                                                echo "</form>"; //'Validate' button. Functionality not included here.
                                            }
                                            
                                            echo "</tr>";
                                            $count++;
                                        }
     echo "</tbody></table><div id='footer pagination'>";
    echo $links."</div>";                                   
    }
}
/* End of file controller_admin_home.php */
/* Location: ./application/controllers/admin/controller_admin_home.php */