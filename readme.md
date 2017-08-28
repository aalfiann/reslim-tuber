reSlim-tuber
=======
[![Build](https://img.shields.io/badge/coverage-100%25-green.svg)](https://github.com/aalfiann/reSlim-tuber)
[![Version](https://img.shields.io/badge/stable-1.0.0-green.svg)](https://github.com/aalfiann/reSlim-tuber)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/aalfiann/reSlim-tuber/blob/master/license.md)

A simple web app for boost to make money on your videos on youtube, vimeo, etc<br>
reSlim-tuber is based on [reSlim](https://github.com/aalfiann/reSlim) which is based on [Slim Framework version 3](http://www.slimframework.com/).<br>

omovv.ga use this script >> [visit](https://omovv.ga)
---------------

Roadmap:
---------------
1. Post or Embed your video from Youtube, Vimeo, etc.
2. Ads management system
3. Like and Dislike rating system
4. Share video using sharethis
5. Comment system using disqus
6. Very simple and small as there is no member system
7. Automatic build Sitemap and RSS
8. Dynamic robots.txt
9. Modern and SEO Optimized design
10. Etc

Feature:
---------------
Reslim is already build with essentials of user management system in rest api way.

1. User register, login and logout
2. Auto generated token every login
3. User can revoke all active token
4. Every user can upload file to server
5. There is a role for superuser, admin and member
6. Auto clear current token when logout,user deleted or password was changed
7. Change, reset, forgot password concept is very secure
8. Mailer for sending email or contact form
9. User can manage their API Keys
10. Pagination json response
11. Etc.

System Requirements
---------------

1. Web server with URL rewriting
2. Web server with mcrypt extension
3. PHP 5.5 or newer


Getting Started
---------------
1. Get or download the project
2. Install it using Composer

### reSlim-tuber Configuration

Example Config.php
```php
/** 
 * Configuration App
 *
 * @var $config['displayErrorDetails'] to display error details on slim
 * @var $config['addContentLengthHeader'] to set the Content-Length header which makes Slim behave more predictably
 * @var $config['limitLoadData'] to protect high request data load. Default is 1000.
 * @var $config['enableApiKeys'] to protect api from guest or anonymous. Guest which don't have api key can not using this service. Default is true.
 * 
 */
$config['displayErrorDetails']      = true;
$config['addContentLengthHeader']   = false;
$config['limitLoadData'] = 1000;
$config['enableApiKeys'] = true;

/** 
 * Configuration PDO MySQL Database
 *
 * @var $config['db']['host'] = where is database was hosted
 * @var $config['db']['user'] = username database to login
 * @var $config['db']['pass'] = pass database to login
 * @var $config['db']['dbname'] = the database name
 */
$config['db']['host']   = 'localhost';
$config['db']['user']   = 'root';
$config['db']['pass']   = 'root';
$config['db']['dbname'] = 'reSlim-tuber';

/**
 * Configuration SMTP for Mailer
 *
 * @var $config['smtp']['host'] is smtp host. example smtp.gmail.com
 * @var $config['smtp']['autotls'] is make smtp will send using tls protocol as default
 * @var $config['smtp']['auth'] will connect to smtp using authentication
 * @var $config['smtp']['secure'] this is type of smtp security. You can use tls or ssl
 * @var $config['smtp']['port'] this is port smtp
 * @var $config['smtp']['defaultnamefrom'] this is default name from. You can filled with yourname / yourwebsitetitle
 * @var $config['smtp']['username'] your username to login into smtp server
 * @var $config['smtp']['password'] the password to login into smtp server
 * @var $config['smtp']['debug'] get more information by set debug.
 *                               To work using rest api, You should set debug 1,
 *                               because other than 1, there is special characters that will broke json format. 
 */
$config['smtp']['host'] = 'smtp.gmail.com';
$config['smtp']['autotls'] = false;
$config['smtp']['auth'] = true;
$config['smtp']['secure'] = 'tls';
$config['smtp']['port'] = 587;
$config['smtp']['defaultnamefrom'] = 'reSlim-tuber admin';
$config['smtp']['username'] = 'youremail@gmail.com';
$config['smtp']['password'] = 'secret';
$config['smtp']['debug'] = 1;

// Configuration timezone
$config['reslim']['timezone'] = 'Asia/Jakarta';
```

Working with default example for testing
-----------------
I recommend you to use PostMan an add ons in Google Chrome to get Started with test.

1. Import reSlim-tuber.sql in your database then config your database connection in config.php inside folder "reSlim-tuber/src/"
2. Import file reSlim-tuber User.postman_collection.json in your PostMan.
3. Edit the path in PostMan. Because the example test is using my path server which is my server is run in http://localhost:1337 
    The path to run reSlim-tuber is inside folder api.<br> 
    Example for my case is: http://localhost:1337/reSlim-tuber/src/api/<br><br>
    In short, It's depend on your server configuration.
4. Then you can do the test by yourself

Working with gui example for testing
-----------------

1. Import reSlim-tuber.sql in your database then config your database connection in config.php inside folder "reSlim-tuber/src/"
2. Edit the config.php inside folder "reSlim/test/example/backend"<br>
    $config['title'] = 'reSlim Tuber'; //Your title website<br>
    $config['keyword'] = 'Nonton, Streaming, online, film, movie, gratis, subtitle, indonesia'; //Your keyword website<br>
    $config['description'] = 'Nonton atau streaming online film gratis subtitle indonesia dan english'; //Your description website<br>
    $config['email'] = 'youremail@gmail.com'; //Your default email<br>
    $config['basepath'] = 'http://localhost:1337/reSlim-tuber/test/example/backend'; //Your folder backend website<br>
    $config['homepath'] = 'http://localhost:1337/reSlim-tuber/test/example'; //Your folder frontend website<br>
    $config['api'] = 'http://localhost:1337/reSlim-tuber/src/api'; //Your folder rest api<br>
    $config['apikey'] = ''; //Your api key, you can leave this blank and fill this later<br>
    $config['disqus'] = ''; //Your disqus username, you can leave this blank and fill this later<br>
    $config['sharethis'] = '598da1b6ea00a30012ce67a0'; //Your sharethis key, you can leave this blank and fill this later<br>
    $config['facebook'] = ''; //Your facebook page, you can leave this blank and fill this later<br>
    $config['twitter'] = ''; //Your twitter page, you can leave this blank and fill this later<br>
    $config['gplus'] = ''; Your google plus page, you can leave this blank and fill this later<br>
    $config['gpub'] = ''; //Your google publisher page, you can leave this blank and fill this later<br>
    $config['googleanalytics'] = ''; //Your google analytics, you can leave this blank and fill this later<br>
    $config['googlewebmaster'] = ''; //Your google webmaster, you can leave this blank and fill this later<br>
    $config['bingwebmaster'] = ''; //Your bing webmaster, you can leave this blank and fill this later<br>
    $config['yandexwebmaster'] = ''; //Your yandex webmaster, you can leave this blank and fill this later<br>
3. Visit yourserver/reSlim-tuber/test/example/backend<br>
    For my case is http://localhost:1337/reSlim-tuber/test/example/backend
4. You can login with default superuser account:<br>
    Username : reslim<br>
    Password : reslim
5. All is done

The concept authentication in reSlim-tuber
-----------------

1. Register account first
2. Then You have to login to get the generated new token

The token is always generated new when You relogin and the token is will expired in 7 days as default.<br>
If You logout or change password or delete user, the token will be clear automatically.

How to Contribute
-----------------
### Pull Requests

1. Fork the reSlim-tuber repository
2. Create a new branch for each feature or improvement
3. Send a pull request from each feature branch to the develop branch