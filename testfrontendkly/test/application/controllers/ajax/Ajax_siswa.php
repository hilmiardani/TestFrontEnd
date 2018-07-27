<?php
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);

class Ajax_siswa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Siswa");
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
        $Request = $this->Siswa->HtmlSiswa($this->req);
        return $Request;
    }

    private function listdropdownsiswa() {
        $this->req["filter"]["status"] = 1;
        $this->req["Limit"] = 1000;
        $Request = $this->Siswa->HtmlDropdownSiswa($this->req);
        return $Request;
    }
    
    private function getdatabyid() {
        $Request = $this->Siswa->GetSiswa(["filter" => ["id" => $this->req]]);
        return json_encode($Request);
    }

    private function getdatabynis() {
        $Request = $this->Siswa->GetSiswa(["filter" => ["nis" => $this->req]]);
        return json_encode($Request);
    }
    
    private function insertdata() {
        $Request = $this->Siswa->InsertSiswa($this->form);
        return $Request;
    }

    private function updatedata() {
        $id_update = $this->form["id_update"]; unset($this->form["id_update"]);
        $Request = $this->Siswa->UpdateSiswa($id_update, $this->form);
        return $Request;
    }
}
