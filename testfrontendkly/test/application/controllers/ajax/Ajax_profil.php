<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_profil extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("foprofil");
	}

	public function index() {
        if($this->input->is_ajax_request() and $this->input->post("act")) {
            if(method_exists($this, $this->input->post("act"))) {
                $act = $this->input->post("act");
                $this->req  = $this->input->post("req");
                $this->form = $this->input->post("form");
                print_r($this->$act());
            } else {
                print_r($this->api->msg(true, "Invalid Method"));
            }
        } else {
            print_r($this->api->msg(true, "Invalid Request"));
        }
    }

    private function profileuploadimage() {
        $Request = $this->foprofil->UploadImage($this->form);
        return $Request;
    }

    private function updatedata() {
        $id_update = $this->form["id_update"]; unset($this->form["id_update"]);
        $Request = $this->foprofil->UpdatePengguna($id_update, $this->form);
        return $Request;
    }

    private function updatepassword() {
        $id_update["id"] = $this->form["id_update"]; unset($this->form["id_update"]);
        $id_update["password1"] = $this->form["password1"]; unset($this->form["password1"]);
        $id_update["password2"] = $this->form["password2"]; unset($this->form["password2"]);
        $Request = $this->foprofil->UpdatePasswordPengguna($id_update, $this->form);
        return $Request;
    } 
}
