<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php        
        if(!empty($meta))
        foreach($meta as $name=>$content){
            echo "\n\t\t";
            ?>
    <meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
                }
        echo "\n";

        if(!empty($canonical))
        {
            echo "\n\t\t";
            ?>
    <link rel="canonical" href="<?php echo $canonical?>" /><?php

        }
        echo "\n\t";
    ?>
    <link rel="stylesheet" href="<?=base_url('assets/themes/admin/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/themes/admin/css/fontawesome-all.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/themes/admin/css/datatables.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/themes/admin/css/fullcalendar.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/themes/admin/css/bootadmin.min.css')?>">
    <?php
    
    foreach($css as $file){
        echo "\n\t\t";
        ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
    } echo "\n\t";

    ?>
    <title><?=$title?></title>

</head>

<body class="bg-light">

    <?php echo $this->load->get_section('head'); ?>

    <div class="d-flex">
        
        <?php echo $this->load->get_section('menu'); ?>
        
        <?php echo $output; ?>
                                
    </div>

    <footer style=" background-color: #343a40;color:#fff;">
        <div class="container">
        <?php 
            $this->load->section('footer','themes/admin/static/footer'); 
            echo $this->load->get_section('footer'); 
        ?>
        </div>
    <footer>

    <script src="<?=base_url('assets/themes/admin/js/jquery.min.js')?>"></script>
    <script src="<?=base_url('assets/themes/admin/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?=base_url('assets/themes/admin/js/datatables.min.js')?>"></script>
    <script src="<?=base_url('assets/themes/admin/js/moment.min.js')?>"></script>
    <script src="<?=base_url('assets/themes/admin/js/fullcalendar.min.js')?>"></script>
    <script src="<?=base_url('assets/themes/admin/js/bootadmin.min.js')?>"></script>
    
    <?php
    foreach($js as $file):
    ?>
    <script src="<?php echo $file; ?>"></script>
    <?php
        endforeach;
        echo "\n";
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