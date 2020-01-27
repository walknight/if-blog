<div class="content p-4">
    <?php echo $this->load->get_section('flashdata'); ?>

    <?php if($id_cat == ''){ ?>
    <h2 class="mb-4">New Category</h2>
    <?php } else { ?>
    <h2 class="mb-4">Edit Category</h2>
    <?php } ?>

    <?php echo form_open($form_action, array('class'=>'form-horizontal'));?>
    
    <div class="row">
        <div class="col-8">
            <div class="card mb-4">       
                <div class="card-header bg-white font-weight-bold">
                    Form Category
                </div> 		
                
                <div class="card-body">
                    <div class="form-group row">
                        <?php echo lang('form_title_category', 'title',array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-8">
                            <input type="text" name="title" class="form-control" value="<?=$title?>" />
                            <?=form_error('title')?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo lang('form_url_category', 'url_title', array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-8">
                            <input type="text" name="url_title" class="form-control" value="<?=$url_title?>" />
                            <?=form_error('url_title')?>
                        </div>
                    </div>                   

                    <div class="form-group row">
                        <?php echo lang('form_description_category', 'description', array('class' => 'col-sm-2 col-form-label'));?>
                        <div class="col-sm-8">
                            <textarea name="description" class="form-control" rows="3"><?=$description?></textarea>
                            <?=form_error('description')?>
                        </div>
                    </div>                   

                </div>
                
                <div class="card-footer bg-white">
                    <input type="hidden" name="id_cat" value="<?=$id_cat?>" />                    
                    <a href="<?=site_url('admin/category')?>" class="btn btn-secondary"><i class="fa fa-chevron-circle-left"></i> <?=lang('form_btn_back_category')?></a>
                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> <?=lang('form_btn_submit_category')?></button>
                </div>		
                <?php echo form_close(); ?>
            
            </div>
        </div>

    </div>

    <?php echo form_close(); ?>
</div>