<main role="main" class="container">
    <div class="row">
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
        Latest Posts
        </h3>
        <?php if($posts != NULL){ ?>
        <?php foreach($posts as $post_item): ?>
        <?php if($post_item['sticky'] != 1){ ?>
        
        <div class="blog-post">
            <?php foreach($post_item['categories'] as $cat): ?>
            <strong class="d-inline-block mb-2 text-secondary"><?=$cat['name']?></strong>
            <?php endforeach; ?>
            <h2 class="blog-post-title"><?=$post_item['title']?></h2>
            <p class="blog-post-meta"><?=strftime('%B %d, %Y', strtotime($post_item['date_posted'])); ?>  <?php echo lang('by'); ?> <?php echo $post_item['display_name']; ?></p>
            <?php echo $post_item['head_article']; ?>
            <?php echo anchor(post_url($post_item['url_title'], $post_item['date_posted']),lang('read_more'),['class'=>'btn btn-primary btn-sm float-right']); ?>
            <?php if ($links = $this->system_library->generate_social_bookmarking_links(post_url($post_item['url_title'], $post_item['date_posted']), $post_item['title'])): ?>
                <p><?php echo lang('add_to'); ?> <?php echo $links; ?></p>
            <?php endif; ?>
        </div><!-- /.blog-post -->
        <hr>
        <?php } ?>
        <?php endforeach; ?>
        <?php } ?>

        <?php if ($posts_count > $posts_per_page): ?>
            <nav class="blog-pagination">
                <?php if ($current_page < $pages_count): ?>
                    <a class="btn btn-outline-primary" href="<?php echo site_url('post/page/' . $next_page); ?>"><?php echo lang('older_entries'); ?></a>
                <?php  endif; ?>

                <?php if ($current_page > 1){ ?>
                    <?php  if ($previous_page == 1){ ?>
                        <a class="btn btn-outline-primary" href="<?php echo site_url();?>"><?php echo lang('newer_entries'); ?></a>
                    <?php  }else{ ?>
                        <a class="btn btn-outline-secondary disabled" href="<?php echo site_url('post/page/' . $previous_page); ?>"><?php echo lang('newer_entries'); ?></a>
                    <?php } ?>
                <?php } ?>
            </nav>
        <?php  endif; ?>

    </div><!-- /.blog-main -->

    <aside class="col-md-4 blog-sidebar">

        <div class="p-3">
        <h4 class="font-italic">Archives</h4>
        <ol class="list-unstyled mb-0">
            <?php if (($archive = $this->archive_library->get_archive())): ?>
                <?php foreach ($archive as $archive_item): ?>
                    <li><a href="<?php echo archive_url($archive_item['url']); ?>"><?php echo $archive_item['date_posted']; ?> (<?php echo $archive_item['posts_count']; ?>)</a></li>
                <?php endforeach; ?>
            <? endif; ?>
        </ol>
        </div>

    </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->

</main><!-- /.container -->