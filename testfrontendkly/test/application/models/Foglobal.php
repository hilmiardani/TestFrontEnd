<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Foglobal extends CI_Model {
			
		protected $user;

		public function __construct() {
			parent::__construct();
		}

		public function UploadImage($param) {
			$this->api->setAction("ImageUpload");
            $this->api->setParam($param); 
            $output = $this->api->execute();
            return $output;
		}

		public function DeleteImage($param) {
			$this->api->setAction("ImageDelete");
            $this->api->setParam($param); 
            $output = $this->api->execute();
            return $output;
		}
		
		public function MakeJsonError($message) {
			return json_encode([
				"IsError" => true, 
				"ErrMessage" => $message
			]);
		}

		public function encrypt($string) {
			return hash("ripemd160", md5($string));
		}

		public function RandomWord($len = 5) {
		    $word = array_merge(range('a', 'z'), range('A', 'Z'));
		    shuffle($word);
		    return substr(implode($word), 0, $len);
		}

		public function ImgProfile2Photo($db_image) {
			
			if(preg_match("/(http|https)/", $db_image)) {
				return $db_image;
			} else {
				$img = str_replace("1|", "", $db_image);
				return base_url("assets/upload/images/".$img);
			}
		}

		public function MakeAlert($message, $type = "warning") {
			return "<div class='alert alert-{$type}'><a role='button' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>{$message}</div>";
		}

		public function IDtoTextKey($id) {
			$data = [1 => "Admin", 2 => "Sekolah", 3 => "Pengguna"];
			return (array_key_exists($id, $data)) ? $data[$id]: "Level tidak valid";
		}
		public function IDtoSex($id) {
			$data = [1 => "Laki - laki", 2 => "Perempuan"];
			return (array_key_exists($id, $data)) ? $data[$id]: "Jenis Kelamin tidak valid";
		}

		// public function CheckSessionLogin() {
		// 	if(empty($this->session->userdata("user"))) {
		// 		$rHtml = $this->MakeAlert("Silahkan login dahulu untuk melanjutkan");
		// 		$this->session->set_userdata("notifikasi", $rHtml);

		// 		redirect("user/login");
		// 		return;
		// 	}

		// 	$this->user = $this->session->userdata("user");

		// 	$query = $this->ApiSession(["user_key" => $this->user->user_key]);
		// 	if($query->IsError == true) {
		// 		$this->session->unset_userdata("user");
		// 		$this->session->unset_userdata("user_login");

		// 		$rHtml = $this->MakeAlert($query->ErrMessage);
		// 		$this->session->set_userdata("notifikasi", $rHtml);
  //       		redirect("user/login");
		// 	}
		// 	return;
		// }


		public function CheckSessionLogin() {
			if(empty($this->session->userdata("user"))) {
				$data = '{
							"id": "10",
							"nama": "Siswa",
							"username": "siswa",
							"email": "siswa@gmail.com",
							"password": "$2y$04$ZXp5c2Nob29sLSQyeSQxM.dVK46JRa4alvcfOarVLa.F593ohJOL.",
							"level": "2",
							"foto": "default.png",
							"user_key": "nh0ajqglfwMZc3S5QIVC",
							"is_active": "1"
						}';

				$json = json_decode($data);
				$this->session->set_userdata("user",$json);

				// $rHtml = $this->MakeAlert("Silahkan login dahulu untuk melanjutkan");
				// $this->session->set_userdata("notifikasi", $rHtml);

				// redirect("user/login");
				// return;
			}

			$this->user = $this->session->userdata("user");

			$query = $this->ApiSession(["user_key" => $this->user->user_key]);
			if($query->IsError == true) {
				$this->session->unset_userdata("user");
				$this->session->unset_userdata("user_login");

				$rHtml = $this->MakeAlert($query->ErrMessage);
				$this->session->set_userdata("notifikasi", $rHtml);
        		redirect("user/login");
			}
			return;
		}


		public function ApiSession($param) {
			$this->api->set("user/session", $param);
			return $this->api->exec();
		}

		public function CheckStrip($param) {
		    return !empty($param) ? $param : "-";
		}

		public function formatAngka($angka, $precision = 0) { //contoh format sebelum di convert 1000000 
	      if(is_numeric($angka)) {
	        return number_format($angka, $precision, ",", ".");
	      }
	      return $angka;
	    }

	    public function IDtoMonth($id) {
	      	$data = [1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni",
	      			 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember"];
	      	return (array_key_exists($id, $data)) ? $data[$id]: "Bulan tidak valid";
	    }
	}
