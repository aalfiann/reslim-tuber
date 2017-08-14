            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-3 col-md-offset-1 col-sm-offset-2">
                        <?php
                            if (isset($_POST['submitsettings']))
                            {
                                $post_array = array(
                                    'Title' => $_POST['title'],
                                    'Keyword' => $_POST['keyword'],
                                    'Description' => $_POST['description'],
                                    'Email' => $_POST['email'],
                                    'Basepath' => $_POST['basepath'],
                                    'Homepath' => $_POST['homepath'],
                                    'Api' => $_POST['api'],
                                    'ApiKey' => $_POST['apikey'],
                                    'Disqus' => $_POST['disqus'],
                                    'Sharethis' => $_POST['sharethis'],
                                    'Facebook' => $_POST['facebook'],
                                    'Twitter' => $_POST['twitter'],
                                    'Gplus' => $_POST['gplus'],
                                    'Googleanalytics' => $_POST['googleanalytics'],
                                    'Googlewebmaster' => $_POST['googlewebmaster'],
                                    'Bingwebmaster' => $_POST['bingwebmaster'],
                                    'Yandexwebmaster' => $_POST['yandexwebmaster']
                                );
                                Core::saveSettings($post_array);
                            } 
                        ?>
                            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                                <div class="card" data-background="color" data-color="blue">
                                    <div class="header">
                                        <h3 class="title"><?php echo Core::getInstance()->title?> Settings</h3>
                                        <hr>
                                    </div>
                                    <div class="content">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="title" type="text" placeholder="Please input the title of website" class="form-control border-input" maxlength="20" value="<?php echo Core::getInstance()->title?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Keyword</label>
                                            <input name="keyword" type="text" placeholder="Please input the keyword of website separated with commas" class="form-control border-input" maxlength="250" value="<?php echo Core::getInstance()->keyword?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" type="text" placeholder="Please input the description of website" class="form-control border-input" maxlength="200" required><?php echo Core::getInstance()->description?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" type="text" placeholder="Please input Your Email" class="form-control border-input" maxlength="50" value="<?php echo Core::getInstance()->email?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Frontend Path</label>
                                            <input name="homepath" type="text" placeholder="Please input url frontend folder of Your website." class="form-control border-input" value="<?php echo Core::getInstance()->homepath?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Backend Path</label>
                                            <input name="basepath" type="text" placeholder="Please input url backend folder of Your website." class="form-control border-input" value="<?php echo Core::getInstance()->basepath?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Url API</label>
                                            <input name="api" type="text" placeholder="Please input url folder of Your Rest API." class="form-control border-input" value="<?php echo Core::getInstance()->api?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>API Key</label>
                                            <input name="apikey" type="text" placeholder="Please input Your API Key here..." class="form-control border-input" value="<?php echo Core::getInstance()->apikey?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Disqus Username</label>
                                            <input name="disqus" type="text" placeholder="Please input Your Disqus username here..." class="form-control border-input" value="<?php echo Core::getInstance()->disqus?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Sharethis Key</label>
                                            <input name="sharethis" type="text" placeholder="Please input Your Sharethis Key here..." class="form-control border-input" value="<?php echo Core::getInstance()->sharethis?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input name="facebook" type="text" placeholder="Please input Your Facebook page here..." class="form-control border-input" value="<?php echo Core::getInstance()->facebook?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Twitter</label>
                                            <input name="twitter" type="text" placeholder="Please input Your Twitter page here..." class="form-control border-input" value="<?php echo Core::getInstance()->twitter?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Google Plus</label>
                                            <input name="gplus" type="text" placeholder="Please input Your Google Plus page here..." class="form-control border-input" value="<?php echo Core::getInstance()->gplus?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Google Analytics</label>
                                            <input name="googleanalytics" type="text" placeholder="Please input Your ID Google Analytics here..." class="form-control border-input" value="<?php echo Core::getInstance()->googleanalytics?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Google Webmaster</label>
                                            <input name="googlewebmaster" type="text" placeholder="Please input Your ID Google Webmaster here..." class="form-control border-input" value="<?php echo Core::getInstance()->googlewebmaster?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Bing Webmaster</label>
                                            <input name="bingwebmaster" type="text" placeholder="Please input Your ID Bing Webmaster here..." class="form-control border-input" value="<?php echo Core::getInstance()->bingwebmaster?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Yandex Webmaster</label>
                                            <input name="yandexwebmaster" type="text" placeholder="Please input Your ID Yandex Webmaster here..." class="form-control border-input" value="<?php echo Core::getInstance()->yandexwebmaster?>">
                                        </div>
                                        <p class="category"><i class="ti-info-alt"></i> Doesn't have any API Keys? You can create at least one API Key at <a href="modul-data-api.php?m=7&page=1&itemsperpage=10&search=">here</a>.</p>
                                        <p class="category"><i class="ti-info-alt"></i> Doesn't have any Disqus? You can create at <a href="http://disqus.com">here</a>.</p>
                                        <p class="category"><i class="ti-info-alt"></i> Doesn't have any Sharethis Keys? You can create at <a href="http://sharethis.com">here</a>.</p>
                                        <hr>
                                        <div class="form-group text-center">
                                            <button name="submitsettings" type="submit" class="btn btn-fill btn-wd ">Save Settings</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>