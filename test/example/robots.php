<?php include 'backend/Core.php';
    header('Content-Type:text/plain');

    echo 'User-Agent: *
Allow: /

Sitemap: '.Core::getInstance()->homepath.'/sitemap.xml';
?>