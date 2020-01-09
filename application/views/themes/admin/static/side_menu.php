<div class="sidebar sidebar-dark bg-dark">
    <ul class="list-unstyled">
        <li class="active"><a href="<?=$this->session->home_url?>"><i class="fa fa-fw fa-tachometer-alt"></i>
                Dashboard</a>
        </li>
        <li>
            <a href="#sm_base" data-toggle="collapse">
                <i class="fa fa-fw fa-file"></i> Page
            </a>
            <ul id="sm_base" class="list-unstyled collapse">
                <li><a href="<?=site_url('admin/page/new')?>">New Page</a></li>
                <li><a href="<?=site_url('admin/page/')?>">List Page</a></li>                                
            </ul>
        </li>
        <li>
            <a href="#sm_base" data-toggle="collapse">
                <i class="fa fa-fw fa-file-alt"></i> Post
            </a>
            <ul id="sm_base" class="list-unstyled collapse">
                <li><a href="<?=site_url('admin/post/new')?>">New Post</a></li>
                <li><a href="<?=site_url('admin/post/')?>">List Post</a></li>
                <li><a href="<?=site_url('admin/category')?>">Kategori</a></li>                
            </ul>
        </li>
        
        <li><a href="<?=site_url('admin/navigation')?>"><i class="fa fa-fw fa-bars"></i> Navigasi</a></li>
        <li><a href="<?=site_url('admin/home/settings')?>"><i class="fa fa-fw fa-toggle-on"></i> Pengaturan</a></li>
    </ul>
</div>