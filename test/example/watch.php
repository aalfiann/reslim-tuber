<?php include 'backend/Core.php'; 
    //Random Key
    $aaa=rand(0,5);$bbb=rand(3,9);
    //Validation url param
    $postid = filter_var((empty($_GET['movie'])?'':$_GET['movie']),FILTER_SANITIZE_STRING);
    //Data video
    $url = Core::getInstance()->api.'/video/post/data/read/'.$postid.'/?apikey='.Core::getInstance()->apikey;
    $data = json_decode(Core::execGetRequest($url));
    //Data adblock1 (sidebar 336x280)
    $urlsidebar = Core::getInstance()->api.'/ads/data/show/sidebar/?apikey='.Core::getInstance()->apikey;
    $datasidebar = json_decode(Core::execGetRequest($urlsidebar));
    //Data adblock2 (footer 728x90)
    $urlfooter = Core::getInstance()->api.'/ads/data/show/footer/?apikey='.Core::getInstance()->apikey;
    $datafooter = json_decode(Core::execGetRequest($urlfooter));
    //Data adblock3 (content 468x60)
    $urlcontent = Core::getInstance()->api.'/ads/data/show/content/?apikey='.Core::getInstance()->apikey;
    $datacontent = json_decode(Core::execGetRequest($urlcontent));

    //Data twitter
    if (!empty(Core::getInstance()->twitter)){
        $twittersite = Core::getInstance()->twitter;
        $twitterarray = explode('/',$twittersite);
        $twitterusername = end($twitterarray);
    }

    if (!empty($data)){
        if ($data->{'status'} == "success"){
            //make sure directory not empty
            if (empty($_GET['dir'])){
                $dirheader = Core::lang('watch_header'); 
            } else {
                $dirheader = ucwords(str_replace("-"," ",$_GET['dir']));
            }
            $title = $data->result[0]->{'Title'};
            $description = $dirheader.' '.$title.'. '.$data->result[0]->{'Description'};
            $fullkeyword = $data->result[0]->{'Tags_inline'}.
                (!empty($data->result[0]->{'Stars_inline'})?', '.$data->result[0]->{'Stars_inline'}:'').
                (!empty($data->result[0]->{'Cast_inline'})?', '.$data->result[0]->{'Cast_inline'}:'').
                (!empty($data->result[0]->{'Director_inline'})?', '.$data->result[0]->{'Director_inline'}:'').
                (!empty($data->result[0]->{'Country_inline'})?', '.$data->result[0]->{'Country_inline'}:'').
                (!empty(Core::getInstance()->seosite)?', '.Core::getInstance()->seosite:'');
            $keyword = Core::lang('watch_keyword').', '.$data->result[0]->{'Title'}.', '.$fullkeyword;
            $author = $data->result[0]->{'User'};
            //Create auto mirror page
            $datalinks = null;	
            $named = preg_split( "/[,]/", $fullkeyword );
            foreach($named as $name){
                if ($name != null){$datalinks .= '<li><a href="'.Core::getInstance()->homepath.'/'.Core::convertToSlug(Core::lang('watch_header').' '.trim($name)).'/'.$postid.'/'.Core::convertToSlug($data->result[0]->{'Title'}).'" title="'.ucwords(str_replace("-"," ",Core::lang('watch_header').' '.trim($name).' '.$data->result[0]->{'Title'})).'">'.ucwords(str_replace("-"," ",Core::lang('watch_header').' '.trim($name).' '.$data->result[0]->{'Title'})).'</a></li>';}
            }
        } else {
            $title = '';
            $description = '';
            $keyword = '';
            $author = '';
            header("Location: ".Core::getInstance()->homepath."/index.php");
        }
    } else {
        $title = '';
        $description = '';
        $keyword = '';
        $author = '';
        header("Location: ".Core::getInstance()->homepath."/index.php");
    }
?>

