<div class="jumbotron p-md-5 text-white bg-dark container">
    <div class="col-md-8 px-0 container">
        <h1 class="display-4 font-italic"><?=lang('archives')?></h1>
    </div>
</div>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-9 blog-main">
            
            <?php if($posts != NULL){ ?>
            <?php foreach($posts as $cat_post): ?>
                <div class="blog-post">
                    
                    <h2 class="blog-post-title"><?=$cat_post['title']?></h2>
                    <p class="blog-post-meta"><?=strftime('%B %d, %Y', strtotime($cat_post['date_posted'])); ?>  <?php echo lang('by'); ?> <?php echo $cat_post['display_name']; ?></p>
                    <?php echo $cat_post['head_article']; ?>
                    <?php echo anchor(post_url($cat_post['url_title'], $cat_post['date_posted']),lang('read_more'),['class'=>'btn btn-primary btn-sm float-right']); ?>
                    <?php if ($links = $this->system_library->generate_social_bookmarking_links(post_url($cat_post['url_title'], $cat_post['date_posted']), $cat_post['title'])): ?>
                        <p><?php echo lang('add_to'); ?> <?php echo $links; ?></p>
                    <?php endif; ?>
                </div><!-- /.blog-post -->
                <hr>
            <?php endforeach; ?>
            <?php } else { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo lang('no_posts_for_this_cat'); ?>
                </div>
            <?php } ?>

        </div><!-- /.blog-main -->

        <aside class="col-md-3 blog-sidebar">
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