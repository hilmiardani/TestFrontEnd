// var base_url = location.origin,
var base_url = location.origin+"/testfrontendkly/test",
	pagename = "", cdn_url = location.origin+"/testfrontendkly/test-cdn";
var datanext = 0, dataprev = 0;
var request  = {"filter": {"kywd": ""}};
var act = "", getfunc = "";
var l = $(".ladda-button-submit").ladda();

$(document).ready(function() {
	if(jQuery().select2) {
		$(".select2-normal").select2();
		$(".select2-nosearch").select2({
			minimumResultsForSearch: Infinity
		});
	}
});

function ParseGambar(url) {
    if(/(http|https)/.test(url)) {
        url = url.replace("https", "http");
        return url;
    } else {
        url = url.replace("1|", "");
        return cdn_url + "/admin/images" + url;
    }
}

function empty(string) {
  return (string == undefined || string == "" || string == null);
}

function GetData(req = "", action = "", succsesfunc = "") {
	act = (action != "") ? action : "listdatahtml";

	$(".datatable tbody").html(loader(true));
	$.ajax({
		type: "POST",
		url: base_url + "/ajax/" + pagename,
		data: {act:act, req:req},
		dataType: "JSON",
		tryCount: 0,
		retryLimit: 3,
		success: function(resp){
			if(resp.paging.Total != undefined) {
				$(".datatable tbody").html(resp.lsdt);
				pagination(resp.paging);
				if(succsesfunc != "") {
					getfunc = succsesfunc;
					succsesfunc(resp);
				}
			} else {
				$(".datatable tbody").html(resp.lsdt);
				$(".pagination-layout").addClass("hidden");
			}
		},
		error: function(xhr, textstatus, errorthrown) {
			if(textstatus == "timeout") {
				this.tryCount++;
				if(this.tryCount <= this.retryLimit) {
					$.ajax(this);
				}
			}
		}
	});
}

function Login(selectorform, successfunc = "") {
	var captcha	   = $("#g-recaptcha-response").val();
	var formdata   = $(selectorform).serialize() + "&captcha=" + captcha + "&act=login";
	var formaction = $(selectorform).attr("action");
	$.ajax({
		type: "POST",
		url: base_url + "/ajax/ajax-login.html",
		data: formdata,
		dataType: "JSON",
		tryCount: 0,
		retryLimit: 3,
		beforeSend: function() {
			l.ladda("start");
		},
		success: function(resp){
			if(resp.IsError == false) {
				if(resp.lsdt == "success") window.location.href = base_url + "/siswa.html";
				if(resp.lsdt == "error") window.location.href = base_url + "/user/login.html";
			} else {
				$(".notifikasi").html(resp.lsdt);
				l.ladda("stop");
			}
			if(successfunc != "") {
				successfunc(resp);
			}
		},
		error: function(xhr, textstatus, errorthrown) {
			if(textstatus == "timeout") {
				this.tryCount++;
				if(this.tryCount <= this.retryLimit) {
					$.ajax(this);
				}
			}
		}
	});
}


function Forgot(selectorform, successfunc = "") {
	var captcha	   = $("#g-recaptcha-response").val();
	var formdata   = $(selectorform).serialize() + "&act=forgot_password";
	var formaction = $(selectorform).attr("action");
	$.ajax({
		type: "POST",
		url: base_url + "/ajax/ajax-login.html",
		data: formdata,
		dataType: "JSON",
		tryCount: 0,
		retryLimit: 3,
		beforeSend: function() {
			l.ladda("start");
		},
		success: function(resp){
			l.ladda("stop");
			if(resp.IsError == false) {
				$(".notifikasi").html(resp.lsdt);
			} else {
				$(".notifikasi").html(resp.lsdt);
			}
			if(successfunc != "") {
				successfunc(resp);
			}
		},
		error: function(xhr, textstatus, errorthrown) {
			if(textstatus == "timeout") {
				this.tryCount++;
				if(this.tryCount <= this.retryLimit) {
					$.ajax(this);
				}
			}
		}
	});
}

