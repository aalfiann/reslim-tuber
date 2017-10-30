<?php include 'backend/Core.php';
    $page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
    $itemsperpage = filter_var((empty($_GET['itemsperpage'])?'20':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);

    //Get video
    $url = Core::getInstance()->api.'/video/post/data/public/show/released/'.$page.'/'.$itemsperpage.'/?apikey='.Core::getInstance()->apikey;
    $data = json_decode(Core::execGetRequest($url));

    //Data Dynamic Link
    if (!empty(Core::getInstance()->seopage)){
        $datalinks = null;
        $names = Core::getInstance()->seopage;	
        $named = preg_split( "/[,]/", $names );
        foreach($named as $name){
            if ($name != null){$datalinks .= '<li><a href="'.Core::getInstance()->homepath.'/'.Core::convertToSlug(trim($name)).'" title="'.ucwords(str_replace("-"," ",trim($name))).'">'.ucwords(str_replace("-"," ",trim($name))).'</a></li>';}
        }
    }

    $title = Core::lang('released_list').(!empty($page) && ($page != 1)?' | '.Core::lang('page').' '.$page:'').' | '.Core::getInstance()->title;
    $description = Core::lang('released_list').'. '.Core::lang('genre_desc_1').(!empty($page)?' '.Core::lang('page').' '.$page:'');
    $keyword = Core::lang('released_key_1');
    $author = Core::getInstance()->title.' Team';
    $image = Core::getInstance()->homepath.'/images/contact.jpg';
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
                                <ul class="list-inline">
                                    <li class="color-active"><h1 style="font-size: 20px !important;"><strong><?php echo Core::lang('released_list')?></strong></h1></li>
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
                        echo $pagination->makePaginationFrontend($data,$_SERVER['PHP_SELF'].'?show=released');
                    }
                ?>

                <?php if (!empty(Core::getInstance()->seopage)){
                    echo '<!-- Footer link menu-->
                    <div class="content-block head-div">
                        <div class="cb-header">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="list-inline" style="height: 60px; overflow-y: scroll;">
                                        '.(!empty($datalinks)?$datalinks:'').'
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

</body>
</html>
