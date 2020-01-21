<div class="sidebar sidebar-dark bg-dark">
    <ul class="list-unstyled">
        <li class="active"><a href="<?=$this->session->home_url?>"><i class="fa fa-fw fa-tachometer-alt"></i>
                Dashboard</a>
        </li>
        <li>
            <a href="#mod_page" data-toggle="collapse">
                <i class="fa fa-fw fa-file"></i> Page
            </a>
            <ul id="mod_page" class="list-unstyled collapse">
                <li><a href="<?=site_url('admin/page/new')?>">New Page</a></li>
                <li><a href="<?=site_url('admin/page/')?>">List Page</a></li>                                
            </ul>
        </li>
        <li>
            <a href="#mod_post" data-toggle="collapse">
                <i class="fa fa-fw fa-file-alt"></i> Post
            </a>
            <ul id="mod_post" class="list-unstyled collapse">
                <li><a href="<?=site_url('admin/post/new')?>">New Post</a></li>
                <li><a href="<?=site_url('admin/post/')?>">List Post</a></li>
                <li><a href="<?=site_url('admin/category')?>">Category</a></li>                
            </ul>
        </li>
    
        <li><a href="<?=site_url('admin/navigation')?>"><i class="fa fa-fw fa-bars"></i> Navigation</a></li>
        <li><a href="<?=site_url('admin/home/settings')?>"><i class="fa fa-fw fa-toggle-on"></i> Settings</a></li>
    </ul>
</div>