<?php
    $user = $this->session->userdata("user");
    // print_r($this->session->userdata("user"));
    // print_r($this->session->userdata("user_login"));
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Profil</title>
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="" name="description">

        <link href="<?php echo base_url("assets/css/font.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/css/font-awesome.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">
        
        <link href="<?php echo base_url("assets/plugins/simple-line-icons/simple-line-icons.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/plugins/bootstrap-switch/bootstrap-switch.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/plugins/toastr/toastr.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/plugins/select2/select2.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/plugins/select2/select2-bootstrap.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/plugins/ladda/ladda-themeless.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/plugins/jquery-cropper/cropper.min.css"); ?>" rel="stylesheet">
    
        <link href="<?php echo base_url("assets/css/components-rounded.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/css/plugins.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/css/layout.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/css/default.min.css"); ?>" id="style_color" rel="stylesheet">
        <link href="<?php echo base_url("assets/css/profile.min.css"); ?>" id="style_color" rel="stylesheet">
        <link href="<?php echo base_url("assets/css/custom.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/css/responsive.css"); ?>" rel="stylesheet">

        <link rel="shortcut icon" href="<?php echo base_url("assets/img/favicon.ico"); ?>">
        <link rel="icon" type="image/png" href="<?php echo base_url("assets/img/favicon-32x32.png"); ?>" sizes="32x32" />
        <link rel="icon" type="image/png" href="<?php echo base_url("assets/img/favicon-16x16.png"); ?>" sizes="16x16" />
    </head><!-- END HEAD -->
    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
        <?php $this->load->view("other/header") ?>

        <div class="page-container">
            <?php $this->load->view("other/sidebar") ?>

            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-head">
                        <div class="row">
                            <div class="col-md-4 col-sm-9 col-xs-12">
                                <div class="page-title">
                                    <h1>Profil</h1>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-3 col-xs-12 text-right">
                                <div class="pencarian-layout form-inline">
                                    <div class="form-group text-center">
                                        <a role="button" class="btn btn-primary" onclick="location.reload();">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="base-content">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-sidebar">
                                    <div class="portlet light profile-sidebar-portlet bordered">
                                        <div class="profile-userpic">
                                            <img class="img-responsive fotoprof" alt="">
                                        </div>
                                        <div class="profile-usertitle">
                                            <div class="profile-usertitle-name"><?php echo $user->nama; ?></div>
                                            <div class="profile-previlage">Administrator</div>
                                        </div>
                                        <!-- <div class="profile-about text-center">
                                            <span class="profile-desc-text">Programmer</span>
                                        </div> -->
                                        <!-- <div class="profile-usermenu">
                                            <ul class="nav">
                                                <li>
                                                    <a role="button" class="close-account">
                                                        <i class="fa fa-laptop"></i> Administrator
                                                    </a>
                                                </li>
                                            </ul>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="portlet light bordered">
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form id="FrmSaveUserProf" action="ajax-profil.html" role="form">
                                                    <div class="form-group">
                                                        <label>Nama <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Nama" name="form[nama]" value="<?php echo $user->nama; ?>" required>
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label>Username <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Username" name="form[username]" value="<?php echo $user->username; ?>" required>
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label>Email <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" placeholder="Email" name="form[email]" value="<?php echo $user->email; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Foto</label>
                                                        <input type="file" class="form-control photo" name="userfile" accept="image/*">
                                                        <input type="hidden" class="input-photo" name="form[foto]">
                                                    </div>
                                                    <div class="text-right">
                                                        <input type="hidden" class="hidden-idupdate" name="form[id_update]" value="<?php echo $user->id; ?>">
                                                        <button type="submit" class="btn btn-primary ladda-button ladda-button-submit" data-style="slide-up">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="portlet light bordered">
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form id="FrmSavePasswordProf" action="ajax-profil.html">
                                                    <div class="form-group">
                                                        <label>Password Baru<span class="text-danger">*</span></label>
                                                        <input type="password" class="form-control pass1" placeholder="Password Baru" required minlength="6" maxlength="8">
                                                        <input type="hidden" name="form[password1]" class="hidden-pass1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Ketik Ulang Password Baru<span class="text-danger">*</span></label>
                                                        <input type="password" class="form-control pass2" placeholder="Ketik Ulang Password Baru" required minlength="6" maxlength="8">
                                                        <input type="hidden" name="form[password2]" class="hidden-pass2">
                                                    </div>
                                                    <div class="text-right">
                                                        <input type="hidden" class="hidden-idupdate" name="form[id_update]" value="<?php echo $user->id; ?>">
                                                        <button type="submit" class="btn btn-primary ladda-button ladda-button-submit" data-style="slide-up">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             
            <?php $this->load->view("other/footer") ?>
        </div>

         <?php $this->load->view("profil/modal/crop") ?>

        <script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script> 
       
        <script src="<?php echo base_url("assets/plugins/moment.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/js.cookie.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/plugins/jquery.blockui.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/plugins/bootstrap-switch/bootstrap-switch.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/toastr/toastr.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/plugins/select2/select2.full.min.js"); ?>"></script>

        <!-- Jquery Validate + Ladda Button -->
        <script src="<?php echo base_url("assets/plugins/validate/jquery.validate.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/plugins/ladda/spin.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/ladda/ladda.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/ladda/ladda.jquery.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/jquery-md5/jquery.md5.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/jquery-cropper/cropper.min.js"); ?>"></script>
              
        <script src="<?php echo base_url("assets/js/theme.js"); ?>"></script>   
        <script src="<?php echo base_url("assets/js/layout.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/js/demo.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/js/proses.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/js/public.js"); ?>"></script> 

        <script>
            pagename = "ajax-profil.html";
            $(document).ready(function() {
                if("<?php echo $user->foto; ?>" == "")
                {
                    $(".fotoprof").attr("src", "<?php echo base_url("assets/img/default.png"); ?>");
                }
                else
                {
                    foto = ParseGambar("<?php echo $user->foto; ?>");
                    $(".fotoprof").attr("src", foto);
                }
            });

            $("#FrmSavePasswordProf .pass1").keyup(function() {
                $("#FrmSavePasswordProf .hidden-pass1").val($.md5($(this).val()));
            });

            $("#FrmSavePasswordProf .pass2").keyup(function() {
                $("#FrmSavePasswordProf .hidden-pass2").val($.md5($(this).val()));
            });

            var FrmSaveUserProf = $("#FrmSaveUserProf").validate({
                submitHandler: function(form) {
                    var base64 = $(".input-photo").val();
                    if(base64 !== "") {
                        UpdateDataWithImage(base64, form);
                    } else {
                        $(".input-photo").val("<?php echo $user->foto; ?>");
                        UpdateData(form, function() {
                            $(".input-photo").val("");
                            setTimeout(function() {
                                window.location.href = "<?php echo base_url()?>user/profil.html";
                            }, 750);
                        });
                    }                    
                },
                errorPlacement: function (error, element) {
                    if (element.parent(".input-group").length) { 
                        error.insertAfter(element.parent());      // radio/checkbox?
                    } else if (element.hasClass("select2-normal") || element.hasClass("select2-nosearch")) {     
                        error.insertAfter(element.next("span"));  // select2
                    } else {                                      
                        error.insertAfter(element);               // default
                    }
                }
            });

            var FrmSavePasswordProf = $("#FrmSavePasswordProf").validate({
                submitHandler: function(form) {
                    UpdatePassword(form, function(resp) {
                        setTimeout(function() {
                            window.location.href = "<?php echo base_url()?>user/logout.html";
                        }, 750);
                    });                
                },
                errorPlacement: function (error, element) {
                    if (element.parent(".input-group").length) { 
                        error.insertAfter(element.parent());      // radio/checkbox?
                    } else if (element.hasClass("select2-normal") || element.hasClass("select2-nosearch")) {     
                        error.insertAfter(element.next("span"));  // select2
                    } else {                                      
                        error.insertAfter(element);               // default
                    }
                }
            });

            $(".photo").change(function() {
                var selector = $(this);
                if (this.files && this.files[0]) {
                    var tipefile = this.files[0].type.toString();
                    if(tipefile == "image/jpeg") {
                        if((this.files[0].size / 1024) < 20480){
                            var FR = new FileReader();
                            FR.addEventListener("load", function(e) {
                                // var base64 = e.target.result.replace(/^data:image\/(png|jpg|jpeg|bmp);base64,/, '');
                                // $(".input-photo").val(base64);

                                var base64 = e.target.result;
                                ImageCropAndResize(base64);
                                $(".modal-crop-image .modal-title").html("Edit Foto Profil");
                                $(".modal-crop-image").modal("show");
                            }); 
                            FR.readAsDataURL(this.files[0]);
                        } else {
                            $(this).val("");
                            toastrshow("warning", "Ukuran file maksimum adalah 20 MB", "Warning");
                        }
                    } else {
                        $(this).val("");
                        toastrshow("warning", "Format salah, pilih file dengan format jpg", "Warning");
                    }
                }
            });

            function UpdateDataWithImage(base64, form) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/ajax/ajax-profil.html",
                    data: {act:"profileuploadimage", req:{"FileBase64": base64}},
                    dataType: "JSON",
                    cache: false,
                    tryCount: 0,
                    retryLimit: 3,
                    beforeSend: function() {
                        l.ladda("start");
                    },
                    success: function(resp){
                        l.ladda("stop");
                        form = $("#FrmSaveUserProf");
                        if(resp.IsError == false) {
                            // toastrshow("success", "Sukses mengunggah foto", "Success");
                            $(".input-photo").val(resp.Output);
                            UpdateData(form, function() {
                                setTimeout(function() {
                                    window.location.href = "<?php echo base_url()?>user/profil.html";
                                }, 750);
                            });                     
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
        </script>
        <script>
            //Initialize Cropper Variable
            var layout = $(".crop-layout"), width  = 568, height = layout.height();
            var cropper_image = layout.find("img");
            var cropper_result;
            var cropper_option = {
                dragMode: "move",
                responsive: true,
                aspectRatio: 1 / 1, 
                cropBoxResizable: false,
                cropBoxMovable: false,
                minContainerWidth: width,
                minContainerHeight: height,
            }

            function ImageCropAndResize(base64) {
                cropper_image.attr("src", base64);
                cropper_image.cropper(cropper_option);
            }

            var FrmCropImage = $("#FrmCropImage").validate({
                submitHandler: function(form) {
                    var input = $(".input-photo");
                    l.ladda("start");
                    cropper_result = cropper_image.cropper("getCroppedCanvas");
                    cropper_result = cropper_result.toDataURL("image/png");
                    cropper_result = cropper_result.replace(/^data:image\/(png|jpg|jpeg|bmp|gif);base64,/, '');
                    input.val(cropper_result);  
      
                    $(".modal-crop-image").modal("hide");
                    l.ladda("stop");     
                }
            });

            $(".modal-crop-image a[data-dismiss]").click(function() {
                $(".crop-layout img").cropper("destroy");
                $(".photo").val("");
                $(".input-photo").val("");
            });

            $(".crop-action a").click(function() {
                var selector = $(this), data;
                data = {
                    method : selector.data("crop-method"),
                    option : selector.data("crop-value"),
                    option2: selector.data("crop-second-value")
                };

                switch (data.method) {
                    case "scaleX":
                    case "scaleY":
                        if(data.option == "-1") $(this).data("crop-value", "1");
                        else $(this).data("crop-value", "-1");
                    break;
                }

                cropper_result = cropper_image.cropper(data.method, data.option, data.option2);
            });
        </script>
    </body>
</html>