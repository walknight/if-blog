<div class="content p-4">
    <?php echo $this->load->get_section('flashdata'); ?>

    <h2 class="mb-4">Comment List</h2>
    
    <div class="card mb-4">       
        
        <div class="card-body">
            <table class="table table-striped table-bordered" id="commentTable">
                <tr>
                    <th width="15">
                        Id.
                    </th>
                    <th>
                        Comment
                    </th>
                    <th class="text-center">
                        Date
                    </th>
                    <th class="text-center">
                        Show
                    </th>
                    <th class="text-center" width="150">
                        Action
                    </th>
                </tr>
                <?php foreach ($comment_list->result() as $list):?>
                <tr>
                    <td>
                        <?=$list->id?>
                    </td>
                    <td>
                        <h5><?=$list->name; ?><br/></h5>
                        <?=$list->email.' - '.$list->url?><br/>
                        Link Post: <?=anchor(post_url($list->url_title, $list->date_posted), $list->post_title, 'target="_blank" title="'.$list->post_title.'"')?>
                        <input type="hidden" name="comment_<?=$list->id?>" value="<?=$list->comment?>" />
                        <input type="hidden" name="name_<?=$list->id?>" value="<?=$list->name?>" />
                        <input type="hidden" name="email_<?=$list->id?>" value="<?=$list->email?>" />
                    </td>
                    <td align="center">
                        <?php echo date('d M Y H:i:s ',strtotime($list->date))?>
                    </td>
                    <td align="center">                        
                        <?php echo ($list->show == 'Y') ? '<span class="badge badge-success">'.lang('index_show_comments').'</span>' : '<span class="badge badge-danger">'.lang('index_not_show_comments').'</span>';?>
                    </td>                    
                    <td align="center"> 
                        <?php
                        //check permission user
                        if(in_array('updateComments', $this->_user_permission)) {
                            if($list->show == 'N'){
                                $attr_btn_view = 'class="btn btn-sm btn-icon btn-primary" data-id="'.$list->id.'" data-publish="Y"  id="PublishBtn" title="Publish"';
                            } else {
                                $attr_btn_view = 'class="btn btn-sm btn-icon btn-secondary" data-id="'.$list->id.'" data-publish="N" id="PublishBtn" title="Unpublish"';
                            }
                            echo anchor('#','<i class="fa fa-globe"></i>', $attr_btn_view);
                            echo "\n\t\t\t\t\t\t";
                        }
                        if(in_array('viewComments', $this->_user_permission)) {
                            $attr_btn_view = 'class="btn btn-sm btn-icon btn-warning" data-id="'.$list->id.'"  id="ViewBtn" title="View"';
                            echo anchor('#','<i class="fa fa-eye"></i>', $attr_btn_view);
                            echo "\n\t\t\t\t\t\t";
                        } 
                        if(in_array('replyComments', $this->_user_permission)){
                            $attr_btn_edit = 'class="btn btn-sm btn-icon btn-info" data-id="'.$list->id.'" data-post-id="'.$list->post_id.'" id="ReplyBtn" title="Reply"';
                            echo anchor('#','<i class="fa fa-reply"></i>', $attr_btn_edit);
                            echo "\n\t\t\t\t\t\t";
                        }
                        if(in_array('deleteComments', $this->_user_permission)){
                            $attr_btn_delete = 'class="btn btn-sm btn-icon btn-danger" id="deleteBtn" data-id="'.$list->id.'" title="Delete"';
                            echo anchor('#', '<i class="fa fa-trash"></i>', $attr_btn_delete );
                            echo "\n\t\t\t\t\t\t";
                        }
                        ?>                        
                    </td>
                </tr>
                <?php endforeach;?>
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
                <h5 class="modal-title" id="exampleModalCenterTitle"><?=lang('form_btn_delete_comments')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open(site_url('admin/comments/delete'),array('id' => 'removeForm')); ?>            
                <div class="modal-body">
                    <p>Are you sure want to delete this item ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=lang('form_btn_close_comments')?></button>
                    <button type="submit" class="btn btn-danger"><?=lang('form_btn_delete_comments')?></button>
                </div>
                <input type="hidden" id="id_comment" name="id_comment" value="">                
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- view modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>            
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <p id="name_view"></p>
                </div>
                <div class="form-group">
                    <label for="name">Comments</label>
                    <p id="comment_view"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=lang('form_btn_close_comments')?></button>
            </div>
        
        </div>
    </div>
</div>

<!-- reply modal -->
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><?=lang('form_btn_reply_comments')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open(site_url('admin/comments/reply'),array('id' => 'replyForm')); ?>            
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name_reply" id="name_reply" value="<?=$this->session->username?>" readonly>
                        <input type="hidden" class="user_id" value="<?=$this->session->user_id?>" />
                    </div>
                    <div class="form-group">
                        <label for="name">Comments</label>
                        <textarea name="comment_reply" class="form-control" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=lang('form_btn_close_comments')?></button>
                    <button type="submit" class="btn btn-info"><?=lang('form_btn_reply_comments')?></button>
                </div>
                <input type="hidden" id="id_parent" name="id_parent" value="">                
                <input type="hidden" id="id_post" name="id_post" value="">                
            <?php echo form_close(); ?>
        </div>
    </div>
</div>