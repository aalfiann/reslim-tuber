<?php include 'backend/Core.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Our Privacy Policy.">
    <meta name="keyword" content="Privacy, policy, <?php echo Core::getInstance()->keyword?>"?>
    <meta name="author" content="<?php echo Core::getInstance()->title.' Team'?>">
    <link rel="icon" href="favicon.png">

    <title><?php echo Core::getInstance()->title?> | Privacy Policy</title>

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
                                        <h4 class="color-active">Privacy Policy Notice:</h4>
                                        <h5 class="desc">1. No Registration</h5>
                                        <p class="desc">
                                            We do not have a user registration service, but we have a mailing form which requires your personal data such as your name and email addresses.
                                        </p>

                                        <h5 class="desc">2. Sharing</h5>
                                        <p class="desc">We share aggregated demographic information with our partners and advertisers. This is not linked to any personal information that can identify any individual person.</p>
                                        <p class="desc">And/or:<br>
                                        We use an outside shipping company to ship orders, and a credit card processing company to bill users for goods and services. These companies do not retain, share, store or use personally identifiable information for any secondary purposes beyond filling your order.</p>
                                        <p class="desc">And/or:<br>
                                        We partner with another party to provide specific services. When the user signs up for these services, we will share names, or other contact information that is necessary for the third party to provide these services. These parties are not allowed to use personally identifiable information except for the purpose of providing these services.
                                        </p>

                                        <h5 class="desc">3. Links</h5>
                                        <p class="desc">
                                            This website contains links to other sites. Please be aware that we are not responsible for the content or privacy practices of such other sites. We encourage our users to be aware when they leave our site and to read the privacy statements of any other site that collects personally identifiable information.
                                        </p>

                                        <h5 class="desc">4. Cookies</h5>
                                        <p class="desc">
                                            We are not use any cookies so there is no any personal information stored but our third party may do use cookies. 
                                        </p>

                                        <h4 class="color-active">Information Collection, Use, and Sharing</h4>
                                        <p class="desc">We are the sole owners of the information collected on this site. We only have access to/collect information that you voluntarily give us via email or other direct contact from you. We will not sell or rent this information to anyone.</p>
                                        <p class="desc">We will use your information to respond to you, regarding the reason you contacted us. We will not share your information with any third party outside of our organization, other than as necessary to fulfill your request, e.g. to ship an order.</p>
                                        <p class="desc">Unless you ask us not to, we may contact you via email in the future to tell you about specials, new products or services, or changes to this privacy policy.</p>
                                        <p class="desc">We do not retrieve any user information or website visitors if the user or visitor is not registered as a member.
                                        </p>

                                        <h4 class="color-active">Your Access to and Control Over Information</h4>
                                        <p class="desc">
                                            You may opt out of any future contacts from us at any time. You can do the following at any time by contacting us via the email address given on our website:
                                            <ol class="desc">
                                                <li>See what data we have about you, if any.</li>
                                                <li>Change/correct any data we have about you.</li>
                                                <li>Have us delete any data we have about you.</li>
                                                <li>Express any concern you have about our use of your data.</li>
                                            </ol>
                                        </p>

                                        <h4 class="color-active">Security</h4>
                                        <p class="desc">We take precautions to protect your information. When you submit sensitive information via the website, your information is protected both online and offline.</p>
                                        <p class="desc">Wherever we collect sensitive information (such as credit card data), that information is encrypted and transmitted to us in a secure way. You can verify this by looking for a lock icon in the address bar and looking for "https" at the beginning of the address of the Web page.</p>
                                        <p class="desc">While we use encryption to protect sensitive information transmitted online, we also protect your information offline. Only employees who need the information to perform a specific job (for example, billing or customer service) are granted access to personally identifiable information. The computers/servers in which we store personally identifiable information are kept in a secure environment.
                                        </p>

                                        <h4 class="color-active">Redress</h4>
                                        <p class="desc">
                                            If you feel that we are not abiding by this privacy policy, you should contact us immediately via email to <?php echo Core::getInstance()->email?>.
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
