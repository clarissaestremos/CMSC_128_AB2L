<?php
include_once("controller_log.php");
class Controller_reservation extends Controller_log{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_reservation');
	}
	
	public function index(){
		//$this->load->view('view_admin_home');
		$this->get_All();
		//$this->send_email();
	}//END OF index()

	/*Function to show all borrowed book information stored in the database */
	public function get_All(){
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		$data['query'] = $this->model_reservation->show_all_user_book_reservation('borrowed',0,0);
		$data['overdue'] = $this->model_reservation->show_all_user_book_reservation('overdue',0,0);
		$data['parent'] = "Books";
    	$data['current'] = "View Borrowed Books";

    		 $this->load->helper(array('form','html'));
	        $this->load->view("admin/view_header",$data);
	        $this->load->view("admin/view_aside");
	        $this->load->view('admin/view_reserved_books', $data);	
	        $this->load->view("admin/view_footer");
		
	}//END OF get_All()
	
	public function extend(){
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
        $res_number=$_POST['res_number'];
        $this->model_reservation->update_book_reservation($res_number, "extend");
		$session_user = $this->session->userdata('logged_in')['username'];
            $this->add_log("Admin $session_user extended a book reservation with Reservation Number: $res_number", "Extend Reservation");
            $base = base_url();
        echo "<div id='mysuccess' title='Add Book Success'>
        <h6>You have successfully extend the material's due date!</h6>
        </div>
        <script src='$base/js/jquery-1.10.2.min.js'></script>
        <script src='$base/js/jquery-ui.js'></script>
        <link rel='stylesheet' href='$base/style/jquery-ui.css'/>
        <script>
            $('#mysuccess').dialog({
                modal: true,
                closeOnEscape: true,
                resizable: false,
                  width: 300,
                  minHeight: 200,
                closeText: 'show',
                show: {
                  effect: 'fadeIn',
                  duration: 200
                },
                draggable: false,
                close: function(event, ui){
                    window.location.replace('$base/index.php/admin/controller_reservation');
                },
                buttons : {
                  'Ok': function() {
                      window.location.replace('$base/index.php/admin/controller_reservation');
                  },
                }
     
            });
        </script>";
    }//END OF extend()
    public function get_book_data(){
    	$row_number=$this->model_reservation->countRows("overdue");
        //echo "<h1>$row_number<h1>";
        $config['base_url'] = base_url().'index.php/admin/controller_reservation/get_book_data';     //EDIT THIS BASE_URL IF YOU ARE USING A DIFFERENT URL. 
        $config['total_rows'] = $row_number;
        $config['per_page'] = 5;
        $config['div'] = '#displayArea';
        $page=$this->uri->segment(4);       // splits the URI segment by /
        //fetches data from database.
        $row = $this->model_reservation->show_all_user_book_reservation('overdue',$config['per_page'],$page);
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
            </thead>
            <tbody>";

        $this->jquery_pagination->initialize($config);
        $data['links'] = $this->jquery_pagination->create_links();
        $this->print_books($row, $data['links'],'overdue');
    }
    public function get_book_data2(){
    	$row_number=$this->model_reservation->countRows("borrowed");
        //echo "<h1>$row_number<h1>";
        $config['base_url'] = base_url().'index.php/admin/controller_reservation/get_book_data2';     //EDIT THIS BASE_URL IF YOU ARE USING A DIFFERENT URL. 
        $config['total_rows'] = $row_number;
        $config['per_page'] = 5;
        $config['div'] = '#displayArea2';
        $page=$this->uri->segment(4);       // splits the URI segment by /
        //fetches data from database.
        $row = $this->model_reservation->show_all_user_book_reservation('borrowed',$config['per_page'],$page);
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
        </thead>
        <tbody>";
        $this->print_books($row, $data['links'],'borrowed');
    }
     function print_books($overdue,$link,$stat){
     	$date = date("Y-m-d");
            $count = 1;
            $ret = "ret".$stat;
            $ext = "ext".$stat;
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
				if($row->due_date <= $date){
				echo "<td><form action='controller_reservation/extend' id='$ret$count' method='post'>
						<input type='hidden' name='res_number' value='{$row->res_number}' />
						<input type='submit' class='background-red' name='extend' onclick='return extendBook($ret$count);' value='Extend' />
						</form></td>";
				}else{
					echo "<td></td>";
				}
				echo	"<td><form action='controller_outgoing_books/return_book/' id='$ext$count' method='post'>
                        <input type='hidden' name='res_number' value='{$row->res_number}' />
                        <input type='submit' class='background-red' name='return' onclick='return returnBook($ext$count);' value='Return' />
                    </form></td>";
                echo "</tr>";
                $count++;
     }
     echo "</tbody></table><div id='footer pagination'>";
    echo $link."</div>";
 }
}
?>
