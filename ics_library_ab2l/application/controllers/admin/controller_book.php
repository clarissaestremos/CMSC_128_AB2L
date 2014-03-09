<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once("controller_log.php");
class Controller_book extends Controller_log {   
 function __construct(){
            parent::__construct();
            $this->load->helper("url");
            $this->load->library('Jquery_pagination');
            $this->load->model('model_get_list');
            $this->load->model('model_book');
            $this->load->library('pagination');
    }

	public function index()
	{
		//$session_user = $this->checklogin();
		$this->load->model('model_book');
		$data['query'] = $this->model_book->select_all_book_info();
		$data['parent'] = "Books";
    	$data['current'] = "View Books";
    	$data['user'] = $this->session->userdata('logged_in');

    	$this->load->helper(array('form','html'));
	    $this->load->view("admin/view_header",$data);
	    $this->load->view("admin/view_aside");
	    $this->load->view('admin/view_books');
	    $this->load->view("admin/view_footer");
		
	}

	public function get_book_data1(){
        $this->input->post('serialised_form');
        $sort_by = addslashes($this->input->post('sort_by')); 
        $order_by = addslashes($this->input->post('order_by')); 
        $data['result_all']  = $this->model_get_list->select_all_book_info($sort_by,$order_by,NULL,0,0);

        //configuration of the ajax pagination  library.
        $config['base_url'] = base_url().'index.php/admin/controller_book/get_book_data1';        //EDIT THIS BASE_URL IF YOU ARE USING A DIFFERENT URL. 
        $config['total_rows'] = count($data['result_all']);
        $config['per_page'] = '10';
        $config['div'] = '#change_here';
        $config['additional_param']  = 'serialize_form1()';

        $page=$this->uri->segment(4);       // splits the URI segment by /
        
        $data['result'] = $this->model_get_list->select_all_book_info($sort_by,$order_by,$data['result_all'],$config['per_page'],$page);
        $this->jquery_pagination->initialize($config);
        //$this->pagination->initialize($config);
        $data['links'] = $this->jquery_pagination->create_links();
        $this->print_books($data['result'],$data['links']);
       
    }

    public function print_books($result, $links){
		echo" <table class='body'>
                <thead>
                    <tr>
                        <th style'width: 5%;'>#</th>
                        				<th style='width: 10%;'><center>Call Number</center></th>
                                        <th style='width: 10%;'><center>Subject</center></th>
                                        <th style='width: 50%;'><center>Material</center></th>
                                        <th style='width: 7%;'><center>Type</center></th>
                                        <th style='width: 5%;'><center>Qty</center></th>
                                        <th style='width: 8%;'></th>
                                        <th style='width: 8%;'></th>
                                    </tr>
                                </thead> 
                                <tbody>";
                                    
                                        $count = 1;
                                        foreach($result as $row){
                                            echo "<tr>";
                                            echo "<td>$count</td>";
                                            $data['query1'] = $this->model_book->get_book_call_numbers($row->id);
                                            $call_number="";
                                            foreach($data['query1'] as $call_number_list){
                                                $call_number .= "{$call_number_list->call_number}<br/> ";
                                            }
                                            echo "<td>{$call_number}</td>"; 
                                            $data['query1'] = $this->model_book->get_book_subjects($row->id);
                                            $subjects ="";
                                            foreach($data['query1'] as $subjects_list){
                                                $subjects .= "{$subjects_list->subject}<br/> ";
                                            }
                                            echo "<td>{$subjects}</td>";
                                            echo "<td><b>{$row->title}</b><br/>";
                                            $data['query1'] = $this->model_book->get_book_authors($row->id);
                                            $authors ="";
                                            foreach($data['query1'] as $authors_list){
                                                $authors .= "{$authors_list->author},";
                                            }
                                           	echo"{$authors} ({$row->year_of_pub})<br/>";
                                           		if ($row->isbn != NULL)
                                           			echo "ISBN:{$row->isbn}";
                                           echo"</td>";
                                           
                                            //image source: http://3.bp.blogspot.com/-hUGEJQbn1Hk/ULY_bdWVgdI/AAAAAAAAAd0/Z2vFFfsae_4/s1600/Red_book_cover.png
			                                if ($row->type == "BOOK"){
			                                    echo "<td><center><img title = 'BOOK' width = 30px height = 30px src='../../images/type_book.png'/></center></td>";
			                                }

			                                else
                                           		 //image source: http://www.webweaver.nu/clipart/img/education/diploma.png
			                                	 echo "<td><img title = 'THESIS/SP' width = 30px height = 30px src='../../images/type_thesis.png' /></td>";


                                            echo "<td>{$row->no_of_available}/{$row->quantity}</td>

                                            <td>";
                                            $base = base_url();
                                                echo "<form action='$base"."index.php/admin/controller_book/edit/' method='post'>
                                                    <input type=\"hidden\" name=\"id\" value=\"{$row->id}\" />
                                                    <input type='submit' class='background-red' name='edit' value='Edit' enabled/>
                                                </form>
                                                </td>
                                                <td>
                                                <form action='$base"."index.php/admin/controller_book/delete/' method='post'>
                                                    <input type=\"hidden\"  name=\"id\" value=\"{$row->id}\" />
                                                    <input type='submit' name='delete' class='background-red' value='Delete' onclick=\"return confirm('Are you sure you want to delete this book entry?\\nThis cannot be undone!')\" enabled/>
                                                </form>
                                                </td>
                                                </tr>";


                                            echo "</tr>";
                                            $count++;
                                        }
                                   
                              echo"  </tbody>
                            </table>
                            <div class='footer pagination'>";
                                echo $links;
                            echo"</div>";

    }
	/*ADD BOOK FUNCTIONS*/
	function add_book(){
		$this->load->view("view_add_book");
	}
	
