<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Controller_siswa extends REST_Controller {

	protected $methods = [
        "list_post" => ["level" => 1],
        "add_post" 	=> ["level" => 1],
        "edit_post" => ["level" => 1]
    ];

	public function __construct() {
		parent::__construct();
		$this->load->model("system/Siswa");
	}

	public function index_post() {
		$msg = $this->func->CreateArray(true, "Invalid Request");
		$this->response($msg, REST_Controller::HTTP_OK);
	}

	public function list_post() {
		$Output = $this->func->CheckParam(["user_key"]);

		if($Output["IsError"]) {
			$this->response($Output, REST_Controller::HTTP_OK);
		} else {
			$Output = $this->Siswa->SiswaList($this->input->post());
			$this->response($Output, REST_Controller::HTTP_OK);
		}
	}

	public function add_post() {
		set_time_limit(0);
		$Output = $this->func->CheckParam(["user_key", "nama", "email", "ulangtahun", "alamat"]);

		if($Output["IsError"]) {
			$this->response($Output, REST_Controller::HTTP_OK);
		} else {
			$Output = $this->Siswa->SiswaAdd($this->input->post());
			$this->response($Output, REST_Controller::HTTP_OK);
		}
	}

	public function edit_post() {
		$Output = $this->func->CheckParam(["user_key", "nama", "email", "ulangtahun", "alamat"]);

		if($Output["IsError"]) {
			$this->response($Output, REST_Controller::HTTP_OK);
		} else {
			$Output = $this->Siswa->SiswaEdit($this->input->post());
			$this->response($Output, REST_Controller::HTTP_OK);
		}
	}
}
