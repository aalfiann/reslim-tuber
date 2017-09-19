    <link rel="icon" href="<?php echo Core::getInstance()->homepath?>/favicon.png">
    <link rel="canonical" href="<?php echo ((Core::isHttpsButtflare()) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" />
    <link rel="alternate" href="<?php echo ((Core::isHttpsButtflare()) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" hreflang="<?php echo Core::getInstance()->setlang?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS Feed <?php echo Core::lang('search_desc_1').' '.Core::getInstance()->title?>" href="<?php echo Core::getInstance()->homepath?>/rss.php" />
    <link rel="alternate" type="application/xml" title="Sitemap <?php echo Core::lang('search_desc_1').' '.Core::getInstance()->title?>" href="<?php echo Core::getInstance()->homepath?>/sitemap.xml" />
    <meta name="google-site-verification" content="<?php echo Core::getInstance()->googlewebmaster?>" />
    <meta name="msvalidate.01" content="<?php echo Core::getInstance()->bingwebmaster?>"/>
    <meta name="yandex-verification" content="<?php echo Core::getInstance()->yandexwebmaster?>"/>
    
    <!-- Bootstrap core CSS -->
    <link href="<?php echo Core::getInstance()->homepath?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="<?php echo Core::getInstance()->homepath?>/css/style.css" rel="stylesheet">
    <link href="<?php echo ((Core::isHttpsButtflare()) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST']?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo Core::getInstance()->homepath?>/css/font-circle-video.css" rel="stylesheet">

    <!-- font-family: 'Hind', sans-serif; -->
    <link href='https://fonts.googleapis.com/css?family=Hind:400,300,500,600,700|Hind+Guntur:300,400,500,700' rel='stylesheet' type='text/css'>