<?php include 'backend/Core.php';
    header('Content-type: application/xml');

    //Data Dynamic Link
    if (!empty(Core::getInstance()->seopage)){
        echo '<?xml version="1.0" encoding="UTF-8"?>
        <urlset
            xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $datalinks = null;
        $names = Core::getInstance()->seopage;	
        $named = preg_split( "/[,]/", $names );
        foreach($named as $name){
            if ($name != null){$datalinks .= '<url>
                <loc>
                    '.Core::getInstance()->homepath.'/'.Core::convertToSlug(trim($name)).'
                </loc>
                <changefreq>daily</changefreq>
            </url>';}
        }
        echo $datalinks;
        echo '</urlset>';
    }
?>        