<?php
///template/global/page_top.php
?>
<!DOCTYPE html>
<html lang="<?php echo ($userLanguage); ?>" data-layout="topnav">

<head>
    <meta charset="utf-8" />
    <title>
        <?php echo (_lang['user_title']); ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="57x57" href="./itheme/panel/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="./itheme/panel/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="./itheme/panel/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="./itheme/panel/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="./itheme/panel/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="./itheme/panel/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="./itheme/panel/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="./itheme/panel/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="./itheme/panel/icon/apple-icon-180x180.png">
    <link rel="icon" type="images/png" sizes="192x192" href="./itheme/panel/icon/android-icon-192x192.png">
    <link rel="icon" type="images/png" sizes="32x32" href="./itheme/panel/icon/favicon-32x32.png">
    <link rel="icon" type="images/png" sizes="96x96" href="./itheme/panel/icon/favicon-96x96.png">
    <link rel="icon" type="images/png" sizes="16x16" href="./itheme/panel/icon/favicon-16x16.png">
    <link rel="manifest" href="./itheme/panel/icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="./itheme/panel/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="author" content="Mehdi Imeni: Imeni1982@gmail.com" />


    <link href="./itheme/panel/vendor/select2/css/select2.min.css" rel="stylesheet" type="text/css" />


    <style>
        #parent {
            /* can be any value */
            width: 300px;
            text-align: right;
            direction: rtl;
            position: relative;
        }

        #parent .select2-container--open+.select2-container--open {
            left: auto;
            right: 0;
            width: 100%;
        }
    </style>
    <!-- Fullcalendar css -->
    <link href="./itheme/panel/vendor/fullcalendar/main.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme Config Js -->
    <script src="./itheme/panel/js/hyper-config.js"></script>



    <!-- App css -->
    <link href="./itheme/panel/css/app-creative.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="./itheme/panel/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>


