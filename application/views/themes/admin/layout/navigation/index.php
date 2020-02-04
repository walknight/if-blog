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
                            <div class="form-check">
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
                    Menu List 
                    <?php                        
                        $attr = 'id="menu_group" class="form-control-sm col-1 float-right"';
                        echo form_dropdown('menu_list', $group_list, '1', $attr);
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
                            <li class="dd-item" data-id="<?=$menu['id']?>" data-name="<?=$menu['title']?>" data-slug="<?=$menu['url']?>" data-new="0" data-deleted="0">
                                <div class="dd-handle"><?=$menu['title']?> </div>
                                <a href="#" class="btn button-delete btn-danger btn-sm btn-icon pull-right" data-owner-id="<?=$menu['id']?>"><i class="fa fa-fw fa-times" aria-hidden="true"></i></a>
                                <a href="#" class="btn button-edit btn-success btn-sm btn-icon pull-right" data-owner-id="<?=$menu['id']?>"><i class="fa fa-fw fa-pencil-alt" aria-hidden="true"></i></a>                            
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
                    <button type="button" class="btn btn-warning float-right" name="saveOrder" id="saveOrder"><?=lang('save_order_btn_value')?></button>
                </div>
            </div>
        </div>
    </div>

</div>