	public function call_add(){
			$session_user = $this->session->userdata('logged_in')['username'];
			if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		if(isset($_POST['submit'])){
			$call_number = array_unique ($_POST['call_number']);
			$title = htmlspecialchars($_POST['title1']);
			$author = array_unique ($_POST['author']);
			$subject = array_unique ($_POST['subject']);
			$isbn = htmlspecialchars($_POST['isbn']);
			$year_of_pub = htmlspecialchars($_POST['year_of_pub']);
			$type = strtoupper ($_POST['type1']);
			$quantity = sizeof($call_number);
			$no_of_available = $quantity;
			$book_stat = 0;
			$tags = array_unique ($_POST['tags']);
			
			$this->load->model("model_book");
			$id = $this->model_book->insert_book_info($call_number, $title, $year_of_pub, $isbn, $type, $no_of_available, $quantity, $book_stat, $author, $subject, $tags);
			if($type== "BOOK"){
				$type = ucfirst($type);
				$message = "Admin $session_user added a new $type with ISBN: $isbn";
			}else{
				$cn="";
				foreach ($call_number as $value3) {
					$cn .= $value3.", ";
				}
				$message = "Admin $session_user added a new $type with Call Number(s): $cn";
			}
			$this->add_log($message,"Add Book");	
			$this->call_success();
		}
	}

	public function call_success(){
			echo "<script>
				alert('You have successfully add a material');
			</script>";
			redirect('index.php/admin/controller_add_books', 'refresh');
	}
	
	/*UPDATE book*/
	//EDIT
	function edit(){
		$session_user = $this->session->userdata('logged_in')['username'];
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		$id = $_POST['id'];
		$this->load->model('model_book');
		$book = $this->model_book->get_by_id($id);
		$data['book'] = $book;

		$data['query'] = $this->model_book->select_all_book_info();
		$data['parent'] = "Books";
    	$data['current'] = " Books";
    	$data['user'] = $this->session->userdata('logged_in');

		$this->load->helper(array('form','html'));
		$this->load->view("admin/view_header",$data);
		$this->load->view("admin/view_aside");
		$this->load->view('admin/view_edit_book', $data);
		$this->load->view("admin/view_footer");
	}

	function edit_book(){
		$session_user = $this->session->userdata('logged_in')['username'];
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		$this->load->model('model_book');
		$id = $this->input->post('id');
		$call_numbers = array_unique ($this->input->post('call_number'));
		$book_authors = array_unique ($this->input->post('author'));
		$book_subjects = array_unique ($this->input->post('subject'));
		$isbn = $this->input->post('isbn');
		$typeCheck = $this->input->post('type');
		if ($typeCheck != "BOOK")
			$isbn = "";
		$book = array(
			'title' => $this->input->post('title'),
			'year_of_pub' => $this->input->post('year_of_pub'),
			'no_of_available' => $this->input->post('no_of_available'),
			'type' => strtoupper($this->input->post('type')),
			'isbn' => $isbn,
			'quantity' => sizeof($call_numbers),
		);
		//BUG: CHECK IF A COPY OF THE BOOK IS ON LOAN, THEN SUBTRACT NUMBER OF ON LOAN BOOKS IN QUANTITY THEN UPDATE NO. OF AVAILABLE
		$this->model_book->edit_book($id, $book, $call_numbers, $book_authors, $book_subjects);
		$this->add_log("Admin $session_user updated book with ID Number: $id", "Update Book");
		$this->edit_success();

	}

	function edit_success(){
		$session_user = $this->session->userdata('logged_in')['username'];

		echo "<script>
				alert('You have successfully updated a book.');
			</script>";
		header("refresh:0;url=../controller_book");
	}
	
	//DELETE
	function delete(){
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		$session_user = $this->session->userdata('logged_in')['username'];
		$this->load->model('model_book');
		$id = $_POST['id'];
		$this->add_log("Admin $session_user deleted book with ID Number: $id", "Delete Book");
		$this->model_book->delete_book($id);
		echo "<script>
				alert('You have successfully deleted a book.');
			</script>";
		redirect('index.php/admin/controller_book', 'refresh');
	}


}
 ?>

