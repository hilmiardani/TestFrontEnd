<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/phpexcel/PHPExcel.php";
require_once APPPATH."/third_party/phpexcel/PHPExcel/IOFactory.php";

class Excel extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->model("system/mdkelas");
	}

	public function ExcelReader($param) {
		// Get Config
		if(!preg_match("!([\d+]|)(.*)!", $param["ExcelPath"])) {
			$result = $this->func->CreateArray(true, "Lokasi excel tidak valid. Mohon cek kembali. ([\d+]|)(.*)");
			goto ResultData;
		}
		if(empty($param["Sheet"])) {
			$param["Sheet"] = 1;
		}
		if(!is_numeric($param["Sheet"])) {
			$result = $this->func->CreateArray(true, "Sheet wajib numeric. ([\d+]|)(.*)");
			goto ResultData;
		}

		$File = $this->func->ConvertPathFile($param["ExcelPath"]);
        $DiskDownload = $this->config->item("DiskDownload");
        $PathDownloadFile = $this->config->item("PathDownloadFile");
        $PathDownloadImage = $this->config->item("PathDownloadImage");
        $FileServerLocation = $File[0];
        $FilePathLocation = $File[1];

        $FilePath = $DiskDownload[$FileServerLocation].$PathDownloadFile."/".$FilePathLocation;

        $param["Sheet"] = ($param["Sheet"] - 1);
        $result = $this->ReadExcel($FilePath, $param["Sheet"]);

        ResultData:
        return $result;
	}

	private function ReadExcel($path, $sheet) {
		try {
			$PHPExcel = PHPExcel_IOFactory::load($path);
			$PHPExcel->setActiveSheetIndex($sheet);

			$DateSheet  = $PHPExcel->getActiveSheet()->toArray(null,true,true,true);
			$ArrayCount = count($DateSheet);
			$Temp		= [];

			$n = 0;
			$show_column = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M"];
			for($i = 2; $i <= $ArrayCount; $i++){
				foreach ($show_column as $value) {
					if(!empty($DateSheet[$i][$value])) {
						if(!empty($DateSheet[1][$value])) $Temp[$n][$DateSheet[1][$value]] = $DateSheet[$i][$value];
					}
				}
				$n++;
			}
			$Temp = $this->func->CreateArray(false, $Temp);
		} catch(Exception $e) {
			$Temp = $this->func->CreateArray(true, $e->getMessage());
		}
		return $Temp;
	}

	public function ExcelTemplateDownload($param) {
		if ($param["nama_template"] == "EzySchool-Template-DataSiswa.xlsm") {
			return $this->ExcelTemplateDataSis($param);
		} else {
			return $this->ExcelTemplateDataDefault($param);
		}
	}

	private function ExcelTemplateDataSis($param) { //path dan db
		$path = $this->config->item("DiskExcelTemplate")."/".$param["nama_template"];
		if(!file_exists($path)) {
			return $this->func->CreateArray(true, "File yang di maksud tidak tersedia. (".__FUNCTION__.")"); 
		}

		$PHPExcel = PHPExcel_IOFactory::createReader("Excel2007");
		$PHPExcel = $PHPExcel->load($this->config->item("DiskExcelTemplate")."/".$param["nama_template"]);

		$WorkSheet= $PHPExcel->setActiveSheetIndex(0);

		//Set Dropdown data validation (Jenis Kelamin)
		for ($var = 2; $var <= 1000; $var++) {
			$DataValidation = $WorkSheet->getCell("D".$var)->getDataValidation();
			$DataValidation->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
			$DataValidation->setShowDropDown(true);
			$DataValidation->setFormula1("_DataValidation_JenisKelamin");
		}

		//Set Dropdown data validation (Kelas)
		for ($var = 2; $var <= 1000; $var++) {
			$DataValidation = $WorkSheet->getCell("E".$var)->getDataValidation();
			$DataValidation->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
			$DataValidation->setShowDropDown(true);
			$DataValidation->setFormula1("_DataValidation_Kelas");
		}

		//Set Sheet ke 2
		$WorkSheet= $PHPExcel->setActiveSheetIndex(1);
		$result = $this->mdkelas->KelasList([
			"db" 	=> $param["id_sekolah"],
			"Field" => "a.id as id_kelas, a.nama"
		]);

		//Set Data
		if($result["IsError"] == false) {
			if(empty($result["Data"])) {
				return $this->func->CreateArray(true, "Tidak ada data Kelas. Silahkan masukkan terlebih dahulu. Untuk mengunduh template");
			}

			$i = 2;
			foreach ($result["Data"] as $value) {
				$WorkSheet->setCellValue("A".$i, "({$value["id_kelas"]}) {$value["nama"]}")->setCellValue("B".$i, $value["id_kelas"]);
				$i++;
			}

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.ms-excel.sheet.macroEnabled.12');
			header('Content-Disposition: attachment;filename="'. $param["nama_template"] .'"');
			header('Cache-Control: max-age=0');

			$Writer = PHPExcel_IOFactory::createWriter($PHPExcel, "Excel2007");
			$Writer->save("php://output"); //C:/xampp/htdocs/ezyschool-cdn/system/files/
		}
	}

	private function ExcelTemplateDataDefault($param) {
		$path = $this->config->item("DiskExcelTemplate")."/".$param["nama_template"];
		if(!file_exists($path)) {
			return $this->func->CreateArray(true, "File yang di maksud tidak tersedia. (".__FUNCTION__.")"); 
		}

		$extensi = explode(".", $param["nama_template"]);
		$extensi = $extensi[1];

		if($extensi == "xlsx") {
			$Content_Type = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
		} else if($extensi == "xlsm") {
			$Content_Type = "application/vnd.ms-excel.sheet.macroEnabled.12";
		} else {
			return $this->func->CreateArray(true, "Format extensi file tidak valid.");
		}

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Description: File Transfer');
		header('Content-Type: '.$Content_Type);
		header('Content-Disposition: attachment;filename="'. basename($path) .'"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        readfile($path);
	}
}
