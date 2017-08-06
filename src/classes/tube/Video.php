<?php
/**
 * This class is a part of video tube project
 * @author M ABD AZIZ ALFIAN <github.com/aalfiann>
 *
 * Don't remove this class unless You know what to do
 *
 */
namespace classes\tube;
use \classes\Auth as Auth;
use \classes\tube\Video as Video;
use \classes\Validation as Validation;
use \classes\CustomHandlers as CustomHandlers;
use PDO;
	/**
     * A class for video management
     *
     * @package    Video tube
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2017 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/reSlim/blob/master/license.md  MIT License
     */
     class Video {
        protected $db;

        //master var
        var $username,$token,$postid,$companyid,$adsid,$website,$statusid,$apikey,$adminname,
		//post
        $image,$title,$description,$embed,$duration,$stars,$cast,$director,$country,$released,$rating,$liked,$disliked,$viewer,
        $tags,$search,$firstdate,$lastdate;

		// for pagination
		var $page,$itemsPerPage;

        function __construct($db=null) {
			if (!empty($db)) {
    	        $this->db = $db;
        	}
		}

        //POST=====================================

		/** 
		 * Add new post
		 * @return result process in json encoded data
		 */
        public function addPost(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
			
    		    try {
    				$this->db->beginTransaction();
	    			$sql = "INSERT INTO data_post (Image,Title,Description,Embed_video,Duration,Stars,Cast,Director,Tags,Country,Released,Rating,Liked,Disliked,StatusID,Viewer,Created_at,Username) 
		    			VALUES (:image,:title,:description,:embed,:duration,:stars,:cast,:director,:tags,:country,:release,:rating,'0','0','51','0',current_timestamp,:username);";
					$stmt = $this->db->prepare($sql);
					$stmt->bindParam(':image', $this->image, PDO::PARAM_STR);
                    $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
                    $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
                    $stmt->bindParam(':embed', $this->embed, PDO::PARAM_STR);
                    $stmt->bindParam(':duration', $this->duration, PDO::PARAM_STR);
                    $stmt->bindParam(':stars', $this->stars, PDO::PARAM_STR);
                    $stmt->bindParam(':cast', $this->cast, PDO::PARAM_STR);
                    $stmt->bindParam(':director', $this->director, PDO::PARAM_STR);
                    $stmt->bindParam(':tags', $this->tags, PDO::PARAM_STR);
                    $stmt->bindParam(':country', $this->country, PDO::PARAM_STR);
                    $stmt->bindParam(':release', $this->released, PDO::PARAM_STR);
                    $stmt->bindParam(':rating', $this->rating, PDO::PARAM_STR);
                    $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
					if ($stmt->execute()) {
						$data = [
							'status' => 'success',
							'code' => 'RS101',
							'message' => CustomHandlers::getreSlimMessage('RS101')
						];	
					} else {
    					$data = [
					    	'status' => 'error',
				    		'code' => 'RS201',
			    			'message' => CustomHandlers::getreSlimMessage('RS201')
		    			];
	    			}
	    			$this->db->commit();
    			} catch (PDOException $e) {
			        $data = [
    	    			'status' => 'error',
	    				'code' => $e->getCode(),
    	    			'message' => $e->getMessage()
    			    ];
	    		    $this->db->rollBack();
    		    }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;

        }

		/** 
		 * Update data post
		 * @return result process in json encoded data
		 */
        public function updatePost(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                    $newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
                    $newpostid = Validation::integerOnly($this->postid);
                    $newstatusid = Validation::integerOnly($this->statusid);
                    
        			try {
	        			$this->db->beginTransaction();
                        if (Auth::getRoleID($this->db,$this->token) == '3'){
                            $sql = "UPDATE data_post 
                                SET Image=:image,Title=:title,Description=:description,Embed_video=:embed,Duration=:duration,
                                    Stars=:stars,Cast=:cast,Director=:director,Tags=:tags,Country=:country,Released=:released,
                                    Rating=:rating,Updated_by=:username,StatusID=:status
			        		    WHERE PostID=:postid and Username=:username;";
                        } else{
                            $sql = "UPDATE data_post
                                SET Image=:image,Title=:title,Description=:description,Embed_video=:embed,Duration=:duration,
                                    Stars=:stars,Cast=:cast,Director=:director,Tags=:tags,Country=:country,Released=:released,
                                    Rating=:rating,Updated_by=:username,StatusID=:status
			        		    WHERE PostID=:postid;";
                        }

				    $stmt = $this->db->prepare($sql);
					$stmt->bindParam(':image', $this->image, PDO::PARAM_STR);
                    $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
                    $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
                    $stmt->bindParam(':embed', $this->embed, PDO::PARAM_STR);
                    $stmt->bindParam(':duration', $this->duration, PDO::PARAM_STR);
                    $stmt->bindParam(':stars', $this->stars, PDO::PARAM_STR);
                    $stmt->bindParam(':cast', $this->cast, PDO::PARAM_STR);
                    $stmt->bindParam(':director', $this->director, PDO::PARAM_STR);
                    $stmt->bindParam(':tags', $this->tags, PDO::PARAM_STR);
                    $stmt->bindParam(':country', $this->country, PDO::PARAM_STR);
                    $stmt->bindParam(':released', $this->released, PDO::PARAM_STR);
                    $stmt->bindParam(':rating', $this->rating, PDO::PARAM_STR);
                    $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                    $stmt->bindParam(':status', $newstatusid, PDO::PARAM_STR);
					$stmt->bindParam(':postid', $newpostid, PDO::PARAM_STR);
	    				if ($stmt->execute()) {
		    				$data = [
			    				'status' => 'success',
				    			'code' => 'RS103',
					    		'message' => CustomHandlers::getreSlimMessage('RS103')
						    ];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS203',
				    			'message' => CustomHandlers::getreSlimMessage('RS203')
					    	];
    					}
	    			    $this->db->commit();
		    	    } catch (PDOException $e) {
			    	    $data = [
    			    		'status' => 'error',
	    			    	'code' => $e->getCode(),
		    			    'message' => $e->getMessage()
    			    	];
	    			    $this->db->rollBack();
    	    		} 
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;

        }

		/** 
		 * Delete data post
		 * @return result process in json encoded data
		 */
        public function deletePost(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                if (Auth::getRoleID($this->db,$this->token) == '1' || Auth::getRoleID($this->db,$this->token) == '2'){
                    $newpostid = Validation::integerOnly($this->postid);
			
    			    try {
    	    			$this->db->beginTransaction();
	    	    		$sql = "DELETE FROM data_post 
		    	    		WHERE PostID=:postid;";
			    		$stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':postid', $newpostid, PDO::PARAM_STR);
					    if ($stmt->execute()) {
    						$data = [
	    						'status' => 'success',
		    					'code' => 'RS104',
			    				'message' => CustomHandlers::getreSlimMessage('RS104')
				    		];	
					    } else {
    						$data = [
	    						'status' => 'error',
		    					'code' => 'RS204',
			    				'message' => CustomHandlers::getreSlimMessage('RS204')
				    		];
					    }
    				    $this->db->commit();
        			} catch (PDOException $e) {
	        			$data = [
		        			'status' => 'error',
			        		'code' => $e->getCode(),
				        	'message' => $e->getMessage()
        				];
	        			$this->db->rollBack();
    	    		}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }
            
			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;

        }

		/** 
		 * Search all data post paginated
		 * @return result process in json encoded data
		 */
		public function searchPostAsPagination() {
			if (Auth::validToken($this->db,$this->token,$this->username)){
				$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
				$search = "%$this->search%";
					if (Auth::getRoleID($this->db,$this->token) == '3'){
						$sqlcountrow = "SELECT count(a.PostID) as TotalRow
							from data_post a
							inner join core_status b on a.StatusID=b.StatusID
							where a.Username=:username and a.PostID like :search
							or a.Username=:username and a.Title like :search
							or a.Username=:username and a.Stars like :search
							or a.Username=:username and a.Cast like :search
							or a.Username=:username and a.Director like :search
							or a.Username=:username and a.Tags like :search
							or a.Username=:username and a.Country like :search
							or a.Username=:username and a.Released like :search
							order by a.Created_at desc;";
						$stmt = $this->db->prepare($sqlcountrow);
						$stmt->bindValue(':username', $newusername, PDO::PARAM_STR);
						$stmt->bindValue(':search', $search, PDO::PARAM_STR);
					} else if (Auth::getRoleID($this->db,$this->token) == '1' || Auth::getRoleID($this->db,$this->token) == '2'){
						$sqlcountrow = "SELECT count(a.PostID) as TotalRow
							from data_post a
							inner join core_status b on a.StatusID=b.StatusID
							where a.PostID like :search
							or a.Title like :search
							or a.Stars like :search
							or a.Cast like :search
							or a.Director like :search
							or a.Tags like :search
							or a.Country like :search
							or a.Released like :search
							order by a.Created_at desc;";
						$stmt = $this->db->prepare($sqlcountrow);
						$stmt->bindValue(':search', $search, PDO::PARAM_STR);
					}
					

					if ($stmt->execute()) {	
    	    	    	if ($stmt->rowCount() > 0){
							$single = $stmt->fetch();
						
							// Paginate won't work if page and items per page is negative.
							// So make sure that page and items per page is always return minimum zero number.
							$newpage = Validation::integerOnly($this->page);
							$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
							$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
							$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

							if (Auth::getRoleID($this->db,$this->token) == '3'){
								// Query Data
							$sql = "SELECT a.PostID,a.Created_at,a.Image,a.Title,a.Description,a.Embed_video,a.Duration,a.Stars,a.Cast,
									a.Director,a.Tags,a.Country,a.Released,a.Rating,a.Viewer,a.Liked,a.Disliked,a.Username as 'User',
									a.Updated_at,a.Updated_by,b.`Status`
								from data_post a
								inner join core_status b on a.StatusID=b.StatusID
								where a.Username=:username and a.PostID like :search
								or a.Username=:username and a.Title like :search
								or a.Username=:username and a.Stars like :search
								or a.Username=:username and a.Cast like :search
								or a.Username=:username and a.Director like :search
								or a.Username=:username and a.Tags like :search
								or a.Username=:username and a.Country like :search
								or a.Username=:username and a.Released like :search
								order by a.Created_at desc LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindValue(':username', $newusername, PDO::PARAM_STR);
							$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
							} else if (Auth::getRoleID($this->db,$this->token) == '1' || Auth::getRoleID($this->db,$this->token) == '2'){
								// Query Data
							$sql = "SELECT a.PostID,a.Created_at,a.Image,a.Title,a.Description,a.Embed_video,a.Duration,a.Stars,a.Cast,
									a.Director,a.Tags,a.Country,a.Released,a.Rating,a.Viewer,a.Liked,a.Disliked,a.Username as 'User',
									a.Updated_at,a.Updated_by,b.`Status`
								from data_post a
								inner join core_status b on a.StatusID=b.StatusID
								where a.PostID like :search
								or a.Title like :search
								or a.Stars like :search
								or a.Cast like :search
								or a.Director like :search
								or a.Tags like :search
								or a.Country like :search
								or a.Released like :search
								order by a.Created_at desc LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
							}

							
						
							if ($stmt2->execute()){
								if ($stmt2->rowCount() > 0){
									$datares = "[";
									while($redata = $stmt2->fetch()) 
									{
										//Start Tags
										$return_arr = null;
										$names = $redata['Tags'];	
										$named = preg_split( "/[;,@#]/", $names );
										foreach($named as $name){
											if ($name != null){$return_arr[] = trim($name);}
										}
										//End Tags

										//Start Stars
										$stars_arr = null;
										$starnames = $redata['Stars'];	
										$starnamed = preg_split( "/[;,@#]/", $starnames );
										foreach($starnamed as $name){
											if ($name != null){$stars_arr[] = trim($name);}
										}
										//End Stars

										//Start Cast
										$cast_arr = null;
										$castnames = $redata['Cast'];	
										$castnamed = preg_split( "/[;,@#]/", $castnames );
										foreach($castnamed as $name){
											if ($name != null){$cast_arr[] = trim($name);}
										}
										//End Cast

										//Start Director
										$director_arr = null;
										$directornames = $redata['Director'];	
										$directornamed = preg_split( "/[;,@#]/", $directornames );
										foreach($directornamed as $name){
											if ($name != null){$director_arr[] = trim($name);}
										}
										//End Director

										//Start Country
										$country_arr = null;
										$countrynames = $redata['Country'];	
										$countrynamed = preg_split( "/[;,@#]/", $countrynames );
										foreach($countrynamed as $name){
											if ($name != null){$country_arr[] = trim($name);}
										}
										//End Country

										//Start Embed
										$embed_arr = null;
										$embednames = $redata['Embed_video'];	
										$embednamed = preg_split( "/[,@#]/", $embednames );
										foreach($embednamed as $name){
											if ($name != null){$embed_arr[] = trim($name);}
										}
										//End Embed

										$datares .= '{"PostID":'.json_encode($redata['PostID']).',
											"Title":'.json_encode($redata['Title']).',
											"Description":'.json_encode($redata['Description']).',
											"Image":'.json_encode($redata['Image']).',
											"Embed_inline":'.json_encode($redata['Embed_video']).',
											"Embed":'.json_encode($embed_arr).',
											"Duration":'.json_encode($redata['Duration']).',
											"Stars_inline":'.json_encode($redata['Stars']).',
											"Stars":'.json_encode($stars_arr).',
											"Cast_inline":'.json_encode($redata['Cast']).',
											"Cast":'.json_encode($cast_arr).',
											"Director_inline":'.json_encode($redata['Director']).',
											"Director":'.json_encode($director_arr).',
											"Tags_inline":'.json_encode($redata['Tags']).',
											"Tags":'.json_encode($return_arr).',
											"Country_inline":'.json_encode($redata['Country']).',
											"Country":'.json_encode($country_arr).',
											"Released":'.json_encode($redata['Released']).',
											"Rating":'.json_encode($redata['Rating']).',
											"Viewer":'.json_encode($redata['Viewer']).',
											"Liked":'.json_encode($redata['Liked']).',
											"Disliked":'.json_encode($redata['Disliked']).',
											"Created_at":'.json_encode($redata['Created_at']).',
											"User":'.json_encode($redata['User']).',
											"Updated_at":'.json_encode($redata['Updated_at']).',
											"Updated_by":'.json_encode($redata['Updated_by']).',
											"Updated_by":'.json_encode($redata['Status']).'},';
									}
									$datares = substr($datares, 0, -1);
									$datares .= "]";
									$pagination = new \classes\Pagination();
									$pagination->totalRow = $single['TotalRow'];
									$pagination->page = $this->page;
									$pagination->itemsPerPage = $this->itemsPerPage;
									$pagination->fetchAllAssoc = json_decode($datares);
									$data = $pagination->toDataArray();
								} else {
									$data = [
		   	    		    			'status' => 'error',
	    			    		    	'code' => 'RS601',
	        					        'message' => CustomHandlers::getreSlimMessage('RS601')
									];
								}
							} else {
								$data = [
        	    		    		'status' => 'error',
		    	    		    	'code' => 'RS202',
	        			    	    'message' => CustomHandlers::getreSlimMessage('RS202')
								];	
							}			
				        } else {
    	    			    $data = [
        	    		    	'status' => 'error',
		    	    		    'code' => 'RS601',
        			    	    'message' => CustomHandlers::getreSlimMessage('RS601')
							];
		    	        }          	   	
					} else {
						$data = [
    	    				'status' => 'error',
							'code' => 'RS202',
	        			    'message' => CustomHandlers::getreSlimMessage('RS202')
						];
					}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}

		/** 
		 * Search all data post paginated public
		 * @return result process in json encoded data
		 */
		public function searchPostAsPaginationPublic() {
			$search = "%$this->search%";
			$sqlcountrow = "SELECT count(a.PostID) as TotalRow
				from data_post a
				inner join core_status b on a.StatusID=b.StatusID
				where a.StatusID='51' and a.PostID like :search
				or a.StatusID='51' and a.Title like :search
				or a.StatusID='51' and a.Stars like :search
				or a.StatusID='51' and a.Cast like :search
				or a.StatusID='51' and a.Director like :search
				or a.StatusID='51' and a.Tags like :search
				or a.StatusID='51' and a.Country like :search
				or a.StatusID='51' and a.Released like :search
				order by a.Created_at desc;";
				$stmt = $this->db->prepare($sqlcountrow);
				$stmt->bindValue(':search', $search, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	        	if ($stmt->rowCount() > 0){
						$single = $stmt->fetch();
						
						// Paginate won't work if page and items per page is negative.
						// So make sure that page and items per page is always return minimum zero number.
						$newpage = Validation::integerOnly($this->page);
						$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
						$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
						$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

						// Query Data
						$sql = "SELECT a.PostID,a.Created_at,a.Image,a.Title,a.Description,a.Embed_video,a.Duration,a.Stars,a.Cast,
								a.Director,a.Tags,a.Country,a.Released,a.Rating,a.Viewer,a.Liked,a.Disliked,a.Username as 'User',
								a.Updated_at,a.Updated_by,b.`Status`
							from data_post a
							inner join core_status b on a.StatusID=b.StatusID
							where a.StatusID='51' and a.PostID like :search
							or a.StatusID='51' and a.Title like :search
							or a.StatusID='51' and a.Stars like :search
							or a.StatusID='51' and a.Cast like :search
							or a.StatusID='51' and a.Director like :search
							or a.StatusID='51' and a.Tags like :search
							or a.StatusID='51' and a.Country like :search
							or a.StatusID='51' and a.Released like :search
							order by a.Created_at desc LIMIT :limpage , :offpage;";
						$stmt2 = $this->db->prepare($sql);
						$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
						$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
						$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
						if ($stmt2->execute()){
							if ($stmt2->rowCount() > 0){
								$datares = "[";
								while($redata = $stmt2->fetch()) 
								{
									//Start Tags
									$return_arr = null;
									$names = $redata['Tags'];	
									$named = preg_split( "/[;,@#]/", $names );
									foreach($named as $name){
										if ($name != null){$return_arr[] = trim($name);}
									}
									//End Tags

									//Start Stars
									$stars_arr = null;
									$starnames = $redata['Stars'];	
									$starnamed = preg_split( "/[;,@#]/", $starnames );
									foreach($starnamed as $name){
										if ($name != null){$stars_arr[] = trim($name);}
									}
									//End Stars

									//Start Cast
									$cast_arr = null;
									$castnames = $redata['Cast'];	
									$castnamed = preg_split( "/[;,@#]/", $castnames );
									foreach($castnamed as $name){
										if ($name != null){$cast_arr[] = trim($name);}
									}
									//End Cast

									//Start Director
									$director_arr = null;
									$directornames = $redata['Director'];	
									$directornamed = preg_split( "/[;,@#]/", $directornames );
									foreach($directornamed as $name){
										if ($name != null){$director_arr[] = trim($name);}
									}
									//End Director

									//Start Country
									$country_arr = null;
									$countrynames = $redata['Country'];	
									$countrynamed = preg_split( "/[;,@#]/", $countrynames );
									foreach($countrynamed as $name){
										if ($name != null){$country_arr[] = trim($name);}
									}
									//End Country

									//Start Embed
									$embed_arr = null;
									$embednames = $redata['Embed_video'];	
									$embednamed = preg_split( "/[,@#]/", $embednames );
									foreach($embednamed as $name){
										if ($name != null){$embed_arr[] = trim($name);}
									}
									//End Embed

									$datares .= '{"PostID":'.json_encode($redata['PostID']).',
										"Title":'.json_encode($redata['Title']).',
										"Description":'.json_encode($redata['Description']).',
										"Image":'.json_encode($redata['Image']).',
										"Embed":'.json_encode($embed_arr).',
										"Duration":'.json_encode($redata['Duration']).',
										"Stars":'.json_encode($stars_arr).',
										"Cast":'.json_encode($cast_arr).',
										"Director":'.json_encode($director_arr).',
										"Tags":'.json_encode($return_arr).',
										"Country":'.json_encode($country_arr).',
										"Released":'.json_encode($redata['Released']).',
										"Rating":'.json_encode($redata['Rating']).',
										"Viewer":'.json_encode($redata['Viewer']).',
										"Liked":'.json_encode($redata['Liked']).',
										"Disliked":'.json_encode($redata['Disliked']).',
										"Created_at":'.json_encode($redata['Created_at']).',
										"User":'.json_encode($redata['User']).',
										"Updated_at":'.json_encode($redata['Updated_at']).',
										"Updated_by":'.json_encode($redata['Updated_by']).',
										"Updated_by":'.json_encode($redata['Status']).'},';
								}
								$datares = substr($datares, 0, -1);
								$datares .= "]";
								$pagination = new \classes\Pagination();
								$pagination->totalRow = $single['TotalRow'];
								$pagination->page = $this->page;
								$pagination->itemsPerPage = $this->itemsPerPage;
								$pagination->fetchAllAssoc = json_decode($datares);
								$data = $pagination->toDataArray();
							} else {
								$data = [
		   	    	    			'status' => 'error',
	    		    		    	'code' => 'RS601',
	        				        'message' => CustomHandlers::getreSlimMessage('RS601')
								];
							}
						} else {
							$data = [
        	    	    		'status' => 'error',
		        		    	'code' => 'RS202',
	    			    	    'message' => CustomHandlers::getreSlimMessage('RS202')
							];	
						}			
				    } else {
    	    		    $data = [
        			    	'status' => 'error',
			    		    'code' => 'RS601',
    			    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
		    	    }          	   	
				} else {
					$data = [
    					'status' => 'error',
						'code' => 'RS202',
        			    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}

		/** 
		 * Show data release video only single detail for guest without login
		 * @return result process in json encoded data
		 */
		public function showSinglePost(){
            $newpostid = Validation::integerOnly($this->postid);
				
				$sql = "SELECT a.PostID,a.Created_at,a.Image,a.Title,a.Description,a.Embed_video,a.Duration,a.Stars,a.Cast,
								a.Director,a.Tags,a.Country,a.Released,a.Rating,a.Viewer,a.Liked,a.Disliked,a.Username as 'User',
								a.Updated_at,a.Updated_by,b.`Status`
							from data_post a
							inner join core_status b on a.StatusID=b.StatusID
							where a.StatusID='51' and a.PostID = :postid";
				
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':postid', $newpostid, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$datares = "[";
								while($redata = $stmt->fetch()) 
								{
									//Start Tags
									$return_arr = null;
									$names = $redata['Tags'];	
									$named = preg_split( "/[;,@#]/", $names );
									foreach($named as $name){
										if ($name != null){$return_arr[] = trim($name);}
									}
									//End Tags

									//Start Stars
									$stars_arr = null;
									$starnames = $redata['Stars'];	
									$starnamed = preg_split( "/[;,@#]/", $starnames );
									foreach($starnamed as $name){
										if ($name != null){$stars_arr[] = trim($name);}
									}
									//End Stars

									//Start Cast
									$cast_arr = null;
									$castnames = $redata['Cast'];	
									$castnamed = preg_split( "/[;,@#]/", $castnames );
									foreach($castnamed as $name){
										if ($name != null){$cast_arr[] = trim($name);}
									}
									//End Cast

									//Start Director
									$director_arr = null;
									$directornames = $redata['Director'];	
									$directornamed = preg_split( "/[;,@#]/", $directornames );
									foreach($directornamed as $name){
										if ($name != null){$director_arr[] = trim($name);}
									}
									//End Director

									//Start Country
									$country_arr = null;
									$countrynames = $redata['Country'];	
									$countrynamed = preg_split( "/[;,@#]/", $countrynames );
									foreach($countrynamed as $name){
										if ($name != null){$country_arr[] = trim($name);}
									}
									//End Country

									//Start Embed
									$embed_arr = null;
									$embednames = $redata['Embed_video'];	
									$embednamed = preg_split( "/[,@#]/", $embednames );
									foreach($embednamed as $name){
										if ($name != null){$embed_arr[] = trim($name);}
									}
									//End Embed

									$datares .= '{"PostID":'.json_encode($redata['PostID']).',
											"Title":'.json_encode($redata['Title']).',
											"Description":'.json_encode($redata['Description']).',
											"Image":'.json_encode($redata['Image']).',
											"Embed_inline":'.json_encode($redata['Embed_video']).',
											"Embed":'.json_encode($embed_arr).',
											"Duration":'.json_encode($redata['Duration']).',
											"Stars_inline":'.json_encode($redata['Stars']).',
											"Stars":'.json_encode($stars_arr).',
											"Cast_inline":'.json_encode($redata['Cast']).',
											"Cast":'.json_encode($cast_arr).',
											"Director_inline":'.json_encode($redata['Director']).',
											"Director":'.json_encode($director_arr).',
											"Tags_inline":'.json_encode($redata['Tags']).',
											"Tags":'.json_encode($return_arr).',
											"Country_inline":'.json_encode($redata['Country']).',
											"Country":'.json_encode($country_arr).',
											"Released":'.json_encode($redata['Released']).',
											"Rating":'.json_encode($redata['Rating']).',
											"Viewer":'.json_encode($redata['Viewer']).',
											"Liked":'.json_encode($redata['Liked']).',
											"Disliked":'.json_encode($redata['Disliked']).',
											"Created_at":'.json_encode($redata['Created_at']).',
											"User":'.json_encode($redata['User']).',
											"Updated_at":'.json_encode($redata['Updated_at']).',
											"Updated_by":'.json_encode($redata['Updated_by']).',
											"Updated_by":'.json_encode($redata['Status']).'},';
								}
								$datares = substr($datares, 0, -1);
								$datares .= "]";
						$data = [
			   	            'result' => json_decode($datares), 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}	
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Get all data Status for Release
		 * @return result process in json encoded data
		 */
		public function showOptionRelease() {
			if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.StatusID,a.Status
					FROM core_status a
					WHERE a.StatusID = '51' OR a.StatusID = '52'
					ORDER BY a.Status ASC";
				
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':token', $this->token, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'result' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}
     }