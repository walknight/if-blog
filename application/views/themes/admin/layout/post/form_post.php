<div class="content p-4">
    <?php echo $this->load->get_section('flashdata'); ?>

    <?php if($id_post == ''){ ?>
    <h2 class="mb-4">New Post</h2>
    <?php } else { ?>
    <h2 class="mb-4">Edit Post</h2>
    <?php } ?>

    <?php echo form_open_multipart($form_action, array('class'=>'form-horizontal'));?>
    
    <div class="row">
        <div class="col-8">
            <div class="card mb-4">       
                <div class="card-header bg-white font-weight-bold">
                    Form Post
                </div> 		
                
                <div class="card-body">
                    <div class="form-group row">
                        <?php echo lang('form_title_post', 'title',array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-8">
                            <input type="text" name="title" class="form-control" value="<?=$title?>" />
                            <?=form_error('title')?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo lang('form_url_post', 'url_title', array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-8">
                            <input type="text" name="url_title" class="form-control" value="<?=$url_title?>" />
                            <?=form_error('url_title')?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo lang('form_category_post', 'id_cat', array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-8">
                            <select name="id_cat" class="form-control">
								<?php if(!empty($cat_list) AND isset($cat_list))
								{
									foreach($cat_list as $row):
								?>
									<option value="<?php echo $row['id'];?>" <?php echo set_select('id_cat', $row['id'], ($row['id'] == $id_cat) ? TRUE : FALSE); ?> ><?php echo $row['name']; ?></option>
								<?php	
									endforeach;
								} else {
									echo "<option>--no-data--</option>";
								}
								?>
							</select>
                            <?=form_error('id_cat')?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo lang('form_head_article_post', 'head_article', array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-8">
                            <textarea name="head_article" class="form-control" rows="3"><?=$head_article?></textarea>
                            <?=form_error('head_article')?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo lang('form_main_content_post', 'main_article',array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-10">
                            <textarea name="main_article" class="form-control" id="editor" rows="5"><?=$main_article?></textarea>
                            <?=form_error('main_article')?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo lang('form_tags_post', 'tags',array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-10">
                            <input type="text" name="tags" class="form-control" value="<?=$tags?>" />
                            <small><?php echo lang('form_tags_note_post'); ?></small><br/>
                            <?=form_error('tags')?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo lang('form_meta_key_post', 'meta_key',array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-8">
                            <input type="text" name="meta_key" class="form-control" value="<?=$meta_key?>" />
                            <small><?php echo lang('form_meta_key_note_post'); ?></small><br/>
                            <?=form_error('meta_key')?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo lang('form_meta_description_post', 'meta_desc',array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-8">
                            <textarea name="meta_desc" class="form-control" rows="3"><?=$meta_desc?></textarea>
                            <?=form_error('meta_desc')?>
                        </div>
                    </div>

                </div>
                
                <div class="card-footer bg-white">
                    <input type="hidden" name="id_post" value="<?=$id_post?>" />                    
                    <a href="<?=site_url('admin/posts')?>" class="btn btn-secondary"><i class="fa fa-chevron-circle-left"></i> <?=lang('form_btn_back_post')?></a>
                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> <?=lang('form_btn_submit_post')?></button>
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
                        <?php echo lang('form_status_post', 'status',array('class' => 'col-sm-3 col-form-label'));?>
                        <div class="col-sm-6">
                            <input type="radio" name="status" value="published" <?php echo set_radio('status','published',isset($status) && $status == 'published' ? TRUE : FALSE); ?> /> Publish
							<input type="radio" name="status" value="draft" <?php echo set_radio('status','draft',isset($status) && $status == 'draft' ? TRUE : FALSE); ?> /> Draft
                            <br/>
                            <?=form_error('status')?>
                        </div>
                    </div>
                </div>

                <div class="card-body">                    
                    <div class="form-group row">
                        <?php echo lang('form_sticky_content_post', 'sticky',array('class' => 'col-sm-3 col-form-label'));?>
                        <div class="col-sm-6">
                            <input type="checkbox" name="sticky" value="1" <?php echo set_checkbox('sticky','1',isset($sticky) && $sticky == 1 ? TRUE : FALSE); ?> /> Yes
                            <br/>
                            <?=form_error('sticky')?>
                        </div>
                    </div>
                </div>

                <div class="card-body">                    
                    <div class="form-group row">
                        <?php echo lang('form_featured_content_post', 'featured',array('class' => 'col-sm-3 col-form-label'));?>
                        <div class="col-sm-6">
                            <input type="checkbox" name="featured" value="1" <?php echo set_checkbox('featured','1',isset($featured) && $featured == 1 ? TRUE : FALSE); ?> /> Yes
                            <br/>
                            <?=form_error('featured')?>
                        </div>
                    </div>
                </div>

                <div class="card-body">                    
                    <div class="form-group row">
                        <?php echo lang('form_allow_comment_post', 'allow_comments',array('class' => 'col-sm-3 col-form-label'));?>
                        <div class="col-sm-6">
                            <input type="checkbox" name="allow_comments" value="1" <?php echo set_checkbox('allow_comments','1',isset($allow_comments) && $allow_comments == 1 ? TRUE : FALSE); ?> /> Yes
                            <br/>
                            <?=form_error('allow_comments')?>
                        </div>
                    </div>
                </div>

                <div class="card-body">                    
                    <div class="form-group row">
                        <?php echo lang('form_date_post', 'date_posted',array('class' => 'col-sm-3 col-form-label'));?>
                        <div class="col-sm-6">
                            <input type="text" name="date_posted" id="datepicker" class="form-control" value="<?=date('H:i m/d/Y', strtotime($date_posted))?>" />
                            <?=form_error('date_posted')?>
                        </div>
                    </div>
                </div>

                <div class="card-body">                    
                    <div class="form-group row">
                        <?php echo lang('form_image_header_post', 'image_header',array('class' => 'col-sm-3 col-form-label'));?>
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