<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="<?php echo $description;?>">
    <meta name="keyword" content="<?php echo $keyword;?>">
    <meta name="author" content="<?php echo $author;?>">
    <?php
        if (!empty($data)){
            if ($data->{'status'} == "success"){
                echo '<!-- Open Graphs -->
                    <link rel="author" href="'.((!empty(Core::getInstance()->gplus))?Core::getInstance()->gplus:'').'"/>
                    <link rel="publisher" href="'.((!empty(Core::getInstance()->gpub))?Core::getInstance()->gpub:'').'"/>
                    <meta itemprop="name" content="'.$dirheader.' '.$data->result[0]->{'Title'}.'">
                    <meta itemprop="description" content="'.$data->result[0]->{'Description'}.'">
                    <meta itemprop="image" content="'.$data->result[0]->{'Image'}.'">
                	<meta name="twitter:card" content="summary_large_image" />
                	<meta name="twitter:title" content="'.$dirheader.' '.$data->result[0]->{'Title'}.'" />
                	<meta name="twitter:description" content="'.$data->result[0]->{'Description'}.'" />
                    <meta name="twitter:image" content="'.$data->result[0]->{'Image'}.'" />
                    <meta name="twitter:image:alt" content="'.$dirheader.' '.$data->result[0]->{'Title'}.'" />
                    <meta name="twitter:site" content="'.((!empty(Core::getInstance()->twitter))?'@'.$twitterusername:'').'">
                    <meta name="twitter:creator" content="'.((!empty(Core::getInstance()->twitter))?'@'.$twitterusername:'').'">
                    <meta property="og:title" content="'.$dirheader.' '.$data->result[0]->{'Title'}.'" />
                    <meta property="og:description" content="'.$data->result[0]->{'Description'}.'" />
                    <meta property="og:url" content="'.((Core::isHttpsButtflare()) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" />
                    <meta property="og:image" content="'.str_replace('UX182_CR0,0,182,268','UX200_CR0,0,200,286',$data->result[0]->{'Image'}).'" />
                    <meta property="og:image:alt" content="'.$dirheader.' '.$data->result[0]->{'Title'}.'" />
                	<meta property="og:site_name" content="'.Core::getInstance()->title.'" />
                    <meta property="og:type" content="video.movie" />
                	<meta property="og:video:release_date" content="'.date_format(date_create($data->result[0]->{'Created_at'}), 'Y-m-d').'" />';
                echo "\n";
                echo '<meta property="og:video:duration" content="'.Core::convertTimeToSeconds($data->result[0]->{'Duration'}).'" />';
                echo "\n";
                if (!empty($data->result[0]->{'Director'})) {
                    foreach ($data->result[0]->{'Director'} as $name => $valuedirector) {
                        echo '<meta property="og:video:director" content="'.$valuedirector.'" />';
                        echo "\n";
                    }
                }
                if (!empty($data->result[0]->{'Stars'})) {
                    foreach ($data->result[0]->{'Stars'} as $name => $valuestars) {
                        echo '<meta property="og:video:actor" content="'.$valuestars.'" />';
                        echo "\n";
                    }    
                }
                if (!empty($data->result[0]->{'Tags'})) {
                    foreach ($data->result[0]->{'Tags'} as $name => $valuegenre) {
                        echo '<meta property="og:video:tag" content="'.$valuegenre.'" />';
                        echo "\n";
                    }
                }
            }
        }
    ?>

    <title><?php echo $dirheader?> <?php echo $title;?> | <?php echo Core::getInstance()->title;?></title>

    <?php include 'global-meta.php';?>
    <!--Remove white flash on all IE and Edge browser-->
    <script>!function(){var e=document.createElement("div"),n=document.getElementsByTagName("base")[0]||document.getElementsByTagName("script")[0];e.innerHTML="&shy;<style>iframe {visibility: hidden;} .video-responsive{background:url('<?php echo Core::getInstance()->homepath?>/images/spinner-black.gif') no-repeat center center;}</style>",n.parentNode.insertBefore(e,n),window.onload=function(){e.parentNode.removeChild(e)}}();</script>
</head>

<body class="single-video dark">
<?php include 'global-header.php';?>

