<?php include 'backend/Core.php';
    header('Content-type: application/xml');
    
    //Validasi param
    $page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
    $itemsperpage = filter_var((empty($_GET['itemsperpage'])?'1000':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);
    
    //Data tags
    $urlgenre = Core::getInstance()->api.'/video/post/data/public/tags/all/?apikey='.Core::getInstance()->apikey;
    $datagenre = json_decode(Core::execGetRequest($urlgenre));
    //Data country
    $urlcountry = Core::getInstance()->api.'/video/post/data/public/countries/all/?apikey='.Core::getInstance()->apikey;
    $datacountry = json_decode(Core::execGetRequest($urlcountry));
    //Data release
    $urlrelease = Core::getInstance()->api.'/video/post/data/public/release/all/?apikey='.Core::getInstance()->apikey;
    $datarelease = json_decode(Core::execGetRequest($urlrelease));

    echo '<?xml version="1.0" encoding="UTF-8"?>
            <urlset
                xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
                xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
    if (!empty($datagenre)){
        if($datagenre->{'status'} == "success"){
            foreach ($datagenre->result->{'Tags'} as $name => $valuegenre) {
                echo '<url>
                    <loc>'.Core::getInstance()->homepath.'/index.php?search='.$valuegenre.'</loc>
                    <changefreq>yearly</changefreq>
                </url>';
            }
        }
    }
    if (!empty($datacountry)){
        if($datacountry->{'status'} == "success"){
            foreach ($datacountry->result->{'Country'} as $name => $valuecountry) {
                echo '<url>
                    <loc>'.Core::getInstance()->homepath.'/index.php?search='.$valuecountry.'</loc>
                    <changefreq>yearly</changefreq>
                </url>';
            }
        }
    }
    if (!empty($datarelease)){
        if($datarelease->{'status'} == "success"){
            foreach ($datarelease->result->{'Released'} as $name => $valuerelease) {
                echo '<url>
                    <loc>'.Core::getInstance()->homepath.'/index.php?search='.$valuerelease.'</loc>
                    <changefreq>yearly</changefreq>
                </url>';
            }
        }
    }
    echo '</urlset>';
?>