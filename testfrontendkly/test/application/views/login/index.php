<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Login | Akademik</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <link href="<?php echo base_url("assets/css/font-awesome.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

        <link href="<?php echo base_url("assets/plugins/simple-line-icons/simple-line-icons.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/plugins/bootstrap-switch/bootstrap-switch.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/plugins/select2/select2.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/plugins/select2/select2-bootstrap.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/plugins/ladda/ladda-themeless.min.css"); ?>" rel="stylesheet">
        
        <link href="<?php echo base_url("assets/css/components-rounded.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/css/login.min.css") ?>" rel="stylesheet"/>
        <link href="<?php echo base_url("assets/css/custom.css") ?>" rel="stylesheet"/>
        <link href="<?php echo base_url("assets/plugins/bootstrap-social/bootstrap-social.css"); ?>" rel="stylesheet">
        
        <link rel="shortcut icon" href="<?php echo base_url("assets/img/favicon.ico"); ?>">
        <link rel="icon" type="image/png" href="<?php echo base_url("assets/img/favicon-32x32.png"); ?>" sizes="32x32" />
        <link rel="icon" type="image/png" href="<?php echo base_url("assets/img/favicon-16x16.png"); ?>" sizes="16x16" />
        <style>
            .login .content .form-actions {
                padding-top: 0px;
            }
            .login .content .form-actions .other {
                float: right;
                font-size: 13px;
                text-align: right;
                margin-top: 3px;
            }
            .login .content .form-actions .other a {
                display: block;
            }
            .login .content .form-actions .other .register {
                margin-top: 2px;
            }
            @media only screen and (max-width : 640px) {
                .login .content {
                    width: 360px;
                }
            }
        </style>
    </head>

    <body class="login">
        <div class="logo" style="display: table;" align="center">
            <div style="display: table-cell;">
                <img src="<?php echo base_url("assets/img/logo1.png") ?>" alt="" width="100px"/> 
            </div>
            <!-- &nbsp;
            <div style="display: table-cell;">
                <div style="display: table-row;">
                    <font size="5" color="white"><b>Sistem Informasi Manajemen Jalan dan Jembatan</b></font>
                </div>
                <div style="display: table-row;">
                    <font size="2" color="white"><b>Dinas Pekerjaan Umum & Penataan Ruang Kabupaten Situbondo</b></font>
                </div>
            </div> -->
        </div>
        <div class="content">
            <h3 class="form-title font-green">Login Akademik</h3>
            <div class="notifikasi">
                <?php 
                    print_r($this->session->userdata("notifikasi")); 
                    $this->session->unset_userdata("notifikasi"); 
                ?>
            </div>
            

            <form id="FrmLogin" role="form">
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input type="text" class="form-control form-control-solid placeholder-no-fix" placeholder="Username / Email" name="form[username]" autofocus required>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input type="password" class="form-control form-control-solid placeholder-no-fix" placeholder="Password" required>
                    <input type="hidden" class="hidden-password" name="form[password]">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn green ladda-button ladda-button-submit" data-style="slide-up">Masuk</button>
                    <!-- <div class="other">
                        <a href="<?php //echo base_url("user/forgot.html"); ?>" class="forget">Lupa Password?</a>
                    </div> -->
                </div>
            </form>

        </div>
        <div class="copyright"> <?php echo date("Y"); ?> © Tes Front End KLY</div>

        <script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script> 

        <script src="<?php echo base_url("assets/plugins/js.cookie.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/plugins/jquery.blockui.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/plugins/bootstrap-switch/bootstrap-switch.min.js"); ?>"></script>

        <!-- Jquery Validate + Ladda Button -->
        <script src="<?php echo base_url("assets/plugins/validate/jquery.validate.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/plugins/ladda/spin.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/ladda/ladda.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/ladda/ladda.jquery.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/jquery-md5/jquery.md5.js"); ?>"></script>

        <script src="<?php echo base_url("assets/js/theme.js"); ?>"></script>   
        <script src="<?php echo base_url("assets/js/layout.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/js/demo.min.js"); ?>"></script>  
        <script src="<?php echo base_url("assets/js/proses.js"); ?>"></script>  
        <script>
            $("#FrmLogin input[type=password]").keyup(function() {
                $("#FrmLogin .hidden-password").val($.md5($(this).val()));
            });

            var FrmSave = $("#FrmLogin").validate({
                submitHandler: function(form) {
                    Login(form, function(resp) {
                        if(resp.IsError == true) {
                            $("#FrmLogin").find("input[type=text]").filter(":first").focus();
                        }
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
        </script>
    </body>
</html>