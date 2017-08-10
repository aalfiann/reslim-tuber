<?php include '../backend/Core.php';
    //Validation url param
    $search = filter_var((empty($_GET['search'])?'':$_GET['search']),FILTER_SANITIZE_STRING);
    $page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
    $itemsperpage = filter_var((empty($_GET['itemsperpage'])?'1':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);

    //Get video
    $url = Core::getInstance()->api.'/video/post/data/public/search/'.$page.'/'.$itemsperpage.'/?apikey='.Core::getInstance()->apikey.'&query='.$search;
    $data = json_decode(Core::execGetRequest($url));

    if (empty($search)){
        $title = Core::getInstance()->title.' | Nonton atau streaming film gratis subtitle indonesia';
        $description = '';
        $keyword = 'Nonton, Streaming, film, movie, gratis, subtitle, indonesia';
        $author = Core::getInstance()->title.' Team';
    } else {
        $title = Core::getInstance()->title.' | Filter search results: '.$search;
        $description = 'Filter search results: '.$search;
        $keyword = 'Filter, Search, Results, '.$search;
        $author = Core::getInstance()->title.' Team';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="<?php echo $description?>">
    <meta name="keyword" content="<?php echo $keyword?>">
    <meta name="author" content="<?php echo $author?>">
    <link rel="icon" href="favicon.png">

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
                                    <?php if (empty($search)){
                                        echo '<li class="color-active">Latest Movies</li>';
                                    } else {
                                        echo '<li class="color-active">Filter search results: '.$search.'</li>';
                                    }
                                    ?>
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
                                                            <a href="watch.php?movie='.$value->{'PostID'}.'"><img src="'.$value->{'Image'}.'" class="top-cropped" alt="'.$value->{'Title'}.'"></a>
                                                            <div class="rating">'.$value->{'Rating'}.'</div>
                                                            <div class="time">'.$value->{'Duration'}.'</div>
                                                        </div>
                                                        <div class="v-desc">
                                                            <a href="watch.php?movie='.$value->{'PostID'}.'">'.Core::cutLongText($value->{'Title'},60).'</a>
                                                        </div>
                                                        <div class="v-views">
                                                            '.number_format($value->{'Viewer'}).' views. 
                                                        </div>
                                                    </div>
                                                </div>';
                                            if ($i%2==4){
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
                                            <h2 class="color-active">Sorry, we can\'t found any movies that you\'re looking for...</h2>
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
