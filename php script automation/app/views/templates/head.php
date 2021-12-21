<?php
if(!isset($data['print'])) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= SITE_TITLE; ?></title>
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="<?= SITE_TITLE; ?>">
        <link rel="shortcut icon" href="<?= URL ?>public/img/favicon.ico">
        <link href="<?= URL ?>public/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= URL ?>public/css/bootstrap-reset.css" rel="stylesheet">

        <link href="<?= URL ?>public/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?= URL ?>public/css/owl.carousel.css" type="text/css">
        <link href="<?= URL ?>public/css/w3.css" rel="stylesheet">
        <link href="<?= URL ?>public/css/style.css" rel="stylesheet">
        <link href="<?= URL ?>public/css/style-responsive.css" rel="stylesheet" />
        <script src="<?= URL ?>public/js/jquery.min.js"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="<?= URL ?>public/js/html5shiv.js"></script>
        <script src="<?= URL ?>public/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body <?php if(isset($data['login'])){ ?>
        style="background-image: url('<?=URL?>public/img/banner.png');background-position: top; background-size: inherit;"
    <?php } ?>>

    <?php if(!isset($data['login'])){ ?>    <section id="container" class="main-containers" > <?php } ?>
<?php
}
?>