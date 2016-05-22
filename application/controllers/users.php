<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('User');
		$this->load->library("form_validation");
		$this->load->helper('date');
	}

	public function index() {
		//login and reg - create view
		$this->load->view('main');
	}	

	public function register() {
		//insert in db user info if it does not exist
		$this->form_validation->set_rules('name', 'Name', 'trim|min_length[3]|required');
		$this->form_validation->set_rules('alias', 'Alias', 'trim|min_length[3]|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[users.email]|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|required|matches[confirm_password]|md5');
		$this->form_validation->set_rules('confirm_password', 'Confirm_Password', 'trim|required|md5');
		$this->form_validation->set_rules('dob', 'Dob', 'required|callback_date_check');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata("registration_error", validation_errors());
			redirect('/');

    } else {
			$new_user = $this->input->post(NULL, TRUE);
			$this->User->add_user($new_user);
			$this->session->set_flashdata("registration_error", "You successfuly registered, please log in!");
		}
			redirect('/');
}
	public function date_check() {
		// var_dump($date);
		// die();
		// string '2014-10-10'
		$dob = strtotime($this->input->post('dob'));
		if($dob < NOW()) {
			return true;
		} else {
			$this->form_validation->set_message("date_check", "The %s field must be a past date!");
			return false;
		}
	}
	public function login() {
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		$this->form_validation->set_rules("password", "Password", "trim|required|md5");

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata("loggin_error", validation_errors());
			redirect('/');
		} else {
			//check email and password against db info
			$this->load->model('User');
			$existing_user = $this->input->post(NULL, TRUE);
			$user = $this->User->get_user_login($existing_user);

			if($user && $user['password'] == $existing_user['password']) {
				$this->session->set_userdata('login_info', $user);
				$this->display_pokes($user);

			} else {
				$this->session->set_flashdata("loggin_error", "No such user, please go to registration");
				redirect('/');
			}
		}
	}

		public function display_pokes($user) {
			//get user's pokes and other users to be poked and load to view
			$loggedin_user = $this->session->userdata('login_info');
			$user_pokes = $this->User->get_user_pokes();
			//var_dump($user_pokes); die();
			$user_total_pokes = $this->User->get_user_total_pokes();
			$other_users_pokes = $this->User->get_other_users_pokes();
			//var_dump($other_users_pokes) die();

			$this->load->view('pokes',
																		['info'=> $loggedin_user,
																		 'user_pokes'=>$user_pokes,
																		 'user_total_pokes'=>$user_total_pokes,
																		 'other_users_pokes'=>$other_users_pokes
																		]);
		}

	public function add_pokes($poked_id) {
		$user = $this->session->userdata('login_info');
		$this->User->add_pokes($poked_id);
		$this->display_pokes($user);
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect($uri=base_url());
	}

}
