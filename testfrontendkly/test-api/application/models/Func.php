<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Func extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function HashPass($string) {
		$options = [
		    "cost" => 4,
		    "salt" => "persdisenlekal-$2y$10$1PVmIRpK",
		];
		return password_hash($string, PASSWORD_BCRYPT, $options);
	}

	public function CheckParam($param, $table = "sys_users", $hak_akses = false) {
		$id = "";
		$db = false;
		$result = false;

		$this->CleanParamSqlInjection();
		foreach ($param as $key => $value) {
			if(empty($this->input->post($value))) {
				$msg = $this->CreateArray(true, "Parameter '".$value."' wajib diisi");
				return $msg;
			}

			if($value == "user_key") {
				if(!$db) $db = $this->db;

				$key   = $this->input->post($value);
				$query = $this->CheckUserKey($key, $hak_akses, $db, $table);
				unset($_POST["user_key"]);

				if($query["IsError"] == true) {
					$msg = $this->CreateArray(true, $query["ErrMessage"]);
					return $msg;
				}  else {
					$result = $query;
				}
			}
		}
		return $result;
	}

	//Escaping sting. supaya gak kena sql_injection
	public function CleanParamSqlInjection() {
		foreach($_POST as $key => $value) {
			$_POST[$key] = $this->db->escape_str($_POST[$key]);
		}
		return true;
	}

	public function GetDateLastMonth($format = false) {
		if(!$format) $format = "Y-n-j";
		return date($format, strtotime("last day of this month"));
	}

	public function GetUserKeyByEmail($email) {
		$db = $this->db;

		$db->select("user_key");
		$db->where("email = '".$email."'");
		$query = $db->get("sys_users");
		if(!$query) {
			$result = $this->func->CreateArray(true, "Gagal melakukan kueri ke database. (err: GetKey)");
		} else {
			if($query->num_rows() < 1) {
				$result = $this->func->CreateArray(true, "User tidak ditemukan. Mohon check kembali (user: ".$email.")");
			} else {
				$result = $query->result_array();
				$result = $this->func->CreateArray(false, $result[0]["user_key"]);
			}
		}

		return $result;
	}

	public function CreateArray($is_error, $message) {
		if($is_error == true) {
			$ReturnData = ["IsError"=> $is_error, "ErrMessage"=> $message];
		} else {
			if(is_array($message)) $ReturnData = ["IsError"=> $is_error, "Data"=> $message];
			else $ReturnData = ["IsError"=> $is_error, "Output"=> $message];
		}
		return $ReturnData;
	}

	public function CreateKeyByUser($user, $db, $table) {
		$key = random_string("alnum", 20);
		$rdt = ["user_key" => $key];

		if($table != "dt_siswa") $db->where("username", $user);
		else $db->where("nis", $user);
		
		$db->update($table, $rdt);
		return $key;
	}

	public function CheckUserKey($key, $hak_akses = false, $db, $table) {
		if($table == "dt_siswa") $new_column = ", nis";
		else $new_column = "";

    	$db->select("id, nama".$new_column);
		$db->where("user_key", $key);
		$db->where("is_active", "1");
		
		if($hak_akses) {
			$hak_akses = implode(",", $hak_akses);
			$db->where("hak_akses NOT IN (".$hak_akses.")"); //Sing gak oleh ngakses
		}

		$query = $db->get($table);
		if(!$query) {
			$result = $this->CreateArray(true, $db->error()["message"]);
		} else {
			if($query->num_rows() >= 1) {
				$data   = $query->result_array();
				if($table == "dt_siswa") $id = $data[0]["nis"];
				else $id = $data[0]["id"];

				$result = $this->CreateArray(false, $id);
			} else {
				$result = $this->CreateArray(true, "Sesi User telah habis atau Pengguna lainnya telah login"); //Invalid User Key. Key tidak ditemukan
			}
		}
		return $result;
    }
	
    public function UnsetArrayByKey($data, $unset_data) {
    	foreach ($data as $key => $value) {
    		if(in_array($key, $unset_data, true)) {
    			unset($data[$key]);
    		}
    	}
    	return $data;
    }

    public function IsValidDate($date, $format) {
    	$d = DateTime::createFromFormat($format, $date);
   		return $d && $d->format($format) === $date;
    }

    public function ConvertPathFile($path) {
    	return explode("|", $path);
    }

    public function GetSunday($y,$m){ 
	    $date = "$y-$m-01";
	    $first_day = date('N',strtotime($date));
	    $first_day = 7 - $first_day + 1;
	    $last_day =  date('t',strtotime($date));
	    $days = array();
	    for($i=$first_day; $i<=$last_day; $i=$i+7 ){
	        $days[] = $i;
	    }
	    return  $days;
	}

	public function FirebaseApi($param) {
		$headers= ["Authorization: key=".$this->config->item("firebase_server_key"), "Content-Type: application/json"];
		$notification = [
			"title"=> $param["subyek"],
			"body"=> $param["pesan"],
			"vibrate"=> 1,
			"sound"=> 1
		];
		$fields = [
			"to"=> (!empty($param["topics"]))? $param["topics"]: $param["registration_id"], 
			"notification"=> $notification
		];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		$info	= curl_getinfo($ch);
		curl_close($ch);
		return json_decode($result, true);
	}

	function removeslashes($string) {
	    $string=implode("",explode("\\",$string));
	    return stripslashes(trim($string));
	}
}