function ResetPass(selectorform, successfunc = "") {
	var captcha	   = $("#g-recaptcha-response").val();
	var formdata   = $(selectorform).serialize() + "&captcha=" + captcha + "&act=reset_password";
	var formaction = $(selectorform).attr("action");
	$.ajax({
		type: "POST",
		url: base_url + "/ajax/ajax-login.html",
		data: formdata,
		dataType: "JSON",
		tryCount: 0,
		retryLimit: 3,
		beforeSend: function() {
			l.ladda("start");
		},
		success: function(resp){
			l.ladda("stop");
			if(resp.IsError == false) {
				$(".notifikasi").html(resp.lsdt);
			} else {
				$(".notifikasi").html(resp.lsdt);
			}
			if(successfunc != "") {
				successfunc(resp);
			}
		},
		error: function(xhr, textstatus, errorthrown) {
			if(textstatus == "timeout") {
				this.tryCount++;
				if(this.tryCount <= this.retryLimit) {
					$.ajax(this);
				}
			}
		}
	});
}

function InsertData(selectorform, successfunc = "") {
	var formdata   = $(selectorform).serialize() +"&act=insertdata";
	var formaction = $(selectorform).attr("action");
	$.ajax({
		type: "POST",
		url: base_url + "/ajax/" + formaction,
		data: formdata,
		dataType: "JSON",
		tryCount: 0,
		retryLimit: 3,
		beforeSend: function() {
			l.ladda("start");
		},
		success: function(resp){
			l.ladda("stop");
			if(resp.IsError == false) {
				toastrshow("success", "Data berhasil disimpan", "Success");
				$(selectorform).parents(".modal").modal("hide"); //Tutup modal	
				
				if(successfunc != "") {
					successfunc(resp);
				}
			} else {
				toastrshow("error", resp.ErrMessage, "Error");
			}
		},
		error: function(xhr, textstatus, errorthrown) {
			if(textstatus == "timeout") {
				this.tryCount++;
				if(this.tryCount <= this.retryLimit) {
					$.ajax(this);
				}
			}
		}
	});
}

function UpdateData(selectorform, successfunc = "") {
	var formdata   = $(selectorform).serialize() +"&act=updatedata";
	var formaction = $(selectorform).attr("action");
	$.ajax({
		type: "POST",
		url: base_url + "/ajax/" + formaction,
		data: formdata,
		dataType: "JSON",
		tryCount: 0,
		retryLimit: 3,
		beforeSend: function() {
			l.ladda("start");
		},
		success: function(resp){
			l.ladda("stop");
			if(resp.IsError == false) {
				toastrshow("success", "Data berhasil disimpan", "Success");
				$(selectorform).parents(".modal").modal("hide"); //Tutup modal
				if(successfunc != "") {
					successfunc(resp);
				}
			} else {
				toastrshow("error", resp.ErrMessage, "Error");
			}
		},
		error: function(xhr, textstatus, errorthrown) {
			if(textstatus == "timeout") {
				this.tryCount++;
				if(this.tryCount <= this.retryLimit) {
					$.ajax(this);
				}
			}
		}
	});
}

function UpdatePassword(selectorform, successfunc = "") {
	var formdata   = $(selectorform).serialize() +"&act=updatepassword";
	var formaction = $(selectorform).attr("action");
	$.ajax({
		type: "POST",
		url: base_url + "/ajax/" + formaction,
		data: formdata,
		dataType: "JSON",
		tryCount: 0,
		retryLimit: 3,
		beforeSend: function() {
			l.ladda("start");
		},
		success: function(resp){
			l.ladda("stop");
			if(resp.IsError == false) {
				toastrshow("success", "Data berhasil disimpan", "Success");
				$(selectorform).parents(".modal").modal("hide"); //Tutup modal
				if(successfunc != "") {
					successfunc(resp);
				}
			} else {
				toastrshow("error", resp.ErrMessage, "Error");
			}
		},
		error: function(xhr, textstatus, errorthrown) {
			if(textstatus == "timeout") {
				this.tryCount++;
				if(this.tryCount <= this.retryLimit) {
					$.ajax(this);
				}
			}
		}
	});
}

