<?php include 'backend/Core.php';
    //Validation url param
    $search = filter_var((empty($_GET['search'])?'':$_GET['search']),FILTER_SANITIZE_STRING);
    $page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
    $itemsperpage = filter_var((empty($_GET['itemsperpage'])?'20':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);

    //Get video
    $url = Core::getInstance()->api.'/video/post/data/public/search/'.$page.'/'.$itemsperpage.'/?apikey='.Core::getInstance()->apikey.'&query='.rawurlencode($search);
    $data = json_decode(Core::execGetRequest($url));

    if (empty($search)){
        $title = Core::getInstance()->description.(!empty($page) && ($page != 1)?' | '.Core::lang('page').' '.$page:'').' | '.Core::getInstance()->title;
        $description = Core::getInstance()->description.'. '.Core::lang('genre_desc_1').(!empty($page)?' '.Core::lang('page').' '.$page:'').' | '.Core::getInstance()->title;
        $keyword = Core::getInstance()->keyword;
        $author = Core::getInstance()->title.' Team';
        $image = Core::getInstance()->homepath.'/images/contact.jpg';
    } else {
        $title = Core::lang('search_desc_1').' '.$search.(!empty($page)?' | '.Core::lang('page').' '.$page:'').' | '.Core::getInstance()->title;
        $description = ''.Core::lang('search_desc_1').' '.$search.'. '.Core::lang('genre_desc_1').(!empty($page)?' '.Core::lang('page').' '.$page:'');
        $keyword = ''.Core::lang('search_key_1').' '.$search;
        $author = Core::getInstance()->title.' Team';
        $image = Core::getInstance()->homepath.'/images/contact.jpg';
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

    <?php include 'global-opengraph.php';?>

    <title><?php echo $title?></title>

    <?php include 'global-meta.php';?>
</head>

<body class="dark">
<?php include 'global-header.php';?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- Latest Movies -->
                <div class="content-block head-div">
                    <div class="cb-header">
                        <div class="row">
                            <div class="col-lg-10 col-sm-10 col-xs-8">
                                <ul class="list-inline"><h1 style="font-size: 20px !important;">
                                    <?php if (empty($search)){
                                        echo '<li class="color-active">'.Core::lang('latest_movie').'</li>';
                                    } else {
                                        echo '<li class="color-active">'.Core::lang('search_desc_1').' '.$search.'</li>';
                                    }
                                    ?></h1>
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

                <?php
                    if (!empty($data) && ($data->{'status'} == "success")){
                        $pagination = new Pagination;
                        echo $pagination->makePaginationFrontend($data,$_SERVER['PHP_SELF'].'?search='.rawurlencode($search));
                    }
                ?>

            </div>
        </div>
    </div>
</div>

<?php include 'global-footer.php';?>
<?php include 'global-js.php';?>

</body>
</html>
