<?php 
//Validation url param
$search = filter_var((empty($_GET['search'])?'':$_GET['search']),FILTER_SANITIZE_STRING);
$page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
$itemsperpage = filter_var((empty($_GET['itemsperpage'])?'10':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);
// Data Company
$listcompany = Core::getInstance()->api.'/ads/company/list/'.$datalogin['token'];
$datacompany = json_decode(Core::execGetRequest($listcompany));
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
                                <input name="m" type="text" class="form-control border-input" value="9" hidden>
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
                        if (isset($_POST['submitnewads']))
                        {
                            $post_array = array(
                                'Username' => $datalogin['username'],
                                'Token' => $datalogin['token'],
                                'CompanyID' => filter_var($_POST['companyid'],FILTER_SANITIZE_STRING),
                                'Title' => filter_var($_POST['title'],FILTER_SANITIZE_STRING),
                                'Embed' => $_POST['embed'],
                                'StartDate' => filter_var($_POST['startdate'],FILTER_SANITIZE_STRING),
                                'EndDate' => filter_var($_POST['enddate'],FILTER_SANITIZE_STRING),
                                'Amount' => filter_var($_POST['amount'],FILTER_SANITIZE_STRING)
                            );
                            Core::processCreate(Core::getInstance()->api.'/ads/data/new',$post_array,'New Ads');
                        }
                    ?>
                    <!-- Start Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add new Ads</h4>
                              </div>
                              <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Company</label>
                                            <select name="companyid" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">';
                                                <?php if (!empty($datacompany)) {
                                                            foreach ($datacompany->results as $name => $valuecompany) {
                                                                echo '<option value="'.$valuecompany->{'CompanyID'}.'">'.$valuecompany->{'Name'}.'</option>';
                                                            }
                                                        }
                                                    echo '</select>';?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="title" type="text" placeholder="Input the company name here..." maxlength="250" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Embed</label>
                                            <textarea name="embed" rows="3" type="text" placeholder="Input the address here..." class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input name="startdate" id="firstdate" type="text" placeholder="Input the start date here..." class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input name="enddate" id="lastdate" type="text" placeholder="Input the end date here..." class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input name="amount" type="text" placeholder="Input the amount of ads here..." maxlength="10" class="form-control border-input" required>
                                        </div>
                                    </div>
                                </div>
                                <p class="category"><i class="ti-info-alt"></i> Put prefix [header], [footer] or [sidebar] on title for the position ads.</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submitnewads" class="btn btn-primary">Submit</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <button type="submit" class="btn btn-wd" data-toggle="modal" data-target="#myModal">Add new Ads</button>
                            </div>
                        </div>
                    </div>
<?php 
    if (isset($_POST['submitupdateads'.(empty($_POST['adsid'])?'':$_POST['adsid'])])){
        $post_array = array(
            'Username' => $datalogin['username'],
            'Token' => $datalogin['token'],
            'CompanyID' => filter_var($_POST['companyid'],FILTER_SANITIZE_STRING),
            'Title' => filter_var($_POST['title'],FILTER_SANITIZE_STRING),
            'Embed' => $_POST['embed'],
            'StartDate' => filter_var($_POST['startdate'],FILTER_SANITIZE_STRING),
            'EndDate' => filter_var($_POST['enddate'],FILTER_SANITIZE_STRING),
            'Amount' => filter_var($_POST['amount'],FILTER_SANITIZE_STRING),
            'AdsID' => filter_var($_POST['adsid'],FILTER_SANITIZE_STRING),
            'StatusID' => filter_var($_POST['status'],FILTER_SANITIZE_STRING)
        );
        Core::processUpdate(Core::getInstance()->api.'/ads/data/update',$post_array,'Ads');
    }
    
    if (isset($_POST['submitdeleteads'.(empty($_POST['adsid'])?'':$_POST['adsid'])])){
        $post_array = array(
            'Username' => $datalogin['username'],
            'Token' => $datalogin['token'],
            'AdsID' => $_POST['adsid']
        );
        Core::processDelete(Core::getInstance()->api.'/ads/data/delete',$post_array,'Ads');
    }

    $url = Core::getInstance()->api.'/ads/data/search/'.$datalogin['username'].'/'.$datalogin['token'].'/'.$page.'/'.$itemsperpage.'/?query='.rawurlencode($search);
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
                                <h4 class="title text-uppercase">Data Ads</h4>
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
                                    	<th>Ads ID</th>
                                        <th>Company ID</th>
                                    	<th>Name</th>
                                    	<th>Title</th>
                                        <th>Embed</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Amount</th>
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
                    echo '<td>' . $value->{'AdsID'} .'</td>';
                    echo '<td>' . $value->{'CompanyID'} .'</td>';
			        echo '<td>' . $value->{'Name'} .'</td>';
        			echo '<td>' . $value->{'Title'} .'</td>';
                	echo '<td>' . htmlspecialchars($value->{'Embed'}) .'</td>';
                    echo '<td>' . $value->{'StartDate'} .'</td>';
                    echo '<td>' . $value->{'EndDate'} .'</td>';
                    echo '<td>' . $value->{'Amount'} .'</td>';
                    echo '<td>' . $value->{'Status'} .'</td>';
                	echo '<td>' . $value->{'Created_at'} .'</td>';
            	    echo '<td>' . $value->{'Updated_at'} .'</td>';
                    echo '<td>' . $value->{'Updated_by'} .'</td>';
                    echo '<td><a href="#" data-toggle="modal" data-target="#'.$value->{'AdsID'}.'"><i class="ti-pencil"></i> Edit</a></td>';
	    	    	echo '</tr>';              
                }
                echo '</tbody>
                </table>';

                echo '</div>
                </div>';

                $pagination = new Pagination;
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=9&search='.rawurlencode($search));
                
                echo '</div>';
                foreach ($data->results as $name=>$value){
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="'.$value->{'AdsID'}.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add new Ads</h4>
                              </div>
                              <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=9&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$search.'">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Ads ID</label>
                                            <input name="adsid" type="text" placeholder="Input the ads id here..." class="form-control border-input" value="'.$value->{'AdsID'}.'" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Company ID</label>
                                            <select name="companyid" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">';
                                                if (!empty($datacompany)) {
                                                            foreach ($datacompany->results as $name => $valuecompany) {
                                                                echo '<option value="'.$valuecompany->{'CompanyID'}.'" '.(($valuecompany->{'CompanyID'} == $value->{'CompanyID'})?'selected':'').'>'.$valuecompany->{'Name'}.'</option>';
                                                            }
                                                        }
                                                    echo '</select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="title" type="text" placeholder="Input the title here..." class="form-control border-input" maxlength="250" value="'.$value->{'Title'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Embed</label>
                                            <textarea name="embed" rows="3" type="text" placeholder="Input the embed ads here..." class="form-control border-input" required>'.$value->{'Embed'}.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input name="startdate" id="firstdate" type="text" placeholder="Input the start date here..." class="form-control border-input" value="'.$value->{'StartDate'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input name="enddate" id="lastdate" type="text" placeholder="Input the end date here..." class="form-control border-input" value="'.$value->{'EndDate'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input name="amount" type="text" placeholder="Input the amount of ads here..." class="form-control border-input" maxlength="10" value="'.$value->{'Amount'}.'" required>
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
                                    <input name="adsid" type="text" class="form-control border-input" value="'.$value->{'AdsID'}.'" hidden>
                                </div>
                                <p class="category"><i class="ti-info-alt"></i> Put prefix [header], [footer] or [sidebar] on title for the position ads.</p>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="submitdeleteads'.$value->{'AdsID'}.'" class="btn btn-danger pull-left">Delete</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submitupdateads'.$value->{'AdsID'}.'" class="btn btn-primary">Update</button>
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

                