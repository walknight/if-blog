<div class="sidebar sidebar-dark bg-dark">
    <ul class="list-unstyled">
        <li><a href="<?=$this->session->home_url?>"><i class="fa fa-fw fa-tachometer-alt"></i>
                Dashboard</a>
        </li>
        <li>
            <a href="#mod_page" data-toggle="collapse">
                <i class="fa fa-fw fa-file"></i> Pages
            </a>
            <ul id="mod_page" class="list-unstyled collapse">
                <li><a href="<?=site_url('admin/pages/new')?>">New Page</a></li>
                <li><a href="<?=site_url('admin/page/')?>">List Page</a></li>                                
            </ul>
        </li>
        <li>
            <a href="#mod_post" data-toggle="collapse">
                <i class="fa fa-fw fa-file-alt"></i> Posts
            </a>
            <ul id="mod_post" class="list-unstyled collapse">
                <li><a href="<?=site_url('admin/posts/new')?>">New Post</a></li>
                <li><a href="<?=site_url('admin/posts/')?>">List Post</a></li>
                <li><a href="<?=site_url('admin/category')?>">Category</a></li>                
            </ul>
        </li>
        <li>
            <a href="#mod_users" data-toggle="collapse">
                <i class="fa fa-fw fa-users"></i> Users
            </a>
            <ul id="mod_users" class="list-unstyled collapse">
                <li><a href="<?=site_url('admin/users/')?>">List Users</a></li>
                <li><a href="<?=site_url('admin/users/index_group')?>">Groups</a></li>
            </ul>
        </li>
        <li><a href="<?=site_url('admin/navigation')?>"><i class="fa fa-fw fa-bars"></i> Navigation</a></li>
        <li><a href="<?=site_url('admin/home/settings')?>"><i class="fa fa-fw fa-toggle-on"></i> Settings</a></li>
    </ul>
</div>