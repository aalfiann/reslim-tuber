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

    $title = Core::lang('genre_browse')." | ".Core::getInstance()->title;
    $description = Core::lang('genre_desc_1');
    $keyword = "Genre, ".Core::lang('country').", ".Core::lang('year').", ".Core::getInstance()->keyword;
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
            <div class="col-lg-12 v-categories side-menu">

                <!-- Popular Channels -->
                <div class="content-block">
                    <div class="cb-header">
                        <div class="row">
                            <div class="col-lg-10">
                                <ul class="list-inline">
                                    <li><a href="#" class="color-active" title="Trending Genre"><h1 style="font-size: 20px !important;"><strong>Trending Genre</strong></h1></a></li>
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
                    <div class="cb-content">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-4">
                                <aside class="sidebar-menu">
                                    <ul>
                                        <li><a href="index.php?search=Action" title="<?php echo Core::lang('watch_header')?> Action">Action</a></li>
                                        <li><a href="index.php?search=Anime" title="<?php echo Core::lang('watch_header')?> Anime"></a></li>
                                        <li><a href="index.php?search=Comedy" title="<?php echo Core::lang('watch_header')?> Comedy">Comedy</a></li>
                                        <li><a href="index.php?search=Horror" title="<?php echo Core::lang('watch_header')?> Horror">Horror</a></li>
                                        <li><a href="index.php?search=Sci-fi" title="<?php echo Core::lang('watch_header')?> Sci-fi">Sci-fi</a></li>
                                        <li><a href="index.php?search=Romance" title="<?php echo Core::lang('watch_header')?> Romance">Romance</a></li>
                                        <li><a href="index.php?search=China" title="<?php echo Core::lang('watch_header')?> China">China</a></li>
                                        <li><a href="index.php?search=India" title="<?php echo Core::lang('watch_header')?> India">India</a></li>
                                        <li><a href="index.php?search=Japan" title="<?php echo Core::lang('watch_header')?> Japan">Japan</a></li>
                                        <li><a href="index.php?search=Korea" title="<?php echo Core::lang('watch_header')?> Korea">Korea</a></li>
                                        <li><a href="index.php?search=Thailand" title="<?php echo Core::lang('watch_header')?> Thailand">Thailand</a></li>
                                        <li><a href="index.php?search=<?php echo Date('Y')?>" title="<?php echo Core::lang('watch_header').' '.Date('Y')?>"><?php echo Date('Y')?></a></li>
                                        <li><a href="index.php?search=<?php echo (Date('Y')-1)?>" title="<?php echo Core::lang('watch_header').' '.(Date('Y')-1)?>"><?php echo (Date('Y')-1)?></a></li>
                                        <li><a href="index.php?search=<?php echo (Date('Y')-2)?>" title="<?php echo Core::lang('watch_header').' '.(Date('Y')-2)?>"><?php echo (Date('Y')-2)?></a></li>
                                    </ul>
                                    <div class="bg-add"></div>
                                </aside>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-8">
                                <div class="row">
                                    <h3 class="color-active"><div id="totalvideo"></div></h3>
                                </div>
                                <!-- All Genre -->
                                <div class="row">
                                    <?php
                                        if (!empty($datagenre)){
                                            if ($datagenre->{'status'} == "success"){
                                                $n=0;
                                                echo '<h3 class="color-active">'.Core::lang('all').' Genre:</h3><h4>';
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
                                                echo '<h3 class="color-active">'.Core::lang('all').' '.Core::lang('country').':</h3><h4>';
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
                                                echo '<h3 class="color-active">'.Core::lang('all').' '.Core::lang('year').':</h3><h4>';
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
