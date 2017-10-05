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
use \classes\tube\Issues as Issues;
use \classes\Validation as Validation;
use \classes\CustomHandlers as CustomHandlers;
use PDO;
	/**
     * A class for issues video management
     *
     * @package    Issues Video Tube
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2017 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/reSlim/blob/master/license.md  MIT License
     */
     class Issues {
        protected $db;

        //master var
        var $username,$token,$statusid,
		//data
        $reportid,$postid,$email,$issue,$fullname,$search;

		// for pagination
        var $page,$itemsPerPage;
        
        /**
         * Status code will be using :
         *
         * Waiting = 48
         * On Process = 29
         * On Hold = 28
         * Closed = 9
         */

        function __construct($db=null) {
			if (!empty($db)) {
    	        $this->db = $db;
        	}
        }
        
        /** 
		 * Get User IP
		 * @return result process in json encoded data
		 */
		private function getUserIP(){
			$client  = @$_SERVER['HTTP_CLIENT_IP'];
    		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		    $remote  = $_SERVER['REMOTE_ADDR'];

		    if(filter_var($client, FILTER_VALIDATE_IP)) {
        		$ip = $client;
		    } elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
		        $ip = $forward;
			} else {
        		$ip = $remote;
		    }

			return $ip;
        }

        //ISSUE=====================================

		/** 
		 * Add new issues
		 * @return result process in json encoded data
		 */
         public function addIssue(){
            $newpostid = Validation::integerOnly($this->postid);
            $newfullname = filter_var($this->fullname,FILTER_SANITIZE_STRING);
            $newemail = filter_var($this->email,FILTER_SANITIZE_EMAIL);
            $newissue = filter_var($this->issue,FILTER_SANITIZE_STRING);
            $userip = $this->getUserIP();
    		try {
    			$this->db->beginTransaction();
	    		$sql = "INSERT INTO data_report (PostID,Fullname,Email,Issue,StatusID,Created_at,IP) 
		    		VALUES (:postid,:fullname,:email,:issue,'48',current_timestamp,:ip);";
					$stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':postid', $newpostid, PDO::PARAM_STR);
                    $stmt->bindParam(':fullname', $newfullname, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $newemail, PDO::PARAM_STR);
                    $stmt->bindParam(':issue', $newissue, PDO::PARAM_STR);
                    $stmt->bindParam(':ip', $userip, PDO::PARAM_STR);
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

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;

        }

		/** 
		 * Update data issue
		 * @return result process in json encoded data
		 */
        public function updateIssue(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                    $newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
                    $newreportid = Validation::integerOnly($this->reportid);
                    $newstatusid = Validation::integerOnly($this->statusid);
                    
        			try {
	        			$this->db->beginTransaction();
                        $sql = "UPDATE data_report
                        SET Updated_by=:username,StatusID=:status
                        WHERE ReportID=:reportid;";

				    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                    $stmt->bindParam(':status', $newstatusid, PDO::PARAM_STR);
					$stmt->bindParam(':reportid', $newreportid, PDO::PARAM_STR);
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
		 * Delete data issue
		 * @return result process in json encoded data
		 */
        public function deleteIssue(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                if (Auth::getRoleID($this->db,$this->token) == '1' || Auth::getRoleID($this->db,$this->token) == '2'){
                    $newreportid = Validation::integerOnly($this->reportid);
			
    			    try {
    	    			$this->db->beginTransaction();
	    	    		$sql = "DELETE FROM data_report 
		    	    		WHERE ReportID=:reportid;";
			    		$stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':reportid', $newreportid, PDO::PARAM_STR);
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
		 * Get all data Status for Issue
		 * @return result process in json encoded data
		 */
		public function showOptionIssue() {
			if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.StatusID,a.Status
					FROM core_status a
					WHERE a.StatusID = '48' OR a.StatusID = '29' OR a.StatusID = '28' OR a.StatusID = '9'
					ORDER BY a.Status DESC";
				
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':token', $this->token, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'results' => $results, 
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
        
        /** 
		 * Search all data issues paginated
		 * @return result process in json encoded data
		 */
		public function searchIssuesAsPagination() {
			if (Auth::validToken($this->db,$this->token,$this->username)){
                $newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
                $search = "%$this->search%";
                if (Auth::getRoleID($this->db,$this->token) == '1' || Auth::getRoleID($this->db,$this->token) == '2'){
					$sqlcountrow = "SELECT count(a.ReportID) as TotalRow 
                        from data_report a
                        inner join core_status b on a.StatusID = b.StatusID
                        inner join data_post c on a.PostID = c.PostID
                        where a.ReportID like :search
                        or a.PostID like :search
                        or c.Title like :search
                        or c.Username like :search
                        or b.`Status` like :search
                        or a.Fullname like :search
                        or a.Email like :search
                        order by b.StatusID desc,a.Created_at asc;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindValue(':search', $search, PDO::PARAM_STR);
                } else {
                    $sqlcountrow = "SELECT count(a.ReportID) as TotalRow 
                        from data_report a
                        inner join core_status b on a.StatusID = b.StatusID
                        inner join data_post c on a.PostID = c.PostID
                        where c.Username=:username and a.ReportID like :search
                        or c.Username=:username and a.PostID like :search
                        or c.Username=:username and c.Title like :search
                        or c.Username=:username and b.`Status` like :search
                        or c.Username=:username and a.Fullname like :search
                        or c.Username=:username and a.Email like :search
                        order by b.StatusID desc,a.Created_at asc;";
                    $stmt = $this->db->prepare($sqlcountrow);
                    $stmt->bindValue(':search', $search, PDO::PARAM_STR);
                    $stmt->bindValue(':username', $newusername, PDO::PARAM_STR);
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

							if (Auth::getRoleID($this->db,$this->token) == '1' || Auth::getRoleID($this->db,$this->token) == '2'){
                                // Query Data
    							$sql = "SELECT a.ReportID,a.PostID,c.Title,c.Username,a.StatusID,b.`Status`,a.Fullname,a.Email,a.Issue,a.IP,a.Created_at,a.Updated_at,a.Updated_by
                                    from data_report a
                                    inner join core_status b on a.StatusID = b.StatusID
                                    inner join data_post c on a.PostID = c.PostID
                                    where a.ReportID like :search
                                    or a.PostID like :search
                                    or c.Title like :search
                                    or c.Username like :search
                                    or b.`Status` like :search
                                    or a.Fullname like :search
                                    or a.Email like :search
                                    order by b.StatusID desc,a.Created_at asc LIMIT :limpage , :offpage;";
                                $stmt2 = $this->db->prepare($sql);
                                $stmt2->bindValue(':search', $search, PDO::PARAM_STR);
                                $stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
                                $stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
                            } else {
                                // Query Data
    							$sql = "SELECT a.ReportID,a.PostID,c.Title,c.Username,a.StatusID,b.`Status`,a.Fullname,a.Email,a.Issue,a.IP,a.Created_at,a.Updated_at,a.Updated_by 
                                    from data_report a
                                    inner join core_status b on a.StatusID = b.StatusID
                                    inner join data_post c on a.PostID = c.PostID
                                    where c.Username=:username and a.ReportID like :search
                                    or c.Username=:username and a.PostID like :search
                                    or c.Username=:username and c.Title like :search
                                    or c.Username=:username and b.`Status` like :search
                                    or c.Username=:username and a.Fullname like :search
                                    or c.Username=:username and a.Email like :search
                                    order by b.StatusID desc,a.Created_at asc LIMIT :limpage , :offpage;";
                                $stmt2 = $this->db->prepare($sql);
                                $stmt2->bindValue(':username', $newusername, PDO::PARAM_STR);
                                $stmt2->bindValue(':search', $search, PDO::PARAM_STR);
                                $stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
                                $stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
                            }
						
							if ($stmt2->execute()){
								if ($stmt2->rowCount() > 0){
									$results = $stmt2->fetchAll(PDO::FETCH_ASSOC);
									$pagination = new \classes\Pagination();
									$pagination->totalRow = $single['TotalRow'];
									$pagination->page = $this->page;
									$pagination->itemsPerPage = $this->itemsPerPage;
									$pagination->fetchAllAssoc = $results;
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
    }