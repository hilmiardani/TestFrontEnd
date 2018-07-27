<?php

/**
 * Created by PhpStorm.
 * User: Dimas
 * Date: 11/23/2016
 * Time: 12:40 PM
 */
class Fileapi extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function File_Upload($params){
        $Hasil["IsError"]=true;


        // Get Config
        $ServerDownload=$this->config->item("ServerDownload");
        if(!empty($params["ServerDownload"])) {
            $ServerDownload = $params["ServerDownload"];
        }
        $DiskDownload=$this->config->item("DiskDownload");
        $PathDownloadFile=$this->config->item("PathDownloadFile");
        $PathDownloadImage=$this->config->item("PathDownloadImage");



        // Nama file + Path
        $NamaFile=self::getGUID();
        $Tanggal=date("Ymd");
        $Directori=$DiskDownload[$ServerDownload].$PathDownloadFile."/".$params["FolderName"]."/".$Tanggal."/";
        $PathFile=$Directori.$NamaFile.".".$params["FileExtension"];

        $PutFile=self::forceFilePutContents($PathFile, base64_decode($params["FileBase64"]));
        $FinalPath=$ServerDownload."|"."/".$params["FolderName"]."/".$Tanggal."/".$NamaFile.".".$params["FileExtension"];

        if(!$PutFile){
            $Hasil["IsError"]=true;
            $Hasil["ErrMessage"]="Failed to upload file. (err: fileapi, path: ".$FinalPath.")";
            return $Hasil;
        } else {
            $Hasil["IsError"]=false;
            $Hasil["Output"]=$FinalPath;
        }

