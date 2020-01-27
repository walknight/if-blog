<div class="content p-4">
    <?php echo $this->load->get_section('flashdata'); ?>

    <?php if($id_page == ''){ ?>
    <h2 class="mb-4">New Page</h2>
    <?php } else { ?>
    <h2 class="mb-4">Edit Page</h2>
    <?php } ?>

    <?php echo form_open_multipart($form_action, array('class'=>'form-horizontal'));?>
    
    <div class="row">
        <div class="col-8">
            <div class="card mb-4">       
                <div class="card-header bg-white font-weight-bold">
                    Form Page
                </div> 		
                
                <div class="card-body">
                    <div class="form-group row">
                        <?php echo lang('form_title_page', 'title',array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-8">
                            <input type="text" name="title" class="form-control" value="<?=$title?>" />
                            <?=form_error('title')?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo lang('form_url_page', 'url_title', array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-8">
                            <input type="text" name="url_title" class="form-control" value="<?=$url_title?>" />
                            <?=form_error('url_title')?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo lang('form_content_area_page', 'content',array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-10">
                            <textarea name="content" class="form-control" id="editor" rows="5"><?=$content?></textarea>
                            <?=form_error('content')?>
                        </div>
                    </div>                    

                    <div class="form-group row">
                        <?php echo lang('form_meta_key_page', 'meta_key',array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-8">
                            <input type="text" name="meta_key" class="form-control" value="<?=$meta_key?>" />
                            <small><?php echo lang('form_meta_key_note_page'); ?></small><br/>
                            <?=form_error('meta_key')?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo lang('form_meta_description_page', 'meta_desc',array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-8">
                            <textarea name="meta_desc" class="form-control" rows="3"><?=$meta_desc?></textarea>
                            <?=form_error('meta_desc')?>
                        </div>
                    </div>

                </div>
                
                <div class="card-footer bg-white">
                    <input type="hidden" name="id_page" value="<?=$id_page?>" />                    
                    <a href="<?=site_url('admin/pages')?>" class="btn btn-secondary"><i class="fa fa-chevron-circle-left"></i> <?=lang('form_btn_back_page')?></a>
                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> <?=lang('form_btn_submit_page')?></button>
                </div>		
                <?php echo form_close(); ?>
            
            </div>
        </div>

        <div class="col-4">
            <div class="card mb-4">       
                <div class="card-header bg-white font-weight-bold">
                    Settings
                </div> 		
                
                <div class="card-body">                    
                    <div class="form-group row">
                        <?php echo lang('form_status_page', 'status',array('class' => 'col-sm-3 col-form-label'));?>
                        <div class="col-sm-6">
                            <input type="radio" name="status" value="active" <?php echo set_radio('status','active',isset($status) && $status == 'active' ? TRUE : FALSE); ?> /> Active
							<input type="radio" name="status" value="inactive" <?php echo set_radio('status','inactive',isset($status) && $status == 'inactive' ? TRUE : FALSE); ?> /> In-Active
                            <br/>
                            <?=form_error('status')?>
                        </div>
                    </div>
                </div>

                <div class="card-body">                    
                    <div class="form-group row">
                        <?php echo lang('form_default_content_page', 'default',array('class' => 'col-sm-3 col-form-label'));?>
                        <div class="col-sm-6">
                            <input type="checkbox" name="default" value="1" <?php echo set_checkbox('default','1',isset($default) && $default == 1 ? TRUE : FALSE); ?> /> Yes
                            <br/>
                            <?=form_error('featured')?>
                        </div>
                    </div>
                </div>

                <div class="card-body">                    
                    <div class="form-group row">
                        <?php echo lang('form_date_page', 'date',array('class' => 'col-sm-3 col-form-label'));?>
                        <div class="col-sm-6">
                            <input type="text" name="date" id="datepicker" class="form-control" value="<?=date('H:i m/d/Y', strtotime($date))?>" />
                            <?=form_error('date')?>
                        </div>
                    </div>
                </div>

                <div class="card-body">                    
                    <div class="form-group row">
                        <?php echo lang('form_image_header_page', 'image_header',array('class' => 'col-sm-3 col-form-label'));?>
                        <div class="col-sm-8">
                            <?php if($image_header != ''){ ?>
                                <img id="blah" alt="image header" src="<?=base_url($image_header)?>" class="img-thumbnail" />
                                <input type="hidden" name="def_image" value="<?=$image_header?>" />  
                            <?php } else { ?>
                                <img id="blah" alt="image header" src="<?=base_url('assets/images/no-img.jpg')?>" class="img-thumbnail" />
                            <?php } ?>
                            <input type="file" name="image_header" class="form-control-file" id="image_header" />                                                      
                            <small><?php echo lang('form_image_header_note'); ?></small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php echo form_close(); ?>
</div>