<div class="content p-4">
    <?php echo $this->load->get_section('flashdata'); ?>

    <h2 class="mb-4">Edit Site Setting</h2>

    <?php echo form_open_multipart($form_action, array('id'=>'settingForm'));?>
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
            Vertical
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active show" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-home" aria-selected="false"><i class="fa fa-fw fa-cog"></i> General</a>
                        <a class="nav-link" id="v-pills-logo-tab" data-toggle="pill" href="#v-pills-logo" role="tab" aria-controls="v-pills-logo" aria-selected="false"><i class="fa fa-fw fa-image"></i> Site Logo</a>
                        <a class="nav-link" id="v-pills-email-tab" data-toggle="pill" href="#v-pills-email" role="tab" aria-controls="v-pills-email" aria-selected="false"><i class="fa fa-fw fa-envelope"></i> Email Settings</a>
                        <a class="nav-link" id="v-pills-social-tab" data-toggle="pill" href="#v-pills-social" role="tab" aria-controls="v-pills-social" aria-selected="false"><i class="fa fa-fw fa-comment-dots"></i> Social & RSS</a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                            <h4><i class="fa fa-fw fa-cog"></i> General Form</h4>
                            <hr>
                            <div class="form-group">
                                <label for="site_title">Site Title</label>
                                <input type="text" name="site_title" class="form-control" id="site_title" value="<?=$this->_settings['site_title']?>">
                            </div>
                            <div class="form-group">
                                <label for="site_title">Site Description</label>
                                <textarea name="site_description" class="form-control" id="site_description" rows="5"><?=$this->_settings['site_description']?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">Default Meta Keywords</label>
                                <input type="text" name="meta_keywords" class="form-control" id="meta_keywords" value="<?=$this->_settings['meta_keywords']?>">
                            </div>
                            <div class="form-group">
                                <label for="posts_per_page">Post per Pages</label>
                                <input type="number" name="posts_per_page" class="form-control col-2" id="posts_per_page" value="<?=$this->_settings['posts_per_page']?>">
                            </div>
                            <div class="form-group">
                                <label for="links_per_box">Links per Box</label>
                                <input type="number" name="links_per_box" class="form-control col-2" id="links_per_box" value="<?=$this->_settings['links_per_box']?>">
                            </div>
                            <div class="form-group">
                                <label for="months_per_archive">Month per archive</label>
                                <input type="number" name="months_per_archive" class="form-control col-2" id="months_per_archive" value="<?=$this->_settings['months_per_archive']?>">
                            </div>                            
                            <div class="form-group">
                                <label for="offline_reason">Offline Reason</label>
                                <textarea readonly name="offline_reason" class="form-control" id="offline_reason" rows="5"><?=$this->_settings['offline_reason']?></textarea>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?=$this->_settings['site_enabled']?>" <?php echo set_checkbox('site_enabled',1,($this->_settings['site_enabled'] == 1) ? TRUE : FALSE); ?> name="site_enabled" id="site_enabled">
                                <label class="form-check-label" for="site_enabled">
                                    Site Enabled <i class="text-info">(uncheck this for maintenance mode)</i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?=$this->_settings['allow_registrations']?>" <?php echo set_checkbox('allow_registrations',1,($this->_settings['allow_registrations'] == 1) ? TRUE : FALSE); ?> name="allow_registrations" id="allow_registrations">
                                <label class="form-check-label" for="allow_registrations">
                                    Allow Registrations
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?=$this->_settings['recognize_user_agent']?>" <?php echo set_checkbox('recognize_user_agent',1,($this->_settings['recognize_user_agent'] == 1) ? TRUE : FALSE); ?> name="recognize_user_agent" id="recognize_user_agent">
                                <label class="form-check-label" for="recognize_user_agent">
                                    Recognize user agent <i class="text-info">(if you have mobile template check this)</i>
                                </label>
                            </div>
                            
                        </div>
                        <div class="tab-pane fade" id="v-pills-logo" role="tabpanel" aria-labelledby="v-pills-logo-tab">
                            <h4><i class="fa fa-fw fa-image"></i> Site Logo Form</h4>
                            <hr>
                            
                            <div class="form-group">
                                <label for="site_logo">Site Logo</label>
                                <div class="col-sm-8">
                                    <?php if($this->_settings['site_logo'] !== ''){ ?>
                                        <img id="image_logo" alt="image logo" src="<?=base_url($this->config->item('images').$this->_settings['site_logo'])?>" class="img-thumbnail" />
                                        <input type="hidden" name="def_logo_image" value="<?=$this->_settings['site_logo']?>" />  
                                    <?php } else { ?>
                                        <img id="image_logo" alt="image logo" src="#" class="img-thumbnail" />
                                    <?php } ?>
                                    <input type="file" name="site_logo" class="form-control-file" id="site_logo" />                                                      
                                    <small>file : jpg or png, max size : 2MB</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="og_image">Og Image</label>
                                <div class="col-sm-8">
                                    <?php if($this->_settings['og_image'] !== ''){ ?>
                                        <img id="image_og" alt="og image" src="<?=base_url($this->config->item('images').$this->_settings['og_image'])?>" class="img-thumbnail" />
                                        <input type="hidden" name="def_og_image" value="<?=$this->_settings['og_image']?>" />  
                                    <?php } else { ?>
                                        <img id="image_og" alt="og image" src="#" class="img-thumbnail" />
                                    <?php } ?>
                                    <input type="file" name="og_image" class="form-control-file" id="og_image" />                                                      
                                    <small>file : jpg or png, max size : 2MB</small>
                                </div>
                            </div>
                            
                        </div>
                        <div class="tab-pane fade" id="v-pills-email" role="tabpanel" aria-labelledby="v-pills-email-tab">
                            <h4><i class="fa fa-fw fa-envelope"></i> Email Account</h4>
                            <hr>
                            <div class="form-group">
                                <label for="contact_email">Contact Email</label>
                                <input type="text" name="contact_email" class="form-control" id="contact_email" value="<?=$this->_settings['contact_email']?>">
                                <small>This is for contact email</small>
                            </div>
                            <div class="form-group">
                                <label for="admin_email">Admin Email</label>
                                <input type="text" name="admin_email" class="form-control" id="admin_email" value="<?=$this->_settings['admin_email']?>">
                                <small>This is for admin email</small>
                            </div>
                            <div class="form-group mb-4">
                                <label for="system_email">System Email</label>
                                <input type="text" name="system_email" class="form-control" id="system_email" value="<?=$this->_settings['system_email']?>">
                                <small>This is for system email and can't reply</small>
                            </div>
                            <h4><i class="fa fa-fw fa-envelope-square"></i> Email System Settings</h4>
                            <hr>       
                            <div class="form-group">
                                <label for="admin_email">Email Protocal</label>
                                <?php 
                                    $att = 'id="email_protocal" class="form-control"';
                                    $data = array();
                                    $data['mail'] = 'Mail';
                                    $data['sendmail'] = 'Sendmail';
                                    $data['smtp'] = 'SMTP';
                                    echo form_dropdown('email_protocal', $data, $this->_settings['email_protocal'], $att); 
                                ?>
                            </div>
                            <div class="form-group" id="sendmail_input" style="display:none;">                                
                                <label for="sendmail_path">Send Mail Path</label>
                                <input type="text" name="sendmail_path" class="form-control" id="sendmail_path" value="<?=$this->_settings['sendmail_path']?>">                                                                
                            </div>
                            <div class="form-group smtp_input" id="smtp_user" style="display:none;">
                                <label for="smtp_user">SMTP User</label>
                                <input type="text" name="smtp_user" class="form-control" id="smtp_user" value="<?=$this->_settings['smtp_user']?>"> 
                            </div>
                            <div class="form-group smtp_input" id="smtp_password" style="display:none;">
                                <label for="smtp_pass">SMTP Password</label>
                                <input type="text" name="smtp_pass" class="form-control" id="smtp_pass" value="<?=$this->_settings['smtp_pass']?>">
                            </div>
                            <div class="form-group smtp_input" id="smtp_port" style="display:none;">
                                <label for="smtp_port">SMTP Port</label>
                                <input type="text" name="smtp_port" class="form-control" id="smtp_port" value="<?=$this->_settings['smtp_port']?>"> 
                            </div>                     
                        </div>
                        <div class="tab-pane fade" id="v-pills-social" role="tabpanel" aria-labelledby="v-pills-social-tab">
                            <h4><i class="fa fa-fw fa-rss-square"></i> RSS</h4>
                            <hr>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo set_checkbox('enable_atom_comments',1,($this->_settings['enable_atom_comments'] == 1) ? TRUE : FALSE); ?> name="enable_atom_comments" id="enable_atom_comments">
                                <label class="form-check-label" for="enable_atom_comments">
                                    enable_atom_comments
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo set_checkbox('enable_atom_posts',1,($this->_settings['enable_atom_posts'] == 1) ? TRUE : FALSE); ?> name="enable_atom_posts" id="enable_atom_posts">
                                <label class="form-check-label" for="enable_atom_posts">
                                enable_atom_posts
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo set_checkbox('enable_captcha',1,($this->_settings['enable_captcha'] == 1) ? TRUE : FALSE); ?> name="enable_captcha" id="enable_captcha">
                                <label class="form-check-label" for="enable_captcha">
                                enable_captcha
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo set_checkbox('enable_delicious',1,($this->_settings['enable_delicious'] == 1) ? TRUE : FALSE); ?> name="enable_delicious" id="enable_delicious">
                                <label class="form-check-label" for="enable_delicious">
                                enable_delicious
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo set_checkbox('enable_digg',1,($this->_settings['enable_digg'] == 1) ? TRUE : FALSE); ?> name="enable_digg" id="enable_digg">
                                <label class="form-check-label" for="enable_digg">
                                enable_digg
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo set_checkbox('enable_furl',1,($this->_settings['enable_furl'] == 1) ? TRUE : FALSE); ?> name="enable_furl" id="enable_furl">
                                <label class="form-check-label" for="enable_furl">
                                enable_furl
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo set_checkbox('enable_rss_comments',1,($this->_settings['enable_rss_comments'] == 1) ? TRUE : FALSE); ?> name="enable_rss_comments" id="enable_rss_comments">
                                <label class="form-check-label" for="enable_rss_comments">
                                enable_rss_comments
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo set_checkbox('enable_rss_posts',1,($this->_settings['enable_rss_posts'] == 1) ? TRUE : FALSE); ?> name="enable_rss_posts" id="enable_rss_posts">
                                <label class="form-check-label" for="enable_rss_comments">
                                enable_rss_posts
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo set_checkbox('enable_stumbleupon',1,($this->_settings['enable_stumbleupon'] == 1) ? TRUE : FALSE); ?> name="enable_stumbleupon" id="enable_stumbleupon">
                                <label class="form-check-label" for="enable_stumbleupon">
                                enable_stumbleupon
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" <?php echo set_checkbox('enable_technorati',1,($this->_settings['enable_technorati'] == 1) ? TRUE : FALSE); ?> name="enable_technorati" id="enable_technorati">
                                <label class="form-check-label" for="enable_technorati">
                                enable_technorati
                                </label>
                            </div>
                            <br/>
                            <h4><i class="fa fa-fw fa-link"></i> Social Links</h4>
                            <hr>
                            <?php 
                            foreach($social_links as $links): 
                            ?>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="<?=$links['icon']?>"></i></span>
                                    </div>
                                    <input class="form-check-input" type="checkbox" <?php echo set_checkbox("social[".$links['social_id']."]['active']",1,($links['active'] == 1) ? TRUE : FALSE); ?> id="<?=$links['social_name']?>" name="social[<?=$links['social_name']?>][active]">
                                    <input type="text" class="form-control" name="social[<?=$links['social_name']?>][link]" placeholder="<?=ucfirst($links['social_name']) ?> Link" value="<?=$links['social_url']?>">                                    
                                </div>
                            </div>
                            <?php
                            endforeach;
                            ?>
                                                       
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">                              
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?=lang('submit_btn_value')?></button>
        </div>		
    </div>
    <?php echo form_close(); ?>
</div>