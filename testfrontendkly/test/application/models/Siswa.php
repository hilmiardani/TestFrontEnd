<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Siswa extends CI_Model {

		private $user;
			
		public function __construct() {
			parent::__construct();
			$this->user = $this->session->userdata("user");
		}

		public function GetSiswa($param) {
			$args = ["user_key" => $this->user->user_key];

			if(!empty($param["filter"]["kywd"])) {
				$args["search"] = $param["filter"]["kywd"];
			}
			if(!empty($param["filter"]["id"])) {
				$args["id"] = $param["filter"]["id"];
			}
			if(!empty($param["filter"]["nis"])) {
				$args["nis"] = $param["filter"]["nis"];
			}
			if(!empty($param["filter"]["jurusan"])) {
				$args["jurusan"] = $param["filter"]["jurusan"];
			}
			if(!empty($param["filter"]["jk"])) {
				$args["jk"] = $param["filter"]["jk"];
			}
			if(isset($param["filter"]["status"]) and $param["filter"]["status"] != "") {
				$args["is_active"] = $param["filter"]["status"];
			}

			//Default
			if(!empty($param["Sort"]))  $args["Sort"] = $param["Sort"]; //Sorting
            if(!empty($param["Limit"])) $args["Limit"] = $param["Limit"]; //Limit
            if(!empty($param["Page"]))  $args["Page"] = $param["Page"]; //Limit

			$this->api->set("siswa/list", $args);
			return $this->api->exec();
		}

		public function HtmlSiswa($param) {
			$rHtml ="";

			$query = $this->GetSiswa($param);
			if($query->IsError == false) {
				if(!empty($query->Data)) {
					foreach ($query->Data as $item) {
						$is_active = ($item->is_active) ? "<span class='label label-success'>Aktif</span>": "<span class='label label-danger'>Tidak Aktif</span>"; 
						$rHtml .= '<tr>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars"></i></button>
                                                <ul class="dropdown-menu">
                                                    <li><a role="button" class="edit-data" data-idupdate="'.$item->id.'" href="'.base_url("siswa/edit.html?id=".$item->id."").'"><i class="fa fa-pencil"></i> Edit Siswa</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>'.$item->nama.'</td>
                                        <td>'.$item->ulangtahun.'</td>
                                        <td>'.$item->email.'</td>
                                        <td>'.$item->alamat.'</td>
                                    </tr>';
					}
				} else {
					$rHtml = "<tr><td colspan='10' class='text-center'><span class='label label-warning'>Tidak ada data</span></td></tr>";
				}
			} else {
				$rHtml = "<tr><td colspan='10' class='text-center'><span class='label label-warning'>".$query->ErrMessage."</span></td></tr>";
			}

			$Paging = (!empty($query->Paging)) ? $query->Paging : "";
            $ReturnData = ["lsdt" => $rHtml, "paging" => $Paging];
            return json_encode($ReturnData);
		}

		public function HtmlDropdownSiswa($param) {
			$rHtml ="";

			$query = $this->GetSiswa($param);
			if($query->IsError == false) {
				if(!empty($query->Data)) {
					foreach ($query->Data as $item) {
						 $rHtml .= '<option value="' . $item->nis . '">' . $item->nis . ' - ' . $item->nama .' </option>';
					}
				} else {
					$rHtml = '<option>Tidak ada data</option>';
				}
			} else {
				$rHtml = '<option>' . $query->ErrMessage . '</option>';
			}

			$Paging = (!empty($query->Paging)) ? $query->Paging : "";
            $ReturnData = ["lsdt" => $rHtml, "paging" => $Paging];
            return json_encode($ReturnData);
		}

		public function InsertSiswa($param) {
            $param['user_key'] = $this->user->user_key;

           	$this->api->set("siswa/add", $param);
           	$query = $this->api->exec();
			if($query->IsError == true) {
				$dataError = preg_match_all("!Parameter[\s+]\'([\w]+)!", $query->ErrMessage, $matches);
				if($dataError) {
					switch ($matches[1][0]) {
						case 'nama':
							return $this->foglobal->MakeJsonError("Nama Siswa tidak valid.");
							break;
						case 'user_key':
							return $this->foglobal->MakeJsonError("User Key tidak valid.");
							break;
					}
				}
			}
			return json_encode($query);
        }

        public function UpdateSiswa($id_update, $param) {
        	$param['user_key'] = $this->user->user_key;
        	$param['id'] = $id_update;

           	$this->api->set("siswa/edit", $param);
           	$query = $this->api->exec();
			if($query->IsError == true) {
				$dataError = preg_match_all("!Parameter[\s+]\'([\w]+)!", $query->ErrMessage, $matches);
				if($dataError) {
					switch ($matches[1][0]) {
						case 'id':
							return $this->foglobal->MakeJsonError("ID Siswa tidak valid.");
							break;
						case 'nama':
							return $this->foglobal->MakeJsonError("Nama Siswa tidak valid.");
							break;
						case 'user_key':
							return $this->foglobal->MakeJsonError("User Key tidak valid.");
							break;
					}
				}
			}
			return json_encode($query);
        }
	}
