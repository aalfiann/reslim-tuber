<?php if (!empty(Core::getInstance()->seopage)){
    //Data Dynamic Link
    $datalinks = null;
    $names = Core::getInstance()->seopage;	
    $named = preg_split( "/[,]/", $names );
    foreach($named as $name){
        if ($name != null){$datalinks .= '<li><a href="'.Core::getInstance()->homepath.'/'.Core::convertToSlug(trim($name)).'" title="'.ucwords(str_replace("-"," ",trim($name))).'">'.ucwords(str_replace("-"," ",trim($name))).'</a></li>';}
    }
    echo '<!-- Footer link menu-->
        <div class="content-block head-div">
            <div class="cb-header">
                <div class="row">
                    <div class="col-lg-12">
                        <p>Detected incoming link to this page:</p>
                        <ul class="list-inline" style="height: 30px; overflow-y: scroll;">
                            '.(!empty($datalinks)?$datalinks:'').'
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <!-- Footer link menu-->';
}?>