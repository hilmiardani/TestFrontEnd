<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keys extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function KeysList($param) {
		$data 			= [];
		$data["Target"] = "sys_keys";
		$filter 		= "";

		if(!empty($param["id_keys"])) {
			$flt = "id = ".$param["id_keys"];
			$filter .= empty($filter) ? $flt : " and ".$flt;
		}
		if(!empty($param["level"])) {
			$flt = "level = ".$param["level"];
			$filter .= empty($filter) ? $flt : " and ".$flt;
		}
		if(!empty($param["search"])) {
			$flt  = "MATCH(kunci, ip_addresses) AGAINST ('*".$param["search"]."*' IN BOOLEAN MODE)"; 
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

		$result = $this->databaseapi->GetData($data);

		ResultData:
		return $result;
	}

	public function KeysAdd($param) {
		$rdt = [];
		$data  				= [];
		$data["Target"] 	= "sys_keys";
		$data["ParamsData"] = json_encode($param);
		$rdt = $this->databaseapi->InsertData($data);

		ResultData:
		return $rdt;
	}

	public function KeysEdit($param) {
		$id = $param["id_keys"];
		$param = $this->func->UnsetArrayByKey($param, ["id_keys"]);

		$rdt = [];
		$data  				 = [];
		$data["Target"] 	 = "sys_keys";
		$data["ParamsFilter"]= "id = ".$id;
		$data["ParamsData"]  = json_encode($param);
		$rdt = $this->databaseapi->UpdateData($data);

		ResultData:
		return $rdt;
	}
}
