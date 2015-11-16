<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Dist_Registration extends MY_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}
	public function index() {
		$data['content_view'] = "signup_v";
		$data['banner_text'] = "Sign Up";
		$this -> load -> view("template", $data);
	}
	
	public function submit(){
		if ($this->_submit_validate() === FALSE) {
			$this->index();
			return;
		}

		$email=$this->input->post('email');
		$name1=$this->input->post('fname');
		$name2=$this->input->post('lname');
		$password=$this->input->post('password');
		$username=$this->input->post('username');
		
		$u = new User();
		$u->fname=$this->input->post('fname');
		$u->lname=$this->input->post('lname');
		$u->email = $this->input->post('email');
		$u->username = $this->input->post('username');
		$u->password = $this->input->post('password');
		$u->usertype_id = 3;
		$u->telephone = $this->input->post('tell');
		$u->district = $this->input->post('district');
		$u->facility = $this->input->post('facility');
		$u->save();
		
		
			$fromm='hcmpkenya@gmail.com';
		$messages='Hallo, You have been Registered as a user for the Health Commodities Management Platform System. Your username is '.$username.' and your password is '.$password.' . Please change your password when you login into the system. 
		
		Thank you';
	
  
  		$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'hcmpkenya@gmail.com';
        $config['smtp_pass']    = 'healthkenya';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not  
		

        $this->email->initialize($config);
		$this->load->library('email', $config);
 
  		$this->email->set_newline("\r\n");
  		$this->email->from($fromm,'Health Commodities Management Platform'); // change it to yours
  		$this->email->to($email); // change it to yours
  		$this->email->cc('kariukijackson@gmail.com,kelvinmwas@gmail.com,nicomaingi@gmail.com,jsphmk14@gmail.com');
  		$this->email->subject('User Registration :'.$name1.' '.$name2);
 	    $this->email->message($messages);
 
  if($this->email->send())
 {

 }
 else
{
 show_error($this->email->print_debugger());
}
		//District User Registration
		/*$u1=new Log();
		$action='Registered a User';
		$u1->user_id=$this -> session -> userdata('identity');
		$u1->action=$action;
		$u1->save();*/
		
		$data['content_view'] = "signup_v";
		$data['banner_text'] = "Sign Up";
		$this -> load -> view("template", $data);
	}
	private function _submit_validate() {
		
		// validation rules
		$this->form_validation->set_rules('fname', 'First Name', 
			'trim|required|alpha_numeric|min_length[3]');
			
		$this->form_validation->set_rules('lname', 'Last Name', 
			'trim|required|alpha_numeric|min_length[3]');
			
		$this->form_validation->set_rules('username', 'Username', 
			'trim|required|alpha_numeric|min_length[3]|max_length[12]|unique[User.username]');
		
		$this->form_validation->set_rules('password', 'Password',
			'trim|required|min_length[3]|max_length[12]');
		
		$this->form_validation->set_rules('passconf', 'Confirm Password',
			'trim|required|matches[password]');
		
		$this->form_validation->set_rules('email', 'E-mail',
			'trim|required|valid_email|unique[User.email]');
			
			$this->form_validation->set_rules('tell', 'Mobile Number', 
			'trim|required|numeric|min_length[10]');
		
		return $this->form_validation->run();
		
	}
}