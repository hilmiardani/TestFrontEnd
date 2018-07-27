<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_pengguna extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("fopengguna");
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

    private function listdatahtml() {
        if (isset($this->req["filter"]["status"]) and $this->req["filter"]["status"] != "") {
            $this->req["filter"]["status"] = $this->req["filter"]["status"];
        }
        else {
            $this->req["filter"]["status"] = 1;
        }
        $Request = $this->fopengguna->HtmlPengguna($this->req);
        return $Request;
    }

    /*private function listdropdowngroup() {
        $this->req["filter"]["status"] = 1;
        $Request = $this->fosekolah->HtmlDropdownGroup($this->req);
        return $Request;
    }*/
    
    private function getdatabyid() {
        $Request = $this->fopengguna->GetPengguna(["filter" => ["id" => $this->req]]);
        return json_encode($Request);
    }
    
    private function insertdata() {
        unset($this->form["id_update"]); 
        $data["nama"] = $this->form["nama"];
        $data["username"] = $this->form["username"];
        $data["email"] = $this->form["email"];
        $data["password1"] = $this->form["password1"];
        $data["password2"] = $this->form["password2"];
        $Request = $this->fopengguna->InsertPengguna($data, $this->form);
        return $Request;
    }

    private function updatedata() {
        $id_update = $this->form["id_update"]; unset($this->form["id_update"]);
        $Request = $this->fopengguna->UpdatePengguna($id_update, $this->form);
        return $Request;
    }

    private function updatepassword() {
        $id_update["id"] = $this->form["id_update"]; unset($this->form["id_update"]);
        $id_update["password1"] = $this->form["password1"]; unset($this->form["password1"]);
        $id_update["password2"] = $this->form["password2"]; unset($this->form["password2"]);
        $Request = $this->fopengguna->UpdatePasswordPengguna($id_update, $this->form);
        return $Request;
    } 
}
