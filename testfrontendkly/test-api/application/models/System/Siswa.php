<?php
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(100);

class Siswa extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function SiswaList($param) {
		$Koneksi = $this->db;

		$data 			= [];
		$data["Target"] = "dt_siswa";
		$filter 		= "";

		if(!empty($param["id"])) {
			$flt = "id = ".$param["id"];
			$filter .= empty($filter) ? $flt : " and ".$flt;
		}
		if(!empty($param["nama"])) {
			$flt = "nama = ".$param["nama"];
			$filter .= empty($filter) ? $flt : " and ".$flt;
		}
		if(!empty($param["search"])) {
			$flt  = "nama LIKE '%".$param["search"]."%'";
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

	public function SiswaAdd($param) {
		$Koneksi = $this->db;
		
		$data = [];
		$data["Target"] 	= "dt_siswa";
		$data["ParamsData"] = json_encode($param);
		$result = $this->databaseapi->InsertData($data, $Koneksi);
		
		ResultData:
		return $result;
	}

	public function SiswaEdit($param) {
		$id = $param["id"];
		$param = $this->func->UnsetArrayByKey($param, ["id"]);

		$data  				 = [];
		$data["Target"] 	 = "dt_siswa";
		$data["ParamsFilter"]= "id = ".$id;
		$data["ParamsData"]  = json_encode($param);
		$rdt = $this->databaseapi->UpdateData($data);

		ResultData:
		return $rdt;
	}
}
