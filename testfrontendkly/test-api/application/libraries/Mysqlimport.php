<?php 
set_time_limit(0);
/*
* ClassName: PHP MySQL Importer v2.0.1
* PHP class for importing big SQL files into a MySql server. 
* Author: David Castillo - davcs86@gmail.com  
* Hire me on: https://www.freelancer.com/u/DrAKkareS.html
* Blog: http://blog.d-castillo.info/
*/

class Mysqlimport { 
    public $hadErrors = false;
    public $errors = array();
    public $conn = null;

    public function connect($host, $user, $pass, $port = false) {
        if ($port==false){
            $port = ini_get("mysqli.default_port");
        }
        $this->hadErrors = false;
        $this->errors = array();
        $this->conn = new mysqli($host, $user, $pass, "", $port);
        if ($this->conn->connect_error) {
            $this->addError("Connect Error (".$this->conn->connect_errno.") ".$this->conn->connect_error);
        }
    }

    public function addError($errorStr){
        $this->hadErrors = true;
        $this->errors = "Import_SQLFile: ".$errorStr;
    }

    public function doImport($sqlFile, $database = "", $createDB = false, $dropDB = false) {    
        if ($this->hadErrors == false) {
            //Drop database if it's required
            if ($dropDB && $database!=""){
                if (!$this->conn->query("DROP DATABASE IF EXISTS ".$database)){
                    $this->addError("Query error (".$this->conn->errno.") ".$this->conn->error);
                }
            }
            //Create the database if it's required
            if ($createDB && $database!=""){
                if (!$this->conn->query("CREATE DATABASE IF NOT EXISTS ".$database)){
                    $this->addError("Query error (".$this->conn->errno.") ".$this->conn->error);
                }
            }
            //Select the database if it's required
            if ($database!=""){
                if (!$this->conn->select_db($database)){
                    $this->addError("Query error (".$this->conn->errno.") ".$this->conn->error);
                }
            }
        }
    }
}  
    
?> 
