<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb">
<head>
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/ccslider/ccslider.css" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen"/>

    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/zoom.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ccslider/jquery.easing.1.3.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ccslider/jquery.ccslider.pack.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ccslider/demo.js"></script> 
    <body>
    <div id="wrapper" <?php body_class(); ?>>
        <div id="logo"><a href="<?php bloginfo('url') ?>"></a></div>
        <div id="slogan"><?php bloginfo('description'); ?></div>
        <div id="nav-top">
            <?php wp_nav_menu($args = array(
            'menu' => 'Top', //(string) Название выводимого меню (указывается в админке при создании меню, приоритетнее чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
            'container' => 'div', //(string) Контейнет меню. Обворачиватель ul. Указывается тег контейнера (по умолчанию в тег div)
            'container_class' => '', //(string) class контейнера (div тега)
            'container_id' => '', //(string) id контейнера (div тега)
            'menu_class' => 'menu', //(string) class самого меню (ul тега)
            'menu_id' => 'ccc', //(string) id самого меню (ul тега)
            'echo' => true, //(boolean) Выводить на экран или возвращать для обработки
            'fallback_cb' => 'wp_page_menu', //(string) Используемая (резервная) функция, если меню не существует (не удалось получить)
            'before' =>  '', //(string) Текст перед <a> каждой ссылки
            'after' => '', //(string) Текст после </a> каждой ссылки
            'link_before' => '', //(string) Текст перед анкором (текстом) ссылки
            'link_after' => '', //(string) Текст после анкора (текста) ссылки
            'depth' => 0, //(integer) Глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
            'walker' => '', //(object) Класс собирающий меню. Default: new Walker_Nav_Menu
            'theme_location' => '') //(string) Расположение меню в шаблоне. (указывается ключь которым было зарегистрировано меню в функции register_nav_menus
        );?>
        </div>
        <?php wp_head(); ?>
</head>
