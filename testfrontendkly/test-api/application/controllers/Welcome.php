<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/phpexcel/PHPExcel/IOFactory.php";

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		redirect("https://www.google.com");
	}
}
