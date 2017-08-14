<!-- Bootstrap core JavaScript
================================================== -->
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>

<!-- Sharethis -->
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=<?php echo Core::getInstance()->sharethis?>&product=inline-share-buttons"></script>

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