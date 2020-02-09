<div class="content p-4">
    <?php echo $this->load->get_section('flashdata'); ?>

    <h2 class="mb-4">Navigation</h2>

    <div class="row">
        <div class="col-3">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-white font-weight-bold">
                            <?=lang('page_header_card');?>
                        </div>
                        <div class="card-body">
                            <?php
                            if(isset($page_list)){
                                foreach($page_list as $list):
                            ?>
                            <div class="form-check" id="menu_page">
                                <input class="form-check-input" type="checkbox" name="menu_page[]" data-url="<?='page/'.$list['url_title']?>" value="<?=$list['id']?>" id="PageMenu">
                                <input type="hidden" name="menu_page_name[]" value="<?=$list['title']?>" />
                                <label class="form-check-label" for="menu_page">
                                    <?=$list['title']?>
                                </label>
                            </div>
                            <?php
                                endforeach;
                            }
                            ?>
                        </div>

                        <div class="card-footer">
                            <button type="button" class="btn btn-warning float-right addToMenu" name="PageMenu">Ada To Menu</button>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-white font-weight-bold">
                            <?=lang('categories_header_card');?>
                        </div>
                        <div class="card-body">                          
                            <?php
                            if(isset($cat_list)){
                                foreach($cat_list as $row):
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="menu_category[]" data-url="<?='category/'.$row['url_name']?>" value="<?=$row['id']?>" id="CatMenu">
                                <input type="hidden" name="menu_category_name[]" value="<?=$row['name']?>" />
                                <label class="form-check-label" for="menu_category">
                                    <?=$row['name']?>
                                </label>
                            </div>
                            <?php
                                endforeach;
                            }
                            ?>
                        </div>

                        <div class="card-footer">
                            <button type="button" class="btn btn-warning float-right addToMenu" name="CatMenu">Ada To Menu</button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-white font-weight-bold ">
                            <?=lang('external_header_card');?>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="menu_name_external">Menu Name</label>
                                <input type="text" class="form-control" id="MenuNameExternal" name="menu_name_external">
                            </div>
                            <div class="form-group">
                                <label for="menu_external">URL External Link</label>
                                <input type="text" class="form-control" id="ExternalMenu" name="menu_external">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="button" class="btn btn-warning float-right addToMenu" name="ExternalMenu">Ada To Menu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-9">
            <div class="card">
                <div class="card-header bg-white font-weight-bold">
                    Menu Group : <?=$group_list[$group_select]?>
                    <?php                        
                        $attr = 'id="menu_group" class="form-control-sm col-1 float-right"';
                        echo form_dropdown('menu_list', $group_list, $group_select, $attr);
                    ?>
                </div>

                <div class="card-body">
                    <div class="dd nestable" id="nestable">
                        <ol class="dd-list">
                        <!--- Initial Menu Items --->
                        <?php                         
                        if(isset($nav_list)){
                            foreach($nav_list as $menu):
                        ?>
                            <!--- Item<?=$menu['id']?> --->
                            <li class="dd-item" data-id="<?=$menu['id']?>" data-name="<?=$menu['title']?>" data-external="<?=$menu['external']?>"  data-slug="<?=$menu['url']?>" data-desc="<?=$menu['description']?>" data-new="0" data-deleted="0">
                                <div class="dd-handle"><?=$menu['title']?> </div>
                                <a href="#" class="btn button-delete btn-danger btn-sm btn-icon pull-right" data-owner-id="<?=$menu['id']?>"><i class="fa fa-fw fa-times" aria-hidden="true"></i></a>
                                <a href="#" class="btn button-edit btn-success btn-sm btn-icon pull-right" data-owner-id="<?=$menu['id']?>"><i class="fa fa-fw fa-pencil-alt" aria-hidden="true"></i></a>                            
                                
                                <?php 
                                    //get children if any
                                    $children = $this->navigation_model->get_children($menu['id']);
                                    if($children !== FALSE){                                        
                                ?>
                                <!-- Item<?=$menu['id']?> children -->
                                <ol class="dd-list">
                                    <?php foreach($children as $child): ?>
                                    <!--- Item<?=$child['id']?> --->
                                    <li class="dd-item" data-id="<?=$child['id']?>" data-name="<?=$child['title']?>" data-external="<?=$child['external']?>" data-slug="<?=$child['url']?>" data-desc="<?=$child['description']?>" data-new="0" data-deleted="0">
                                        <div class="dd-handle"><?=$child['title']?></div>
                                        <a href="#" class="btn button-delete btn-danger btn-sm btn-icon pull-right" data-owner-id="<?=$child['id']?>"><i class="fa fa-fw fa-times" aria-hidden="true"></i></a>
                                        <a href="#" class="btn button-edit btn-success btn-sm btn-icon pull-right" data-owner-id="<?=$child['id']?>"><i class="fa fa-fw fa-pencil-alt" aria-hidden="true"></i></a>                                        
                                        <?php 
                                            //get children if any
                                            $third_child = $this->navigation_model->get_children($child['id']);
                                            if($third_child !== FALSE){                                                
                                        ?>
                                        <!-- Item<?=$child['id']?> children -->
                                        <ol class="dd-list">
                                            <?php foreach($third_child as $thchild): ?>
                                            <!--- Item<?=$thchild['id']?> --->
                                            <li class="dd-item" data-id="<?=$thchild['id']?>" data-name="<?=$thchild['title']?>" data-external="<?=$thchild['external']?>" data-slug="<?=$thchild['url']?>" data-desc="<?=$thchild['description']?>" data-new="0" data-deleted="0">
                                                <div class="dd-handle"><?=$thchild['title']?></div>
                                                <a href="#" class="btn button-delete btn-danger btn-sm btn-icon pull-right" data-owner-id="<?=$thchild['id']?>"><i class="fa fa-fw fa-times" aria-hidden="true"></i></a>
                                                <a href="#" class="btn button-edit btn-success btn-sm btn-icon pull-right" data-owner-id="<?=$thchild['id']?>"><i class="fa fa-fw fa-pencil-alt" aria-hidden="true"></i></a> 
                                            </li>
                                            <?php endforeach; ?>
                                        </ol>
                                        <?php
                                            }
                                        ?>
                                    
                                    </li>
                                    <?php endforeach; ?>
                                </ol>
                                <?php
                                    } 
                                ?>
                            
                            </li>
                        <?php
                            endforeach;
                        }
                        ?>
                        <!--------------------------->
                        </ol>
                    </div>
                </div>

                <div class="card-footer">
                    <input type="hidden" name="order" value="" />
                    <button type="button" class="btn btn-warning float-right" name="saveOrder" id="saveOrder"><?=lang('save_order_btn_value')?></button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Edit -->

<!-- remove modal -->
<div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open(site_url('admin/navigation/update'),array('id' => 'editForm')); ?>            
                <div class="modal-body">
                    <div class="form-group">
                        <label for="site_title">Menu Name</label>
                        <input type="text" name="menu_name_edit" class="form-control" id="menu_name_edit" value="">
                    </div>
                    <div class="form-group">
                        <label for="site_title">Url Menu</label>
                        <input type="text" name="menu_url_edit" class="form-control" id="menu_url_edit" value="">
                    </div>
                    <div class="form-group">
                        <label for="site_title">Description</label>
                        <input type="text" name="menu_desc_edit" class="form-control" id="menu_desc_edit" value="">
                    </div>
                    <p>External menu</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="menu_ext_edit" id="menu_ext_edit">
                        <label class="form-check-label" for="menu_ext_edit">
                            Y
                        </label>
                    </div>
                    <div class="form-group mt-3">
                        <label for="site_title">Group</label>
                        <?php                        
                            $attr = 'id="menu_group_edit" class="form-control"';
                            echo form_dropdown('menu_group_edit', $group_list, $group_select, $attr);
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
                <input type="hidden" id="id_nav" name="id_nav" value="">                
            <?php echo form_close(); ?>
        </div>
    </div>
</div>