<!-- logo, menu, search, avatar -->
<div class="container-fluid">
    <div class="row">
        <div class="btn-color-toggle">
            <img src="images/icon_bulb_dark.png" alt="">
        </div>
        <div class="navbar-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1 col-sm-2 col-xs-2">
                        <a class="navbar-brand" href="index.html"><img src="images/logo.svg" alt="Project name" class="logo" /></a>
                    </div>
                    <div class="col-lg-3 col-sm-10 col-xs-10">
                        <ul class="list-inline menu">
                            <li class="pages <?php echo ((pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "index")?'color-active':'')?>"><a href="index.php">Home</a></li>
                            <li class="pages <?php echo ((pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "genre")?'color-active':'')?>"><a href="genre.php">Genre</a></li>
                            <li class="pages <?php echo ((pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "country")?'color-active':'')?>"><a href="country.php">Country</a></li>
                        </ul>
                    </div>
                    <div class="visible-xs visible-sm clearfix"></div>
                    <div class="col-lg-6 col-sm-11 col-xs-12">
                        <form method="get" action="index.php">
                            <div class="topsearch">
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-search"></i></span>
                                    <input type="text" name="search" class="form-control" placeholder="Search" aria-describedby="sizing-addon2">
                                    
                                    <div class="input-group-btn">
                                        <button name="submitsearch" type="submit" class="btn btn-default">Go!&nbsp;&nbsp;&nbsp;</button>
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