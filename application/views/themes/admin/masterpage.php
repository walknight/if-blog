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

    <title><?=$title?></title>

</head>

<body class="bg-light">

    <?php echo $this->load->get_section('head'); ?>

    <div class="d-flex">
        
        <?php echo $this->load->get_section('menu'); ?>

        <?php echo $output; ?>

    </div>

    <script src="https://bootadmin.net/js/jquery.min.js"></script>
    <script src="https://bootadmin.net/js/bootstrap.bundle.min.js"></script>
    <script src="https://bootadmin.net/js/datatables.min.js"></script>
    <script src="https://bootadmin.net/js/moment.min.js"></script>
    <script src="https://bootadmin.net/js/fullcalendar.min.js"></script>
    <script src="https://bootadmin.net/js/bootadmin.min.js"></script>

</body>

</html>