function DeleteData(id_delete, page_name, successfunc = "") {
	$.ajax({
		type: "POST",
		url: base_url + "/ajax/" + page_name,
		data: {act:"deletedata", req: {"id": id_delete}},
		dataType: "JSON",
		tryCount: 0,
		retryLimit: 3,
		beforeSend: function() {
			l.ladda("start");
		},
		success: function(resp){
			l.ladda("stop");
			if(resp.IsError == false) {
				$(".modal-delete").modal("hide");
				toastrshow("success", "Data berhasil disimpan", "Success");
				if(successfunc != "") {
					successfunc(resp);
				}
			} else {
				toastrshow("error", resp.ErrMessage, "Error");
			}
		},
		error: function(xhr, textstatus, errorthrown) {
			if(textstatus == "timeout") {
				this.tryCount++;
				if(this.tryCount <= this.retryLimit) {
					$.ajax(this);
				}
			}
		}
	})
}

function getdatadropdownsiswa(selected = "") {
    $.ajax({
        type: "POST",
        url: base_url + "/ajax/ajax-siswa.html",
        data: {act:"listdropdownsiswa"},
        dataType: "JSON",
        tryCount: 0,
        retryLimit: 3,
        success: function(resp){
            if(resp.lsdt && resp.lsdt != "undefined") {
                var result  = "<option value=''>Pilih Siswa</option>";
                    result += resp.lsdt;
                
                $(".dropdown-siswa").html(result);

                if(selected != "") {
                	$(".dropdown-siswa").val(selected).trigger("change");
                }
            }
        },
        error: function(xhr, textstatus, errorthrown) {
            if(textstatus == "timeout") {
                this.tryCount++;
                if(this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                }
            }
        }
    });
}

function getdatadropdownjurusan(selected = "") {
    $.ajax({
        type: "POST",
        url: base_url + "/ajax/ajax-jurusan.html",
        data: {act:"listdropdownjurusan"},
        dataType: "JSON",
        tryCount: 0,
        retryLimit: 3,
        success: function(resp){
            if(resp.lsdt && resp.lsdt != "undefined") {
                var result  = "<option value=''>Pilih Jurusan</option>";
                    result += resp.lsdt;
                
                $(".dropdown-jurusan").html(result);

                if(selected != "") {
                	$(".dropdown-jurusan").val(selected).trigger("change");
                }
            }
        },
        error: function(xhr, textstatus, errorthrown) {
            if(textstatus == "timeout") {
                this.tryCount++;
                if(this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                }
            }
        }
    });
}

function getdatadropdownprovinsi(selected = "") {
    $.ajax({
        type: "POST",
        url: base_url + "/ajax/ajax-provinsi.html",
        data: {act:"listdropdownprovinsi"},
        dataType: "JSON",
        tryCount: 0,
        retryLimit: 3,
        success: function(resp){
            if(resp.lsdt && resp.lsdt != "undefined") {
                var result  = "<option value=''>Pilih Provinsi</option>";
                    result += resp.lsdt;
                
                $(".dropdown-provinsi").html(result);

                if(selected != "") {
                	$(".dropdown-provinsi").val(selected).trigger("change");
                }
            }
        },
        error: function(xhr, textstatus, errorthrown) {
            if(textstatus == "timeout") {
                this.tryCount++;
                if(this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                }
            }
        }
    });
}

function getdatadropdownprovinsi2(selected = "") {
    $.ajax({
        type: "POST",
        url: base_url + "/ajax/ajax-provinsi.html",
        data: {act:"listdropdownprovinsi"},
        dataType: "JSON",
        tryCount: 0,
        retryLimit: 3,
        success: function(resp){
            if(resp.lsdt && resp.lsdt != "undefined") {
                var result  = "<option value=''>Pilih Provinsi</option>";
                    result += resp.lsdt;
                
                $(".dropdown-provinsi2").html(result);

                if(selected != "") {
                	$(".dropdown-provinsi2").val(selected).trigger("change");
                }
            }
        },
        error: function(xhr, textstatus, errorthrown) {
            if(textstatus == "timeout") {
                this.tryCount++;
                if(this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                }
            }
        }
    });
}

