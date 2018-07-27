<?php
    $user = $this->session->userdata("user");
?>
<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner">
        <div class="page-logo">
            <center>
                <img alt="logo" class="logo-default" src="<?php echo base_url("assets/img/logo1.png") ?>" style="height: 30px; width: 30px;">
            </a>
            <div class="menu-toggler sidebar-toggler"></div>
            </center>
        </div>
        <a role="button" class="menu-toggler responsive-toggler" data-target=".navbar-collapse" data-toggle="collapse"></a> <!-- END RESPONSIVE MENU TOGGLER -->
         <div class="page-group top-menu">
            <div>
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-extended dropdown-dark">
                        <a href="<?php echo base_url(); ?>" role="button" class="dropdown-toggle submit">
                            <h2 class="hidden-xs hidden-sm group"><span class="group-name">Akademik</span></h2>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="page-top">
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="javascript:;">
                            <span class="username"><?php echo $user->nama; ?></span>
                            <img alt="" class="img-circle fotoprof" >
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                             <li>
                                <a href="<?php echo base_url("user/profil.html"); ?>"><i class="fa fa-user"></i> Edit Profil</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("user/logout.html"); ?>"><i class="fa fa-sign-out"></i> Keluar</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>