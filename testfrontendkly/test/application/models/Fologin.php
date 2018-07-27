<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Fologin extends CI_Model {
			
		public function __construct() {
			parent::__construct();
		}
		
		//////////////// Login and Relogin //////////////////
		public function Login($param) {
        	if(empty($param)){
				$param['username'] = $this->form['username'];
        		$param['password'] = $this->form['password'];
        	}

			$this->api->set("user/login", $param);
			return $this->api->exec();
		}	

		public function LoginProcess($captcha, $param) {

			$UserData = $this->Login($param);
			$IsError  = $UserData->IsError;

			if($UserData->IsError == false) {
				if(empty($UserData->Data)) {
					$IsError = true;
					$rHtml = $this->foglobal->MakeAlert("Alamat email/password tidak valid.");
					goto returnData;
				}

				if($UserData->Data->is_active == 0) {
					$IsError = true;
					$rHtml = $this->foglobal->MakeAlert("Akun tidak aktif. Silahkan hubungi Administrator untuk tindakan lebih lanjut.");
					goto returnData;
				}

				if(!empty($UserData->Data->tgl_expired) and $UserData->Data->tgl_expired < date("Y-m-d")) {
					$IsError = true;
					$rHtml = $this->foglobal->MakeAlert("Akun telah expired. Silahkan hubungi Administrator untuk tindakan lebih lanjut.");
					goto returnData;
				}
				
				$Data = $UserData->Data;

				$rHtml = "success";
				if(empty($this->session->set_userdata)) {
					$this->session->set_userdata(["user" => $Data, "user_login" => $param]);
				}
				else {
					$this->session->sess_destroy();
					$this->session->set_userdata(["user" => $Data, "user_login" => $param]);
				}

			} else {
				$rHtml = "error";
				$UserData->IsError = true;
				$rHtml = $this->foglobal->MakeAlert("Error: {$UserData->ErrMessage}.");
			}

			returnData:
			$ReturnData = ["IsError" => $IsError, "lsdt" => $rHtml];
			return json_encode($ReturnData);
		}

		public function ReLogin() {
			$captcha = "tanpa_captcha";
			if(empty($this->session->userdata("user_login"))) return true;
			else {
				$user_login = $this->session->userdata("user_login");
				$UserData = $this->LoginProcess($captcha, $user_login);
				return false;
			}
		}

		//////////////// Forgot Password //////////////////
		public function Forgot($param) {
			$param['reset_url'] = base_url("user/reset");
        	$param['email'] = $this->form['email']; //Mendeteksi email

			$this->api->set("user/reset/password", $param);
			return $this->api->exec();
		}

		public function ForgotProcess($param) {
			if(empty($param["email"])) {
				$IsError = true;
				$rHtml = $this->foglobal->MakeAlert("Silahkan masukkan alamat email.");
				goto returnData;
			} else {
				$CheckUser = $this->Forgot(["email" => $param["email"]]); //Errornya disini
				if($CheckUser->IsError == false) {
					$IsError = false;
					$rHtml = $this->foglobal->MakeAlert("Email telah terkirim. Silahkan periksa kotak masuk/spam dan klik link untuk aksi selanjutnya", "success");
				} else {
					$IsError = true;
					$rHtml = $this->foglobal->MakeAlert("<strong>Opps!</strong> Error : {$CheckUser->ErrMessage}.");
				}
			}

			returnData:
			$Paging = (!empty($CheckUser->Paging)) ? $CheckUser->Paging : "";
			$ReturnData = ["IsError" => $IsError, "lsdt" => $rHtml, "paging" => $Paging];
			return json_encode($ReturnData);
		}

		//////////////// Reset Password //////////////////
		public function Reset() {
			$param['user_key'] = $this->form['user_key'];
	        $param['password1'] = $this->form["newpass1"];
        	$param['password2'] = $this->form["newpass2"];

           	$this->api->set("user/edit/password", $param);
			return $this->api->exec();
		}

		public function ResetProcess($captcha, $param) {
			// if(empty($captcha)) {
			// 	$IsError = true;
			// 	$rHtml = $this->foglobal->MakeAlert("Mohon masukkan captcha dengan benar");
			// 	goto returnData;
			// } else {
			// 	$response = $this->recaptcha->verifyResponse($captcha);
			// 	if($response["success"] === false) {
			// 		$IsError = true;
			// 		$rHtml = $this->foglobal->MakeAlert("Mohon masukkan captcha dengan benar");
			// 		goto returnData;
			// 	}
			// }

	        if(empty($param["newpass1"]) or empty($param["newpass2"])) {
				$IsError = true;
	            $rHtml = $this->foglobal->MakeAlert("Mohon masukkan password dengan benar");
	            goto returnData;
	        }
	        else if($param["newpass1"] != $param["newpass2"]) {
	        	$IsError = true;
	            $rHtml = $this->foglobal->MakeAlert("Password baru tidak sama. Mohon periksa kembali");
	            goto returnData;
	        }

	        else {
	        	$CheckUser = $this->Reset();
	        	if($CheckUser->IsError == false) {
	        		$IsError = false;
	        		$rHtml = $this->foglobal->MakeAlert("Password sudah diganti. Sekarang Anda dapat masuk ke sistem", "success");
	        	} else {
	        		$IsError = true;
	        		$dataError = preg_match_all("!Parameter[\s+]\'([\w]+)!", $CheckUser->ErrMessage, $matches);
	        		if($dataError) {
	        			switch ($matches[1][0]) {
	        				case 'password1':
	        					$rHtml = $this->foglobal->MakeAlert("Password Pengguna tidak valid.");
	        					break;
	        				case 'password2':
	        					$rHtml = $this->foglobal->MakeAlert("Password Pengguna tidak valid.");
	        								break;
	        				case 'user_key':
	        					$rHtml = $this->foglobal->MakeAlert("User Key tidak valid.");
	        					break;
	        			}
	        		}
	        		$rHtml = $this->foglobal->MakeAlert("<strong>Opps!</strong> Error : {$CheckUser->ErrMessage}.");
	        	}		     
	        }

	        returnData:
			$Paging = (!empty($CheckUser->Paging)) ? $CheckUser->Paging : "";
			$ReturnData = ["IsError" => $IsError, "lsdt" => $rHtml, "paging" => $Paging];
			return json_encode($ReturnData);
		}

		//////////// Update Data and Password //////////////
		public function UpdatePengguna($id_update, $param) {
        	$param['user_key'] = $this->user->user_key;
        	// $param['id_users'] = $id_update;

           	$this->api->set("user/edit", $param);
			$query = $this->api->exec();
			if($query->IsError == true) {
				$dataError = preg_match_all("!Parameter[\s+]\'([\w]+)!", $query->ErrMessage, $matches);
				if($dataError) {
					switch ($matches[1][0]) {
						case 'id_users':
							return $this->foglobal->MakeJsonError("ID Pengguna tidak valid.");
							break;
						case 'user_key':
							return $this->foglobal->MakeJsonError("User Key tidak valid.");
							break;
					}
				}
			}
			return json_encode($query);
        }

        public function UpdatePasswordPengguna($id_update, $param) {
        	$param['user_key'] = $this->user->user_key;
        	// $param['id_users'] = $id_update['id'];
        	$param['password1'] = $id_update['password1'];
        	$param['password2'] = $id_update['password2'];

           	$this->api->set("user/edit/password", $param);
			$query = $this->api->exec();
			if($query->IsError == true) {
				$dataError = preg_match_all("!Parameter[\s+]\'([\w]+)!", $query->ErrMessage, $matches);
				if($dataError) {
					switch ($matches[1][0]) {
						case 'id_users':
							return $this->foglobal->MakeJsonError("ID Pengguna tidak valid.");
							break;
						case 'password1':
							return $this->foglobal->MakeJsonError("Password Pengguna tidak valid.");
							break;
						case 'password2':
							return $this->foglobal->MakeJsonError("Password Pengguna tidak valid.");
							break;
						case 'user_key':
							return $this->foglobal->MakeJsonError("User Key tidak valid.");
							break;
					}
				}
			}
			return json_encode($query);
        }
	}