function getdatadropdownkotakab(id_prov, selected = "") {
    $.ajax({
        type: "POST",
        url: base_url + "/ajax/ajax-kotakab.html",
        data: {act:"listdropdownkotakab", req: {"id_prov": id_prov}},
        dataType: "JSON",
        tryCount: 0,
        retryLimit: 3,
        success: function(resp){
            if(resp.lsdt && resp.lsdt != "undefined") {
                var result  = "<option value=''>Pilih Kota/Kabupaten</option>";
                    result += resp.lsdt;
                
                $(".dropdown-kotakab").html(result);

                if(selected != "") {
                	$(".dropdown-kotakab").val(selected).trigger("change");
                }
            }
        },
        error: function(xhr, textstatus, errorthrown) {
            if(textstatus == "timeout") {
                this.tryCount++;
                if(this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                }
            }
        }
    });
}

function getdatadropdownkotakab2(id_prov, selected = "") {
    $.ajax({
        type: "POST",
        url: base_url + "/ajax/ajax-kotakab.html",
        data: {act:"listdropdownkotakab", req: {"id_prov": id_prov}},
        dataType: "JSON",
        tryCount: 0,
        retryLimit: 3,
        success: function(resp){
            if(resp.lsdt && resp.lsdt != "undefined") {
                var result  = "<option value=''>Pilih Kota/Kabupaten</option>";
                    result += resp.lsdt;
                
                $(".dropdown-kotakab2").html(result);

                if(selected != "") {
                	$(".dropdown-kotakab2").val(selected).trigger("change");
                }
            }
        },
        error: function(xhr, textstatus, errorthrown) {
            if(textstatus == "timeout") {
                this.tryCount++;
                if(this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                }
            }
        }
    });
}

function getdatadropdownkecamatan(id_kota, selected = "", func = "") {
    $.ajax({
        type: "POST",
        url: base_url + "/ajax/ajax-kecamatan.html",
        data: {act:"listdropdownkecamatan", req: {"id_kota": id_kota}},
        dataType: "JSON",
        tryCount: 0,
        retryLimit: 3,
        success: function(resp){
            if(resp.lsdt && resp.lsdt != "undefined") {
                var result  = "<option value=''>Pilih Kecamatan</option>";
                    result += resp.lsdt;
                
                $(".dropdown-kecamatan").html(result);

                if(selected != "") {
                	$(".dropdown-kecamatan").val(selected).trigger("change");
                }
                if(!empty(func)) {
                	func(resp);
                }
            }
        },
        error: function(xhr, textstatus, errorthrown) {
            if(textstatus == "timeout") {
                this.tryCount++;
                if(this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                }
            }
        }
    });
}

function getdatadropdownkecamatan2(id_kota, selected = "", func = "") {
    $.ajax({
        type: "POST",
        url: base_url + "/ajax/ajax-kecamatan.html",
        data: {act:"listdropdownkecamatan", req: {"id_kota": id_kota}},
        dataType: "JSON",
        tryCount: 0,
        retryLimit: 3,
        success: function(resp){
            if(resp.lsdt && resp.lsdt != "undefined") {
                var result  = "<option value=''>Pilih Kecamatan</option>";
                    result += resp.lsdt;
                
                $(".dropdown-kecamatan2").html(result);

                if(selected != "") {
                	$(".dropdown-kecamatan2").val(selected).trigger("change");
                }
                if(!empty(func)) {
                	func(resp);
                }
            }
        },
        error: function(xhr, textstatus, errorthrown) {
            if(textstatus == "timeout") {
                this.tryCount++;
                if(this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                }
            }
        }
    });
}

