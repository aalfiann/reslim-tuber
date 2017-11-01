    <link rel="icon" href="<?php echo Core::getInstance()->homepath?>/favicon.png">
    <link rel="canonical" href="<?php echo ((Core::isHttpsButtflare()) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" />
    <link rel="alternate" href="<?php echo ((Core::isHttpsButtflare()) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" hreflang="<?php echo Core::getInstance()->setlang?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS Feed <?php echo Core::lang('search_desc_1').' '.Core::getInstance()->title?>" href="<?php echo Core::getInstance()->homepath?>/rss.php" />
    <link rel="alternate" type="application/xml" title="Sitemap <?php echo Core::lang('search_desc_1').' '.Core::getInstance()->title?>" href="<?php echo Core::getInstance()->homepath?>/sitemap.xml" />
    <meta name="google-site-verification" content="<?php echo Core::getInstance()->googlewebmaster?>" />
    <meta name="msvalidate.01" content="<?php echo Core::getInstance()->bingwebmaster?>"/>
    <meta name="yandex-verification" content="<?php echo Core::getInstance()->yandexwebmaster?>"/>
    <?php
        // Load bootstrap inline 
        echo str_replace('../fonts',Core::getInstance()->homepath.'/bootstrap/fonts',file_get_contents(Core::getInstance()->homepath.'/bootstrap/css/bootstrap.php'));
        // load css inline
        echo str_replace('../fonts',Core::getInstance()->homepath.'/fonts',file_get_contents(Core::getInstance()->homepath.'/css/style.php'));
    ?>
    <?php 
        if (!empty(Core::getInstance()->googleanalytics)){
		    echo '<!-- Google Analytics -->
			<script>
				(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,\'script\',\'https://www.google-analytics.com/analytics.js\',\'ga\');
				ga(\'create\', \''.Core::getInstance()->googleanalytics.'\', \'auto\');
				ga(\'send\', \'pageview\');
			</script>';
    	}
    ?>