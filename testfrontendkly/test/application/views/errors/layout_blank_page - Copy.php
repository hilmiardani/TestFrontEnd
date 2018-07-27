<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8">
        <title>Metronic Admin Theme #4 | Blank Page Layout</title>
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="Preview page of Metronic Admin Theme #4 for blank page layout" name="description">
        <meta content="" name="author"><!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/plugins/simple-line-icons/simple-line-icons.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/plugins/bootstrap-switch/bootstrap-switch.min.css"); ?>" rel="stylesheet" type="text/css"><!-- END GLOBAL MANDATORY STYLES -->
        <link href="<?php echo base_url("assets/plugins/toastr/toastr.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/plugins/select2/select2.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/plugins/select2/select2-bootstrap.min.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/plugins/ladda/ladda-themeless.min.css"); ?>" rel="stylesheet">
    
        <link href="<?php echo base_url("assets/css/components-rounded.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/plugins.min.css"); ?>" rel="stylesheet" type="text/css"><!-- END THEME GLOBAL STYLES -->

        <link href="<?php echo base_url("assets/css/layout.min.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/default.min.css"); ?>" id="style_color" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/custom.css"); ?>" rel="stylesheet" type="text/css"><!-- END THEME LAYOUT STYLES -->
        <link href="<?php echo base_url("assets/css/responsive.css"); ?>" rel="stylesheet" type="text/css"><!-- END THEME LAYOUT STYLES -->
    </head><!-- END HEAD -->
    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
        <?php $this->load->view("other/header") ?>

        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <?php $this->load->view("other/sidebar") ?>

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="page-title">
                                    <h1>Add New Group</h1>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12 text-right">
                                <div class="title-action form-inline">
                                    <div class="form-group text-center">
                                        <form id="frmSearch">
                                            <div class="input-group input-search">
                                                <input type="text" placeholder="Cari (Nama)" class="form-control" autofocus> 
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="form-group text-center">
                                        <a role="button" class="btn btn-primary tambah-data">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a role="button" class="btn btn-primary" data-toggle="collapse" data-target=".filter">
                                            <i class="fa fa-filter"></i>
                                        </a>
                                        <a role="button" class="btn btn-primary" onclick="location.reload();">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                        <span class="pagination-layout">
                                            <a role="button" class="btn btn-primary disabled prev">
                                                <i class="fa fa-chevron-left"></i>
                                            </a>    
                                            <a role="button" class="btn btn-primary disabled next">
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- END PAGE HEAD-->
                    <div class="base-content">
						<div class="portlet light bordered">
                            <div class="portlet-body">
                                <form id="filter-form">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Sorting</label>
                                                <select class="form-control select2-nosearch" style="width: 100%;">
                                                    <option value="id desc">Default</option>
                                                    <option value="tgl_input desc">Tgl Upload Desc</option>
                                                    <option value="tgl_input asc">Tgl Upload Asc</option>
                                                    <option value="progres desc">Progres Desc</option>
                                                    <option value="progres asc">Progres Asc</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary">Tampilkan</button>
                                </form>
                            </div>
                        </div>
                        <div class="portlet light bordered">
                            <div class="portlet-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>Action</td>
                                            <td>Nama Group</td>
                                            <td>Status</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- END CONTENT BODY -->
            </div><!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
             
            <?php $this->load->view("other/footer") ?>
        </div><!-- END CONTAINER -->

        <!--[if lt IE 9]>
        <script src="../assets/global/plugins/respond.min.js"></script>
        <script src="../assets/global/plugins/excanvas.min.js"></script> 
        <script src="../assets/global/plugins/ie8.fix.min.js"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url("assets/js/jquery.min.js"); ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url("assets/plugins/js.cookie.min.js"); ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url("assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"); ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url("assets/plugins/jquery.blockui.min.js"); ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url("assets/plugins/bootstrap-switch/bootstrap-switch.min.js"); ?>" type="text/javascript"></script> <!-- END CORE PLUGINS -->
        <script src="<?php echo base_url("assets/plugins/select2/select2.full.min.js"); ?>" type="text/javascript"></script> <!-- END CORE PLUGINS -->
        <script src="<?php echo base_url("assets/plugins/toastr/toastr.min.js"); ?>" type="text/javascript"></script> <!-- END CORE PLUGINS -->
        <script src="<?php echo base_url("assets/plugins/bootstrap-switch/bootstrap-switch.min.js"); ?>" type="text/javascript"></script> <!-- END CORE PLUGINS -->
        <script src="<?php echo base_url("assets/plugins/ladda/ladda.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/ladda/ladda.jquery.min.js"); ?>"></script>        

        <script src="<?php echo base_url("assets/js/theme.js"); ?>" type="text/javascript"></script>   
        <script src="<?php echo base_url("assets/js/layout.min.js"); ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url("assets/js/demo.min.js"); ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url("assets/js/proses.js"); ?>" type="text/javascript"></script> 
    </body>
</html>