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
        $image,$title,$description,$embed,$duration,$stars,$cast,$director,$country,$release,$rating,$like,$dislike,$viewer,
        $tags,$pages,$search,$firstdate,$lastdate;

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
	    			$sql = "INSERT INTO data_post (Image,Title,Description,Embed_video,Duration,Stars,Cast,Director,Tags,Country,
                        Release,Rating,Like,Dislike,StatusID,Viewer,Created_at,Username) 
		    			VALUES (:image,:title,:description,:embed,:duration,:stars,:cast,:director,:tags,:country,:release,
                            :rating,'0','0','35','0',current_timestamp,:username);";
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
                    $stmt->bindParam(':release', $this->release, PDO::PARAM_STR);
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
                                    Stars=:stars,Cast=:cast,Director=:director,Tags=:tags,Country=:country,Release=:release,
                                    Rating=:rating,Updated_by=:username,StatusID=:status
			        		    WHERE PostID=:postid and Username=:username;";
                        } else{
                            $sql = "UPDATE data_post
                                SET Image=:image,Title=:title,Description=:description,Embed_video=:embed,Duration=:duration,
                                    Stars=:stars,Cast=:cast,Director=:director,Tags=:tags,Country=:country,Release=:release,
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
                    $stmt->bindParam(':release', $this->release, PDO::PARAM_STR);
                    $stmt->bindParam(':rating', $this->rating, PDO::PARAM_STR);
                    $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                    $stmt->bindParam(':status', $newstatusid, PDO::PARAM_STR);
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
			if (Auth::validToken($this->db,$this->token)){
				if (Auth::getRoleID($this->db,$this->token) == '1'){
					$search = "%$this->search%";
					$sqlcountrow = "SELECT count(a.AuthorID) as TotalRow
					FROM book_author a 
					WHERE a.Name like :search
					ORDER BY a.Name ASC;";
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
							$sql = "SELECT a.AuthorID,a.Name
								FROM book_author a
								WHERE a.Name like :search
								ORDER BY a.Name ASC LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
							if ($stmt2->execute()){
								$pagination = new \classes\Pagination();
								$pagination->totalRow = $single['TotalRow'];
								$pagination->page = $this->page;
								$pagination->itemsPerPage = $this->itemsPerPage;
								$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
								$data = $pagination->toDataArray();
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
	        $this->db= null;
		}
     }