        return $Hasil;
    }

    public function File_Delete($params){
        $Hasil["IsError"]=true;

        // Get Config
        $DiskDownload=$this->config->item("DiskDownload");
        $PathDownloadFile=$this->config->item("PathDownloadFile");
        $PathDownloadImage=$this->config->item("PathDownloadImage");

        $FileServerLocation=$params["ServerFile"];
        $FilePathLocation=$params["PathFile"];

        $FilePath=$DiskDownload[$FileServerLocation].$PathDownloadFile."/".$FilePathLocation;

        chmod($FilePath, 0666);
        if(!unlink($FilePath)){
            $Hasil["IsError"]=true;
            $Hasil["ErrMessage"]="Unable remove file";
            return $Hasil;
        } else {
            $Hasil["IsError"]=false;
            $Hasil["Output"]="Successfully";
        }
        
        return $Hasil;

    }

    public function Image_Upload($params){
        $Hasil["IsError"]=true;


        // Get Config
        $ServerDownload=$this->config->item("ServerDownload");
        if(!empty($params["ServerDownload"])) {
            $ServerDownload = $params["ServerDownload"];
        }
        $DiskDownload=$this->config->item("DiskDownload");
        $PathDownloadFile=$this->config->item("PathDownloadFile");
        $PathDownloadImage=$this->config->item("PathDownloadImage");

        $ImageUploadConfig=$this->config->item("SettingImage");
        $WatermarkConfig=$ImageUploadConfig["watermark"];
        if(!empty($params["SettingGambar"])){
            $ImageUploadConfig=json_decode($params["SettingGambar"],true);
            $WatermarkConfig=array_merge($WatermarkConfig, $ImageUploadConfig["watermark"]);
            if(empty($ImageUploadConfig) || empty($ImageUploadConfig["type"])){
                $Hasil["IsError"]=true;
                $Hasil["ErrMessage"]="Invalid 'SettingGambar' value is json data";
            }
        }


        // Nama file + Path
        $NamaFile=self::getGUID().".".$ImageUploadConfig["type"];
        $Tanggal=date("Ymd");
        $Directori=$DiskDownload[$ServerDownload].$PathDownloadImage."/".$params["FolderName"]."/".$Tanggal."/";
        $PathFile=$Directori."/original/".$NamaFile;

        // upload to original file
        $PutFile=self::forceFilePutContents($PathFile, base64_decode($params["FileBase64"]));
        $FinalPath=$ServerDownload."|"."/".$params["FolderName"]."/".$Tanggal."/original/".$NamaFile;

        if(!$PutFile){
            $Hasil["IsError"]=true;
            $Hasil["ErrMessage"]="Failed to upload image. (err: fileapi, path: ".$FinalPath.")";
        } else {
            $Hasil["IsError"]=false;
            $Hasil["Output"]=$FinalPath;
        }

        // Add Watermark

//        return;
        if($WatermarkConfig["use"] && !empty($WatermarkConfig)){
            if(!self::doWatreMark($PathFile,$WatermarkConfig)){
                $Hasil["IsError"]=true;
                $Hasil["ErrMessage"]="Failed add watermark";
            } else {
                $Hasil["IsError"]=false;
                $Hasil["Output"]=$FinalPath;
            }
        } 

        // Looping sesuai banyak ukuran
        foreach ($ImageUploadConfig["size"] as $key=>$value) {
            $NewPath=$Directori.$key."/".$NamaFile;
            self::doResizeImage($PathFile,$NewPath,$value["height"],$value["width"],$value["quality"]);
        }

        return $Hasil;
    }

    public function Back_Upload($params){
        $Hasil["IsError"]=true;


        // Get Config
        $ServerDownload=$this->config->item("ServerDownload");
        if(!empty($params["ServerDownload"])) {
            $ServerDownload = $params["ServerDownload"];
        }
        $DiskDownload=$this->config->item("DiskDownload");
        $PathDownloadImage=$this->config->item("PathDownloadImage");

        $ImageUploadConfig=$this->config->item("SettingImage");
        $WatermarkConfig=$ImageUploadConfig["watermark"];
        if(!empty($params["SettingGambar"])){
            $ImageUploadConfig=json_decode($params["SettingGambar"],true);
            $WatermarkConfig=array_merge($WatermarkConfig, $ImageUploadConfig["watermark"]);
            if(empty($ImageUploadConfig) || empty($ImageUploadConfig["type"])){
                $Hasil["IsError"]=true;
                $Hasil["ErrMessage"]="Invalid 'SettingGambar' value is json data";
            }
        }


        // Nama file + Path
        if($params["id"] == 1) {
            $NamaFile="background-1.".$ImageUploadConfig["type"];
        } else if($params["id"] == 2) {
            $NamaFile="background-2.".$ImageUploadConfig["type"];
        }
        $Directori=$DiskDownload[$ServerDownload].$PathDownloadImage."/".$params["FolderName"]."/";
        $PathFile=$Directori.$NamaFile;

        // upload to original file
        $PutFile=self::forceFilePutContents($PathFile, base64_decode($params["FileBase64"]));
        $FinalPath=$ServerDownload."|"."/".$params["FolderName"]."/".$NamaFile;

        if(!$PutFile){
            $Hasil["IsError"]=true;
            $Hasil["ErrMessage"]="Failed to upload image. (err: fileapi, path: ".$FinalPath.")";
        } else {
            $Hasil["IsError"]=false;
            $Hasil["Output"]=$FinalPath;
        }

        // Add Watermark

//        return;
        if($WatermarkConfig["use"] && !empty($WatermarkConfig)){
            if(!self::doWatreMark($PathFile,$WatermarkConfig)){
                $Hasil["IsError"]=true;
                $Hasil["ErrMessage"]="Failed add watermark";
            } else {
                $Hasil["IsError"]=false;
                $Hasil["Output"]=$FinalPath;
            }
        } 

        // Looping sesuai banyak ukuran
        foreach ($ImageUploadConfig["size"] as $key=>$value) {
            $NewPath=$Directori.$key."/".$NamaFile;
            self::doResizeImage($PathFile,$NewPath,$value["height"],$value["width"],$value["quality"]);
        }

        return $Hasil;
    }

    public function Image_Delete($params){
        $Hasil["IsError"]=true;

        // Get Config
        $DiskDownload=$this->config->item("DiskDownload");
        $PathDownloadFile=$this->config->item("PathDownloadFile");
        $PathDownloadImage=$this->config->item("PathDownloadImage");

        $FileServerLocation=$params["ServerImage"];
        $FilePathLocation=$params["PathImage"];

        $FilePath=$DiskDownload[$FileServerLocation].$PathDownloadImage."/".$FilePathLocation;

        chmod($FilePath, 0666);
        if(!unlink($FilePath)){
            $Hasil["IsError"]=true;
            $Hasil["ErrMessage"]="Unable remove image";
            return $Hasil;
        }

        $Hasil["IsError"]=false;
        $Hasil["Output"]="Successfully";
        return $Hasil;

    }

    private function getGUID(){
//        if (function_exists('com_create_guid')){
//            return com_create_guid();
//        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid =
                substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
//                .chr(125);
            return strtolower($uuid);
//        }
    }


    /**
     * create file with content, and create folder structure if doesn't exist
     * @param String $filepath
     * @param String $file
     * @return boolean
     */
    private function forceFilePutContents ($filepath, $file){
        try {
            $isInFolder = preg_match("/^(.*)\/([^\/]+)$/", $filepath, $filepathMatches);
            if($isInFolder) {
                $folderName = $filepathMatches[1];
                $fileName = $filepathMatches[2];
                if (!is_dir($folderName)) {
                    mkdir($folderName, 0777, true);
                }
            }
            if(file_put_contents($filepath, $file)){
                return true;
            }else{
                return false;
            }
        } catch (Exception $e) {
            return false;
            echo "ERR: error writing '$file' to '$filepath', ". $e->getMessage();
        }
    }


    private function doWatreMark($source,$configwatermark){

//        echo BASEPATH.'../assets/portfolio/';
        $this->load->library('image_lib');
        $config['source_image'] = $source;

        $WaterMarkFile=$this->config->item("PathWatermark").$configwatermark["filewatermark"];

        // check apakah ada file watermark
        if(!is_file($WaterMarkFile)){
            $config['wm_overlay_path'] = $this->config->item("PathWatermarkImage");
        }

        $config['wm_type'] = 'overlay';
        $config['wm_opacity']   = '25';
        $config['wm_x_transp'] = '9';
        $config['wm_y_transp'] = '9';
        $config['wm_vrt_alignment'] = $configwatermark["vrt_alignment"];
        $config['wm_hor_alignment'] = $configwatermark["hor_alignment"];
        $this->image_lib->initialize($config);
        $this->image_lib->watermark();
        $this->image_lib->clear();
        return true;
    }

    private function doResizeImage($source,$newpath,$height,$width,$quality){
        $this->load->library('image_lib');

        // create a folder
        $isInFolder = preg_match("/^(.*)\/([^\/]+)$/", $newpath, $filepathMatches);
        if($isInFolder) {
            $folderName = $filepathMatches[1];
            $fileName = $filepathMatches[2];
            if (!is_dir($folderName)) {
                mkdir($folderName, 0777, true);
            }
        }


        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = $width;
        $config['height']       = $height;
        $config['quality']       = $quality;
        $config['new_image'] = $newpath;

        $this->image_lib->initialize($config);

//        $this->image_lib->clear();
        $this->image_lib->resize();
        $this->image_lib->clear();

//        return true;
    }
}