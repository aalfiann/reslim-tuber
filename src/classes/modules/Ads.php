<?php
/**
 * This class is a part of reSlim project
 * @author M ABD AZIZ ALFIAN <github.com/aalfiann>
 *
 * Don't remove this class unless You know what to do
 *
 */
namespace classes\modules;
use \classes\Auth as Auth;
use \classes\modules\Ads as Ads;
use \classes\Validation as Validation;
use \classes\CustomHandlers as CustomHandlers;
use PDO;
	/**
     * A class for ads management
     *
     * @package    reSlim
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2017 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/reSlim/blob/master/license.md  MIT License
     */
     class Ads {
        protected $db;

        //master var
        var $username,$token,$companyid,$name,$adsid,$website,$statusid,$apikey,$adminname,
		//data
        $address,$phone,$email,$title,$embed,$startdate,$enddate,$amount,$search,$firstdate,$lastdate;

		// for pagination
		var $page,$itemsPerPage;

        function __construct($db=null) {
			if (!empty($db)) {
    	        $this->db = $db;
        	}
		}

        //COMPANY=====================================

		/** 
		 * Add new company
		 * @return result process in json encoded data
		 */
        public function addCompany(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
			
    		    try {
    				$this->db->beginTransaction();
	    			$sql = "INSERT INTO data_company (Name,Address,Phone,Email,Website,StatusID,Created_at,Username) 
		    			VALUES (:name,:address,:phone,:email,:website,'1',current_timestamp,:username);";
					$stmt = $this->db->prepare($sql);
					$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
                    $stmt->bindParam(':address', $this->address, PDO::PARAM_STR);
                    $stmt->bindParam(':phone', $this->phone, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
                    $stmt->bindParam(':website', $this->website, PDO::PARAM_STR);
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
		 * Update data company
		 * @return result process in json encoded data
		 */
        public function updateCompany(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
				if (Auth::getRoleID($this->db,$this->token) == '1' || Auth::getRoleID($this->db,$this->token) == '2'){
                    $newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
                    $newcompanyid = Validation::integerOnly($this->companyid);
                    $newstatusid = Validation::integerOnly($this->statusid);
                    
        			try {
	        			$this->db->beginTransaction();
                        $sql = "UPDATE data_company 
                            SET Name=:name,Address=:address,Phone=:phone,Email=:email,Website=:website,
                                StatusID=:status,Updated_by=:username
		        		    WHERE CompanyID=:companyid;";

				    $stmt = $this->db->prepare($sql);
					$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
                    $stmt->bindParam(':address', $this->address, PDO::PARAM_STR);
                    $stmt->bindParam(':phone', $this->phone, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
                    $stmt->bindParam(':website', $this->website, PDO::PARAM_STR);
                    $stmt->bindParam(':status', $newstatusid, PDO::PARAM_STR);
					$stmt->bindParam(':companyid', $newcompanyid, PDO::PARAM_STR);
					$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
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
		 * Delete data company
		 * @return result process in json encoded data
		 */
        public function deleteCompany(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                if (Auth::getRoleID($this->db,$this->token) == '1' || Auth::getRoleID($this->db,$this->token) == '2'){
                    $newpostid = Validation::integerOnly($this->postid);
			
    			    try {
    	    			$this->db->beginTransaction();
	    	    		$sql = "DELETE FROM data_company 
		    	    		WHERE CompanyID=:companyid;";
			    		$stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':companyid', $newpostid, PDO::PARAM_STR);
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
		 * Search all data company paginated
		 * @return result process in json encoded data
		 */
		public function searchCompanyAsPagination() {
			if (Auth::validToken($this->db,$this->token,$this->username)){
				if (Auth::getRoleID($this->db,$this->token) == '1' || Auth::getRoleID($this->db,$this->token) == '2'){
					$search = "%$this->search%";
					$sqlcountrow = "SELECT count(a.CompanyID) as TotalRow
							from data_company a
							inner join core_status b on a.StatusID=b.StatusID
							where a.CompanyID like :search
							or a.Name like :search
							or a.Phone like :search
							or a.Email like :search
							or a.Website like :search
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
							$sql = "SELECT a.CompanyID,a.Created_at,a.Name,a.Address,a.Phone,a.Email,a.Website,a.Username as 'User',
									a.Updated_at,a.Updated_by,a.StatusID,b.`Status`
								from data_company a
								inner join core_status b on a.StatusID=b.StatusID
								where a.CompanyID like :search
								or a.Name like :search
								or a.Phone like :search
								or a.Email like :search
								or a.Website like :search
								order by a.Created_at desc LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
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

		/** 
		 * Get all data list Company
		 * @return result process in json encoded data
		 */
		public function showListCompany() {
			if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.CompanyID,a.Name,a.StatusID,b.Status
					FROM data_company a
					INNER JOIN core_status b on a.StatusID=b.StatusID
					WHERE a.StatusID = '1' OR a.StatusID = '42'
					ORDER BY a.StatusID,a.Name ASC";
				
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


        //ADS==========================================


        /** 
		 * Add new ads
		 * @return result process in json encoded data
		 */
        public function addAds(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                $newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
			
    		    try {
    				$this->db->beginTransaction();
	    			$sql = "INSERT INTO data_ads (CompanyID,Title,Embed,StartDate,EndDate,Amount,Viewer,StatusID,Created_at,Username) 
		    			VALUES (:companyid,:title,:embed,:startdate,:enddate,:amount,'0','51',current_timestamp,:username);";
					$stmt = $this->db->prepare($sql);
					$stmt->bindParam(':companyid', $this->companyid, PDO::PARAM_STR);
                    $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
                    $stmt->bindParam(':embed', $this->embed, PDO::PARAM_STR);
                    $stmt->bindParam(':startdate', $this->startdate, PDO::PARAM_STR);
                    $stmt->bindParam(':enddate', $this->enddate, PDO::PARAM_STR);
					$stmt->bindParam(':amount', $this->amount, PDO::PARAM_STR);
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
		 * Update data ads
		 * @return result process in json encoded data
		 */
        public function updateAds(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
				if (Auth::getRoleID($this->db,$this->token) == '1' || Auth::getRoleID($this->db,$this->token) == '2'){
                    $newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
                    $newcompanyid = Validation::integerOnly($this->companyid);
                    $newstatusid = Validation::integerOnly($this->statusid);
					$newadsid = Validation::integerOnly($this->adsid);
                    
        			try {
	        			$this->db->beginTransaction();
                        $sql = "UPDATE data_ads 
                            SET CompanyID=:companyid,Title=:title,Embed=:embed,StartDate=:startdate,EndDate=:enddate,
                                Amount=:amount,StatusID=:status,Updated_by=:username
		        		    WHERE AdsID=:adsid;";

				    	$stmt = $this->db->prepare($sql);
						$stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
    	                $stmt->bindParam(':embed', $this->embed, PDO::PARAM_STR);
        	            $stmt->bindParam(':startdate', $this->startdate, PDO::PARAM_STR);
            	        $stmt->bindParam(':enddate', $this->enddate, PDO::PARAM_STR);
						$stmt->bindParam(':amount', $this->amount, PDO::PARAM_STR);
                	    $stmt->bindParam(':status', $newstatusid, PDO::PARAM_STR);
						$stmt->bindParam(':companyid', $newcompanyid, PDO::PARAM_STR);
						$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
						$stmt->bindParam(':adsid', $newadsid, PDO::PARAM_STR);
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
		 * Delete data ads
		 * @return result process in json encoded data
		 */
        public function deleteAds(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                if (Auth::getRoleID($this->db,$this->token) == '1' || Auth::getRoleID($this->db,$this->token) == '2'){
                    $newadsid = Validation::integerOnly($this->adsid);
			
    			    try {
    	    			$this->db->beginTransaction();
	    	    		$sql = "DELETE FROM data_ads 
		    	    		WHERE AdsID=:adsid;";
			    		$stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':adsid', $newadsid, PDO::PARAM_STR);
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
		 * Search all data ads paginated
		 * @return result process in json encoded data
		 */
		public function searchAdsAsPagination() {
			if (Auth::validToken($this->db,$this->token,$this->username)){
				if (Auth::getRoleID($this->db,$this->token) == '1' || Auth::getRoleID($this->db,$this->token) == '2'){
					$search = "%$this->search%";
					$sqlcountrow = "SELECT count(a.AdsID) as 'TotalRow'
								from data_ads a
								inner join data_company b on a.CompanyID=b.CompanyID
								inner join core_status c on a.StatusID=c.StatusID
								where a.AdsID like :search
								or b.`Name` like :search
								or a.Title like :search
								order by a.EndDate asc,a.Title asc,a.StatusID desc;";
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
							$sql = "SELECT a.AdsID,a.Created_at,b.CompanyID,b.`Name`,a.Title,a.Embed,a.StartDate,a.EndDate,a.Amount,a.Viewer,a.Username as 'User',a.Updated_at,a.Updated_by,a.StatusID,c.`Status`
								from data_ads a
								inner join data_company b on a.CompanyID=b.CompanyID
								inner join core_status c on a.StatusID=c.StatusID
								where a.AdsID like :search
								or b.`Name` like :search
								or a.Title like :search
								order by a.EndDate asc,a.Title asc,a.StatusID desc LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
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

		/** 
		 * Show data ads random single detail for guest without login
         * @var $layout is the position ads to be appear in page. Example: header, footer, leftsidebar, rightsidebar, etc 
		 * @return result process in json encoded data
		 */
		public function showAds($layout){
            $newlayout = "%$layout%";
				
				$sql = "SELECT a.AdsID,a.Created_at,b.CompanyID,b.`Name`,a.Title,a.Embed,a.StartDate,a.EndDate
					from data_ads a
					inner join data_company b on a.CompanyID=b.CompanyID
					inner join core_status c on a.StatusID=c.StatusID
					where a.EndDate > DATE(now())
					and b.StatusID ='1'
					and a.StatusID = '51'
					and a.Title like :layout
					order by rand() LIMIT 1;";
				
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':layout', $newlayout, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$adsid = $results[0]['AdsID'];
						$updateviewer = "UPDATE data_ads a SET a.Viewer=a.Viewer+1 where a.AdsID=:adsid;";
						$stmt2 = $this->db->prepare($updateviewer);		
						$stmt2->bindParam(':adsid', $adsid, PDO::PARAM_STR);
						$stmt2->execute();
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
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }


        //STATUS=======================================


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
		 * Get all data Status for Active
		 * @return result process in json encoded data
		 */
		public function showOptionActive() {
			if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.StatusID,a.Status
					FROM core_status a
					WHERE a.StatusID = '1' OR a.StatusID = '42'
					ORDER BY a.Status ASC";
				
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
     }