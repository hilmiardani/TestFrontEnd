<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function login($param) {
		$Koneksi = $this->db;
		if(!empty($param["db"])) {
			//Connect database ke 2
			$Koneksi = $this->func->KonekDatabaseSekolah($param["db"]);
			if(is_array($Koneksi) and $Koneksi["IsError"] == true) {
				$result_data = $Koneksi;
				goto ResultData;
			}
		} 
		
		if(!empty($param["db"])) $nama_table = "dt_pegawai";
		else $nama_table = "sys_users";

		$Koneksi->where("(username = '{$param["username"]}' or email = '{$param["username"]}')"); 
		$query = $Koneksi->get($nama_table);
		
		if(!$query) {
			$result_data = $this->func->CreateArray(true, $Koneksi->error()["message"]);
			goto ResultData;
		}

		if($query->num_rows() >= 1) {
			$result = $query->result_array();
			
			if(empty($result[0]["password"])) {
				$result_data = $this->func->CreateArray(true, "Username atau Password yang anda masukkan salah.");
				goto ResultData;
			}

			if(!password_verify($param["password"], $result[0]["password"])) { 
				$result_data = $this->func->CreateArray(true, "Username atau Password yang anda masukkan salah.");
				goto ResultData;
			}

			if($result[0]["is_active"] == false) {
				$result_data = $this->func->CreateArray(true, "User tidak aktif");
				goto ResultData;
			}

			if(!empty($result[0]["tgl_expired"]) and $result[0]["tgl_expired"] <= date("Y-m-d")) {
				$result_data = $this->func->CreateArray(true, "User telah kadaluarsa");
				goto ResultData;
			}

			$result_data = $result[0];
			$result_data["user_key"] = $this->func->CreateKeyByUser($param["username"], $Koneksi, $nama_table);
			$result_data = $this->func->CreateArray(false, $result_data);
		} else {
			$result_data = $this->func->CreateArray(true, "Username atau Password yang anda masukkan salah.");
		}

		ResultData:
		return $result_data;
	}
}
