<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Controller_tools extends REST_Controller {

	protected $methods = [
        "upload_image_post"  => ["level" => 1],
        "upload_file_post" 	 => ["level" => 1]
    ];

	public function __construct() {
		parent::__construct();
		$this->load->model("system/tools/upload");
	}

	public function upload_image_post() {
		$Output = $this->func->CheckParam(["FileBase64"]);

		if($Output["IsError"]) {
			$this->response($Output, REST_Controller::HTTP_OK);
		} else {
			$param = $this->input->post();
			$param["ServerDownload"] = 1;

			$Output = $this->upload->UploadImage($param);
			$this->response($Output, REST_Controller::HTTP_OK);
		}
	}

	public function upload_file_post() {
		$Output = $this->func->CheckParam(["FileBase64", "FileExtension"]);

		if($Output["IsError"]) {
			$this->response($Output, REST_Controller::HTTP_OK);
		} else {
			$param = $this->input->post();
			$param["ServerDownload"] = 1;

			$Output = $this->upload->UploadFile($param);
			$this->response($Output, REST_Controller::HTTP_OK);
		}
	}
}
