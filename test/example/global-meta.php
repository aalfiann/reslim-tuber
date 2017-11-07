    <link rel="icon" href="<?php echo Core::getInstance()->homepath?>/favicon.png">
    <link rel="canonical" href="<?php echo ((Core::isHttpsButtflare()) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" />
    <link rel="alternate" href="<?php echo ((Core::isHttpsButtflare()) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" hreflang="<?php echo Core::getInstance()->setlang?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS Feed <?php echo Core::lang('search_desc_1').' '.Core::getInstance()->title?>" href="<?php echo Core::getInstance()->homepath?>/rss.php" />
    <link rel="alternate" type="application/xml" title="Sitemap <?php echo Core::lang('search_desc_1').' '.Core::getInstance()->title?>" href="<?php echo Core::getInstance()->homepath?>/sitemap.xml" />
    <meta name="google-site-verification" content="<?php echo Core::getInstance()->googlewebmaster?>" />
    <meta name="msvalidate.01" content="<?php echo Core::getInstance()->bingwebmaster?>"/>
    <meta name="yandex-verification" content="<?php echo Core::getInstance()->yandexwebmaster?>"/>
    <?php
        /** Set $internalcss to true, if You want to use css as internal inside html to boost the google pagespeed.
         * Internal css is not recommended as cache system will not working and bootstrap.min.css file still too big to render
         **/
        $internalcss = true;
        $combination = true;         // If set to true then internalcss created for bootstrap only and main css will set to external but the rest will load deferred
        if($internalcss){
            if ($combination){
                // Bootstrap core CSS
                echo str_replace('../fonts',Core::getInstance()->homepath.'/bootstrap/fonts',file_get_contents(Core::getInstance()->homepath.'/bootstrap/css/bootstrap.php'));
                echo '<!-- Core CSS -->
                <link href="'.Core::getInstance()->homepath.'/css/main.min.css" rel="stylesheet">';
            } else {
                // Bootstrap core CSS
                echo str_replace('../fonts',Core::getInstance()->homepath.'/bootstrap/fonts',file_get_contents(Core::getInstance()->homepath.'/bootstrap/css/bootstrap.php'));
                // Core CSS
                echo str_replace('../fonts',Core::getInstance()->homepath.'/fonts',file_get_contents(Core::getInstance()->homepath.'/css/style.php'));
            }
        } else {
            echo '<!-- Bootstrap core CSS -->
            <link href="'.Core::getInstance()->homepath.'/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <!-- Core CSS -->
            <link href="'.Core::getInstance()->homepath.'/css/main.min.css" rel="stylesheet">';
        }
    ?>