<div class="content-wrapper" style="padding-top:0px">
    <div class="jumbotron" style="background-color:black;padding-top:10px;padding-bottom:10px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">
                <?php 
                    if (!empty($data)){
                        if ($data->{'status'} == "success"){
                            $totalvideo=0;
                            foreach ($data->result[0]->{'Embed'} as $name => $valuevideo) {
                                $totalvideo++;
                            }
                            if ($totalvideo>1) echo '<h1><a href="'.((Core::isHttpsButtflare()) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" title="'.$dirheader.' '.$title.'">'.$dirheader.' '.$title.'</a></h1>';
                                $datavideo = '';
                                $n=1;
                                foreach ($data->result[0]->{'Embed'} as $name => $valuevideo) {
                                    if ($totalvideo>1){
                                        $datavideo .= '<button type="button" class="btn btn-danger btn-block" data-toggle="collapse" data-target="#eps'.$n.'" '.(($n>1)?'onclick="loadeps'.$n.'();return false"':'').'>Episode '.$n.' <span class="caret"></span></button>
                                            <div id="eps'.$n.'" class="collapse'.(($n==1)?' in':'').'">
                                                '.(($n==1)?'<div class="sv-video"><div class="video-responsive">'.$valuevideo.'</div></div>':'
                                                <script>
                                                    var eps'.$n.'_loaded = false;
                                                    function loadeps'.$n.'() {
                                                        if (!eps'.$n.'_loaded)  {
                                                            eps'.$n.'_loaded = true;
                                                            var div = document.getElementById("eps'.$n.'");
                                                            div.innerHTML = \'<div class="sv-video"><div class="video-responsive">'.$valuevideo.'</div></div>\';
                                                            $("#eps'.$n.' iframe").attr("data-src", function() { return $(this).attr("src"); }).removeAttr("src").addClass("lazyload");
                                                        }
                                                    }
                                                </script>').'
                                            </div><br>';
                                        $n++;
                                    } else{
                                        $datavideo .= '<div class="sv-video">
                                            <div class="video-responsive">
                                                '.$valuevideo.'
                                            </div>
                                        </div><br>';
                                    }
                                }
                                $datavideo = substr($datavideo, 0, -4);
                                echo $datavideo;
                        }
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xs-12 col-sm-12">
                <?php
                    if (!empty($data)){
                        if ($data->{'status'} == "success"){
                            //author
                            if ($totalvideo==1) echo '<h1><a href="'.((Core::isHttpsButtflare()) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" title="'.$dirheader.' '.$title.'">'.$dirheader.' '.$title.'</a></h1>';
                                echo '<div class="author">
                                    <div class="sv-views">
                                        <div class="sv-views-count">
                                            '.number_format($data->result[0]->{'Viewer'}).''.Core::lang('views').'
                                        </div>
                                        <div class="sv-views-progress">
                                            <div class="sv-views-progress-bar"></div>
                                        </div>
                                        <div class="sv-views-stats text-right">
                                            <span id="totalliked" class="green"><a title="Like"><i class="fa fa-thumbs-up iliked"></i></a> '.number_format($data->result[0]->{'Liked'}).'</span>
                                            <span id="totaldisliked" class="percent"><a title="Dislike"><i class="fa fa-thumbs-down idisliked"></i></a> '.number_format($data->result[0]->{'Disliked'}).'</span>
                                            
                                        </div>
                                        <div class="sv-views-stats text-right">
                                            <span id="voteresult" class="green"></span>
                                        </div>
                                    </div>
                                    <div class="sv-name">
                                        <div class="adblock3">
                                            <div class="img">
                                                '.((!empty($datacontent) && ($datacontent->{'status'} == "success"))?$datacontent->result[0]->{'Embed'}:'<a class="color-active" href="'.Core::getInstance()->homepath.'/contact.php" title="'.Core::lang('ads_here').'">'.Core::lang('ads_here').' 468 x 60</a>').'
                                            </div>
                                        </div>
                                        <p><a href="#" data-toggle="modal" data-target="#report" title="'.Core::lang('watch_report_info').'"><i class="fa fa-flag"></i> '.Core::lang('watch_report_info').'</a></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>';
                            
                            $datastars = '';
                            if (!empty($data->result[0]->{'Stars'})) {
                                $datastars .= '<h4>'.Core::lang('watch_stars').'</h4>';
                                $datastars .= '<p class="sv-tags">';
                                foreach ($data->result[0]->{'Stars'} as $name => $valuestars) {
                                    $datastars .= '<span><a href="'.Core::getInstance()->homepath.'/index.php?search='.$valuestars.'" title="'.Core::lang('watch_header').' '.$valuestars.'">'.$valuestars.'</a></span>';
                                }
                                $datastars .= '</p>';
                            }

                            $datacast = '';
                            if (!empty($data->result[0]->{'Cast'})) {
                                $datacast .= '<h4>'.Core::lang('watch_cast').'</h4>';
                                $datacast .= '<p class="sv-tags">';
                                foreach ($data->result[0]->{'Cast'} as $name => $valuecast) {
                                    $datacast .= '<span><a href="'.Core::getInstance()->homepath.'/index.php?search='.$valuecast.'" title="'.Core::lang('watch_header').' '.$valuecast.'">'.$valuecast.'</a></span>';
                                }
                                $datacast .= '</p>';
                            }

                            $datadirector = '';
                            if (!empty($data->result[0]->{'Director'})) {
                                $datadirector .= '<h4>'.Core::lang('watch_director').'</h4>';
                                $datadirector .= '<p class="sv-tags">';
                                foreach ($data->result[0]->{'Director'} as $name => $valuedirector) {
                                    $datadirector .= '<span><a href="'.Core::getInstance()->homepath.'/index.php?search='.$valuedirector.'" title="'.Core::lang('watch_header').' '.$valuedirector.'">'.$valuedirector.'</a></span>';
                                }
                                $datadirector .= '</p>';
                            }

                            $datacountry = '';
                            if (!empty($data->result[0]->{'Country'})) {
                                $datacountry .= '<h4>'.Core::lang('watch_country').'</h4>';
                                $datacountry .= '<p class="sv-tags">';
                                foreach ($data->result[0]->{'Country'} as $name => $valuecountry) {
                                    $datacountry .= '<span><a href="'.Core::getInstance()->homepath.'/index.php?search='.$valuecountry.'" title="'.Core::lang('watch_header').' '.$valuecountry.'">'.$valuecountry.'</a></span>';
                                }
                                $datacountry .= '</p>';
                            }

                            $datagenre = '';
                            if (!empty($data->result[0]->{'Tags'})) {
                                $datagenre .= '<h4>'.Core::lang('watch_genre').'</h4>';
                                $datagenre .= '<p class="sv-tags">';
                                foreach ($data->result[0]->{'Tags'} as $name => $valuegenre) {
                                    $datagenre .= '<span><a href="'.Core::getInstance()->homepath.'/index.php?search='.$valuegenre.'" title="'.Core::lang('watch_header').' '.$valuegenre.'">'.$valuegenre.'</a></span>';
                                }
                                $datagenre .= '</p>';
                            }

                            //Info Video
                            echo '<div class="info">
                                    
                                    <h4>'.Core::lang('watch_about').'</h4>
                                    <p>'.$data->result[0]->{'Description'}.'</p>

                                    '.$datastars.'
                                    '.$datacast.'
                                    '.$datadirector.'
                                    '.$datacountry.'

                                    <h4>'.Core::lang('watch_release').'</h4>
                                    <p class="sv-tags"><span><a href="'.Core::getInstance()->homepath.'/index.php?search='.$data->result[0]->{'Released'}.'" title="'.Core::lang('watch_header').' '.$data->result[0]->{'Released'}.'">'.$data->result[0]->{'Released'}.'</a><span></p>

                                    '.$datagenre.'
                                    <br>
                                    <p class="text-center">'.Core::lang('watch_share').' '.$dirheader.' '.$title.'</p>
                                    <div class="sharethis-inline-share-buttons"></div>
                                    <div class="adblock2">
                                        <div class="img">
                                            '.((!empty($datafooter) && ($datafooter->{'status'} == "success"))?$datafooter->result[0]->{'Embed'}:'<a class="color-active" href="'.Core::getInstance()->homepath.'/contact.php" title="'.Core::lang('ads_here').'">'.Core::lang('ads_here').'<br>728 x 90</a>').'
                                        </div>
                                    </div>

                    <!-- similar videos -->
                    <div class="caption">
                        <div class="left">
                            <a href="#" title="'.Core::lang('watch_this_too').'">'.Core::lang('watch_this_too').'</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="list similar-videos">
                        <div class="row">';
                            if (!empty($data) && ($data->{'status'} == "success")){
                                //Data random movies by it's released year
                                $urlrandomyear = Core::getInstance()->api.'/video/post/data/public/search/random/'.$data->result[0]->{'Released'}.'/1/4/?apikey='.Core::getInstance()->apikey.'&query=';
                                $datarandomyear = json_decode(Core::execGetRequest($urlrandomyear));
                                if (!empty($datarandomyear) && ($datarandomyear->{'status'} == "success")){
                                    $i=1;
                                    foreach ($datarandomyear->results as $name => $valuerandomyear) {
                                        echo '<div class="col-lg-3 col-xs-12 col-sm-6 videoitem">
                                                <div class="b-video">
                                                <div class="v-img">
                                                    <a href="'.Core::getInstance()->homepath.'/'.Core::lang('watch').'/'.$valuerandomyear->{'PostID'}.'/'.Core::convertToSlug($valuerandomyear->{'Title'}).'" title="'.Core::lang('watch_header').' '.$valuerandomyear->{'Title'}.'"><img src="'.$valuerandomyear->{'Image'}.'" class="top-cropped sm" alt="'.Core::lang('watch_header').' '.$valuerandomyear->{'Title'}.'"></a>
                                                    <div class="rating">'.$valuerandomyear->{'Rating'}.'</div>
                                                    <div class="time">'.$valuerandomyear->{'Duration'}.'</div>
                                                </div>
                                                <div class="v-desc">
                                                    <a href="'.Core::getInstance()->homepath.'/'.Core::lang('watch').'/'.$valuerandomyear->{'PostID'}.'/'.Core::convertToSlug($valuerandomyear->{'Title'}).'" title="'.Core::lang('watch_header').' '.$valuerandomyear->{'Title'}.'">'.Core::cutLongText($valuerandomyear->{'Title'},40).'</a>
                                                </div>
                                                <div class="v-views">';
                                                $datatag = "";
                                                foreach ($valuerandomyear->{'Tags'} as $namegenre => $valuegenre) {
                                                    $datatag .= '<a style="color:#6F6D6D" onMouseOut="this.style.color=\'#6F6D6D\'" onMouseOver="this.style.color=\'#ea2c5a\'" href="'.Core::getInstance()->homepath.'/index.php?search='.$valuegenre.'" title="'.Core::lang('watch_header').' '.$valuegenre.'">'.$valuegenre.'</a>, ';
                                                }
                                                $datatag = substr($datatag, 0, -2);
                                                echo $datatag;
                                                echo '</div>
                                                <div class="v-views">
                                                    '.number_format($valuerandomyear->{'Viewer'}).''.Core::lang('views').'.
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
                                }
                            }

                        echo '</div>
                    </div>
                    <!-- END similar videos -->';

                    if (!empty(Core::getInstance()->disqus)){
                        echo '<!-- START comments -->
                            <div class="comments">
                                <div class="comments-block">
                                    <button id="show-comments" class="btn btn-danger btn-block" onclick="disqus();return false;">'.Core::lang('watch_show_comments').'</button>
                                </div>
                                <div id="disqus_thread" class="color-active"></div>
                                <script>
                                    var disqus_loaded = false;
                                    function disqus() {
                                        if (!disqus_loaded)  {
                                            disqus_loaded = true;
                                            /**
                                            *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                                            *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                                            var disqus_config = function () {
                                                this.page.url = \''.((Core::isHttpsButtflare()) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'\';  // Replace PAGE_URL with your page\'s canonical URL variable
                                                this.page.identifier = \''.$postid.'\'; // Replace PAGE_IDENTIFIER with your page\'s unique identifier variable
                                            };
                                            var d = document, s = d.createElement(\'script\');
                                            s.src = \'https://'.Core::getInstance()->disqus.'.disqus.com/embed.js\';
                                            s.setAttribute(\'data-timestamp\', +new Date());
                                            (d.head || d.body).appendChild(s);
                                            $("#show-comments").fadeOut();
                                        }
                                    }
                                    //Opens comments when linked to directly
                                    var hash = window.location.hash.substr(1);
                                    if (hash.length > 8) {
                                        if (hash.substring(0, 8) == "comment-") {
                                            disqus();
                                        }
                                    }
                                </script>
                                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" title="Please enable JavaScript to view the comments">comments.</a></noscript>
                            </div>
                        <!-- END comments -->';
                    }

                    if (!empty($fullkeyword)){
                        echo '<!-- Footer link menu-->
                        <div class="content-block">
                            <div class="cb-header">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="list-inline" style="height: 30px; overflow-y: scroll;">
                                            '.(!empty($datalinks)?$datalinks:'').'
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Footer link menu-->';
                    }
                    
                echo '</div>';
                        }
                    }
                ?>

            </div>

            <!-- right column -->
            <div class="col-lg-4 col-xs-12 col-sm-12">

                <div class="adblock">
                    <div class="img">
                        <?php echo ((!empty($datasidebar) && ($datasidebar->{'status'} == "success"))?$datasidebar->result[0]->{'Embed'}:'<a class="color-active" href="'.Core::getInstance()->homepath.'/contact.php" title="'.Core::lang('ads_here').'">'.Core::lang('ads_here').'<br>336 x 280</a>');?>
                    </div>
                </div>

                <!-- Recomended Videos -->
                <div class="caption">
                    <div class="left">
                        <a href="#" title="<?php echo Core::lang('watch_recomended')?>"><?php echo Core::lang('watch_recomended')?></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="list">
                    <?php 
                        if (!empty($data) && ($data->{'status'} == "success")){
                            //Data random movies
                            $urlrandom = Core::getInstance()->api.'/video/post/data/public/search/random/1/10/?apikey='.Core::getInstance()->apikey.'&query=';
                            $datarandom = json_decode(Core::execGetRequest($urlrandom));
                            if (!empty($datarandom) && ($datarandom->{'status'} == "success")){
                                foreach ($datarandom->results as $name => $valuerandom) {
                                    echo '<div class="h-video row">
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="v-img">
                                                <a href="'.Core::getInstance()->homepath.'/'.Core::lang('watch').'/'.$valuerandom->{'PostID'}.'/'.Core::convertToSlug($valuerandom->{'Title'}).'" title="'.Core::lang('watch_header').' '.$valuerandom->{'Title'}.'"><img src="'.$valuerandom->{'Image'}.'" class="top-cropped sm" alt="'.Core::lang('watch_header').' '.$valuerandom->{'Title'}.'"></a>
                                                <div class="rating">'.$valuerandom->{'Rating'}.'</div>
                                                <div class="time">'.$valuerandom->{'Duration'}.'</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="v-desc">
                                                <a href="'.Core::getInstance()->homepath.'/'.Core::lang('watch').'/'.$valuerandom->{'PostID'}.'/'.Core::convertToSlug($valuerandom->{'Title'}).'" title="'.Core::lang('watch_header').' '.$valuerandom->{'Title'}.'">'.Core::cutLongText($valuerandom->{'Title'},40).'</a>
                                            </div>
                                            <div class="v-views">';
                                            $datatag = "";
                                            foreach ($valuerandom->{'Tags'} as $namegenre => $valuegenre) {
                                                $datatag .= '<a style="color:#6F6D6D" onMouseOut="this.style.color=\'#6F6D6D\'" onMouseOver="this.style.color=\'#ea2c5a\'" href="'.Core::getInstance()->homepath.'/index.php?search='.$valuegenre.'" title="'.Core::lang('watch_header').' '.$valuegenre.'">'.$valuegenre.'</a>, ';
                                            }
                                            $datatag = substr($datatag, 0, -2);
                                            echo $datatag;
                                            echo '</div>
                                            <div class="v-views">
                                                '.number_format($valuerandom->{'Viewer'}).''.Core::lang('views').'.
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>';
                                }
                            }

                            
                        }
                    ?>
                </div>
                <!-- END Recomended Videos -->

                <!-- load more -->
                <div class="loadmore">
                    <a href="<?php echo Core::getInstance()->homepath?>/genre.php" title="<?php echo Core::lang('watch_all_genre')?>"><?php echo Core::lang('watch_all_genre')?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'global-footer.php';?>
<!-- Modal -->
<div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo Core::lang('watch_report').(!empty($data) && ($data->{'status'} == "success")?' '.$data->result[0]->{'Title'}:'!')?></h4>
      </div>
      <form method="post" id="sendreport" action="#">
      <div class="modal-body">
        <div class="row">
            <div id="report-send"></div>
            <div class="col-lg-12">
                <div class="form-group">
                <label><?php echo Core::lang('mail_name')?></label>
                    <input id="post-fullname" name="Fullname" type="text" placeholder="<?php echo Core::lang('mail_input_name')?>" class="form-control border-input" style="background-color:white;" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label><?php echo Core::lang('mail_email')?></label>
                    <input id="post-email" name="Email" type="text" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" placeholder="<?php echo Core::lang('mail_input_email')?>" class="form-control border-input" style="background-color:white;" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label><?php echo Core::lang('issue_detail')?></label>
                    <textarea id="post-issue" name="Issue" rows="3" type="text" placeholder="<?php echo Core::lang('issue_input_detail')?>" class="form-control border-input" style="background-color:white;" required></textarea>
                </div>
                <div class="form-group hidden">
                    <input id="key-aaa" name="aaa" type="text" class="form-control border-input" value="<?php echo $aaa?>">
                    <input id="key-bbb" name="bbb" type="text" class="form-control border-input" value="<?php echo $bbb?>">
                    <input id="post-id" name="PostID" type="text" class="form-control border-input" maxlength="50" value="<?php echo $postid?>" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Security: <?php echo $aaa?> + <?php echo $bbb?> = ?</label>
                    <input id="post-key" name="key" type="text" placeholder="<?php echo Core::lang('mail_input_security')?>" class="form-control border-input" style="background-color:white;" maxlength="50" required>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo Core::lang('close')?></button>
        <button type="submit" class="btn btn-success"><?php echo Core::lang('issue_send')?> <i class="fa fa-paper-plane"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php include 'global-js.php';?>

<?php
    if (!empty($data) && ($data->{'status'} == "success")){
        echo '<!-- Start Structured Data -->
        <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@id": "'.Core::convertToSlug($dirheader).'-'.Core::convertToSlug($data->result[0]->{'Title'}).'-'.$data->result[0]->{'PostID'}.'",
          "@type": "Movie",
          "dateCreated": "'.$data->result[0]->{'Created_at'}.'",
          "name": "'.$dirheader.' '.$data->result[0]->{'Title'}.'",
          "url": "'.((Core::isHttpsButtflare()) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'",
          "description": "'.$data->result[0]->{'Description'}.'",
          "releasedEvent": {
            "@type": "PublicationEvent",
            "startDate": "'.$data->result[0]->{'Released'}.'",
            "location": {
              "@type": "Country",
              "name": '.json_encode($data->result[0]->{'Country'}).'
            }
          },
          "image": {
            "@type": "ImageObject",
            "url": "'.$data->result[0]->{'Image'}.'"
          },';
            if (!empty($data->result[0]->{'Stars'})) {
                echo "\n";
                echo '"actor": {
                    "@type": "Person",
                    "name": '.json_encode($data->result[0]->{'Stars'}).'
                },';
            }
            if (!empty($data->result[0]->{'Director'})) {
                echo "\n";
                echo '"director": {
                    "@type": "Person",
                    "name": '.json_encode($data->result[0]->{'Director'}).'
                  },';
            }
            echo "\n";
            echo '"duration": "'.$data->result[0]->{'Duration'}.'"
        }
        </script>
        <!-- End Structured Data -->';
    }
?>

<!-- Rating -->
<script type="text/javascript">
    $(function(){    
        $(".iliked").on("click",function(){
            $.ajax({
                type: "POST",
				url: "<?php echo Core::getInstance()->api?>/video/post/data/liked/<?php echo $postid?>/?apikey=<?php echo Core::getInstance()->apikey?>",
				dataType: 'json',
				success: function( data ) {
                    document.getElementById("voteresult").innerHTML='';
					if(data.status=='success'){
                        document.getElementById("totalliked").innerHTML='<i class="fa fa-thumbs-up iliked"></i> '+data.total;
                        document.getElementById("voteresult").innerHTML=data.message;
					} else {
						document.getElementById("voteresult").innerHTML=data.message;
					}
				},
				error: function( xhr, textStatus, error ) {
					console.log("XHR: " + xhr.statusText);
                    console.log("STATUS: "+textStatus);
                    console.log("ERROR: "+error);
                    console.log("TRACE: "+xhr.responseText);
				}
			}).done(function(res){ 
                
			});
        }),
        $(".idisliked").on("click",function(){
            $.ajax({
                type: "POST",
				url: "<?php echo Core::getInstance()->api?>/video/post/data/disliked/<?php echo $postid?>/?apikey=<?php echo Core::getInstance()->apikey?>",
				dataType: 'json',
				success: function( data ) {
                    document.getElementById("voteresult").innerHTML='';
					if(data.status=='success'){
                        document.getElementById("totaldisliked").innerHTML='<i class="fa fa-thumbs-down idisliked"></i> '+data.total;
                        document.getElementById("voteresult").innerHTML=data.message;
					} else {
						document.getElementById("voteresult").innerHTML=data.message;
					}
				},
				error: function( xhr, textStatus, error ) {
                    console.log("XHR: " + xhr.statusText);
                    console.log("STATUS: "+textStatus);
                    console.log("ERROR: "+error);
                    console.log("TRACE: "+xhr.responseText);
				}
			}).done(function(res){ 
                
			});
        });
    });
</script>
</body>
</html>
