<div class="content p-4">
    <?php $this->load->get_section('flashdata'); ?>

    <h2 class="mb-4">User List</h2>
    
    <div class="card mb-4">       
        <div class="card-header bg-white">
            <a href="<?=site_url('admin/users/create_user')?>" class="btn btn-primary float-right">
                <i class="fa fa-user-plus"></i> <?=lang('index_create_user_link')?>
            </a>
        </div> 		
        <div class="card-body">
            <table class="table table-striped table-bordered" id="manageTable">
                <tr>
                    <th width="15">
                        No.
                    </th>
                    <th>
                        <?php echo lang('index_fname_th');?>
                    </th>
                    <th>
                        <?php echo lang('index_lname_th');?>
                    </th>
                    <th>
                        <?php echo lang('index_email_th');?>
                    </th>
                    <th>
                        <?php echo lang('index_groups_th');?>
                    </th>
                    <th>
                        <?php echo lang('index_status_th');?>
                    </th>
                    <th>
                        <?php echo lang('index_action_th');?>
                    </th>
                </tr>
                <?php $start = 0; foreach ($users as $user):?>
                <tr>
                    <td>
                        <?=++$start?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?>
                    </td>
                    <td>
                        <?php foreach ($user->groups as $group):?>
                        <?php echo '<span class="label label-warning">'. htmlspecialchars($group->name,ENT_QUOTES,'UTF-8').'</span>';?><br />
                        <?php endforeach?>
                    </td>
                    <td>
                        <?php echo ($user->active) ? '<span class="label label-success">'.lang('index_active_link').'</span>' : '<span class="label label-danger">'.lang('index_inactive_link').'</span>';?>
                    </td>
                    <td>
                        <?php
                        //check permission user
                        if(in_array('viewUser', $this->_user_permission)) {
                            $attr_btn_view = 'class="btn btn-sm btn-icon btn-primary" title="View"';
                            echo anchor(site_url('users/view/'.$user->id),'<i class="fa fa-eye"></i>', $attr_btn_view);
                            echo "\n\t\t\t\t\t\t";
                        } 
                        if(in_array('updateUser', $this->_user_permission)){
                            $attr_btn_edit = 'class="btn btn-sm btn-icon btn-info" title="Edit"';
                            echo anchor(site_url('users/edit/'.$user->id),'<i class="fa fa-pencil-alt"></i>', $attr_btn_edit);
                            echo "\n\t\t\t\t\t\t";
                        }
                        if(in_array('deleteUser', $this->_user_permission)){
                            $attr_btn_delete = 'class="btn btn-sm btn-icon btn-danger" id="deleteBtn" data-id="'.$user->id.'" title="Delete"';
                            echo anchor('#', '<i class="fa fa-trash"></i>', $attr_btn_delete );
                            echo "\n\t\t\t\t\t\t";
                        }
                        ?>                        
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
            
        </div>
        <!-- /.box-body -->			
    </div>
    <!-- /.card -->

</div>

<!-- remove modal -->
<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?=site_url('admin/users/delete') ?>" method="post" id="removeForm">
                <div class="modal-body">
                    <p>Are you sure want to delete this item ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
                <input type="hidden" id="id_user" name="id_user" value="">
                <input type="hidden" id="<?=$csrf['name'];?>" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
            </form>            
        </div>
    </div>
</div>