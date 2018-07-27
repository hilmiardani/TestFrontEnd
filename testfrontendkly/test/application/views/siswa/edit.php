<?php 
    $user = $this->session->userdata("user");
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Edit Siswa </title>
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
        <link href="<?php echo base_url("assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css"); ?>" rel="stylesheet">
    
        <link href="<?php echo base_url("assets/css/components-rounded.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/css/plugins.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/css/layout.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/css/default.min.css"); ?>" id="style_color" rel="stylesheet">
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
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="page-title">
                                    <h1 class="title-edit"><i class="fa fa-graduation-cap"></i> Edit Siswa</h1>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                                <div class="pencarian-layout form-inline">
                                    <div class="form-group text-center">
                                        <a href="#" role="button" class="btn btn-primary save-edit-siswa">
                                            <i class="fa fa-save"></i>
                                        </a>
                                        <a role="button" class="btn btn-primary" onclick="location.reload();">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul style="padding-bottom: 0px; margin-top: 5px; margin-bottom: 15px;" class="page-breadcrumb breadcrumb">
                        <li>
                            <span class="active text-default">
                                <a href="<?php echo base_url("siswa.html");?>">Siswa</a>
                            </span>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active text-default">
                                <a href="#" onclick="location.reload();">Edit Siswa</a>
                            </span>
                        </li>
                    </ul>
                    <div class="base-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet custom light bordered">
                                    <div class="portlet-body">
                                        <form method="POST" action="ajax-siswa.html" class="form-horizontal form-edit-siswa">
                                            <div class="form-group">
                                                <center>
                                                    <img class="loading-siswa hidden" style="width: 30px;" src="<?php echo base_url("assets/img/loading.gif") ?>" alt="Loading ...">
                                                </center>
                                            <div class="form-group ">
                                                <label class="control-label col-md-2">Nama <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input required type="text" pattern="[A-Za-z]" class="form-control" placeholder="Nama" name="form[nama]"/>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label col-md-2">Ulang Tahun <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input required type="date" class="form-control" placeholder="Ulang Tahun" name="form[ulangtahun]"/>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label col-md-2">Email <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input required type="email" class="form-control" placeholder="Email" name="form[email]"/>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label col-md-2">Alamat</label>
                                                <div class="col-md-5">
                                                    <textarea style="resize: vertical;" type="text" class="form-control" placeholder="Alamat" name="form[alamat]"></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary ladda-button ladda-button-submit " data-style="slide-up">Simpan</button>
                                            <input type="hidden" class="hidden-idupdate" name="form[id_update]">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagination-layout hidden">
                            <div class="row">
                                <div class="col-md-3 col-sm-4 col-xs-9">
                                    <div class="form-group">
                                        <div class="input-group paging">
                                            <span class="input-group-btn">
                                                <a role="button" class="btn btn-primary input-sm disabled first"><i class="fa fa-step-backward"></i></a>
                                                <a role="button" class="btn btn-primary input-sm disabled prev"><i class="fa fa-chevron-left"></i></a>
                                            </span>
                                            <form id="FrmGotoPage">
                                                <input type="text" class="form-control input-sm text-center" value="1">
                                            </form>
                                            <span class="input-group-btn">
                                                <a role="button" class="btn btn-primary input-sm disabled next"><i class="fa fa-chevron-right"></i></a>
                                                <a role="button" class="btn btn-primary input-sm disabled last"><i class="fa fa-step-forward"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 hidden-sm hidden-xs">
                                    <div class="form-group">
                                        <div class="info text-right">1 - 10 dari 264 Data | 27 Halaman</div>
                                    </div>
                                </div>
                                <div class="col-md-1 hidden-sm hidden-xs">
                                    <div class="form-group">
                                        <select class="form-control select2-nosearch input-sm limit" style="width: 100%;">
                                            <option value="10" selected>10</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                            <option value="40">40</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             
            <?php $this->load->view("other/footer") ?>
        </div>
        
        <?php //$this->load->view("kunci/modal/modal") ?>

        <!--[if lt IE 9]>
        <script src="../assets/global/plugins/respond.min.js"></script>
        <script src="../assets/global/plugins/excanvas.min.js"></script> 
        <script src="../assets/global/plugins/ie8.fix.min.js"></script> 
        <![endif]-->

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
        <script src="<?php echo base_url("assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js"); ?>"></script>
              
        <script src="<?php echo base_url("assets/js/theme.js"); ?>"></script>   
        <script src="<?php echo base_url("assets/js/layout.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/js/demo.min.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/js/proses.js"); ?>"></script> 
        <script src="<?php echo base_url("assets/js/public.js"); ?>"></script> 
        <script>
            pagename = "ajax-siswa.html";
            $(document).ready(function() {
                documentready();
                
                if("<?php echo $user->foto; ?>" == "default.png")
                {
                    $(".fotoprof").attr("src", "<?php echo base_url("assets/img/default.png"); ?>");
                }
                else
                {
                    foto = ParseGambar("<?php echo $user->foto; ?>");
                    $(".fotoprof").attr("src", foto);
                }
            });

            var FrmSaveWebsite = $(".form-edit-siswa").validate({
                submitHandler: function(form) {
                    $('.loading-siswa').removeClass("hidden");
                    UpdateData(form, function(resp) {
                        setTimeout(function() {
                            window.location.href = "<?php echo base_url("siswa.html")?>";
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

            $(".save-edit-siswa").click(function() {
                $(".form-edit-siswa").submit();
            });

            function documentready(){
                var FrmSave = $(".form-edit-siswa");
                var id = <?php echo $this->input->get('id'); ?>;
                $(".hidden-idupdate").val(id);

                getdatabyid(id, function(resp) {
                    
                    // alert(resp.IsError);
                    var resp = resp.Data[0];

                    FrmSave.find("input[name='form[nama]']").val(resp.nama);
                    FrmSave.find("input[name='form[email]']").val(resp.email);
                    FrmSave.find("input[name='form[ulangtahun]']").val(resp.ulangtahun);
                    FrmSave.find("textarea[name='form[alamat]']").val(resp.alamat);
                    FrmSave.find("input[name='form[is_active]']").val(resp.is_active);


                    $('.loading-siswa').addClass("hidden");
                });
            }
        </script>
    </body>
</html>