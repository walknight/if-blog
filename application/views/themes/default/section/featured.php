<?php if(count($featured) > 0){ ?>
<div class="row mb-2">
<?php foreach($featured as $list): ?>
<div class="col-md-6">
    <div class="card flex-md-row mb-4 box-shadow h-md-250">
    <div class="card-body d-flex flex-column align-items-start">        
        <?php //foreach($list['categories'] as $cat): ?>
        <strong class="d-inline-block mb-2 text-danger"><?=$list['categories']['name']?></strong>
        <?php //endforeach; ?>
        <h3 class="mb-0">
        <a class="text-dark" href="#"><?=$list['title']?></a>
        </h3>
        <div class="mb-1 text-muted"><?=strftime('%B %d, %Y', strtotime($list['date_posted'])); ?>  <?php echo lang('by'); ?> <?php echo $list['first_name']; ?></div>
        <p class="card-text mb-auto"><?=word_limiter($list['head_article'], 4);?></p>
        <?php echo anchor(post_url($list['url_title'], $list['date_posted']),lang('read_more'),['class'=>'btn btn-primary btn-sm float-right']); ?>
    </div>
    <img class="card-img-right flex-auto d-none d-lg-block" data-src="holder.js/200x250?theme=thumb" alt="Card image cap">
    </div>
</div>
<?php endforeach; ?>
<?php } ?>