<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="<?=site_url('admin/home');?>">If-Blog</a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">            
            <li class="nav-item"><a href="<?=base_url()?>" target="_blank" class="nav-link"><i class="fa fa-home"></i> View Website</a></li>
            <li class="nav-item dropdown">
                <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$this->session->username?></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                    <a href="<?=site_url('admin/user/profile/update')?>" class="dropdown-item">Profile</a>
                    <a href="<?=site_url('admin/auth/logout')?>" class="dropdown-item">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>