function getdatabyid(id, successfunc) {
	$.ajax({
		type: "POST",
		url: base_url + "/ajax/" + pagename,
		data: {"act":"getdatabyid", req:id},
		tryCount: 0,
		retryLimit: 3,
		success: function(resp){
			if(resp == "nodata") {
				toastrshow("error", "Data tidak tersedia atau tidak ada", "Error");
			} else {
				resp = JSON.parse(resp);
				successfunc(resp);
			}
		},
		error: function(xhr, textstatus, errorthrown) {
			if(textstatus == "timeout") {
				this.tryCount++;
				if(this.tryCount <= this.retryLimit) {
					$.ajax(this);
				}
			}
		}
	});
}

function pagination(page) {
	var paginglayout = $(".pagination-layout");
	var infopage = page.InfoPage+" Records | "+page.JmlHalTotal+" Pages";
	
	paginglayout.removeClass("hidden");
	paginglayout.find("input[type='text']").val(page.HalKe);
	paginglayout.find("div.info").html(infopage);
	if(page.IsNext == true) {
		paginglayout.find(".btn.next").removeClass("disabled");
		paginglayout.find(".btn.last").removeClass("disabled");
		datanext = (page.HalKe + 1);
	} else {
		paginglayout.find(".btn.next").addClass("disabled");
		paginglayout.find(".btn.last").addClass("disabled");
		dataprev = 0;
	}
	if(page.IsPrev == true) {
		paginglayout.find(".btn.prev").removeClass("disabled");
		paginglayout.find(".btn.first").removeClass("disabled");
		dataprev = (page.HalKe - 1);
	} else {
		paginglayout.find(".btn.prev").addClass("disabled");
		paginglayout.find(".btn.first").addClass("disabled");
		dataprev = 0;
	}
}

function loader(withtable = false) {
	var html  = '';
	if(withtable == true) html += "<tr><td colspan='10' class='text-center'>";
	html += '<img src="'+base_url+'/assets/img/loading.gif" alt="Loading ..." style="width: 30px;">';
	if(withtable == true) html += "</td><td>";
	return html;
}

function toastrshow(type, title, message = "") {
	toastr.options = {
		closeButton: true,
		progressBar: true,
		showMethod: "slideDown",
		positionClass: "toast-top-right",
		timeOut: 4000,
		onclick: null,
		showMethod: "fadeIn",
		hideMethod: "fadeOut",
	}
	switch(type) {
		case "success" : toastr["success"](title, message);  break;
		case "info"    : toastr["info"](title, message);   	 break;
		case "warning" : toastr["warning"](title, message);	 break;
		case "error"   : toastr["error"](title, message);	 break;
		default		   : toastr["info"](title, message);	 break;
	}
}

function resetformvalue(selector) {
	$(selector).trigger("reset"); //Reset value di form. Kecuali Select2
	$(selector + " select").val("").trigger("change"); //Reset seluruh Select2 yang ada di form
}

function FormatAngka(angka) {
	var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2    = '';
    var prc     = 1;
    for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
            rev2 += '.';
        }
    }
    return rev2.split('').reverse().join('');
}

function CheckStrip(string) {
	return !empty(string)? string: "-";
}

$(".btn.next").click(function() {
	request["Page"] = datanext;;
	GetData(request, act, getfunc);
	
});

$(".btn.prev").click(function() {
	request["Page"] = dataprev;
	GetData(request, act, getfunc);
});

$(".btn.first").click(function() {
	request["Page"] = 1;
	GetData(request, act, getfunc);
});

$(".btn.last").click(function() {
	request["Page"] = "-1";
	GetData(request, act, getfunc);
});

$(".limit").change(function() {
	var limit = $(this).val();
	request["Limit"] = limit;
	GetData(request, act, getfunc);
});

$("#FrmGotoPage").submit(function() {
	var page = $(this).find("input[type='text']").val();
	request["Page"] = page;
	GetData(request, act, getfunc);
	return false;
});

$("#FrmSearch").submit(function() {
	var kywd = $(this).find(".kywd").val();
	request["filter"]["kywd"] = kywd;
	GetData(request, act, getfunc);
	return false;
});

//Fix Bug jQuery Validation in Select2
$(".select2-validate").on("select2:close", function (e) {  
	$(this).valid(); 
});

$(".copy-text").click(function() {
	$(this).select();
});