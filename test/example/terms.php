<?php include 'backend/Core.php';?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="<?php echo Core::lang('terms')?>">
    <meta name="keyword" content="<?php echo Core::lang('terms')?>, TOS, <?php echo Core::getInstance()->keyword?>"?>
    <meta name="author" content="<?php echo Core::getInstance()->title.' Team'?>">

    <title><?php echo Core::lang('terms')?> | <?php echo Core::getInstance()->title?></title>

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
                                        <h4 class="color-active">Terms Of Service:</h4>
                                        <h5 class="desc">1. Terms</h5>
                                        <p class="desc">By accessing the website at <?php echo Core::getInstance()->homepath?>, you are agreeing to be bound by these terms of service, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this website are protected by applicable copyright and trademark law.</p>
                                    
                                        <h5 class="desc">2. Use License</h5>
                                        <p class="desc">
                                            <ul class="desc">
                                                <li>Permission is granted to temporarily download one copy of the materials (information or software) on <?php echo Core::getInstance()->title?>'s website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
                                                    <ol class="desc">
                                                        <li>modify or copy the materials;</li>
                                                        <li>use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</li>
                                                        <li>attempt to decompile or reverse engineer any software contained on <?php echo Core::getInstance()->title?>'s website;</li>
                                                        <li>remove any copyright or other proprietary notations from the materials; or</li>
                                                        <li>transfer the materials to another person or "mirror" the materials on any other server.</li>
                                                    </ol>
                                                </li>
                                                <li>This license shall automatically terminate if you violate any of these restrictions and may be terminated by <?php echo Core::getInstance()->title?> at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.</li>
                                            </ul>
                                        </p>

                                        <h5 class="desc">3. Disclaimer</h5>
                                        <p class="desc">
                                            <ul class="desc">
                                                <li>The materials on <?php echo Core::getInstance()->title?>'s website are provided on an 'as is' basis. <?php echo Core::getInstance()->title?> makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</li>
                                                <li>Further, <?php echo Core::getInstance()->title?> does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its website or otherwise relating to such materials or on any sites linked to this site.</li>
                                            </ul>
                                        </p>

                                        <h5 class="desc">4. Limitations</h5>
                                        <p class="desc">
                                            In no event shall <?php echo Core::getInstance()->title?> or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on <?php echo Core::getInstance()->title?>'s website, even if <?php echo Core::getInstance()->title?> or a <?php echo Core::getInstance()->title?> authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.
                                        </p>

                                        <h5 class="desc">5. Accuracy of materials</h5>
                                        <p class="desc">
                                            The materials appearing on <?php echo Core::getInstance()->title?>'s website could include technical, typographical, or photographic errors. <?php echo Core::getInstance()->title?> does not warrant that any of the materials on its website are accurate, complete or current. <?php echo Core::getInstance()->title?> may make changes to the materials contained on its website at any time without notice. However <?php echo Core::getInstance()->title?> does not make any commitment to update the materials.
                                        </p>

                                        <h5 class="desc">6. Links</h5>
                                        <p class="desc">
                                            <?php echo Core::getInstance()->title?> has not reviewed all of the sites linked to its website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by <?php echo Core::getInstance()->title?> of the site. Use of any such linked website is at the user's own risk.
                                        </p>

                                        <h5 class="desc">7. Modifications</h5>
                                        <p class="desc">
                                            <?php echo Core::getInstance()->title?> may revise these terms of service for its website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.
                                        </p>

                                        <h5 class="desc">8. Governing Law</h5>
                                        <p class="desc">
                                            These terms and conditions are governed by and construed in accordance with the laws of Indonesia and you irrevocably submit to the exclusive jurisdiction of the courts in that State or location.
                                        </p>
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
