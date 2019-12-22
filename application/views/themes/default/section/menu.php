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
        <a class="blog-header-logo text-dark" href="#">If-Blog</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="text-muted" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
        </a>
        <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
        </div>
    </div>
</header>

<div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
        <?php if(($categories = $this->categories_library->get_categories())); ?>
        <?php foreach($categories as $cat_item): ?>
        <a class="p-2 text-muted" href="<?=$cat_item['url_name']?>"><?=$cat_item['name']?></a>        
        <?php endforeach; ?>
    </nav>
</div>