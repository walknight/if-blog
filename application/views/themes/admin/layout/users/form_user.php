<div class="content p-4">
    <?php $this->load->get_section('flashdata'); ?>

    <h2 class="mb-4"><?php echo lang('create_user_heading');?></h2>    
    
    <div class="card mb-4">       
        <div class="card-header bg-white font-weight-bold">
            <i class="fa fa-users"></i> User Form
        </div> 		
        <?php echo form_open($form_action, array('class'=>'form-horizontal'));?>
        <div class="card-body">
            <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('create_user_fname_label', 'first_name');?> </label>
                    <div class="col-sm-6">
                        <input type="text" name="first_name" class="form-control" value="<?=$first_name?>" />
                        <?=form_error('first_name')?>
                    </div>
            </div>

            <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('create_user_lname_label', 'last_name');?> </label>
                    <div class="col-sm-6">
                        <input type="text" name="last_name" class="form-control" value="<?=$last_name?>" />
                        <?=form_error('last_name')?>
                    </div>
            </div>

            <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('create_user_username_label', 'username');?> </label>
                    <div class="col-sm-6">
                        <input type="text" name="username" class="form-control" value="<?=$username?>" />
                        <?=form_error('username')?>
                    </div>
            </div>

            <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('edit_user_groups_heading', 'group');?> </label>
                    <div class="col-sm-4">
                        <select name="group" class="form-control">
                                <option value="">--Group--</option>
                                <?php
                                foreach($groups as $group):
                                    echo '<option value="'.$group->id.'">'.$group->name.'</option>';
                                endforeach;
                                ?>
                        </select>
                    </div>
            </div>

            <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('create_user_email_label','email');?></label>
                    <div class="col-sm-6">
                        <input type="email" name="email" class="form-control" value="<?=$email?>">
                        <?=form_error('email')?>
                    </div>
            </div>

            <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('create_user_phone_label', 'phone');?> </label>
                    <div class="col-sm-6">
                        <input type="text" name="phone" class="form-control" value="<?=$phone?>" />
                        <?=form_error('phone')?>
                    </div>
            </div>

            <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('create_user_password_label', 'password');?> </label>
                    <div class="col-sm-6">
                        <input type="password" name="password" class="form-control" value="" />
                        <?=form_error('password')?>
                    </div>
            </div>

            <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?> </label>
                    <div class="col-sm-6">
                        <input type="password" name="password_confirm" class="form-control" value="" />
                        <?=form_error('password_confirm')?>
                    </div>
            </div>     
            
        </div>
        <!-- /.box-body -->	

        <div class="card-footer bg-white">
            <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
            <a href="<?=site_url('admin/users')?>" class="btn btn-secondary"><i class="fa fa-chevron-circle-left"></i> Back</a>
            <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> <?=lang('create_user_submit_btn')?></button>
        </div>		
        <?php echo form_close(); ?>

    </div>
    <!-- /.card -->

</div>