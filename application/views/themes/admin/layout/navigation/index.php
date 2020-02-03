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
                                <input class="form-check-input" type="checkbox" name="menu_page" data-url="<?='page/'.$list['url_title']?>" value="<?=$list['id']?>" id="menu_page">
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
                            <button type="button" class="btn btn-warning float-right" name="addPageToMenu" id="addPageToMenu">Ada To Menu</button>
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
                                <input class="form-check-input" type="checkbox" name="menu_category" data-url="<?='category/'.$row['url_name']?>" value="<?=$row['id']?>" id="menu_category">
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
                            <button type="button" class="btn btn-warning float-right" name="addCatToMenu" id="addPageToMenu">Ada To Menu</button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-white font-weight-bold ">
                            <?=lang('external_header_card');?>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="menu_external">URL External Link</label>
                                <input type="text" class="form-control" id="menu_external" name="menu_external">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="button" class="btn btn-warning float-right" name="addExternalToMenu" id="addPageToMenu">Ada To Menu</button>
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

                        <!--- Item1 --->
                        <li class="dd-item" data-id="1" data-name="Home" data-slug="home-slug-1" data-new="0" data-deleted="0">
                            <div class="dd-handle">Home </div>
                            <a href="#" class="btn button-delete btn-danger btn-sm btn-icon pull-right" data-owner-id="1"><i class="fa fa-fw fa-times" aria-hidden="true"></i></a>
                            <a href="#" class="btn button-edit btn-success btn-sm btn-icon pull-right" data-owner-id="1"><i class="fa fa-fw fa-pencil-alt" aria-hidden="true"></i></a>                            
                        </li>

                        <!--- Item2 --->
                        <li class="dd-item" data-id="2" data-name="About Us" data-slug="about-slug-2" data-new="0" data-deleted="0">
                            <div class="dd-handle">About Us</div>
                            <a href="#" class="btn button-delete btn-danger btn-sm btn-icon pull-right" data-owner-id="2"><i class="fa fa-fw fa-times" aria-hidden="true"></i></a>
                            <a href="#" class="btn button-edit btn-success btn-sm btn-icon pull-right" data-owner-id="2"><i class="fa fa-fw fa-pencil-alt" aria-hidden="true"></i></a>
                        </li>

                        <!--- Item3 --->
                        <li class="dd-item" data-id="3" data-name="Services" data-slug="services-slug-3" data-new="0" data-deleted="0">
                            <div class="dd-handle">Services</div>
                            <a href="#" class="btn button-delete btn-danger btn-sm btn-icon pull-right" data-owner-id="3"><i class="fa fa-fw fa-times" aria-hidden="true"></i></a>
                            <a href="#" class="btn button-edit btn-success btn-sm btn-icon pull-right" data-owner-id="3"><i class="fa fa-fw fa-pencil-alt" aria-hidden="true"></i></a>
                            <!--- Item3 children --->
                            <ol class="dd-list">
                            <!--- Item4 --->
                            <li class="dd-item" data-id="4" data-name="UI/UX Design" data-slug="uiux-slug-4" data-new="0" data-deleted="0">
                                <div class="dd-handle">UI/UX Design</div>
                                <a href="#" class="btn button-delete btn-danger btn-sm btn-icon pull-right" data-owner-id="4"><i class="fa fa-fw fa-times" aria-hidden="true"></i></a>
                                <a href="#" class="btn button-edit btn-success btn-sm btn-icon pull-right" data-owner-id="4"><i class="fa fa-fw fa-pencil-alt" aria-hidden="true"></i></a>
                            </li>

                            <!--- Item5 --->
                            <li class="dd-item" data-id="5" data-name="Web Design" data-slug="webdesign-slug-5" data-new="0" data-deleted="0">
                                <div class="dd-handle">Web Design </div>
                                <a href="#" class="btn button-delete btn-danger btn-sm btn-icon pull-right" data-owner-id="5"><i class="fa fa-fw fa-times" aria-hidden="true"></i></a>
                                <a href="#" class="btn button-edit btn-success btn-sm btn-icon pull-right" data-owner-id="5"><i class="fa fa-fw fa-pencil-alt" aria-hidden="true"></i></a>
                            </li>
                            
                            </ol>
                        </li>
                        <li class="dd-item" data-id="6" data-name="Contact Us" data-slug="contact-slug-6" data-new="0" data-deleted="0">
                            <div class="dd-handle">Contact Us</div>
                            <a href="#" class="btn button-delete btn-danger btn-sm btn-icon pull-right" data-owner-id="6"><i class="fa fa-fw fa-times" aria-hidden="true"></i></a>
                            <a href="#" class="btn button-edit btn-success btn-sm btn-icon pull-right" data-owner-id="6"><i class="fa fa-fw fa-pencil-alt" aria-hidden="true"></i></a>
                        </li>
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