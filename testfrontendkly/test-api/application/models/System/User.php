<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function UserList($param) {
		$Koneksi = $this->db;
		$nama_table = "sys_users";

		$data 			= [];
		$data["Target"] = $nama_table;
		$filter 		= "";

		if(!empty($param["id_users"])) {
			$flt = "id = ".$param["id_users"];
			$filter .= empty($filter) ? $flt : " and ".$flt;
		}
		if(!empty($param["search"])) {
			$flt  = "MATCH(nama, username, email) AGAINST ('*".$param["search"]."*' IN BOOLEAN MODE)"; 
			$filter .= empty($filter) ? $flt : " and ".$flt;
		}
		if(isset($param["level"])) {
			$flt = "level = ".$param["level"];
			$filter .= empty($filter) ? $flt : " and ".$flt;
		}
		if(isset($param["is_active"])) {
			$flt = "is_active = ".$param["is_active"];
			$filter .= empty($filter) ? $flt : " and ".$flt;
		}

		//Bawaan
		$data["ParamsFilter"] = $filter;
		if(!empty($param["Sort"]))  $data["ParamsSort"] = $param["Sort"];
		if(!empty($param["Limit"])) $data["Limit"] = $param["Limit"]; 
		if(!empty($param["Page"]))  $data["Page"] = $param["Page"];
		if(!empty($param["Field"])) $data["ParamsField"] = $param["Field"];

		$result = $this->databaseapi->GetData($data, $Koneksi);

		ResultData:
		return $result;
	}

	public function UserAdd($param) {
		$Koneksi = $this->db;
		
		$nama_table = "sys_users";

		$rdt = [];
		if($param["password1"] != $param["password2"]) {
			$rdt = $this->func->CreateArray(true, "Password1 atau Password2 tidak valid");
			goto ResultData;
		}

		if(!empty($param["password1"])) {
			$param["password"] = $this->func->HashPass($param["password1"]);
			$param = $this->func->UnsetArrayByKey($param, ["password1", "password2"]);
		}

		$data  				= [];
		$data["Target"] 	= $nama_table;
		$data["ParamsData"] = json_encode($param);
		$rdt = $this->databaseapi->InsertData($data, $Koneksi);

		ResultData:
		return $rdt;
	}

	public function UserEdit($param) {
		$Koneksi = $this->db;
		
		$nama_table = "sys_users";

		$rdt = [];
		$id_users = $param["id_users"]; 
		$param = $this->func->UnsetArrayByKey($param, ["id_users", "password", "password1", "password2"]);

		$data  				  = [];
		$data["Target"] 	  = $nama_table;
		$data["ParamsData"]   = json_encode($param);
		$data["ParamsFilter"] = "id = ".$id_users;
		$rdt = $this->databaseapi->UpdateData($data, $Koneksi);

		ResultData:
		return $rdt;
	}

	public function UserEditPassword($param) {
		$koneksi = $this->db;
		$nama_table = "sys_users";

		$rdt = [];
		$id_users = $param["id_users"]; 
		$param = $this->func->UnsetArrayByKey($param, ["id_users"]);

		if($param["password1"] != $param["password2"]) {
			$rdt = $this->func->CreateArray(true, "Password1 atau Password2 tidak valid");
			goto ResultData;
		}
		if(!empty($param["password1"])) {
			$param["password"] = $this->func->HashPass($param["password1"]);
			$param = $this->func->UnsetArrayByKey($param, ["password1", "password2"]);
		}

		$data  				  = [];
		$data["Target"] 	  = $nama_table;
		$data["ParamsData"]   = json_encode($param);
		$data["ParamsFilter"] = "id = ".$id_users;
		$rdt = $this->databaseapi->UpdateData($data, $Koneksi);

		ResultData:
		return $rdt;
	}
}
