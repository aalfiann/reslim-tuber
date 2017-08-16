<?php include 'backend/Core.php';
    //Data tags
    $urlgenre = Core::getInstance()->api.'/video/post/data/public/tags/all/?apikey='.Core::getInstance()->apikey;
    $datagenre = json_decode(Core::execGetRequest($urlgenre));
    //Data country
    $urlcountry = Core::getInstance()->api.'/video/post/data/public/countries/all/?apikey='.Core::getInstance()->apikey;
    $datacountry = json_decode(Core::execGetRequest($urlcountry));
    //Data release
    $urlrelease = Core::getInstance()->api.'/video/post/data/public/release/all/?apikey='.Core::getInstance()->apikey;
    $datarelease = json_decode(Core::execGetRequest($urlrelease));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Browse All Genre to make easier for you to search movies.">
    <meta name="keyword" content="Genre, Country, <?php echo Core::getInstance()->keyword?>"?>
    <meta name="author" content="<?php echo Core::getInstance()->title.' Team'?>">

    <title><?php echo Core::getInstance()->title?> | Browse All Genre</title>

    <?php include 'global-meta.php';?>
</head>

<body class="dark">
<?php include 'global-header.php';?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 v-categories side-menu">

                <!-- Popular Channels -->
                <div class="content-block">
                    <div class="cb-header">
                        <div class="row">
                            <div class="col-lg-10">
                                <ul class="list-inline">
                                    <li><a href="#" class="color-active">Trending Genre</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="cb-content">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-4">
                                <aside class="sidebar-menu">
                                    <ul>
                                        <li><a href="index.php?search=Action">Action</a></li>
                                        <li><a href="index.php?search=Anime">Anime</a></li>
                                        <li><a href="index.php?search=Comedy">Comedy</a></li>
                                        <li><a href="index.php?search=Horror">Horror</a></li>
                                        <li><a href="index.php?search=Sci-fi">Sci-fi</a></li>
                                        <li><a href="index.php?search=Romance">Romance</a></li>
                                        <li><a href="index.php?search=Chinese">Chinese</a></li>
                                        <li><a href="index.php?search=India">India</a></li>
                                        <li><a href="index.php?search=Japan">Japan</a></li>
                                        <li><a href="index.php?search=Korea">Korea</a></li>
                                        <li><a href="index.php?search=Thailand">Thailand</a></li>
                                        <li><a href="index.php?search=<?php echo Date('Y')?>"><?php echo Date('Y')?></a></li>
                                        <li><a href="index.php?search=<?php echo (Date('Y')-1)?>"><?php echo (Date('Y')-1)?></a></li>
                                        <li><a href="index.php?search=<?php echo (Date('Y')-2)?>"><?php echo (Date('Y')-2)?></a></li>
                                    </ul>
                                    <div class="bg-add"></div>
                                </aside>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-8">
                                <!-- All Genre -->
                                <div class="row">
                                    <?php
                                        if (!empty($datagenre)){
                                            if ($datagenre->{'status'} == "success"){
                                                $n=0;
                                                echo '<h4 class="color-active">All Genre:</h4></h4>';
                                                foreach ($datagenre->result->{'Tags'} as $name => $valuegenre) {
                                                    $n++;
                                                    echo '<a href="index.php?search='.$valuegenre.'"><span class="label label-default" style="display: inline-block;">'.$valuegenre.'</span></a>&nbsp;&nbsp;';
                                                }
                                                echo '</h4>';
                                            }
                                        }
                                    ?>
                                </div>
                                <!-- All Countries -->
                                <div class="row">
                                    <?php
                                        if (!empty($datacountry)){
                                            if ($datacountry->{'status'} == "success"){
                                                $n=0;
                                                echo '<h4 class="color-active">All Country:</h4><h4>';
                                                foreach ($datacountry->result->{'Country'} as $name => $valuecountry) {
                                                    $n++;
                                                    echo '<a href="index.php?search='.$valuecountry.'"><span class="label label-default" style="display: inline-block;">'.$valuecountry.'</span></a>&nbsp;&nbsp;';
                                                }
                                                echo '</h4>';
                                            }
                                        }
                                    ?>
                                </div>
                                <!-- All Released Year -->
                                <div class="row">
                                    <?php
                                        if (!empty($datarelease)){
                                            if ($datarelease->{'status'} == "success"){
                                                $n=0;
                                                echo '<h4 class="color-active">All Year:</h4></h4>';
                                                foreach ($datarelease->result->{'Released'} as $name => $valuerelease) {
                                                    $n++;
                                                    echo '<a href="index.php?search='.$valuerelease.'"><span class="label label-default" style="display: inline-block;">'.$valuerelease.'</span></a>&nbsp;&nbsp;';
                                                }
                                                echo '</h4>';
                                            }
                                        }
                                    ?>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Popular Channels -->

            </div>
        </div>
    </div>
</div>

<?php include 'global-footer.php';?>
<?php include 'global-js.php';?>

</body>
</html>
