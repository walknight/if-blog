<main role="main" class="container">
    <div class="row">
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
        Latest Posts
        </h3>
        <?php if($posts != NULL){ ?>
        <?php foreach($posts as $post_item): ?>
        <?php if($post_item['sticky'] != 1 && $post_item['featured'] != 1){ ?>
        
        <div class="blog-post">
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
        <div class="p-3 mb-3 bg-light rounded">
        <h4 class="font-italic">About</h4>
        <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        </div>

        <div class="p-3">
        <h4 class="font-italic">Archives</h4>
        <ol class="list-unstyled mb-0">
            <li><a href="#">March 2014</a></li>
            <li><a href="#">February 2014</a></li>
            <li><a href="#">January 2014</a></li>
            <li><a href="#">December 2013</a></li>
            <li><a href="#">November 2013</a></li>
            <li><a href="#">October 2013</a></li>
            <li><a href="#">September 2013</a></li>
            <li><a href="#">August 2013</a></li>
            <li><a href="#">July 2013</a></li>
            <li><a href="#">June 2013</a></li>
            <li><a href="#">May 2013</a></li>
            <li><a href="#">April 2013</a></li>
        </ol>
        </div>

        <div class="p-3">
        <h4 class="font-italic">Elsewhere</h4>
        <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
        </ol>
        </div>
    </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->

</main><!-- /.container -->