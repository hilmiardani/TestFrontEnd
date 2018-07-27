<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Foprofil extends CI_Model {

		private $user;
			
		public function __construct() {
			parent::__construct();
			$this->user = $this->session->userdata("user");
			$this->load->model("fologin");
		}

		public function UploadImage($param) {
			$param['FolderName'] = "image-pengguna";
			$param['db'] = "";
			$param['FileBase64'] = $this->req['FileBase64'];
			
           	$this->api->set("tools/upload/image", $param);
           	$query = $this->api->exec();
           	if($query->IsError == true) {
           		$dataError = preg_match_all("!Parameter[\s+]\'([\w]+)!", $query->ErrMessage, $matches);
				if($dataError) {
					switch ($matches[1][0]) {
						case 'FileBase64':
							return $this->foglobal->MakeJsonError("FileBase64 tidak valid.");
							break;
					}
				}
           	}
           	return json_encode($query);
        }

        public function UpdatePengguna($id_update, $param) {
        	$param['user_key'] = $this->user->user_key;
        	$param['id_users'] = $id_update;

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
			else {
				$this->fologin->Relogin();
			}
			return json_encode($query);
        }

        public function UpdatePasswordPengguna($id_update, $param) {
        	$param['user_key'] = $this->user->user_key;
        	$param['id_users'] = $id_update['id'];
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
			else {
				$this->fologin->Relogin();
			}
			return json_encode($query);
        }
	}
