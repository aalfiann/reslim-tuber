<!-- footer -->
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="container padding-def">
                <div class="col-lg-1  col-sm-2 col-xs-12 footer-logo">
                    <a class="navbar-brand" href="index.php"><img src="images/logo.svg" alt="<?php echo Core::getInstance()->title;?>" class="logo" /></a>
                </div>
                <div class="col-lg-7  col-sm-7 col-xs-12">
                    <div class="f-copy">
                        <ul class="list-inline">
                            <li><a href="index.php"><?php echo Core::getInstance()->title.'</a> | Nonton atau streaming online film gratis subtitle indonesia dan English'?></li>
                        </ul>
                    </div>
                    <div class="delimiter"></div>
                    <div class="f-copy">
                        <ul class="list-inline">
                            <li><a href="contact.php">Contact</a></li>
                            <li><a href="terms.php">Terms</a></li>
                            <li><a href="privacy.php">Privacy</a></li>
                            <li><a href="sitemap.php">Sitemap</a></li>
                            <li><a href="rss.php">Rss</a></li>
                            <li>Copyrights @ <?php echo Date('Y');?>, <a href="<?php echo Core::getInstance()->homepath;?>"><?php echo Core::getInstance()->title;?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-offset-1 col-lg-3 col-sm-3 col-xs-12 hidden-xs">
                    <div class="f-icon pull-left">
                        <a href="<?php echo (empty(Core::getInstance()->facebook)?'#':Core::getInstance()->facebook);?>"><i class="fa fa-facebook-square"></i></a>
                        <a href="<?php echo (empty(Core::getInstance()->twitter)?'#':Core::getInstance()->twitter);?>"><i class="fa fa-twitter"></i></a>
                        <a href="<?php echo (empty(Core::getInstance()->gplus)?'#':Core::getInstance()->gplus);?>"><i class="fa fa-google-plus"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /footer -->