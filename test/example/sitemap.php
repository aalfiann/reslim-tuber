<?php include 'backend/Core.php';
    header('Content-type: application/xml');
    
    //Validasi param
    $page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
    $itemsperpage = filter_var((empty($_GET['itemsperpage'])?'1000':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);
    
    //Get video
    $url = Core::getInstance()->api.'/video/post/data/public/search/asc/'.$page.'/'.$itemsperpage.'/?apikey='.Core::getInstance()->apikey.'&query=';
    $data = json_decode(Core::execGetRequest($url));

    echo '<?xml version="1.0" encoding="UTF-8"?>
                <sitemapindex
                    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
                    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

    if (!empty($data)){
        if($data->{'status'} == "success"){
            for ($x = 1; $x <= $data->metadata->{'page_total'}; $x++) {
                echo '<sitemap>
                    <loc>'.Core::getInstance()->homepath.'/sitemap-video-'.$x.'.xml</loc>
                </sitemap>';
            }
        }
    }
?>
        <sitemap>
            <loc><?php echo Core::getInstance()->homepath?>/sitemap-genre.xml</loc>
        </sitemap>

        <sitemap>
            <loc><?php echo Core::getInstance()->homepath?>/sitemap-static.xml</loc>
        </sitemap>

    </sitemapindex>