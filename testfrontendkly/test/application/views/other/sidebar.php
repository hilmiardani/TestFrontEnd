<?php
    $user = $this->session->userdata("user");
    $level = $user->level;
    // print_r($level);
?>

<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            
            <li class="nav-item <?php if(!empty($siswa)){ echo $siswa;} ?>">
                <a href="<?php echo base_url('siswa.html') ?>" class="nav-link nav-toggle">
                    <i class="fa fa-graduation-cap"></i>
                    <span class="title">Siswa</span>
                </a>
            </li>
        </ul>
    </div>
</div>