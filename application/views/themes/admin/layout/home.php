<div class="content p-4">
    <?php echo $this->load->get_section('flashdata'); ?>

    <h2 class="mb-4">Dashboard</h2>

    <div class="row mb-4">
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-primary text-light p-4">
                    <div class="d-flex align-items-center h-100">
                        <i class="fa fa-3x fa-fw fa-file-alt"></i>
                    </div>
                </div>
                <div class="flex-grow-1 bg-white p-4">
                    <p class="text-uppercase text-secondary mb-0">Page</p>
                    <h3 class="font-weight-bold mb-0"><?=$total_pages?></h3>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-success text-light p-4">
                    <div class="d-flex align-items-center h-100">
                        <i class="fa fa-3x fa-fw fa-comment"></i>
                    </div>
                </div>
                <div class="flex-grow-1 bg-white p-4">
                    <p class="text-uppercase text-secondary mb-0">Post</p>
                    <h3 class="font-weight-bold mb-0"><?=$total_posts?></h3>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-danger text-light p-4">
                    <div class="d-flex align-items-center h-100">
                        <i class="fa fa-3x fa-fw fa-comments"></i>
                    </div>
                </div>
                <div class="flex-grow-1 bg-white p-4">
                    <p class="text-uppercase text-secondary mb-0">Comments</p>
                    <h3 class="font-weight-bold mb-0"><?=$total_comments?></h3>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-info text-light p-4">
                    <div class="d-flex align-items-center h-100">
                        <i class="fa fa-3x fa-fw fa-users"></i>
                    </div>
                </div>
                <div class="flex-grow-1 bg-white p-4">
                    <p class="text-uppercase text-secondary mb-0">Users</p>
                    <h3 class="font-weight-bold mb-0"><?=$total_users?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white font-weight-bold">
                    Latest Post
                </div>
                <div class="card-body">                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; foreach($latest_post as $list): ?>
                            <tr>
                                <td><?=$no++?></td>
                                <td><?=$list['title']?></td>
                                <td><?php echo ($list['status'] == 'published') ? '<span class="badge badge-success">'.lang('index_active_link').'</span>' : '<span class="badge badge-warning">'.lang('index_inactive_link').'</span>';?> </td>
                                <td><?=$list['date_posted']?></td>
                                <td>
                                <?php
                                if(in_array('updatePost', $this->_user_permission)){
                                    $attr_btn_edit = 'class="btn btn-sm btn-icon btn-info" title="Edit"';
                                    echo anchor(site_url('admin/posts/edit/'.$list['id']),'<i class="fa fa-pencil-alt"></i>', $attr_btn_edit);
                                    echo "\n\t\t\t\t\t\t";
                                }
                                ?>
                                </td>
                            </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white font-weight-bold">
                    Latest Comments
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
    
</div>