<?php
	if (!empty(Core::getInstance()->api)){
		$urlarray = explode("/",Core::getInstance()->api);
		array_pop($urlarray);
		$urlhost = implode('/', $urlarray);
		$imdbapi = $urlhost.'/plugins/imdb';
	} 
?>
<!-- Defer Javascript -->
<script>
(function() {
	function getScript(url,success){
		var script=document.createElement('script');
		script.src=url;
		var head=document.getElementsByTagName('head')[0],
		done=false;
		script.onload=script.onreadystatechange = function(){
			if ( !done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete') ) {
				done=true;
				success();
				script.onload = script.onreadystatechange = null;
				head.removeChild(script);
			}
		};
		head.appendChild(script);
	  }

	// Load LazySizes
	getScript('assets/js/lazysizes.min.js',function(){});

	// Load jQuery
	getScript('assets/js/jquery-1.10.2.min.js',function(){
		// Load Bootstrap
		getScript('assets/js/bootstrap.min.js',function(){
			// Load Checkbox, Radio & Switch Plugins
			getScript('assets/js/bootstrap-checkbox-radio.min.js',function(){});
			// Load Paper Dashboard Core javascript and methods for Demo purpose
			getScript('assets/js/paper-dashboard.min.js',function(){});
			// Load Export
			getScript('assets/js/package.export.js',function(){});
			// Load jQuery UI
			getScript('assets/js/jquery-ui-1.10.2.min.js',function(){
				$("head").append("<link rel='stylesheet' type='text/css' href='assets/css/jquery-ui-theme-1.10.1.min.css' /><style>.ui-autocomplete{max-height:200px;overflow-y:auto;overflow-x:hidden}* html .ui-autocomplete{height:200px} .ui-autocomplete-loading { background:url('assets/img/ajax-loader.gif') no-repeat right center }</style><style>.lazyload {opacity: 0;} .lazyloading {opacity: 1;transition: opacity 300ms;background: #f7f7f7 url(assets/img/blank.gif) no-repeat center;} .sidebar .nav > li.active-bottom{position:fixed;width:100%;bottom:10px;} .sidebar .nav > li.active-bottom a{background:rgba(255,255,255,0.14);opacity:1;color:#FFFFFF;}</style><style>.modal{overflow:auto;min-height:100%;position:absolute;background-color:#000000;opacity:0.95 !important;} body.modal-open .main-panel{overflow:hidden !important;}</style>");
				$("#firstdate").datepicker({
					dateFormat:"yy-mm-dd"
				}),
				$("#lastdate").datepicker({
					dateFormat:"yy-mm-dd"
				}),
				$("#year").datepicker({
					changeYear: true,
					dateFormat:"yy"
				});
			});
			$('#formUpload').submit(function() {
				$.ajax({
					url : $(this).attr("action"),
					type: "POST",
					data : new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					xhr: function(){
						//upload Progress
						var xhr = $.ajaxSettings.xhr();
						if (xhr.upload) {
							xhr.upload.addEventListener('progress', function(event) {
								var percent = 0;
								var position = event.loaded || event.position;
								var total = event.total;
								if (event.lengthComputable) {
									percent = Math.ceil(position / total * 100);
								}
								/*update progressbar for jQuery UI
								$('#statusprogress').text(percent +"%");
								$( '#progressbar' ).progressbar({
									value: percent
								});*/
								//update progressbar for Twitter Bootstrap
								$('#statusprogress').text(percent +"%");
								$('#progressbar').css('width', percent+'%').attr('aria-valuenow', percent); 
							}, true);
						}
						return xhr;
					},
					mimeType:"multipart/form-data"
				}).done(function(res){ //
					//$(my_form_id)[0].reset(); //reset form
					//$(result_output).html(res); //output response from server
					//submit_btn.val("Upload").prop( "disabled", false); //enable submit button once ajax is done
				});
			}),
			$('#post-input').on('change', function() {
				$.ajax({
					url: "<?php echo (!empty(Core::getInstance()->api)?Core::getInstance()->api:'')?>/video/post/data/public/search/title/?apikey=<?php echo Core::getInstance()->apikey?>&query="+encodeURIComponent($('#post-input').val()),
					data: {'title' : encodeURIComponent($('#post-input').val())},
					dataType: 'json',
					success: function(data) {
						if(data.result) {
							var div = document.getElementById('title-info');
							div.innerHTML = '<p class="text-danger">Title already exist: '+data.result[0]["Title"]+'</p>';
							$('#myModal')
							.find("button[type=submit]")
							.attr("disabled", "disabled")
							.end();
						}
						else {
							var div = document.getElementById('title-info');
							div.innerHTML = '';
							$('#myModal')
							.find("button[type=submit]")
							.removeAttr("disabled")
							.end();
						}
					},
					error: function(data){
						//error
					}
				});
			}),
			$('#clearmodalform').on('click', function (e) {
				  $('#myModal')
				.find("input,textarea,select")
				.val('')
				.end()
				.find("input[type=checkbox], input[type=radio]")
				.prop("checked", "")
				.end();
			}),
			$("#getimdb").on("click",function(){
				$.ajax({
					type: "GET",
					url: "<?php echo (!empty($imdbapi)?$imdbapi:'')?>/api.php?title="+encodeURIComponent($('#post-input').val()),
					dataType: 'json',
					success: function( data ) {
						document.getElementById("image-imdb").value='';
						document.getElementById("description-imdb").value='';
						document.getElementById("duration-imdb").value='';
						document.getElementById("stars-imdb").value='';
						document.getElementById("director-imdb").value='';
						document.getElementById("tags-imdb").value='';
						document.getElementById("released-imdb").value='';
						document.getElementById("rating-imdb").value='';
						document.getElementById("country-imdb").value='';
						if(data.status=='success'){
							document.getElementById("image-imdb").value=data.result.poster_thumbnails;
							if (data.result.description =='N/A'){
								document.getElementById("description-imdb").value="<?php echo Core::lang('input_no_description')?>";
							} else {
								document.getElementById("description-imdb").value=data.result.description;
							}
							document.getElementById("duration-imdb").value=data.result.runtime_formatted;
							document.getElementById("stars-imdb").value=data.result.castNameStringCommas;
							document.getElementById("director-imdb").value=data.result.castDirectorStringCommas;
							document.getElementById("tags-imdb").value=data.result.genreStringCommas;
							document.getElementById("released-imdb").value=data.result.year;
							document.getElementById("rating-imdb").value=data.result.rating;
							document.getElementById("country-imdb").value=data.result.countryStringCommas;
						} else {
							document.getElementById("image-imdb").value='';
							document.getElementById("description-imdb").value='';
							document.getElementById("duration-imdb").value='';
							document.getElementById("stars-imdb").value='';
							document.getElementById("director-imdb").value='';
							document.getElementById("tags-imdb").value='';
							document.getElementById("released-imdb").value='';
							document.getElementById("rating-imdb").value='';
							document.getElementById("country-imdb").value='';
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
			}),
			$("#embed-drive").on("change",function(){
		        $.ajax({
        	        type: "GET",
					url: "<?php echo (!empty(Core::getInstance()->apidrive)?Core::getInstance()->apidrive:'')?>/api.php?url="+encodeURIComponent($('#embed-drive').val()),
					dataType: 'json',
					success: function( data ) {
						var div = document.getElementById('test-drive');
                		if(data.status=='success'){
							document.getElementById("embed-drive").value='';
							document.getElementById("duration-imdb").value='';
							document.getElementById("embed-drive").value=data.result.embed;
							document.getElementById("duration-imdb").value=data.source.duration;						
							div.innerHTML = '<p class="text-success text-center"><a href="'+data.result.link+'" target="_blank">Play video '+data.source.title+'?</a></p>';
						} else if (data.status=='warning'){
							document.getElementById("embed-drive").value='';
							document.getElementById("duration-imdb").value='';
							document.getElementById("embed-drive").value=data.source.embed;
							document.getElementById("duration-imdb").value=data.source.duration;
							div.innerHTML = '<p class="text-warning text-center"><a href="'+data.source.url+'" target="_blank">Play from Google Drive?</a></p>';
						} else {
							//nothing to do
							div.innerHTML = '';
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
		});
	});	
})();
</script>