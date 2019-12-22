<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title><?=$title?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url('assets/themes/default/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="<?=base_url('assets/themes/default/blog.css')?>" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      
        <?php echo $this->load->get_section('menu'); ?>

        <?php echo $this->load->get_section('highlight'); ?>

        <?php echo $this->load->get_section('featured'); ?>
    </div>

    <?php echo $output; ?>

    <?php echo $this->load->get_section('footer'); ?>

  </body>
</html>
