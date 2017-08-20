<?php include 'backend/Core.php';?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Digital Millennium Copyright Act (DMCA).">
    <meta name="keyword" content="DMCA, <?php echo Core::getInstance()->keyword?>"?>
    <meta name="author" content="<?php echo Core::getInstance()->title.' Team'?>">

    <title>Digital Millennium Copyright Act (DMCA) | <?php echo Core::getInstance()->title?></title>

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
                                        <?php include 'global-sidebar.php';?>
                                    </ul>
                                    <div class="bg-add"></div>
                                </aside>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-8">
                                <!-- Content -->
                                <div class="row">
                                    <div class="b-category">
                                    <h4 class="color-active">Digital Millennium Copyright Act (DMCA):</h4>
                                    <p class="desc"><?php echo Core::getInstance()->title?> is an online service provider website as defined in the Digital Millennium Copyright Act.</p>
                                    <p class="desc">We strongly support the copyright law and will greatly protect the copyright owner's law.</p>

<p class="desc">If you are the owner of any content appearing on the <?php echo Core::getInstance()->title?> website and you do not permit the use of such content, you are strongly encouraged to notify us by writing an email to <?php echo Core::getInstance()->email?> so that we may identify and take necessary action.</p>

<p class="desc">We can not take action if you do not provide us with the necessary information. So please write an email filled with contains some details mentioned below.</p>

<p class="desc">Specify copyright content that you think has been infringed. If you claim a breach of multiple copyrighted works in one email then please write the list in detail along with the website address containing the infringing content.</p>

<p class="desc">Please provide your name, phone, office address and email address to enable us to contact you.<br>
If you have good faith then send the email yourself, not allowed if the email is from an agent or a third party.<br>
The information written should be accurate and under penalty of counterfeiting.</p>
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
