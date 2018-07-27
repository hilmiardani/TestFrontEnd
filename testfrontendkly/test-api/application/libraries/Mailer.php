<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');

	include_once APPPATH.'/third_party/phpmailer/PHPMailerAutoload.php';

	class Mailer {
		
		protected $mail;

		public function __construct() {
			$this->mail = new PHPMailer;
		}
		
		public function add() {
			return $this->mail;
		}
	}