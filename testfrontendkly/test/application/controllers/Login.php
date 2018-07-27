<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		redirect("user/login");
	}

    public function login() {
        if(!empty($this->session->userdata("user"))) {
            redirect("siswa");
        } else {
            $this->load->view("login/index");
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect("user/login");
    }
}
