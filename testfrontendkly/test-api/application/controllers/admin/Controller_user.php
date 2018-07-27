<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Controller_user extends REST_Controller {

	protected $methods = [
        "login_post" 			=> ["level" => 1],
        "session_post" 			=> ["level" => 1],
        "reset_password_post" 	=> ["level" => 1],
        "reset_password_post" 	=> ["level" => 1],
        "list_post" 			=> ["level" => 1],
        "add_post" 				=> ["level" => 1],
        "edit_post" 			=> ["level" => 1],
        "edit_password_post" 	=> ["level" => 1]
    ];

	public function __construct() {
		parent::__construct();
		$this->load->model("system/user");
		$this->load->model("system/login");
	}
	
	public function index_post() {
		$msg = $this->func->CreateArray(true, "Invalid Request");
		$this->response($msg, REST_Controller::HTTP_OK);
	}

	public function login_post() {
		$Output = $this->func->CheckParam(["username", "password"]);

		if($Output["IsError"]) {
			$this->response($Output, REST_Controller::HTTP_OK);
		} else {
			$Output = $this->login->login($this->input->post());
			$this->response($Output, REST_Controller::HTTP_OK);
		}
	}

	public function session_post() {
		$Output = $this->func->CheckParam(["user_key"]);

		if($Output["IsError"]) {
			$this->response($Output, REST_Controller::HTTP_OK);
		} else {
			$Output = $this->func->CreateArray(false, "'user_key' masih aktif");
			$this->response($Output, REST_Controller::HTTP_OK);
		}
	}
	
	public function reset_password_post() {
		$Output = $this->func->CheckParam(["email", "reset_url"]);

		if($Output["IsError"]) {
			$this->response($Output, REST_Controller::HTTP_OK);
		} else {
			$Output = $this->user->UserResetPassword($this->input->post());
			$this->response($Output, REST_Controller::HTTP_OK);
		}
	}

	public function list_post() {
		$Output = $this->func->CheckParam(["user_key"]);

		if($Output["IsError"]) {
			$this->response($Output, REST_Controller::HTTP_OK);
		} else {
			$Output = $this->user->UserList($this->input->post());
			$this->response($Output, REST_Controller::HTTP_OK);
		}
	}


	public function add_post() {
		$Output = $this->func->CheckParam(["user_key", "nama", "username", "email", "password1", "password2"]);

		if($Output["IsError"]) {
			$this->response($Output, REST_Controller::HTTP_OK);
		} else {
			$Output = $this->user->UserAdd($this->input->post());
			$this->response($Output, REST_Controller::HTTP_OK);
		}
	}

	public function edit_post() {
		$Output = $this->func->CheckParam(["user_key", "id_users"]);

		if($Output["IsError"]) {
			$this->response($Output, REST_Controller::HTTP_OK);
		} else {
			$Output = $this->user->UserEdit($this->input->post());
			$this->response($Output, REST_Controller::HTTP_OK);
		}
	}

	public function edit_password_post() {
		$Output = $this->func->CheckParam(["user_key", "password1", "password2"]);

		if($Output["IsError"]) {
			$this->response($Output, REST_Controller::HTTP_OK);
		} else {
			$data = $this->input->post();
			if(empty($data["id_users"])) $data["id_users"] = $Output["Output"];

			$Output = $this->user->UserEditPassword($data);
			$this->response($Output, REST_Controller::HTTP_OK);
		}
	}
}
