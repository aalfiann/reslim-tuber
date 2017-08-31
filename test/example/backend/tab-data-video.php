<?php 
//Validation url param
$search = filter_var((empty($_GET['search'])?'':$_GET['search']),FILTER_SANITIZE_STRING);
$page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
$itemsperpage = filter_var((empty($_GET['itemsperpage'])?'10':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);
?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form method="get" action="<?php $_SERVER['PHP_SELF'].'?search='.filter_var($search,FILTER_SANITIZE_STRING)?>">
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                            <div class="form-group">
                                <input name="search" type="text" placeholder="Search here..." class="form-control border-input" value="<?php echo $search?>">
                            </div>
                            <div class="form-group hidden">
                                <input name="m" type="text" class="form-control border-input" value="10" hidden>
                                <input name="page" type="text" class="form-control border-input" value="1" hidden>
                                <input name="itemsperpage" type="text" class="form-control border-input" value="10" hidden>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-1 col-xs-2">
                            <div class="form-group">
                                <button name="submitsearch" type="submit" class="btn btn-fill btn-wd ">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><hr>
            <div class="container-fluid">
                <div class="row">
                    <?php 
                        if (isset($_POST['submitnewvideo']))
                        {
                            $post_array = array(
                                'Username' => $datalogin['username'],
                                'Token' => $datalogin['token'],
                                'Image' => filter_var($_POST['image'],FILTER_SANITIZE_STRING),
                                'Title' => filter_var($_POST['title'],FILTER_SANITIZE_STRING),
                                'Description' => filter_var($_POST['description'],FILTER_SANITIZE_STRING),
                                'Embed' => $_POST['embed'],
                                'Duration' => filter_var($_POST['duration'],FILTER_SANITIZE_STRING),
                                'Stars' => filter_var($_POST['stars'],FILTER_SANITIZE_STRING),
                                'Cast' => filter_var($_POST['cast'],FILTER_SANITIZE_STRING),
                                'Director' => filter_var($_POST['director'],FILTER_SANITIZE_STRING),
                                'Tags' => filter_var($_POST['tags'],FILTER_SANITIZE_STRING),
                                'Country' => filter_var($_POST['country'],FILTER_SANITIZE_STRING),
                                'Released' => filter_var($_POST['released'],FILTER_SANITIZE_STRING),
                                'Rating' => filter_var($_POST['rating'],FILTER_SANITIZE_STRING)
                            );
                            Core::processCreate(Core::getInstance()->api.'/video/post/new',$post_array,'Video');
                        }
                    ?>
                    <!-- Start Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add new Video</h4>
                              </div>
                              <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input id="image-imdb" name="image" type="text" placeholder="Input the url image here..." class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input id="post-input" name="title" type="text" placeholder="Input the title video here..." maxlength="200" class="form-control border-input" required>
                                            <div id="title-info"></div>
                                        </div>
                                    </div>
                                    <?php if (!empty(Core::getInstance()->imdbapi)) {
                                        echo '<div class="col-lg-12">
                                            <div class="form-group">
                                                <button id="getimdb" type="button" class="btn btn-info btn-block">Get IMDB</button>
                                            </div>
                                        </div>';
                                    }?>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea id="description-imdb" name="description" rows="3" type="text" placeholder="Input the description video here..." maxlength="1000" class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Embed</label>
                                            <textarea name="embed" rows="5" type="text" placeholder="Input the embed / iframe video separated with comma here..." class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Duration</label>
                                            <input id="duration-imdb" name="duration" type="text" placeholder="Format HH:mm:ss" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Stars</label>
                                            <input id="stars-imdb" name="stars" type="text" placeholder="Input the stars name separated with comma here..." maxlength="500" class="form-control border-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Cast</label>
                                            <input name="cast" type="text" placeholder="Input the cast name separated with comma here..." maxlength="500" class="form-control border-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Director</label>
                                            <input id="director-imdb" name="director" type="text" placeholder="Input the director name separated with comma here..." maxlength="250" class="form-control border-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Tags</label>
                                            <input id="tags-imdb" name="tags" type="text" placeholder="Input the tags separated with comma here..." maxlength="500" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input name="country" type="text" placeholder="Input the country name separated with comma here..." maxlength="100" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Release</label>
                                            <input id="released-imdb" name="released" id="year" type="text" placeholder="Input the year of released video here..." maxlength="100" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Rating</label>
                                            <input id="rating-imdb" name="rating" type="text" placeholder="Input the rating video here..." maxlength="3" class="form-control border-input" required>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button id="clearmodalform" type="button" class="btn btn-danger pull-left">Clear Form</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submitnewvideo" class="btn btn-primary">Submit</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <button type="submit" class="btn btn-wd" data-toggle="modal" data-target="#myModal">Add new Video</button>
                            </div>
                        </div>
                    </div>
<?php 
    if (isset($_POST['submitupdatevideo'.(empty($_POST['postid'])?'':$_POST['postid'])])){
        $post_array = array(
            'Username' => $datalogin['username'],
            'Token' => $datalogin['token'],
            'Image' => filter_var($_POST['image'],FILTER_SANITIZE_STRING),
            'Title' => filter_var($_POST['title'],FILTER_SANITIZE_STRING),
            'Description' => filter_var($_POST['description'],FILTER_SANITIZE_STRING),
            'Embed' => $_POST['embed'],
            'Duration' => filter_var($_POST['duration'],FILTER_SANITIZE_STRING),
            'Stars' => filter_var($_POST['stars'],FILTER_SANITIZE_STRING),
            'Cast' => filter_var($_POST['cast'],FILTER_SANITIZE_STRING),
            'Director' => filter_var($_POST['director'],FILTER_SANITIZE_STRING),
            'Tags' => filter_var($_POST['tags'],FILTER_SANITIZE_STRING),
            'Country' => filter_var($_POST['country'],FILTER_SANITIZE_STRING),
            'Released' => filter_var($_POST['released'],FILTER_SANITIZE_STRING),
            'Rating' => filter_var($_POST['rating'],FILTER_SANITIZE_STRING),
            'StatusID' => filter_var($_POST['status'],FILTER_SANITIZE_STRING),
            'PostID' => filter_var($_POST['postid'],FILTER_SANITIZE_STRING)
        );
        Core::processUpdate(Core::getInstance()->api.'/video/post/update',$post_array,'Video');
    }
                    
    if (isset($_POST['submitdeletevideo'.(empty($_POST['postid'])?'':$_POST['postid'])])){
        $post_array = array(
            'Username' => $datalogin['username'],
            'Token' => $datalogin['token'],
            'PostID' => $_POST['postid']
        );
        Core::processDelete(Core::getInstance()->api.'/video/post/delete',$post_array,'Video');
    }

    $url = Core::getInstance()->api.'/video/post/data/search/'.$datalogin['username'].'/'.$datalogin['token'].'/'.$page.'/'.$itemsperpage.'/?query='.rawurlencode($search);
    $data = json_decode(Core::execGetRequest($url));

    // Data Status
    $urlstatus = Core::getInstance()->api.'/ads/status/release/'.$datalogin['token'];
    $datastatus = json_decode(Core::execGetRequest($urlstatus));

    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {
                echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title text-uppercase">Data Video</h4>
                                <p class="category">Message: '.$data->{'message'}.'<br>
                                Shows no: '.$data->metadata->{'number_item_first'}.' - '.$data->metadata->{'number_item_last'}.' from total data: '.$data->metadata->{'records_total'}.'</p>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		    				    			<p><i class="ti-zip"></i> Export Data <b class="caret"></b></p>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'excel\',escape:\'false\'});">Export XLS</a></li>
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'doc\',escape:\'false\'});">Export DOC</a></li>
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'txt\',escape:\'false\'});">Export TXT</a></li>
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'csv\',escape:\'false\'});">Export CSV</a></li>
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'pdf\',pdfFontSize:\'7\',escape:\'false\'});">Export PDF</a></li>
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'sql\'});">Export SQL</a></li>
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'xml\',escape:\'false\'});">Export XML</a></li>
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'json\',escape:\'false\'});">Export JSON</a></li>
                                        </ul>
                                    </div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="export" class="table table-striped">
                                    <thead>
                                        <th>No</th>
                                    	<th>Image</th>
                                    	<th>Title</th>
                                        <th>Duration</th>
                                        <th>Release</th>
                                        <th>Rating</th>
                                        <th>Viewer</th>
                                        <th>Tags</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Updated at</th>
                                        <th>Updated by</th>
                                        <th>Manage</th>
                                    </thead>
                                    <tbody>';
                $n=$data->metadata->{'number_item_first'};
                foreach ($data->results as $name => $value) 
	            {
                    echo '<tr>';
                    echo '<td>' . $n++ .'</td>';
                    echo '<td><img class="img-responsive" src="' . $value->{'Image'} .'"></td>';
			        echo '<td>' . $value->{'Title'} .'</td>';
        			echo '<td>' . $value->{'Duration'} .'</td>';
                	echo '<td>' . $value->{'Released'} .'</td>';
                    echo '<td>' . $value->{'Rating'} .'</td>';
                    echo '<td>' . $value->{'Viewer'} .'</td>';
                    echo '<td>' . $value->{'Tags_inline'} .'</td>';
                    echo '<td>' . $value->{'Status'} .'</td>';
                	echo '<td>' . $value->{'Created_at'} .'</td>';
            	    echo '<td>' . $value->{'Updated_at'} .'</td>';
                    echo '<td>' . $value->{'Updated_by'} .'</td>';
                    echo '<td><a href="#" data-toggle="modal" data-target="#'.$value->{'PostID'}.'"><i class="ti-pencil"></i> Edit</a></td>';
	    	    	echo '</tr>';              
                }
                echo '</tbody>
                </table>';

                echo '</div>
                </div>';

                $pagination = new Pagination;
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=10&search='.rawurlencode($search));
                
                echo '</div>';
                foreach ($data->results as $name=>$value){
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="'.$value->{'PostID'}.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Update Video</h4>
                              </div>
                              <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=10&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$search.'">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Post ID</label>
                                            <input name="postid" type="text" placeholder="Input the post id here..." class="form-control border-input" value="'.$value->{'PostID'}.'" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input name="image" type="text" placeholder="Input the url image here..." class="form-control border-input" value="'.$value->{'Image'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="title" type="text" placeholder="Input the title video here..." maxlength="200" class="form-control border-input" value="'.$value->{'Title'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" rows="3" type="text" placeholder="Input the description video here..." maxlength="1000" class="form-control border-input" required>'.$value->{'Description'}.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Embed</label>
                                            <textarea name="embed" rows="5" type="text" placeholder="Input the embed / iframe video separated with comma here..." class="form-control border-input" required>'.$value->{'Embed_inline'}.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Duration</label>
                                            <input name="duration" type="text" placeholder="Format HH:mm:ss" class="form-control border-input" value="'.$value->{'Duration'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Stars</label>
                                            <input name="stars" type="text" placeholder="Input the stars name separated with comma here..." maxlength="500" class="form-control border-input" value="'.$value->{'Stars_inline'}.'">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Cast</label>
                                            <input name="cast" type="text" placeholder="Input the cast name separated with comma here..." maxlength="500" class="form-control border-input" value="'.$value->{'Cast_inline'}.'">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Director</label>
                                            <input name="director" type="text" placeholder="Input the director name separated with comma here..." maxlength="250" class="form-control border-input" value="'.$value->{'Director_inline'}.'">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Tags</label>
                                            <input name="tags" type="text" placeholder="Input the tags separated with comma here..." maxlength="500" class="form-control border-input" value="'.$value->{'Tags_inline'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input name="country" type="text" placeholder="Input the country name separated with comma here..." maxlength="100" class="form-control border-input" value="'.$value->{'Country_inline'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Release</label>
                                            <input name="released" id="year" type="text" placeholder="Input the year of released video here..." maxlength="100" class="form-control border-input" value="'.$value->{'Released'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Rating</label>
                                            <input name="rating" type="text" placeholder="Input the rating video here..." maxlength="3" class="form-control border-input" value="'.$value->{'Rating'}.'">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">';
                                                if (!empty($datastatus)) {
                                                            foreach ($datastatus->results as $name => $valuestatus) {
                                                                echo '<option value="'.$valuestatus->{'StatusID'}.'" '.(($valuestatus->{'StatusID'} == $value->{'StatusID'})?'selected':'').'>'.$valuestatus->{'Status'}.'</option>';
                                                            }
                                                        }
                                                    echo '</select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group hidden">
                                    <input name="PostID" type="text" class="form-control border-input" value="'.$value->{'PostID'}.'" hidden>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="submitdeletevideo'.$value->{'PostID'}.'" class="btn btn-danger pull-left">Delete</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submitupdatevideo'.$value->{'PostID'}.'" class="btn btn-primary">Update</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->';
                }
            }
            else
            {
                echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title">Message: '.$data->{'message'}.'</h4>
                            </div>
                        </div>
                    </div>';
            } 
        }
?>
                            </div>
                        </div>
                    </div>

                