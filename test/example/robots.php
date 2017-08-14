<?php include 'backend/Core.php';
    header('Content-Type:text/plain');

    echo 'User-Agent: *
Allow: /
Disallow: /backend/

Sitemap: '.Core::getInstance()->homepath.'/sitemap.php';
?>