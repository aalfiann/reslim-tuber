<?php include 'backend/Core.php';
    //Data Dynamic Link
    if (!empty(Core::getInstance()->seopage)){
        if (strpos(strtolower(Core::getInstance()->seopage), strtolower(str_replace("-"," ",$_GET['title']))) !== false) {
            $datalinks = null;
            $names = Core::getInstance()->seopage;	
            $named = preg_split( "/[,]/", $names );
            foreach($named as $name){
                if ($name != null){$datalinks .= '<li><a href="'.Core::getInstance()->homepath.'/'.Core::convertToSlug(trim($name)).'" title="'.ucwords(str_replace("-"," ",trim($name))).'"><h3 style="font-size: 15px !important;">'.ucwords(str_replace("-"," ",trim($name))).'</h3></a></li>';}
            }
        } else {
            header("Location: ".Core::getInstance()->homepath."/index.php");
        }
    } else {
        header("Location: ".Core::getInstance()->homepath."/index.php");
    }

    $page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
    $itemsperpage = filter_var((empty($_GET['itemsperpage'])?'20':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);

    //Get video
    $url = Core::getInstance()->api.'/video/post/data/public/search/random/'.$page.'/'.$itemsperpage.'/?apikey='.Core::getInstance()->apikey;
    $data = json_decode(Core::execGetRequest($url));

    $title = ucwords(str_replace("-"," ",$_GET['title'])).' - '.Core::lang('watch_recomended').' | '.Core::getInstance()->title;
    $description = ucwords(str_replace("-"," ",$_GET['title'])).' - '.Core::lang('watch_recomended').' '.Core::lang('most_popular').'. '.Core::lang('genre_desc_1').' | '.Core::getInstance()->title;
    $keyword = str_replace("-",", ",$_GET['title']).', '.Core::getInstance()->keyword;
    $author = Core::getInstance()->title.' Team';
    $image = Core::getInstance()->homepath.'/images/contact.jpg';

    //Data twitter
    if (!empty(Core::getInstance()->twitter)){
        $twittersite = Core::getInstance()->twitter;
        $twitterarray = explode('/',$twittersite);
        $twitterusername = end($twitterarray);
    }
?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="<?php echo $description?>">
    <meta name="keyword" content="<?php echo $keyword?>">
    <meta name="author" content="<?php echo $author?>">

    <!-- Open Graphs -->
    <link rel="author" href="<?php echo ((!empty(Core::getInstance()->gplus))?Core::getInstance()->gplus:'')?>"/>
    <link rel="publisher" href="<?php echo ((!empty(Core::getInstance()->gpub))?Core::getInstance()->gpub:'')?>"/>
    <meta itemprop="name" content="<?php echo $title?>">
    <meta itemprop="description" content="<?php echo $description?>">
    <meta itemprop="image" content="<?php echo $image?>">
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo $title?>" />
    <meta name="twitter:description" content="<?php echo $description?>" />
    <meta name="twitter:image" content="<?php echo $image?>" />
    <meta name="twitter:image:alt" content="<?php echo $title?>" />
    <meta name="twitter:site" content="<?php echo ((!empty(Core::getInstance()->twitter))?'@'.$twitterusername:'')?>">
    <meta name="twitter:creator" content="<?php echo ((!empty(Core::getInstance()->twitter))?'@'.$twitterusername:'')?>">
    <meta property="og:title" content="<?php echo $title?>" />
    <meta property="og:description" content="<?php echo $description?>" />
    <meta property="og:url" content="<?php echo ((Core::isHttpsButtflare()) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" />
    <meta property="og:image" content="<?php echo $image?>" />
    <meta property="og:site_name" content="<?php echo Core::getInstance()->title?>" />

    <title><?php echo $title?></title>

    <?php include 'global-meta.php';?>
</head>

<body class="dark">
<?php include 'global-header.php';?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Header submenu-->
                <div class="content-block">
                    <div class="cb-header">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="list-inline">
                                    <li><a href="<?php echo Core::getInstance()->homepath.'/'.$_GET['title']?>" class="color-active" title="<?php echo ucwords(str_replace("-"," ",$_GET['title'])) ?>"><h2 style="font-size: 20px !important;"><?php echo ucwords(str_replace("-"," ",$_GET['title'])) ?></h2></a></li>
                                    <li><a href="genre.php" title="<?php echo Core::lang('watch_header').' '.Core::lang('all')?> Genre"><?php echo Core::lang('all')?> Genre</a></li>
                                    <li><a href="rating.php" title="<?php echo Core::lang('watch_header').' '.Core::lang('best_rating')?>"><?php echo Core::lang('best_rating')?></a></li>
                                    <li><a href="popular.php" title="<?php echo Core::lang('watch_header').' '.Core::lang('most_popular')?>"><?php echo Core::lang('most_popular')?></a></li>
                                    <li><a href="favorite.php" title="<?php echo Core::lang('watch_header').' '.Core::lang('most_favorite')?>"><?php echo Core::lang('most_favorite')?></a></li>
                                    <li><a href="alphabet.php" title="<?php echo Core::lang('watch_header').' '.Core::lang('sort_alphabet')?>"><?php echo Core::lang('sort_alphabet')?></a></li>
                                    <li><a href="released.php" title="<?php echo Core::lang('watch_header').' '.Core::lang('sort_released')?>"><?php echo Core::lang('sort_released')?></a></li>
                                    <li><a href="random.php" title="<?php echo Core::lang('watch_header').' '.Core::lang('random')?>"><?php echo Core::lang('random')?></a></li>
                                    <li><a href="tv-online.php" title="<?php echo Core::lang('watch_header')?> TV Online">TV Online</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header submenu-->

                <!-- Latest Movies -->
                <div class="content-block head-div">
                    <div class="cb-header">
                        <div class="row">
                            <div class="col-lg-10 col-sm-10 col-xs-8">
                                <ul class="list-inline">
                                    <li class="color-active"><h1 style="font-size: 20px !important;"><?php echo ucwords(str_replace("-"," ",$_GET['title'])).' - '.Core::lang('watch_recomended')?></h1></li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                    <div class="cb-content videolist">
                        <div class="row">
                            <?php
                                if (!empty($data)){
                                    if ($data->{'status'} == "success"){
                                        $i=1;
                                        foreach ($data->results as $name => $value) {
                                            echo '<div class="col-lg-3 col-sm-6 videoitem">
                                                    <div class="b-video">
                                                        <div class="v-img">
                                                            <a href="'.Core::lang('watch').'/'.$value->{'PostID'}.'/'.Core::convertToSlug($value->{'Title'}).'" title="'.Core::lang('watch_header').' '.$value->{'Title'}.'"><img src="'.$value->{'Image'}.'" class="top-cropped" alt="'.Core::lang('watch_header').' '.$value->{'Title'}.'"></a>
                                                            <div class="rating">'.$value->{'Rating'}.'</div>
                                                            <div class="time">'.$value->{'Duration'}.'</div>
                                                        </div>
                                                        <div class="v-desc">
                                                            <a href="'.Core::lang('watch').'/'.$value->{'PostID'}.'/'.Core::convertToSlug($value->{'Title'}).'" title="'.Core::lang('watch_header').' '.$value->{'Title'}.'">'.Core::cutLongText($value->{'Title'},60).'</a>
                                                        </div>
                                                        <div class="v-views">';
                                                        $datatag = "";
                                                        foreach ($value->{'Tags'} as $namegenre => $valuegenre) {
                                                            $datatag .= '<a style="color:#6F6D6D" onMouseOut="this.style.color=\'#6F6D6D\'" onMouseOver="this.style.color=\'#ea2c5a\'" href="index.php?search='.$valuegenre.'" title="'.Core::lang('watch_header').' '.$valuegenre.'">'.$valuegenre.'</a>, ';
                                                        }
                                                        $datatag = substr($datatag, 0, -2);
                                                        echo $datatag;
                                                        echo '</div>
                                                    </div>
                                                </div>';
                                            if ($i%4==0){
                    				        	echo '<div class="clearfix visible-lg-block"></div>';
        					                }
                                            if ($i%2==0){
                    				        	echo '<div class="clearfix visible-md-block"></div>';
        					                }
                                            $i++;
                                        }
                                    } else {
                                        echo '<div class="col-lg-6 col-sm-6 videoitem">
                                            <strong><h1 class="color-active">404</h1></strong>
                                            <h2 class="color-active">'.Core::lang('search_not_found').'</h2>
                                            </div>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /Latest Movies -->

                <?php if (!empty(Core::getInstance()->seopage)){
                    echo '<!-- Footer link menu-->
                    <div class="content-block head-div">
                        <div class="cb-header">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="list-inline">
                                        '.$datalinks.'
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer link menu-->';
                }?>
            </div>
        </div>
    </div>
</div>

<?php include 'global-footer.php';?>
<?php include 'global-js.php';?>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "WebSite",
  "url": "<?php echo ((Core::isHttpsButtflare()) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>",
  "name": "<?php echo $title?>",
  "alternateName": "<?php echo $description?>",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "<?php echo Core::getInstance()->homepath?>/index.php?search={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
</body>
</html>
