<div class="jumbotron p-md-5 text-white bg-dark">
    <div class="col-md-8 px-0 container">
        <h1 class="display-4 font-italic"><?=$category['name']?></h1>
        <p class="lead my-3"><?=$category['description']?></p>
    </div>
</div>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-10 blog-main">
            
            <?php if($posts != NULL){ ?>
            <?php foreach($posts as $cat_post): ?>
            <div class="blog-post">
                <h2 class="blog-post-title"><?=$cat_post['title']?></h2>
                <p class="blog-post-meta"><?=strftime('%B %d, %Y', strtotime($cat_post['date_posted'])); ?>
                    <?php echo lang('by'); ?> <?php echo $cat_post['display_name']; ?></p>
                <hr>
                <?=$cat_post['head_article']?>
            </div><!-- /.blog-post -->
            <?php endforeach; ?>
            <?php } else { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo lang('no_posts_for_this_cat'); ?>
                </div>
            <?php } ?>

        </div><!-- /.blog-main -->

        <aside class="col-md-2 blog-sidebar">
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

        </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->

</main><!-- /.container -->