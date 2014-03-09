<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Includes the User_Model class as well as the required sub-classes
 * @package codeigniter.application.models
  *	reference: http://www.revillweb.com/tutorials/codeigniter-tutorial-learn-codeigniter-in-40-minutes/
 */

class User_Model extends CI_Model
{
	/*
	* A private variable to represent each column in the database
	*/
	private $id;
	private $username;
	private $password;

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/*
	* SET's & GET's
	* Set's and get's allow you to retrieve or set a private variable on an object
	*/


	/**
		ID
	**/

	/**
	* @return int [$this->_id] Return this objects ID
	*/
	public function getId()
	{
		return $this->id;
	}

	/**
	* @param int Integer to set this objects ID to
	*/
	public function setId($value)
	{
		$this->id = $value;
	}

	/**
		USERNAME
	**/

	/**
	* @return string [$this->_username] Return this objects username
	*/
	public function getUsername()
	{
		return $this->username;
	}

	/**
	* @param string String to set this objects username to
	*/
	public function setUsername($value)
	{
		$this->username = $value;
	}

	/**
		PASSWORD
	**/

	/**
	* @return string [$this->_password] Return this objects password
	*/
	public function getPassword()
	{
		return $this->password;
	}

	/**
	* @param string String to set this objects password to
	*/
	public function setPassword($value)
	{
		$this->password = $value;
	}

	/*
	* Class Methods
	*/

	
	public function login($username, $password)
	{
		$data = array(
			'username' => $this->username,
			'password' => $this->password
		);

		//create query to connect user login database
        $this->db->select('username, password,first_name,middle_initial,last_name');
        $this->db->from('user_account');
        $this->db->where('username', $username);
        $this->db->where('password', sha1($password));
        $this->db->limit(1);
         
        //get query and processing
        $query = $this->db->get();
        if($query->num_rows() == 1) { 
            return $query->result(); //if data is true
        } else {
            return false; //if data is wrong
        }

	}


	public function admin_key($admin_key)
	{

		//create query to connect user login database
        $this->db->select('username, password,first_name,middle_name,last_name');
        $this->db->from('admin_account');
        $this->db->where('admin_key', $admin_key);
        $this->db->limit(1);
         
        //get query and processing
        $query = $this->db->get();
        if($query->num_rows() == 1) { 
            return $query->result(); //if data is true
        } else {
            return false; //if data is wrong
        }

	}

	public function loginAdmin($username, $password)
	{
		$data = array(
			'username' => $this->username,
			'password' => $this->password
		);

		//create query to connect user login database
        $this->db->select('username, password,first_name,middle_name,last_name');
        $this->db->from('admin_account');
        $this->db->where('username', $username);
        $this->db->where('password', sha1($password));
        $this->db->limit(1);
         
        //get query and processing
        $query = $this->db->get();
        if($query->num_rows() == 1) { 
            return $query->result(); //if data is true
        } else {
            return false; //if data is wrong
        }

	}

	//for user
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

	public function update_email($new_email, $username){


        $data = array(
           'email'=> $new_email
        );

		$this->db->where('username', $username);
		$this->db->update('user_account', $data); 
		return true;

               
	}

	public function update_password($new_password, $username){


        $data = array(
           'password'=> sha1($new_password)
        );

		$this->db->where('username', $username);
		$this->db->update('user_account', $data); 
		return true;

               
	}
	public function update_username($old, $new){
		
		  $this->db->where('username',$new);
            $query = $this->db->get('user_account')->num_rows();
            if($query == 0 ){
                    $this->db->where('username',$new);
                    $query = $this->db->get('admin_account')->num_rows();
                     if($query == 0 ){

                     $data = array(
		               'username'=> $new
		            );

					$this->db->where('username', $old);
					$this->db->update('user_account', $data); 
  						return true;

                     }
                       
                     else return false;
              }
            else return false;
	}
	public function getAccntNum($uname){
	
		$this->db->where('username', $uname);
		$num = $this->db->get('user_account');
		$num = $num->result(); 
		return $num;
	}
}

