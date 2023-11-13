<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo SITENAME; ?>
    </title>
    <meta name="description" content="Health, tradition and beauty are paramount to Organic Looms hand-crafted rug collections. Made from the finest materials in their most natural state, each step of the process is connected to the artisan’s hand integrating innovative and sustainable fabrication techniques positively affecting our environment.">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo MAINURLROOT; ?>favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo MAINURLROOT; ?>favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo MAINURLROOT; ?>favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo MAINURLROOT; ?>favicon/site.webmanifest">
    <link rel="mask-icon" href="<?php echo MAINURLROOT; ?>favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="<?php echo MAINURLROOT; ?>favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="<?php echo MAINURLROOT; ?>favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php if (isset($headerStyles)) {
        echo $headerStyles;
    } ?>

    <link rel="stylesheet" href="<?php echo MAINURLROOT; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>css/style.css">
</head>

<body id="top" class="<?= (isset($bodyclass)) ? $bodyclass : ''; ?>">
    <?php if (isset($_SESSION["cart_item"]) && !empty($_SESSION["cart_item"])) {
        $cartTotal = count($_SESSION["cart_item"]);
    } else {
        $cartTotal = 0;
    } ?>
    <span id="cartCount" class="cart-count d-none">
        <?= $cartTotal; ?>
    </span>
    <?php require APPROOT . '/views/inc/navbar.php'; ?>