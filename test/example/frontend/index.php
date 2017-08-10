<?php include '../backend/Core.php';
    //Validation url param
    $search = filter_var((empty($_GET['search'])?'':$_GET['search']),FILTER_SANITIZE_STRING);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.png">

    <title>Circle Video | Home Page</title>

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
                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                        <a href="single-video-tabs.html"><img src="http://movieon21.com/wp-content/uploads/2017/08/Gintama-Live-Action-Mitsuba-hen-Parrt.jpg" class="top-cropped" alt=""></a>
                                        <div class="quality">HD</div>
                                        <div class="rating">7.3</div>
                                        <div class="time">03:50:00</div>
                                    </div>
                                    <div class="v-desc">
                                        <a href="single-video-tabs.html">Man's Sky: 21 Minutes of New Gameplay - IGN First</a>
                                    </div>
                                    <div class="v-views">
                                        27,548 views. 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Latest Movies -->

                <!-- pagination -->
                <div class="v-pagination">
                    <ul class="list-inline">
                        <li><a href="#">
                            <div class="pages"><i class="cv cvicon-cv-previous"></i></div>
                        </a></li>
                        <li><a href="#">
                            <div class="pages">1</div>
                        </a></li>
                        <li><a href="#">
                            <div class="pages">2</div>
                        </a></li>
                        <li><a href="#">
                            <div class="pages active">3</div>
                        </a></li>
                        <li><a href="#">
                            <div class="pages">4</div>
                        </a></li>
                        <li><a href="#">
                            <div class="pages">5</div>
                        </a></li>
                        <li><a href="#">
                            <div class="pages">...</div>
                        </a></li>
                        <li><a href="#">
                            <div class="pages">10</div>
                        </a></li>
                        <li><a href="#">
                            <div class="pages"><i class="cv cvicon-cv-next"></i></div>
                        </a></li>
                    </ul>
                </div>
                <!-- /pagination -->

            </div>
        </div>
    </div>
</div>

<?php include 'global-footer.php';?>
<?php include 'global-js.php';?>

</body>
</html>
