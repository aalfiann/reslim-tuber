<?php include '../backend/Core.php';
    header('Content-type: application/rss+xml');
    
    //Validasi param
    $page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
    $itemsperpage = filter_var((empty($_GET['itemsperpage'])?'50':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);
    
    //Get video
    $url = Core::getInstance()->api.'/video/post/data/public/search/'.$page.'/'.$itemsperpage.'/?apikey='.Core::getInstance()->apikey.'&query=';
    $data = json_decode(Core::execGetRequest($url));

    if (!empty($data)){
        if($data->{'status'} == "success"){
            echo '<?xml version="1.0" encoding="UTF-8"?>  
	                <rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">  
            	    <channel>
                        <atom:link href="'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" rel="self" type="application/rss+xml" />
                        <title>'.Core::getInstance()->title.'</title>
                        <link>'.Core::getInstance()->homepath.'</link>
                        <description>Nonton atau streaming online film gratis subtitle indonesia dan English</description>';
                        echo "\n";
            foreach ($data->results as $name => $value) {
                echo '<item>
                    <title>'.htmlspecialchars($value->{'Title'}, ENT_QUOTES).'</title>
                    <description><![CDATA['.$value->{'Description'}.']]></description>
                    <link>'.Core::getInstance()->homepath.'/index.php?movie='.$value->{'PostID'}.'</link>
                    <guid>'.Core::getInstance()->homepath.'/index.php?movie='.$value->{'PostID'}.'</guid>
                    <pubDate>'.date_format(date_create($value->{'Created_at'}), 'D, d M Y H:i:s O').'</pubDate>
                </item>';
                echo "\n";
            }
            echo '</channel>
                    </rss>';
        }
    }
?>