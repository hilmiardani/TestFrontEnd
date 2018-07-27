<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function UploadImage($param) {
		$param["SettingGambar"]  = json_encode(["type"=>"jpg"]);

		if($param["ServerDownload"] == 1) $param["db"] = "";
		if(empty($param["FolderName"])) 
			$param["FolderName"] = $param["db"]."/lainnya";
		else 
			$param["FolderName"] = $param["db"]."/".$param["FolderName"];

		if(empty($param["status"])) 
			$result = $this->fileapi->Image_Upload($param);
		else 
			$result = $this->fileapi->Back_Upload($param);


		ResultData:
		return $result;
	}

	public function UploadFile($param) {
		if($param["ServerDownload"] == 1) $param["db"] = "";
		if(empty($param["FolderName"])) 
			$param["FolderName"] = $param["db"]."/lainnya";
		else 
			$param["FolderName"] = $param["db"]."/".$param["FolderName"];

		$result = $this->fileapi->File_Upload($param);

		ResultData:
		return $result;
	}
}
