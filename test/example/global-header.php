<!-- logo, menu, search, avatar -->
<div class="container-fluid">
    <div class="row">
        <div class="btn-color-toggle">
            <img src="<?php echo Core::getInstance()->homepath?>/images/icon_bulb_dark.png" alt="<?php echo Core::lang('watch_header')?>">
        </div>
        <div class="navbar-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1 col-sm-2 col-xs-2">
                        <a class="navbar-brand" href="<?php echo Core::getInstance()->homepath?>"><img src="<?php echo Core::getInstance()->homepath?>/images/logo.svg" alt="<?php echo Core::lang('search_desc_1').' '.Core::getInstance()->title;?>" class="logo" /></a>
                    </div>
                    <div class="col-lg-3 col-sm-10 col-xs-10">
                        <ul class="list-inline menu">
                            <li class="pages <?php echo ((pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "index" || pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "")?'color-active':'')?>"><a href="<?php echo Core::getInstance()->homepath?>"><?php echo Core::lang('home')?></a></li>
                            <li class="pages <?php echo ((pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "genre")?'color-active':'')?>"><a href="<?php echo Core::getInstance()->homepath?>/genre.php"><?php echo Core::lang('genre')?></a></li>
                            <li class="pages <?php echo ((pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "rating")?'color-active':'')?>"><a href="<?php echo Core::getInstance()->homepath?>/rating.php"><?php echo Core::lang('best_rating')?></a></li>
                            <li class="pages <?php echo ((pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "filtered")?'color-active':'')?>"><a href="#" data-toggle="modal" data-target="#filter">Filter</a></li>
                        </ul>
                    </div>
                    <div class="visible-xs visible-sm clearfix"></div>
                    <div class="col-lg-6 col-sm-11 col-xs-12">
                        <form method="get" action="<?php echo Core::getInstance()->homepath?>">
                            <div class="topsearch">
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-search"></i></span>
                                    <input type="text" name="search" class="form-control" placeholder="<?php echo Core::lang('input_search')?>" aria-describedby="sizing-addon2">
                                    
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default">Go!&nbsp;&nbsp;&nbsp;</button>
                                    </div><!-- /btn-group -->
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="visible-xs clearfix"></div>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- /logo -->