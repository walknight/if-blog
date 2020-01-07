<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?=base_url('assets/themes/admin/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/themes/admin/css/fontawesome-all.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/themes/admin/css/datatables.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/themes/admin/css/fullcalendar.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/themes/admin/css/bootadmin.min.css')?>">

    <title><?=$title?></title>
    <?php        
        if(!empty($meta))
        foreach($meta as $name=>$content){
            echo "\n\t\t";
            ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
                }
        echo "\n";

        if(!empty($canonical))
        {
            echo "\n\t\t";
            ?><link rel="canonical" href="<?php echo $canonical?>" /><?php

        }
        echo "\n\t";
    ?>
    
</head>
<body class="bg-light">

    <?php echo $output; ?>    

<script src="https://bootadmin.net/js/jquery.min.js"></script>
<script src="https://bootadmin.net/js/bootstrap.bundle.min.js"></script>
<script src="https://bootadmin.net/js/datatables.min.js"></script>
<script src="https://bootadmin.net/js/moment.min.js"></script>
<script src="https://bootadmin.net/js/fullcalendar.min.js"></script>
<script src="https://bootadmin.net/js/bootadmin.min.js"></script>

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