<?php include 'backend/Core.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="<?php echo Core::getInstance()->title?> is an entertainment website which is provide free watch or streaming movie with indonesian or english subtitle.">
    <meta name="keyword" content="About, <?php echo Core::getInstance()->keyword?>"?>
    <meta name="author" content="<?php echo Core::getInstance()->title.' Team'?>">
    <link rel="icon" href="favicon.png">

    <title><?php echo Core::getInstance()->title?> | About Us</title>

    <?php include 'global-meta.php';?>
</head>

<body class="dark">
<?php include 'global-header.php';?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 v-categories side-menu">

                <!-- Menu -->
                <div class="content-block">
                    <div class="cb-header">
                        <div class="row">
                            <div class="col-lg-10">
                                <ul class="list-inline">
                                    <li><a href="#" class="color-active">Menu</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="cb-content">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-4">
                                <aside class="sidebar-menu">
                                    <ul>
                                        <li class="<?php echo ((pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "about")?'color-active':'')?>"><a href="about.php">About Us</a></li>
                                        <li class="<?php echo ((pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "dmca")?'color-active':'')?>"><a href="dmca.php">DMCA</a></li>
                                        <li class="<?php echo ((pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "terms")?'color-active':'')?>"><a href="terms.php">Terms Of Service</a></li>
                                        <li class="<?php echo ((pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "privacy")?'color-active':'')?>"><a href="privacy.php">Privacy Policy</a></li>
                                    </ul>
                                    <div class="bg-add"></div>
                                </aside>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-8">
                                <!-- Content -->
                                <div class="row">
                                    <div class="b-category">
                                    <h4 class="color-active">About <?php echo Core::getInstance()->title?>:</h4>
                                    <p class="desc"><?php echo Core::getInstance()->title?> is an entertainment website which is provide free watch or streaming movie with indonesian or english subtitle.</p>
                                    <p class="desc">Please note, the movies on this web obtained from web search on the internet. We do not store the movie files on our own servers and we just paste those links on our website.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Menu -->

            </div>
        </div>
    </div>
</div>

<?php include 'global-footer.php';?>
<?php include 'global-js.php';?>

</body>
</html>
