<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo SITENAME; ?> - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php if (isset($headerStyles)) {
        echo $headerStyles;
    } ?>

    <link rel="stylesheet" href="<?php echo URLROOT; ?>css/style.css">

</head>

<body>
    <?php require APPROOT . '/views/incadmin/navbar.php'; ?>
    <div class="container">