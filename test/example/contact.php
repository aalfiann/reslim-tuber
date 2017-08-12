<?php include '../backend/Core.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Just contact us, we will hear everything from you.">
    <meta name="author" content="<?php echo Core::getInstance()->title?> Team">
    <link rel="icon" href="favicon.png">

    <title><?php echo Core::getInstance()->title?> | Contact Us</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/font-circle-video.css" rel="stylesheet">

    <!-- font-family: 'Hind', sans-serif; -->
    <link href='https://fonts.googleapis.com/css?family=Hind:400,300,500,600,700|Hind+Guntur:300,400,500,700' rel='stylesheet' type='text/css'>
</head>

<body class="dark">

<?php include 'global-header.php';?>



<div class="container-fluid bg-image">
    <div class="row">
        <div class="login-wraper">
            <img src="images/contact.jpg" alt="">
            <div class="banner-text">
                <div class="line"></div>
                <div class="b-text">
                    Help, <span class="color-active">feedback</span>, claim or <span class="color-b1">ad</span><span class="color-b2">ver</span><span class="color-b3">tise?</span>
                </div>
                <div class="overtext">
                    Just contact us, we will hear everything from you.
                </div>
            </div>
            <div class="login-window">
                <?php
                    $aaa=rand(0,5);$bbb=rand(3,9);
                    if (isset($_POST['submitcontact'])){
                        if (($_POST['aaa'] + $_POST['bbb']) == $_POST['key']){
                            $post_array = array(
                                'To' => Core::getInstance()->email,
                                'Subject' => filter_var($_POST['subject'],FILTER_SANITIZE_STRING),
                                'Message' => $_POST['message'],
                                'From' => filter_var($_POST['email'],FILTER_SANITIZE_EMAIL),
                                'FromName' => filter_var($_POST['name'],FILTER_SANITIZE_STRING),
                                'Html' => true,
                                'CC' => '',
                                'BCC' => '',
                                'Attachment' => ''
                            );
                            Core::sendMailFrontend(Core::getInstance()->api.'/mail/send',$post_array);
                        } else {
                            echo '<div class="col-lg-12 forgottext">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <strong>Wrong security key!</strong>
                                    </div>                                
                                </div>';
                        }
                    } 
                ?>
                <div class="l-head">
                    Contact Us
                </div>
                <div class="l-form">
                    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                        <div class="form-group col-lg-6">
                            <label for="exampleInputEmail1">Name</label>
                            <input name="name" type="name" class="form-control" id="exampleInputEmail1" placeholder="your name here...">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="exampleInputEmail1">Email</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="your email here...">
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="exampleInputEmail1">Subject</label>
                            <input name="subject" type="text" class="form-control" id="exampleInputEmail1" placeholder="write the subject here...">
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="exampleInputEmail1">Message</label>
                            <textarea name="message" type="text" class="form-control" id="exampleInputEmail1" rows="3" placeholder="write the message here..."></textarea>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="exampleInputEmail1">Security: <?php echo $aaa?> + <?php echo $bbb?> = ?</label>
                            <input name="key" type="text" class="form-control" id="exampleInputEmail1" placeholder="your answer here...">
                        </div>
                        <div class="form-group hidden">
                            <input name="aaa" type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $aaa?>">
                            <input name="bbb" type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $bbb?>">
                        </div>
                        <div class="row">
                            <div class="col-lg-12"><button name="submitcontact" type="submit" class="btn btn-cv1">Send Message</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'global-footer.php';?>
<?php include 'global-js.php';?>

</body>
</html>
