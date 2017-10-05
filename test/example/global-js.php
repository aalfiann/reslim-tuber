<?php include_once 'global-filter.php';?>
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

<!-- Load Options START-->
<script type="text/javascript">
	$(function(){
		var get_genre1,get_genre2,get_country,get_year;
		get_genre1 = <?php echo (!empty($_GET['genre1'])?'"'.$_GET['genre1'].'"':'null'); ?>;
		get_genre2 = <?php echo (!empty($_GET['genre2'])?'"'.$_GET['genre2'].'"':'null'); ?>;
		get_country = <?php echo (!empty($_GET['country'])?'"'.$_GET['country'].'"':'null'); ?>;
		get_year = <?php echo (!empty($_GET['year'])?'"'.$_GET['year'].'"':'null'); ?>;
		$('#optionTags1').empty().append('<option value="">--<?php echo Core::lang('select')?>--</option>');
		$('#optionTags2').empty().append('<option value="">--<?php echo Core::lang('select')?>--</option>');
		$('#optionCountry').empty().append('<option value="">--<?php echo Core::lang('select')?>--</option>');        
		$('#optionYear').empty().append('<option value="">--<?php echo Core::lang('select')?>--</option>');
		$.ajax({
        	url: "<?php echo Core::getInstance()->api.'/video/post/data/public/tags/all/?apikey='.Core::getInstance()->apikey?>",
	    	dataType: 'json',
		    type: 'GET',
    	    success: function(data) {
	            if (data.status == 'success'){
        			for (i in data.result.Tags) {                        
						$("#optionTags1").append("<option value=\""+data.result.Tags[i]+"\" "+((get_genre1 == data.result.Tags[i]) ? 'selected' : '')+">"+data.result.Tags[i]+"</option>");
						$("#optionTags2").append("<option value=\""+data.result.Tags[i]+"\" "+((get_genre2 == data.result.Tags[i]) ? 'selected' : '')+">"+data.result.Tags[i]+"</option>");
					}
				}
	    	},
            error: function(x, e) {
    		}
	    }),
		$.ajax({
        	url: "<?php echo Core::getInstance()->api.'/video/post/data/public/countries/all/?apikey='.Core::getInstance()->apikey?>",
	    	dataType: 'json',
		    type: 'GET',
    	    success: function(data) {
	            if (data.status == 'success'){
        			for (i in data.result.Country) {                        
						$("#optionCountry").append("<option value=\""+data.result.Country[i]+"\" "+((get_country == data.result.Country[i]) ? 'selected' : '')+">"+data.result.Country[i]+"</option>");
					}
				}
	    	},
            error: function(x, e) {
    		}
	    }),
		$.ajax({
        	url: "<?php echo Core::getInstance()->api.'/video/post/data/public/release/all/?apikey='.Core::getInstance()->apikey?>",
	    	dataType: 'json',
		    type: 'GET',
    	    success: function(data) {
	            if (data.status == 'success'){
        			for (i in data.result.Released.reverse()) {                        
						$("#optionYear").append("<option value=\""+data.result.Released[i]+"\" "+((get_year == data.result.Released[i]) ? 'selected' : '')+">"+data.result.Released[i]+"</option>");
					}
				}
	    	},
            error: function(x, e) {
    		}
	    });
	});
</script>
<!-- Load Options END-->

<!-- Send Report START-->
<script type="text/javascript">
	$(function(){
		$('#sendreport').on("submit",sendingreport);
	});
	function sendingreport(e){
		console.log('Process sending report...');
		e.preventDefault();
		var that = $(this);
		that.off('submit'); // remove handler
		var div = document.getElementById('report-send');
		var aaa = parseInt($('#key-aaa').val());
		var bbb = parseInt($('#key-bbb').val());
		var key = parseInt($('#post-key').val());
		if ((bbb + aaa) == key){
			$.ajax({
    	   		url: "<?php echo Core::getInstance()->api.'/issues/new/?apikey='.Core::getInstance()->apikey?>",
		   		data : {
					Fullname: $('#post-fullname').val(),
					Email: $('#post-email').val(),
					Issue: $('#post-issue').val(),
					PostID: $('#post-id').val()
				},
				dataType: 'json',
		    	type: 'POST',
	    	    success: function(data) {
					div.innerHTML = '';
		           	if (data.status == 'success'){
						div.innerHTML = '<div class="col-lg-12 forgottext"><div class="alert alert-success alert-dismissible" role="alert"><strong><?php echo Core::lang('issue_send_success_1')?></strong> <?php echo Core::lang('issue_send_success_2')?></div></div>';
						//clear from
						$('#report')
		   				.find("input,textarea,select")
				    	.val('')
        				.end()
				    	.find("input[type=checkbox], input[type=radio]")
	    				.prop("checked", "")
			    		.end()
						.find("button[type=submit]")
	    				.attr("disabled", "disabled")
			    		.end();
						console.log('Process sending report success! Thank you...');
					} else {
						div.innerHTML = '<div class="col-lg-12 forgottext"><div class="alert alert-danger alert-dismissible" role="alert"><strong><?php echo Core::lang('issue_send_failed_1')?></strong> <?php echo Core::lang('issue_send_failed_2')?></div></div>';
					}
		   		},
	       	    error: function(x, e) {
    			}
		    });
		} else {
			div.innerHTML = '<div class="col-lg-12 forgottext"><div class="alert alert-danger alert-dismissible" role="alert"><strong><?php echo Core::lang('contact_wrong_security_key')?></strong> </div></div>';
			that.on('submit', sendingreport); // add handler back after ajax
		}
	}
</script>
<!-- Send Report END-->