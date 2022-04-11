<!DOCTYPE html>
<!--[if IE]><html lang="pt-br" class="lt-ie9 lt-ie8"><![endif]-->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php wp_title( '|', true, null ); ?></title>
    <meta name="language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="format-detection" content="telephone=no">
    <meta name="author" content="André Facchini / github@drunksheep">
    <meta name="language" content="pt-br" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="masthead">
    <div class="upper-partition">
        <div class="center-content">
            <div class="flexed row wrap aic-center pdt-2">
                <i class="fab fa-whatsapp t-red t-20"></i>
                &nbsp;&nbsp;
                <span class="t-purple t-18 t-med">(11) 99999 - 9999</span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <i class="far fa-envelope t-red t-20"></i>
                &nbsp;&nbsp;
                <span class="t-purple t-18 t-med">falamewsocial@gmail.com</span>
            </div>
        </div>
    </div>
    <div class="center-content flexed row wrap aic-center jfc-center pdb-4 pdt-2">
        <a href="<?php echo site_url('/') ?>" class="header-logo ml-auto mr-auto">
            <img src="<?php bloginfo('template_url') ?>/images/logo.png" alt="Logotipo Falamew">
        </a>
    </div>
</header>