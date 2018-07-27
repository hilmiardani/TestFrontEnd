<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("fologin");
	}

	public function index() {
        if($this->input->is_ajax_request() and $this->input->post("act")) {
            if(method_exists($this, $this->input->post("act"))) {
                $act = $this->input->post("act");
                $this->req  = $this->input->post("req");
                $this->form = $this->input->post("form");
                $this->capt = $this->input->post("captcha");
                print_r($this->$act());
            } else {
                print_r($this->api->msg(true, "Invalid Method"));
            }
        } else {
            print_r($this->api->msg(true, "Invalid Request"));
        }
    }

    private function login() {
        $Request = $this->fologin->LoginProcess($this->capt, $this->form);
        return $Request;
    }

    private function reset_password() {
        $Request = $this->fologin->ResetProcess($this->capt, $this->form);
        return $Request;
    }

    private function forgot_password() {
        $Request = $this->fologin->ForgotProcess($this->form);
        return $Request;
    }
}
