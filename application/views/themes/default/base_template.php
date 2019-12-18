<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Bootstrap-ecommerce by Vosidiy">

    <title><?php echo $title; ?></title>

    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>/assets/img/favicon.png">

    <!-- Bootstrap4 files-->    
    <link href="<?php echo base_url(); ?>assets/themes/default/css/bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- Font awesome 5 -->
    <link href="<?php echo base_url(); ?>assets/themes/default/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">

    <!-- plugin: fancybox  -->    
    <link href="<?php echo base_url(); ?>assets/themes/default/plugins/fancybox/fancybox.min.css" type="text/css" rel="stylesheet">

    <!-- custom style -->
    <link href="<?php echo base_url(); ?>assets/themes/default/css/ui.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/themes/default/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />
    <?php
	foreach($css as $file): 
		echo "\n\t\t"; 
	?>
	<link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" />
	<?php
	endforeach;
	echo "\n\t"; 
	?>
    

</head>

<body>

    <?php echo $this->load->get_section('menu'); ?>	

    <?php echo $output; ?>

    <?php echo $this->load->get_section('footer'); ?>

    
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/themes/default/js/jquery-2.0.0.min.js" type="text/javascript"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url(); ?>assets/themes/default/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <!-- plugin : fancybox -->
    <script src="<?php echo base_url(); ?>assets/themes/default/plugins/fancybox/fancybox.min.js" type="text/javascript"></script>

    <!-- custom javascript -->
    <script src="<?php echo base_url(); ?>assets/themes/default/js/script.js" type="text/javascript"></script>

    <?php
	foreach($js as $file):
		echo "\n\t\t"; 
	?>
		<script src="<?php echo $file; ?>"></script>
		<?php
	endforeach; 
	echo "\n\t"; 
	?>

    <?php
    if(isset($script))
    {
        foreach($script as $value):
        echo '<script type="text/javascript">';
        echo $value;
        echo '</script>';
        endforeach;
    }

    if(isset($embed_script))
    {
        echo '<script type="text/javascript">';
        echo $embed_script;
        echo '</script>';
    }
    ?>

</body>

</html>