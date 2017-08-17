<?php include 'backend/Core.php';
    $page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
    $itemsperpage = filter_var((empty($_GET['itemsperpage'])?'20':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);

    //Get video
    $url = Core::getInstance()->api.'/video/post/data/public/search/random/'.$page.'/'.$itemsperpage.'/?apikey='.Core::getInstance()->apikey;
    $data = json_decode(Core::execGetRequest($url));

    $title = Core::getInstance()->title.' | '.Core::getInstance()->description;
    $description = Core::getInstance()->title.' | List random movies today.';
    $keyword = Core::getInstance()->keyword;
    $author = Core::getInstance()->title.' Team';
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
                                    <li class="color-active">List Random Movies Today</li>
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
                                                            <a href="watch/'.$value->{'PostID'}.'/'.Core::convertToSlug($value->{'Title'}).'"><img src="'.$value->{'Image'}.'" class="top-cropped" alt="'.$value->{'Title'}.'"></a>
                                                            <div class="rating">'.$value->{'Rating'}.'</div>
                                                            <div class="time">'.$value->{'Duration'}.'</div>
                                                        </div>
                                                        <div class="v-desc">
                                                            <a href="watch/'.$value->{'PostID'}.'/'.Core::convertToSlug($value->{'Title'}).'">'.Core::cutLongText($value->{'Title'},60).'</a>
                                                        </div>
                                                        <div class="v-views">
                                                            '.number_format($value->{'Viewer'}).' views. 
                                                        </div>
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
                        echo $pagination->makePaginationFrontend($data,$_SERVER['PHP_SELF'].'?show=rating');
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
