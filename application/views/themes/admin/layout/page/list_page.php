<div class="content p-4">
    <?php $this->load->get_section('flashdata'); ?>

    <h2 class="mb-4">Page List</h2>
    
    <div class="card mb-4">       
        <div class="card-header bg-white">
            <a href="<?=site_url('admin/page/new')?>" class="btn btn-primary float-right">
                <i class="fa fa-user-plus"></i> <?=lang('index_create_page_new')?>
            </a>
        </div> 		
        <div class="card-body">
            <table class="table table-striped table-bordered" id="manageTable">
                <tr>
                    <th width="15">
                        No.
                    </th>
                    <th>
                        Title
                    </th>                   
                    <th>
                        Status
                    </th>
                    <th>
                        Author
                    </th>
                    <th>
                        Date Posted
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                <?php if($page_list !== FALSE){ ?>
                <?php foreach ($page_list->result() as $list):?>
                <tr>
                    <td>
                        <?=++$start?>
                    </td>
                    <td>
                        <?php echo $list->title; ?>
                    </td>                  
                    <td>
                        <?php echo $list->status; ?>
                        <?php echo ($list->status) ? '<span class="label label-success">'.lang('index_active_link').'</span>' : '<span class="label label-danger">'.lang('index_inactive_link').'</span>';?>
                    </td>
                    <td>
                        <?php echo $list->author; ?>
                    </td>
                    <td>
                        <?php echo $list->date_posted; ?>
                    </td>
                    <td>
                        <?php
                        //check permission user
                        if(in_array('viewPage', $this->_user_permission)) {
                            $attr_btn_view = 'class="btn btn-sm btn-icon btn-primary" title="View"';
                            echo anchor(site_url('admin/pages/view/'.$list->id),'<i class="fa fa-eye"></i>', $attr_btn_view);
                            echo "\n\t\t\t\t\t\t";
                        } 
                        if(in_array('updatePage', $this->_user_permission)){
                            $attr_btn_edit = 'class="btn btn-sm btn-icon btn-info" title="Edit"';
                            echo anchor(site_url('admin/pages/edit/'.$list->id),'<i class="fa fa-pencil-alt"></i>', $attr_btn_edit);
                            echo "\n\t\t\t\t\t\t";
                        }
                        if(in_array('deletePage', $this->_user_permission)){
                            $attr_btn_delete = 'class="btn btn-sm btn-icon btn-danger" id="deleteBtn" data-id="'.$list->id.'" title="Delete"';
                            echo anchor('#', '<i class="fa fa-trash"></i>', $attr_btn_delete );
                            echo "\n\t\t\t\t\t\t";
                        }
                        ?>                        
                    </td>
                </tr>
                <?php endforeach;?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6" class="text-center">No Data Pages.</td>
                    </tr>
                <?php } ?>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>
            </div> 
            
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
            <form role="form" action="<?=site_url('admin/pages/delete') ?>" method="post" id="removeForm">
                <div class="modal-body">
                    <p>Are you sure want to delete this item ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
                <input type="hidden" id="id_page" name="id_page" value="">
                <input type="hidden" id="<?=$csrf['name'];?>" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
            </form>            
        </div>
    </div>
</div>