<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->foglobal->CheckSessionLogin();
	}

	public function index() {
		$this->load->view("profil/index");
	}
}
