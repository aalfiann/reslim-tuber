<!-- Bootstrap core JavaScript
================================================== -->
<script src="<?php echo Core::getInstance()->homepath?>/js/jquery.min.js"></script>
<script src="<?php echo Core::getInstance()->homepath?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo Core::getInstance()->homepath?>/js/custom.js"></script>

<!-- Sharethis -->
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=<?php echo Core::getInstance()->sharethis?>&product=inline-share-buttons"></script>

<!-- Get total database video START -->
<script type="text/javascript">
    $(function(){    
        $.ajax({
			type: "GET",
			url: "<?php echo Core::getInstance()->api.'/video/post/data/public/search/asc/1/1/?apikey='.Core::getInstance()->apikey.'&query='?>",
			dataType: 'json',
			success: function( data ) {
				document.getElementById("totalvideo").innerHTML='';
				if(data.status=='success'){
					document.getElementById("totalvideo").innerHTML='Database Video: '+addCommas(data.metadata.records_total);
				} else {
					document.getElementById("totalvideo").innerHTML='';
				}
			},
			error: function( xhr, textStatus, error ) {
				console.log("XHR: " + xhr.statusText);
				console.log("STATUS: "+textStatus);
				console.log("ERROR: "+error);
				console.log("TRACE: "+xhr.responseText);
			}
		}).done(function(res){ 
			
		});
    });
	function addCommas(nStr)
	{
    	nStr += '';
	    x = nStr.split('.');
    	x1 = x[0];
	    x2 = x.length > 1 ? '.' + x[1] : '';
    	var rgx = /(\d+)(\d{3})/;
	    while (rgx.test(x1)) {
    	    x1 = x1.replace(rgx, '$1' + ',' + '$2');
	    }
    	return x1 + x2;
	}
</script>
<!-- Get total database video END -->

<?php 
    if (!empty(Core::getInstance()->googleanalytics)){
		echo '<!-- Google Analytics -->
			<script>
				(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,\'script\',\'https://www.google-analytics.com/analytics.js\',\'ga\');
				ga(\'create\', \''.Core::getInstance()->googleanalytics.'\', \'auto\');
				ga(\'send\', \'pageview\');
			</script>';
	}
?>