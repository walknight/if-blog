<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
        <?php if (($navigation = $this->navigation_library->get_navigation())): ?>
            <?php foreach ($navigation as $navigation_item): ?>
                <a class="text-muted" href="<?php echo ($navigation_item['external'] == 0) ? site_url($navigation_item['url']) : $navigation_item['url']; ?>" title="<?php echo $navigation_item['description']; ?>"><?php echo $navigation_item['title']; ?></a> |
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
        <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="<?=site_url()?>"><?=$this->system_library->settings['site_title']?></a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
        <form action="<?=site_url('search')?>" method="post">
            <input type="text" placeholder="Search.." name="term">
            <button type="submit">Submit</button>
        </form>
        </div>
    </div>
</header>

<div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
        <?php if(($categories = $this->categories_library->get_categories())); ?>
        <?php foreach($categories as $cat_item): ?>
        <a class="p-2 text-muted" href="<?=category_url($cat_item['url_name'])?>"><?=$cat_item['name']?></a>        
        <?php endforeach; ?>
    </nav>
</div>