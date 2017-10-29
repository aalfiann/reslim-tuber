<?php 
    spl_autoload_register(function ($classname) {require ( $classname . ".php");});
    /**
     * A class for core example reSlim project
     *
     * @package    Core reSlim
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2016 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/reSlim/blob/master/license.md  MIT License
     */
    class Core {

        // Set title website
        var $title;

        // Set keyword website
        var $keyword;

        // Set description website
        var $description;

        // Set email address website
        var $email;
        
        // Set base path example project
        var $basepath;

        // Set home path example project
        var $homepath;

        // Set base api reslim
        var $api;

        // Set api keys
        var $apikey;

        // Set disqus
        var $disqus;

        // Set facebook
        var $facebook;

        // Set twitter
        var $twitter;

        // Set google plus
        var $gplus;

        // Set google publisher page
        var $gpub;

        // Set sharethis keys
        var $sharethis;

        // Set google analytics
        var $googleanalytics;

        // Set google webmaster tools
        var $googlewebmaster;

        // Set bing webmaster tools
        var $bingwebmaster;
        
        // Set yandex webmaster tools
        var $yandexwebmaster;

        // Set IMDB API
        var $imdbapi;

        // Set Keyword Dynamic Page
        var $seopage;

        // Set Keyword Competitor Site
        var $seosite;

        var $version = '1.0.0';

        // Set language
        var $setlang = 'en';
        var $datalang;

        private static $instance;
        
        function __construct() {
            require_once 'config.php';
            $langs = glob(dirname(__FILE__) .'/language/*.'.$this->setlang.'.php');
            foreach ($langs as $langname) {
                require $langname;
            }
            $lang += $backend;                              // append backend language
            $this->datalang = $lang;                        // set language
            $this->title = $config['title'];
            $this->keyword = $config['keyword'];
            $this->description = $config['description'];
            $this->email = $config['email'];
            $this->basepath = $config['basepath'];
            $this->homepath = $config['homepath'];
            $this->api = $config['api'];
            $this->apikey = $config['apikey'];
            $this->disqus = $config['disqus'];
            $this->sharethis = $config['sharethis'];
            $this->facebook = $config['facebook'];
            $this->twitter = $config['twitter'];
            $this->gplus = $config['gplus'];
            $this->gpub = $config['gpub'];
            $this->googleanalytics = $config['googleanalytics'];
            $this->googlewebmaster = $config['googlewebmaster'];
            $this->bingwebmaster = $config['bingwebmaster'];
            $this->yandexwebmaster = $config['yandexwebmaster'];
            $this->imdbapi = $config['imdbapi'];
            $this->seopage = $config['seopage'];
            $this->seosite = $config['seosite'];
		}

        public static function getInstance()
        {
            if ( is_null( self::$instance ) )
            {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public static function lang($key){
            return self::getInstance()->datalang[$key];
        }
        
        // LIBRARY USER MANAGEMENT AND AUTHENTICATION======================================================================

        /**
		 * Get Message
         *
         * @param $type = the tpe of message in bootstrap. Example: success,warning,danger,info,primary,default
         * @param $primaryMessage = Message to show.
         * @param $secondaryMessage = Additional message to show. This is not required, so default is null.
		 * @return string with message data
		 */
        public static function getMessage($type,$primaryMessage,$secondaryMessage=null){
            return '<div class="alert alert-'.$type.'" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>'.$primaryMessage.'</strong> '.$secondaryMessage.'
                        </div>';
        }

        /**
		 * CURL Post Request
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function execPostRequest($url,$post_array){
        
            if(empty($url)){ return false;}
            //build query
            $fields_string =http_build_query($post_array);
        
            //open connection
            $ch = curl_init();
        
            ////curl parameter set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        
            //execute post
            $result = curl_exec($ch);
        
            //close connection
            curl_close($ch);
        
            return $result;
        }

        /**
		 * CURL Post Upload Request Multipart Data
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function execPostUploadRequest($url,$post_array){
        
            if(empty($url)){ return false;}
            
            //open connection
            $ch = curl_init();
        
            ////curl parameter set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_USERAGENT,'Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15');
            curl_setopt($ch, CURLOPT_HTTPHEADER,array('User-Agent: Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15','Referer: '.self::getInstance()->api,'Content-Type: multipart/form-data'));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // stop verifying certificate
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$post_array);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
            //execute post
            $result = curl_exec($ch);
            if ($result === false){
                $result = curl_error($ch);
            };
        
            //close connection
            curl_close($ch);
        
            return $result;
        }

        /**
		 * CURL Get Request
         *
         * @param $url = The url api to get the request
		 * @return result json encoded data
		 */
        public static function execGetRequest($url){
            //open connection
	    	$ch = curl_init($url);
            
            //curl parameter
    		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
	    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
            
            //execute post
		    $data = curl_exec($ch);
            
            //close connection
    		curl_close($ch);

	    	return $data;
    	}

        /**
		 * Verify API Token
         *
         * @param $token = Your token that generated from api server after login
		 * @return boolean true / false
		 */
        public static function verifyToken($token){
            $result = false;
            $data = json_decode(self::execGetRequest(self::getInstance()->api.'/user/verify/'.$token));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    $result = true;
                }
            }
            return $result;
        }

        /**
		 * Get Role by API Token
         *
         * @param $token = Your token that generated from api server after login
		 * @return integer
		 */
        public static function getRole($token){
            $result = 0;
            $data = json_decode(self::execGetRequest(self::getInstance()->api.'/user/scope/'.$token));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    $result = $data->{'role'};
                }
            }
            return $result;
        }

        /**
		 * Revoke API Token
         *
         * @param $username = Your username
         * @param $token = Your token that generated from api server after login
		 * @return boolean true / false
		 */
        public static function revokeToken($username,$token){
            $result = false;
            $post_array = array(
                'Username' => urlencode($username),
                'Token' => urlencode($token)
            );
            $url = self::getInstance()->api.'/user/logout';
            $data = json_decode(self::execPostRequest($url,$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    $result = true;
                }
            }
            return $result;
        }

        /**
		 * Process Register
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function register($url,$post_array){
            $data = json_decode(self::execPostRequest($url,$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    echo self::getMessage('success','Process Register Successfully!');
                } else {
                    echo self::getMessage('danger','Process Register Failed!',$data->{'message'});    
                }
            } else {
                echo self::getMessage('danger','Process Register Failed!','Can not connected to the server!');
            }
	    }

        /**
		 * Process Update
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function update($url,$post_array){
            $data = json_decode(self::execPostRequest($url,$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    echo self::getMessage('success','Process Update Successfuly!');
                } else {
                    echo self::getMessage('danger','Process Update Failed!',$data->{'message'});
                }
            } else {
                echo self::getMessage('danger','Process Update Failed!','Can not connected to the server!');
            }
	    }

        /**
		 * Process Login
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function login($url,$post_array){
            $data = json_decode(self::execPostRequest($url,$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    if ($post_array['Rememberme'] == "on"){
						session_start();
                        $_SESSION['username'] = $post_array['Username'];
						$_SESSION['token'] = $data->{'token'};
					} else {
						setcookie('username', $post_array['Username'], time() + (3600 * 168), "/", NULL); // expired = 7 days
				  		setcookie('token', $data->{'token'}, time() + (3600 * 168), "/", NULL); // expired = 7 hari
					}
					header("Location: ".self::getInstance()->basepath."/index.php");
                } else {
                    echo self::getMessage('danger','Process Login Failed!',$data->{'message'});
                }
            } else {
                echo self::getMessage('danger','Process Login Failed!','Can not connected to the server!');
            }
	    }

        /**
		 * Process Logout
         *
         * @return redirect to login page
		 */
        public static function logout()
        {
            //Unset SESSION
        	if (!isset($_SESSION['username'])) session_start();
                if (self::revokeToken($_SESSION['username'],$_SESSION['token'])){
                    unset($_SESSION['username']);
                	unset($_SESSION['token']);
                }
        	// unset cookies
        	if (isset($_SERVER['HTTP_COOKIE'])) {
                if (self::revokeToken($_COOKIE['username'],$_COOKIE['token'])){
                    setcookie('username', '', time()-1000, '/');
                    setcookie('token', '', time()-1000, '/');
                }
            	$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            	    foreach($cookies as $cookie) {
                	    $parts = explode('=', $cookie);
                    	$name = trim($parts[0]);
                    	setcookie($name, '', time()-1000);
                        setcookie($name, '', time()-1000, '/');
                	}
	        }
        	header("Location: ".self::getInstance()->basepath."/modul-login.php?m=1");
        }

        /**
		 * Process Forgot Password
         *
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function forgotPassword($post_array){
            $data = json_decode(self::execPostRequest(self::getInstance()->api.'/user/forgotpassword',$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    $linkverify = self::getInstance()->basepath.'/modul-verify.php?passkey='.$data->{'passkey'};
                    $email_array = array(
                        'To' => $post_array['Email'],
                        'Subject' => 'Request reset password',
                        'Message' => '<html><body><p>You have already requested to reset password.<br /><br />
                        Here is the link to reset: <a href="'.$linkverify.'" target="_blank"><b>'.$linkverify.'</b></a>.<br /><br />
                        
                        Just ignore this email if You don\'t want to reset password. Link will be expired 3days from now.<br /><br /><br />
                        Thank You<br />
                        '.self::getInstance()->title.'</p></body></html>',
                        'Html' => 'true',
                        'From' => '',
                        'FromName' => '',
                        'CC' => '',
                        'BCC' => '',
                        'Attachment' => ''
                    );
                    try {
                        $sendemail = json_decode(self::execPostRequest(self::getInstance()->api.'/mail/send',$email_array));
                        echo self::getMessage('success','Request reset password hasbeen sent to your email!','If not, try to resend again later.');
                    } catch (Exception $e) {
                        echo self::getMessage('danger','Process Forgot Password Failed!',$e->getMessage());
                    }
                } else {
                    echo self::getMessage('danger','Process Forgot Password Failed!',$data->{'message'});
                }
            } else {
                echo self::getMessage('danger','Process Forgot Password Failed!','Can not connected to the server!');
            }
	    }

        /**
		 * Process Verify Pass Key
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function verifyPassKey($url,$post_array){
            $data = json_decode(self::execPostRequest($url,$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    echo self::getMessage('success','Process Change Password Successfully!');
                } else {
                    echo self::getMessage('danger','Process Change Password Failed!',$data->{'message'});
                }
            } else {
                echo self::getMessage('danger','Process Change Password Failed!','Can not connected to the server!');
            }
	    }

        /**
		 * Process Upload File
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function uploadFile($url,$post_array){
            $data = json_decode(self::execPostUploadRequest($url,$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    echo self::getMessage('success','Process Upload Successfuly!');
                } else {
                    echo self::getMessage('danger','Process Upload Failed!',$data->{'message'});
                }
            } else {
                echo self::getMessage('danger','Process Upload Failed!','Can not connected to the server!');
            }
	    }

        /**
		 * Process Update File
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function updateFile($url,$post_array){
            $data = json_decode(self::execPostRequest($url,$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('success','Process Update Successfuly!','This page will automatically refresh at 2 seconds...');
                    echo '</div>';
                } else {
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('danger','Process Update Failed!',$data->{'message'}.' This page will automatically refresh at 2 seconds...');
                    echo '</div>';
                }
            } else {
                echo '<div class="col-lg-12">';
                echo self::getMessage('danger','Process Update Failed!','Can not connected to the server! This page will automatically refresh at 2 seconds...');
                echo '</div>';
            }
	    }

        /**
		 * Process Delete File
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function deleteFile($url,$post_array){
            $data = json_decode(self::execPostRequest($url,$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('success','Process Delete Successfuly!','This page will automatically refresh at 2 seconds...');
                    echo '</div>';
                } else {
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('danger','Process Delete Failed!',$data->{'message'}.'. This page will automatically refresh at 2 seconds...');
                    echo '</div>';
                }
            } else {
                echo '<div class="col-lg-12">';
                echo self::getMessage('danger','Process Delete Failed!','Can not connected to the server! This page will automatically refresh at 2 seconds...');
                echo '</div>';
            }
	    }

        /**
		 * Process Send Email
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function sendMail($url,$post_array){
            try{
                $data = json_decode(self::execPostRequest($url,$post_array));
                echo self::getMessage('success','The message is successfully sent!');
            } catch (Exception $e) {
                echo self::getMessage('danger','The message is failed to sent!','Please try again later!');
            }
	    }

        /**
		 * Process Send Email in Frontend
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function sendMailFrontend($url,$post_array){
            try{
                $data = json_decode(self::execPostRequest($url,$post_array));
                echo '<div class="col-lg-12 forgottext">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong>'.self::lang('mail_success').'</strong>
                        </div>                                
                    </div>';
            } catch (Exception $e) {
                echo '<div class="col-lg-12 forgottext">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong>'.self::lang('mail_failed').'</strong>
                        </div>                                
                    </div>';
            }
	    }

        /**
		 * Process Create New API
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function createNewAPI($url,$post_array){
            $data = json_decode(self::execPostRequest($url,$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('success','Process Add new API Keys Successfully!');
                    echo '</div>';
                } else {
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('danger','Process Add new API Keys Failed!',$data->{'message'});    
                    echo '</div>';
                }
            } else {
                echo '<div class="col-lg-12">';
                echo self::getMessage('danger','Process Add new API Keys Failed!','Can not connected to the server!');
                echo '</div>';
            }
	    }

        /**
		 * Process Update API
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function updateAPI($url,$post_array){
            $data = json_decode(self::execPostRequest($url,$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('success','Process Update Successfuly!');
                    echo '</div>';
                } else {
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('danger','Process Update Failed!',$data->{'message'});
                    echo '</div>';
                }
            } else {
                echo '<div class="col-lg-12">';
                echo self::getMessage('danger','Process Update Failed!','Can not connected to the server!');
                echo '</div>';
            }
	    }

        /**
		 * Process Delete API
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
		 * @return result json encoded data
		 */
	    public static function deleteAPI($url,$post_array){
            $data = json_decode(self::execPostRequest($url,$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('success','Process Delete Successfuly!');
                    echo '</div>';
                } else {
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('danger','Process Delete Failed!',$data->{'message'});
                    echo '</div>';
                }
            } else {
                echo '<div class="col-lg-12">';
                echo self::getMessage('danger','Process Delete Failed!','Can not connected to the server!');
                echo '</div>';
            }
	    }

        /**
		 * Process Create
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
         * @param $title = Name of the process itself
		 * @return result json encoded data
		 */
	    public static function processCreate($url,$post_array,$title){
            $data = json_decode(self::execPostRequest($url,$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('success','Process Add '.$title.' Successfully!');
                    echo '</div>';
                } else {
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('danger','Process Add '.$title.' Failed!',$data->{'message'});    
                    echo '</div>';
                }
            } else {
                echo '<div class="col-lg-12">';
                echo self::getMessage('danger','Process Add '.$title.' Failed!','Can not connected to the server!');
                echo '</div>';
            }
	    }

        /**
		 * Process Update
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
         * @param $title = Name of the process itself
		 * @return result json encoded data
		 */
	    public static function processUpdate($url,$post_array,$title){
            $data = json_decode(self::execPostRequest($url,$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('success','Process Update '.$title.' Successfuly!');
                    echo '</div>';
                } else {
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('danger','Process Update '.$title.' Failed!',$data->{'message'});
                    echo '</div>';
                }
            } else {
                echo '<div class="col-lg-12">';
                echo self::getMessage('danger','Process Update '.$title.' Failed!','Can not connected to the server!');
                echo '</div>';
            }
	    }

        /**
		 * Process Delete
         *
         * @param $url = The url api to post the request
         * @param $post_array = Data array to post
         * @param $title = Name of the process itself
		 * @return result json encoded data
		 */
	    public static function processDelete($url,$post_array,$title){
            $data = json_decode(self::execPostRequest($url,$post_array));
            if (!empty($data)){
                if ($data->{'status'} == "success"){
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('success','Process Delete '.$title.' Successfuly!');
                    echo '</div>';
                } else {
                    echo '<div class="col-lg-12">';
                    echo self::getMessage('danger','Process Delete '.$title.' Failed!',$data->{'message'});
                    echo '</div>';
                }
            } else {
                echo '<div class="col-lg-12">';
                echo self::getMessage('danger','Process Delete '.$title.' Failed!','Can not connected to the server!');
                echo '</div>';
            }
	    }

        /**
		 * Check SESSION, COOKIE and Verify Token
         *
         * @return data array, but if null will be redirect to login page
		 */
        public static function checkSessions()
        {
            // If cookie is not found then check session
            if (!isset($_COOKIE['username']) && !isset($_COOKIE['token'])) 
            {
                session_start();
                // if session is not found then redirect to login page
                if (!isset($_SESSION['username']) && !isset($_SESSION['token']))
                {
                    $out['username'] = null;
                    $out['token'] = null;
                    header("Location: ".self::getInstance()->basepath."/modul-login.php?m=1");
                }
                else
                {
                    if (self::verifyToken($_SESSION['token'])) {
                        $out['username'] = $_SESSION['username'];
            	    	$out['token'] = $_SESSION['token'];
                    } else {
                        $out['username'] = null;
                        $out['token'] = null;
                        header("Location: ".self::getInstance()->basepath."/modul-login.php?m=1");
                    }                     
                }
            }
            else // If there is a cookie then return array
            {
                if (self::verifyToken($_COOKIE['token'])) {
                    $out['username'] = $_COOKIE['username'];
            	    $out['token'] = $_COOKIE['token'];
                } else {
                    $out['username'] = null;
                    $out['token'] = null;
                    header("Location: ".self::getInstance()->basepath."/modul-login.php?m=1");
                }
    	    }
	        return $out;
        }

        /**
		 * Redirect Page Location Header
         *
         * @param $page = The page to redirect
         * @param $timeout = The page will be redirected when time is out. Default is zero 
         * @return redirect page
		 */
        public static function goToPage($page,$timeout=0)
        {
           return header("Refresh:".$timeout.";url= ".self::getInstance()->basepath."/".$page."");
        }

        /**
		 * Redirect Page Location Header for frontend
         *
         * @param $page = The page to redirect
         * @param $timeout = The page will be redirected when time is out. Default is zero 
         * @return redirect page
		 */
        public static function goToPageFrontend($page,$timeout=0)
        {
           return header("Refresh:".$timeout.";url= ".self::getInstance()->homepath."/".$page."");
        }

        /**
		 * Redirect Page Location by meta header
         *
         * @param $url = The url to redirect
         * @param $timeout = The page will be redirected when time is out. Default is zero 
         * @return redirect url
		 */
        public static function goToPageMeta($url,$timeout=0)
        {
            return '<meta http-equiv="refresh" content="'.$timeout.';url='.$url.'">';
        }

        /**
		 * Reload Page
         *
         * @param $timeout = The page will be redirected when time is out. Default is 2000 miliseconds. 
         * @return reload self page
		 */
        public static function reloadPage($timeout=2000)
        {
            return '<script>setTimeout(function() {window.location.href=window.location.href}, '.$timeout.')</script>';
        }

        /**
		 * Save Settings
         *
         * @param $post_array = Data array to post
         * @return no return
		 */
        public static function saveSettings($post_array)
        {
            $newcontent = '<?php 
            //Configurations
            $config[\'title\'] = \''.$post_array['Title'].'\'; //Your title website
            $config[\'keyword\'] = \''.$post_array['Keyword'].'\'; //Your keyword website
            $config[\'description\'] = \''.$post_array['Description'].'\'; //Your description website
            $config[\'email\'] = \''.$post_array['Email'].'\'; //Your default email
            $config[\'basepath\'] = \''.$post_array['Basepath'].'\'; //Your folder backend website
            $config[\'homepath\'] = \''.$post_array['Homepath'].'\'; //Your folder frontend website
            $config[\'api\'] = \''.$post_array['Api'].'\'; //Your folder rest api
            $config[\'apikey\'] = \''.$post_array['ApiKey'].'\'; //Your api key, you can leave this blank and fill this later
            $config[\'disqus\'] = \''.$post_array['Disqus'].'\'; //Your disqus username, you can leave this blank and fill this later
            $config[\'sharethis\'] = \''.$post_array['Sharethis'].'\'; //Your sharethis key, you can leave this blank and fill this later
            $config[\'facebook\'] = \''.$post_array['Facebook'].'\'; //Your facebook page, you can leave this blank and fill this later
            $config[\'twitter\'] = \''.$post_array['Twitter'].'\'; //Your twitter page, you can leave this blank and fill this later
            $config[\'gplus\'] = \''.$post_array['Gplus'].'\'; //Your google plus page, you can leave this blank and fill this later
            $config[\'gpub\'] = \''.$post_array['Gpub'].'\'; //Your google publisher page, you can leave this blank and fill this later
            $config[\'googleanalytics\'] = \''.$post_array['Googleanalytics'].'\'; //Your google analytics, you can leave this blank and fill this later
            $config[\'googlewebmaster\'] = \''.$post_array['Googlewebmaster'].'\'; //Your google webmaster, you can leave this blank and fill this later
            $config[\'bingwebmaster\'] = \''.$post_array['Bingwebmaster'].'\'; //Your bing webmaster, you can leave this blank and fill this later
            $config[\'yandexwebmaster\'] = \''.$post_array['Yandexwebmaster'].'\'; //Your yandex webmaster, you can leave this blank and fill this later
            $config[\'imdbapi\'] = \''.$post_array['Imdbapi'].'\'; //IMDB API, you can leave this blank and fill this later
            $config[\'seopage\'] = \''.$post_array['Seopage'].'\'; //Keyword for dynamic page, you can leave this blank and fill this later
            $config[\'seosite\'] = \''.$post_array['Seosite'].'\'; //Keyword for competitor site, you can leave this blank and fill this later';
            $handle = fopen('config.php','w+'); 
				fwrite($handle,$newcontent); 
				fclose($handle); 
            echo self::getMessage('success','Settings hasbeen changed!', 'This page will refresh at 2 seconds...');
            echo self::reloadPage();
        }

        /**
         * Auto cut off long text
         *
         * @param $string = Data text
         * @param $limitLength = Limit value to be auto cut. Default value is 50 chars
         * @param $replaceValue = Value to replacing the cutted text. Default value is ...
         * @return string cutted text
         */
        public static function cutLongText($string,$limitLength=50,$replaceValue='...'){
            return (strlen($string) > $limitLength) ? substr($string, 0, $limitLength) . $replaceValue : $string;
        }

        /**
         * Time to seconds converter
         *
         * @param $str_time = String value must time only. Example: 00:23:45
         * @return integer seconds
         */
        public static function convertTimeToSeconds($str_time){
            $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
            sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
            $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
            return $time_seconds;
        }

        /**
         * Slug converter
         *
         * @param $text = Text value
         * @return string
         */
        public static function convertToSlug($text){
            // replace non letter or digits by -
            $text = preg_replace('~[^\pL\d]+~u', '-', $text);

            // transliterate
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

            // remove unwanted characters
            $text = preg_replace('~[^-\w]+~', '', $text);

            // trim
            $text = trim($text, '-');

            // remove duplicate -
            $text = preg_replace('~-+~', '-', $text);

            // lowercase
            $text = strtolower($text);

            if (empty($text)) {
                return 'n-a';
            }

            return $text;
        }

        /**
         * Determine Server is use SSL or not. This support for full ssl and flexible ssl
         *
         * @return boolean
         */
        public static function isHttpsButtflare() {
            $whitelist = array(
                '127.0.0.1',
                '::1'
            );
            
            if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
                return isset($_SERVER['HTTPS']) ||
                ($visitor = json_decode($_SERVER['HTTP_CF_VISITOR'])) &&
                $visitor->scheme == 'https';
            } else {
                return 0;
            } 
        }
}
