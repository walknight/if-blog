<main role="main" class="container">
    <div class="row pt-5">
        <div class="col-md-9 blog-main">
            <div class="blog-post">
                <img src="https://via.placeholder.com/830x400" class="img-fluid" />
                <strong class="d-inline-block mb-2 mt-3 text-secondary"><?php echo $post['categories']['name']; ?></strong>
                <h2 class="blog-post-title"><?=$post['title']?></h2>
                <p class="blog-post-meta"><?=strftime('%B %d, %Y', strtotime($post['date_posted'])); ?>
                    <?php echo lang('by'); ?> <?php echo $post['display_name']; ?></p>
                <hr>
                <?=$post['main_article']; ?>
            </div><!-- /.blog-post -->
            <?php if($post['allow_comments']){ ?>
            <div class="post-comments">
                <header>
                    <h3 class="h6"><?=lang('comments')?><span class="no-of-comments"><?php echo '('.count($comments).')'; ?></span></h3>
                </header>
                <hr>
                <?php 
                    if(count($comments) > 0){ 
                        foreach($comments as $list):
                ?>
                <div class="media">
                    <img src="https://d19m59y37dris4.cloudfront.net/blog/1-2-1/img/user.svg" width="50px" class="mr-3" alt="picture">
                    <div class="media-body">
                        <h5 class="mt-0">Anonymous</h5>
                        <p class="small">May, 20 2019</p>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras
                        purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
                        vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>
                <?php
                        endforeach;
                    }
                ?>
            </div>
            
            <div class="add-comment mt-5 mb-5">
                <header>
                    <h3 class="h6"><?=lang('leave_reply')?></h3>
                    <p><?=lang('leave_reply_description')?></p>
                </header>
                <form action="#" class="commenting-form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="username" id="username" placeholder="Name" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="username" id="useremail"
                                placeholder="Email Address (will not be published)" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="usercomment" id="usercomment" placeholder="Type your comment"
                                class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-secondary">Submit Comment</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php } else { ?>
            <div class="alert alert-danger">
                <?=lang('comments_disabled')?>
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
                    <?php endif; ?>
                </ol>
            </div>

        </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->

</main><!-- /.container -->