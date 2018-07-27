<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->foglobal->CheckSessionLogin();
	}

	public function index() {
		$this->load->view("siswa/index", array('siswa' => 'active'));
	}

	public function tambah() {
		$this->load->view("siswa/tambah", array('siswa' => 'active'));
	}

	public function edit($id) {
		$this->load->view("siswa/edit", array('siswa' => 'active', 'id' => $id));
	}

	public function detail($id) {
		$this->load->view("siswa/detail", array('siswa' => 'active', 'id' => $id));
	} 
}
