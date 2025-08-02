<?php
	include("mohan_transport_27042024.php");
	class Basic_Functions extends db {
		public $con;
		
		public function connect() {
			$con = parent::connect();
			return $con;
		}
		public function getProjectTitle() {
			$project_title = "";
			if(empty($project_title)) { $project_title = "Mohan Transport"; }
			return $project_title;
		}
		public function encode_decode($action, $string) {
			$output = "";

			if ($action == 'encrypt') {
				$output = base64_encode($string);
				$output = bin2hex($output);
			}

			if ($action == 'decrypt') {
				// Validate that the input is a valid hexadecimal string
				if (ctype_xdigit($string) && strlen($string) % 2 == 0) {
					$decodedHex = hex2bin($string);
					if ($decodedHex !== false) {
						$decodedBase64 = base64_decode($decodedHex, true); // strict mode
						if ($decodedBase64 !== false) {
							$output = html_entity_decode(htmlentities($decodedBase64, ENT_QUOTES));
						}
					}
				}
			}

			return $output;
		}
		public function InsertSQL($table, $columns, $values, $action) {
			$con = $this->connect(); $last_insert_id = "";
			
			if(!empty($columns) && !empty($values)) {
				if(count($columns) == count($values)) {					
					$columns = implode(",", $columns);
					$values = implode(",", $values);
					
					$result = "";
					$insert_query = "INSERT INTO ".$table." (".$columns.") VALUES (".$values.")";
					$result = $con->prepare($insert_query);
					if($result->execute() === TRUE) {
						$last_insert_id = $con->lastInsertId();
						$last_query_insert_id = "";
						if(preg_match("/^\d+$/", $last_insert_id)) {
							$last_log_id = $this->add_log($table, $last_insert_id, $insert_query, $action);
						}
					}
					else {
						$last_insert_id = "Unable to insert the data";
					}
				}
				else {
					$last_insert_id = "Columns are not match";
				}
			}			
					
			return $last_insert_id;
		}
		public function add_log($table, $table_unique_id, $query, $action) {
			$con = $this->connect(); $last_query_insert_id = "";
			if(!empty($query) && !empty($action)) {
				$query = $this->encode_decode('encrypt', $query);
				$action = $this->encode_decode('encrypt', $action);
				$table = $this->encode_decode('encrypt', $table);
			
				$create_date_time = $GLOBALS['create_date_time_label'];
				$creator = "";
				if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
					$creator = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
				}
				$creator_type = "";
				if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
					$creator_type = $this->encode_decode('encrypt', $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']);
				}
				$creator_name = "";
				if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_username']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_username'])) {
					$creator_name = $this->encode_decode('encrypt', $_SESSION[$GLOBALS['site_name_user_prefix'].'_username']);
				}
				$creator_mobile_number = "";
				if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_mobile_number']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_mobile_number'])) {
					$creator_mobile_number = $this->encode_decode('encrypt', $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_mobile_number']);
				}
				$log_backup_file = $GLOBALS['log_backup_file'];
	
				$columns = array('type', 'created_date_time', 'creator', 'creator_name', 'creator_mobile_number', 'log_table', 'log_table_unique_id', 'action', 'query');	
				$values = array("'".$creator_type."'", "'".$create_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$creator_mobile_number."'", "'".$table."'", "'".$table_unique_id."'", "'".$action."'", "'".$query."'");			
				if(count($columns) == count($values)) {	
					$log_data = array();
					$log_data = array('type' => $creator_type, 'created_date_time' => $create_date_time, 'creator' => $creator, 'creator_name' => $creator_name, 'creator_mobile_number' => $creator_mobile_number, 'table' => $table, 'table_unique_id' => $table_unique_id, 'action' => $action, 'query' => $query);	
					if(!empty($log_data)) {
						$log_data = json_encode($log_data);
						
						if(file_exists($log_backup_file)) {
							file_put_contents($log_backup_file, $log_data, FILE_APPEND | LOCK_EX);
							file_put_contents($log_backup_file, "\n", FILE_APPEND | LOCK_EX);
						}
						else {
							$myfile = fopen($log_backup_file, "a+");
							fwrite($myfile, $log_data."\n");
							fclose($myfile);
						}
					}
				}
			}			
					
			return $last_query_insert_id;
		}
		public function UpdateSQL($table, $update_id, $columns, $values, $action) {
			$con = $this->connect(); $updated_data = ''; $msg = "";
			
			if(!empty($columns) && !empty($values)) {
			
				if(count($columns) == count($values)) {					
					for($r = 0; $r < count($columns); $r++) {
						$updated_data = $updated_data.$columns[$r]." = ".$values[$r]."";
						if(!empty($columns[$r+1])) {
							$updated_data = $updated_data.', ';
						}	
					}
					if(!empty($updated_data)) {
						$updated_data = trim($updated_data);
						$update_query = "UPDATE ".$table." SET ".$updated_data." WHERE id='".$update_id."'";
						$result = $con->prepare($update_query);
						if($result->execute() === TRUE) {
							$msg = 1;							
							$last_log_id = $this->add_log($table, $update_id, $update_query, $action);
						}
						else {
							$msg = "Unable to update the data";
						}
					}
					else {
						$msg = "Unable to update the data";
					}
				}
				else {
					$msg = "Columns are not match";
				}
			}
					
			return $msg;	
		}
		public function UpdateLRNumber() {
			$updated = ""; $number = 5581;
			$select_query = "SELECT id FROM ".$GLOBALS['lr_table']." WHERE DATE(lr_date) = '2023-10-19' AND deleted = '0' ORDER BY id ASC";
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['lr_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['id'])) {
							$lr_number = $number.'/P';
							$columns = array(); $values = array(); $lr_updated = "";					
							$columns = array('lr_number');
							$values = array("'".$lr_number."'");
							$lr_updated = $this->UpdateSQL($GLOBALS['lr_table'], $data['id'], $columns, $values, '');
							if(preg_match("/^\d+$/", $lr_updated)) {
								$number = $number + 1;
							}
						}
					}
				}
			}
			return $updated;
		}
        public function ClearLRDetails($from_date, $to_date) {
			$updated = ""; $tripsheet_id = '56464a4a55464e4952555655587a457a4d4467794d4449304d4467794d6a5577587a4d77';
			$select_query = "SELECT * FROM ".$GLOBALS['tripsheet_table']." WHERE tripsheet_id = '".$tripsheet_id."' AND deleted = '0'";
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['tripsheet_table'], $select_query);
				echo "Processing <br>";
				if(!empty($list) && !empty($from_date) && !empty($to_date)) {
					foreach($list as $data) {
						if(!empty($data['id']) && !empty($data['tripsheet_number'])) {
							$unique_id = ""; $tripsheet_number = ""; $branch_id = ""; $lr_id = ""; $lr_number = ""; $price_per_qty = "";
							$unique_id = $data['id'];
							$tripsheet_number = $data['tripsheet_number'];
							$branch_ids = array(); $lr_ids = array(); $lr_numbers = array(); $price_per_qtys = array();
							$where = "";
							if(!empty($from_date)) {
								$from_date = date("Y-m-d", strtotime($from_date));
								$where = "DATE(lr_date) >= '".$from_date."'";
							}
							if(!empty($to_date)) {
								$to_date = date("Y-m-d", strtotime($to_date));
								$where = $where." AND DATE(lr_date) <= '".$to_date."'";
							}
							if(!empty($where)) {
								$lr_query = ""; $lr_list = array();
								$lr_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE ".$where." AND deleted = '0' ORDER BY id ASC";
								if(!empty($lr_query)) {
									$lr_list = $this->getQueryRecords($GLOBALS['lr_table'], $lr_query);
									if(!empty($lr_list)) {
										foreach($lr_list as $row) {
											if(!empty($row['id']) && preg_match("/^\d+$/", $row['id'])) {
												$columns = array(); $values = array(); $lr_updated = "";					
												$columns = array('is_tripsheet_entry', 'tripsheet_number');
												$values = array("'1'", "'".$tripsheet_number."'");
												$lr_updated = $this->UpdateSQL($GLOBALS['lr_table'], $row['id'], $columns, $values, '');
												if(preg_match("/^\d+$/", $lr_updated)) {
													if(!empty($row['branch_id'])) {
														$branch_ids[] = $row['branch_id'];
													}
													if(!empty($row['lr_id'])) {
														$lr_ids[] = $row['lr_id'];
													}
													if(!empty($row['lr_number'])) {
														$lr_numbers[] = $row['lr_number'];
													}
													if(!empty($row['price_per_qty'])) {
														$sum_price_per_qty = 0;
														$sum_price_per_qty = array_sum(explode(",", $row['price_per_qty']));
														$price_per_qtys[] = $sum_price_per_qty;
													}
												}
											}
										}
									}
								}	
							}
							if(!empty($branch_ids) && !empty($lr_ids) && !empty($lr_numbers) && !empty($price_per_qtys)) {
								$branch_id = implode(",", $branch_ids);
								$lr_id = implode(",", $lr_ids);
								$lr_number = implode(",", $lr_numbers);
								$price_per_qty = implode(",", $price_per_qtys);
								$columns = array(); $values = array();					
								$columns = array('branch_id', 'lr_id', 'lr_number', 'price_per_qty');
								$values = array("'".$branch_id."'", "'".$lr_id."'", "'".$lr_number."'", "'".$price_per_qty."'");
								$updated = $this->UpdateSQL($GLOBALS['tripsheet_table'], $unique_id, $columns, $values, '');
							}
						}
					}
				}
				echo "finished";
			}
			return $updated;
		}
		public function automate_number($table, $column, $last_record_id, $current_record_id) {
			// Taking $last_record_id as gst_option for LR table
			// Taking $current_record_id as branch_id for LR table and Tripsheet table
			$last_number = ""; $next_number = "";
			$prefix = "";
			if(!empty($table)) {
				if($table == $GLOBALS['lr_table'] || $table == $GLOBALS['tripsheet_table']) { 
					if(!empty($current_record_id)) {
						$branch_prefix = $this->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $current_record_id, 'branch_lr_prefix');
						if(!empty($branch_prefix) && $branch_prefix != $GLOBALS['null_value']) {
							$prefix = $this->encode_decode('decrypt', $branch_prefix);
						}
					}
					if(!empty($prefix)) {
						if($table == $GLOBALS['lr_table']) {
							if($last_record_id == '1') {
								$prefix = $prefix."-G";
							}
							else {
								$prefix = $prefix."-P";
							}
						}
						else if($table == $GLOBALS['tripsheet_table']) {
							$prefix = $prefix."-TS";
						}
					}
					else {
						if($table == $GLOBALS['lr_table']) {
							if($last_record_id == '1') {
								$prefix = "G";
							}
							else {
								$prefix = "P";
							}
						}
						else if($table == $GLOBALS['tripsheet_table']) {
							$prefix = "TS";
						}
					}
				}
				// else if($table == $GLOBALS['luggage_sheet_table']) { 
				// 	$prefix = "LC"; 
				// }'
			}
			if(!empty($prefix)) {
				$prefix = "/".$prefix;
			}
			//echo "last_number - ".$last_number."<br>";
			$from_date = "";
			if(isset($_SESSION['billing_year_starting_date']) && !empty($_SESSION['billing_year_starting_date'])) {
				$from_date = $_SESSION['billing_year_starting_date'];
				if(!empty($from_date)) {
					$from_date = date("Y-m-d", strtotime($from_date));
				}
			}
			$to_date = "";
			if(isset($_SESSION['billing_year_ending_date']) && !empty($_SESSION['billing_year_ending_date'])) {
				$to_date = $_SESSION['billing_year_ending_date'];
				if(!empty($to_date)) {
					$to_date = date("Y-m-d", strtotime($to_date));
				}
			}
			$bill_rows = 0;
			if(!empty($from_date) && !empty($to_date)) {
				$select_query = ""; $list = array();
				if($table == $GLOBALS['lr_table']) {
					$select_query = "SELECT COUNT(id) as bill_rows FROM ".$table." WHERE DATE(lr_date) >= '".$from_date."' AND DATE(lr_date) <= '".$to_date."' AND gst_option = '".$last_record_id."' AND from_branch_id = '".$current_record_id."' 
										ORDER BY id DESC";	
				}
				// else if($table == $GLOBALS['luggagesheet_table']) {
				// 	$select_query = "SELECT COUNT(id) as bill_rows FROM ".$table." WHERE DATE(luggage_date) >= '".$from_date."' AND DATE(luggage_date) <= '".$to_date."' 
				// 						ORDER BY id DESC";	
				// }
				else if($table == $GLOBALS['tripsheet_table']) {
					$select_query = "SELECT COUNT(id) as bill_rows FROM ".$table." WHERE DATE(tripsheet_date) >= '".$from_date."' AND DATE(tripsheet_date) <= '".$to_date."' AND from_branch_id = '".$current_record_id."' 
										ORDER BY id DESC";	
				}
				if(!empty($select_query)) {
					$list = $this->getQueryRecords($table, $select_query);
					if(!empty($list)) {
						foreach($list as $data) {
							if(!empty($data['bill_rows'])) {
								$bill_rows = $data['bill_rows'];
							}
						}
					}
				}
				if(empty($bill_rows)) { $next_number = 1; }
				else {
					if($table == $GLOBALS['lr_table']) {
						$select_query = "SELECT MAX(CAST(SUBSTRING_INDEX(".$column.", '/', 1) AS UNSIGNED)) AS max_number FROM ".$table." WHERE ".$column." != '' 
											AND DATE(lr_date) >= '".$from_date."' AND DATE(lr_date) <= '".$to_date."' AND gst_option = '".$last_record_id."' AND from_branch_id = '".$current_record_id."' AND ".$column." REGEXP '[0-9]+/[a-zA-Z]'";	
					}
					// else if($table == $GLOBALS['luggagesheet_table']) {
					// 	$select_query = "SELECT MAX(CAST(SUBSTRING_INDEX(".$column.", '/', 1) AS UNSIGNED)) AS max_number FROM ".$table." WHERE ".$column." != '' 
					// 						AND DATE(luggage_date) >= '".$from_date."' AND DATE(luggage_date) <= '".$to_date."' 
					// 						AND ".$column." REGEXP '[0-9]+/[a-zA-Z]'";
					// }
					else if($table == $GLOBALS['tripsheet_table']) {
						$select_query = "SELECT MAX(CAST(SUBSTRING_INDEX(".$column.", '/', 1) AS UNSIGNED)) AS max_number FROM ".$table." WHERE ".$column." != '' 
											AND DATE(tripsheet_date) >= '".$from_date."' AND DATE(tripsheet_date) <= '".$to_date."' AND from_branch_id = '".$current_record_id."' 
											AND ".$column." REGEXP '[0-9]+/[a-zA-Z]'";	
					}			
					//echo $select_query."<br>";
					$list = $this->getQueryRecords($table, $select_query);
					if(!empty($list)) {
						foreach($list as $data) {
							if(!empty($data['max_number'])) {
								$last_number = $data['max_number'];
							}
						}
					}
				}
			}
			if(!empty($last_number) && !empty($bill_rows)) {	 
				//echo "last_number - ".$last_number.", prefix - ".$prefix."<br>";
				if(preg_match("/^\d+$/", $last_number)) {
					$next_number = $last_number + 1;
				}
			}
			if(!empty($next_number) && !empty($prefix)) {
				$next_number = $next_number.$prefix;
			}
			//echo "next_number - ".$next_number."<br>";
			return $next_number;
		}
		public function getTableColumnValue($table, $column, $value, $return_value) {
			$con = $this->connect();
			$table_column_value = ""; $select_query = "";
			if(!empty($column) && !empty($value) && !empty($return_value)) {
				$select_query = "SELECT ".$return_value." FROM ".$table." WHERE ".$column." = '".$value."' AND deleted = '0'";
					
				//echo $select_query."<br>";
				if(!empty($select_query)) {
					$result = 0; $pdo = "";			
					$pdo = $con->prepare($select_query);
					$pdo->execute();	
					$result = $pdo->setFetchMode(PDO::FETCH_ASSOC);
					if(!empty($result)) {
						foreach($pdo->fetchAll() as $row) {
							$table_column_value = $row[$return_value];
						}
					}
				}
			}
			return $table_column_value;
		}
		public function getTableRecords($table, $column, $value) {
			$con = $this->connect();
			$result = ""; $select_query = "";
			if(!empty($table)) {
				if($table == 'user'){
					if(!empty($column) && !empty($value)) {		
						$select_query = "SELECT * FROM ".$table." WHERE ".$column." = '".$value."'  AND deleted = '0' ORDER BY id DESC";	
					}
					else if(empty($column) && empty($value)) {		
						$select_query = "SELECT * FROM ".$table." WHERE deleted = '0' ORDER BY id DESC";	
					}
				}
				else{
					if(!empty($column) && !empty($value)) {		
						$select_query = "SELECT * FROM ".$table." WHERE ".$column." = '".$value."' AND deleted = '0' ORDER BY id DESC";	
					}
					else if(empty($column) && empty($value)) {		
						$select_query = "SELECT * FROM ".$table." WHERE deleted = '0' ORDER BY id DESC";	
					}
				}
				
			}		
			//echo $select_query;
			if(!empty($select_query)) {
				$result = $this->getQueryRecords($table, $select_query);
			}
			return $result;
		}
		public function getQueryRecords($table, $select_query) {
			$con = $this->connect(); $list = array();
			if(!empty($select_query)) {
				$result = 0; $pdo = "";			
				$pdo = $con->prepare($select_query);
				$pdo->execute();	
				$result = $pdo->setFetchMode(PDO::FETCH_ASSOC);
				if(!empty($result)) {
					foreach($pdo->fetchAll() as $row) {
						$table_column_array = "";	
						$table_column_array = array_keys($row);			
						if(!empty($table_column_array)) {
							for($i = 0; $i < count($table_column_array); $i++) {
								if(!empty($table_column_array[$i])) {
									$column = $table_column_array[$i];
									if($table == 'product' && ($column == "name" || $column == "product_code" || $column == "description")){
										$row[$column] = $this -> encode_decode('decrypt',$row[$column]);
										if(strpos($row[$column], '[SA-AS]') !== false) {
											$row[$column] = str_replace('[SA-AS]', "+", $row[$column]);
										} 
										if(strpos($row[$column], '[KA-AK]') !== false) {
											$row[$column] = str_replace('[KA-AK]', '&', $row[$column]);
										}
										if(strpos($row[$column], '[SVL-VSL]') !== false) {
											$row[$column] = str_replace('[SVL-VSL]', '"', $row[$column]);
										}
										if(strpos($row[$column], '[SKK-KSK]') !== false) {
											$row[$column] = str_replace('[SKK-KSK]', "'", $row[$column]);
										}
										if(strpos($row[$column], '[KIKA-KAKI]') !== false) {
											$row[$column] = str_replace('[KIKA-KAKI]', '$', $row[$column]);
										} 
										if(strpos($row[$column], '[AKSL-LSKA]') !== false) {
											$row[$column] = str_replace('[AKSL-LSKA]', '#', $row[$column]);
										} 
										$row[$column] = $this -> encode_decode('encrypt',$row[$column]);
									}
									// $row[$column] = htmlentities($row[$column],ENT_QUOTES);
									// $row[$column] = html_entity_decode($row[$column]);
									
								}
							}
						}
						$list[] = $row;
					}
				}
			}
			return $list;
		}
		public function daily_db_backup() {
			$con = $this->connect();
			$backupAlert = 0; $backup_file = ""; $path = $GLOBALS['backup_folder_name']."/"; $file_name = ""; $dbname = $this->db_name;
			$tables = array();
			//$result = mysqli_query($con, "SHOW TABLES");
			$select_query = "SHOW TABLES";
			$result = 0; $pdo = "";			
			$pdo = $con->prepare($select_query);
			$pdo->execute();	
			$result = $pdo->fetchAll(PDO::FETCH_COLUMN); 
			if (!$result) {
				$backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($con) . 'ERROR NO :' . mysqli_errno($con);
			}
			else {
				$tables = array();
				foreach($result as $table_name) {
					if(!empty($table_name)) {
						$tables[] = $table_name;
					}
				}
				$output = '';
				if(!empty($tables)) {
					foreach($tables as $table) {
						if (strpos($table, $GLOBALS['table_prefix']) !== false) {
							$show_table_query = "SHOW CREATE TABLE " . $table . "";
							$statement = $con->prepare($show_table_query);
							$statement->execute();
							$show_table_result = $statement->fetchAll();
							foreach($show_table_result as $show_table_row) {
								$output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
							}
							$select_query = "SELECT * FROM " . $table . "";
							$statement = $con->prepare($select_query);
							$statement->execute();
							$total_row = $statement->rowCount();
							for($count=0; $count<$total_row; $count++) {
								$single_result = $statement->fetch(\PDO::FETCH_ASSOC);
								$table_column_array = array_keys($single_result);
								$table_value_array = array_values($single_result);
								$output .= "\nINSERT INTO $table (";
								$output .= "" . implode(", ", $table_column_array) . ") VALUES (";
								$output .= "'" . implode("','", $table_value_array) . "');\n";
							}
						}	
					}
				}
				if(!empty($output)) {
					$file_name = $dbname.'.sql';
					$backup_file = $path.$file_name;
					file_put_contents($backup_file, $output);
					if(file_exists($backup_file)) {
						$backupAlert = 1;
					}
				}
			}
			$msg = "";
			if(!empty($backupAlert) && $backupAlert == 1) {
				$msg = $backup_file;
			}
			else {
				$msg = $backupAlert;
			}
			return $msg;
		}
		public function image_directory() {
			$target_dir = "include/images/upload/";
			return $target_dir;
		}
		public function temp_image_directory() {
			$temp_dir = "include/images/temp/";
			return $temp_dir;
		}
		public function clear_temp_image_directory() {
			$temp_dir = "include/images/temp/";
			
			$files = glob($temp_dir.'*'); // get all file names
			foreach($files as $file){ // iterate files
			  if(is_file($file))
				unlink($file); // delete file
			}
			
			return true;
		}
		public function check_user_id_ip_address() {
			$con = $this->connect();
			$select_query = ""; $check_login_id = "";
			
			if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
				$select_query = "SELECT id FROM ".$GLOBALS['login_table']." WHERE user_id = '".$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']."' AND ip_address = '".$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_ip_address']."' AND logout_date_time = '0000-00-00 00:00:00' ORDER BY id DESC LIMIT 1";
				
				$result = 0; $pdo = "";			
				$pdo = $con->prepare($select_query);
				$pdo->execute();	
				$result = $pdo->setFetchMode(PDO::FETCH_ASSOC);
				if(!empty($result)) {
					foreach($pdo->fetchAll() as $row) {
						$check_login_id = $row['id'];
					}
				}
			}
			return $check_login_id;
		}
		public function checkUser() {
			$con = $this->connect();
			
			$user_id = "";
			if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
				$user_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];				
				$today = date('Y-m-d');	
				
				$select_query = "SELECT * FROM ".$GLOBALS['login_table']." WHERE user_id = '".$user_id."' AND DATE(login_date_time) = '".$today."' ORDER BY id DESC LIMIT 1";
				
				$result = 0; $pdo = "";			
				$pdo = $con->prepare($select_query);
				$pdo->execute();	
				$result = $pdo->setFetchMode(PDO::FETCH_ASSOC);
				if(!empty($result)) {
					foreach($pdo->fetchAll() as $row) {
						$login_user_id = $row['user_id'];
					}
				}
			}
			return $login_user_id;
		}
		public function getDailyReport($from_date, $to_date) {
            $log_list = array(); $select_query = ""; $where = "";
			$log_backup_file = $GLOBALS['log_backup_file'];
			if(file_exists($log_backup_file)) {
				$myfile = fopen($log_backup_file, "r");
				while(!feof($myfile)) {
					$log = "";
					$log = fgets($myfile);
					$log = trim($log);
					if(!empty($log)) {
						$log = json_decode($log);
						$log_list[] = $log;
					}
				}
				fclose($myfile);
				if(!empty($log_list)) {
					$list = array();
					foreach($log_list as $row) {							
						if(!empty($from_date) && !empty($to_date)) {
							$success = 0; $action = "";
							foreach($row as $key => $value) {								
								if( (!empty($key) && $key == "action")) {
									$action = $value;
								}
							}
							if(!empty($action)) {
								foreach($row as $key => $value) {
									if( (!empty($key) && $key == "created_date_time")) {
										if( ( date("d-m-Y", strtotime($value)) >= date("d-m-Y", strtotime($from_date)) ) && ( date("d-m-Y", strtotime($value)) <= date("d-m-Y", strtotime($to_date)) ) ) {
											$success = 1;										
										}
									}
								}
							}
							if(!empty($success) && $success == 1) {
								$list[] = $row;
							}
						}
					}
					$log_list = $list;
				}
			}
			return $log_list;
        }
		/*public function send_mobile_details($phone_number, $msg) {		
			$phone_number = '91'.$phone_number;
			$mailin = new MailinSms($GLOBALS['mailin_sms_api_key']);
			$mailin->addTo($phone_number);
			$mailin->setFrom('ram');
			$mailin->setText($msg);
			$mailin->setTag('');
			$mailin->setType('');
			$mailin->setCallback('');
			$res = $mailin->send();
			return $res;
		}*/
		public function send_mobile_details($mobile_number, $sms_number, $sms) {
            $res = true; $sms_link = "";
            if(!empty($mobile_number) && !empty($sms_number) && !empty($sms)) {
                $uid = "mohantransport"; $pwd = urlencode("20655"); $Peid = "1601968163067560686"; $tempid = $sms_number; $sender = urlencode("MOHNTP");
                $message = rawurlencode($sms); $numbers = $mobile_number; $dtTime = date('m-d-Y h:i:s A');
                $data = "&uid=".$uid."&pwd=".$pwd."&mobile=".$numbers."&msg=".$message."&sid=".$sender."&type=0"."&dtTimeNow=".$dtTime."&entityid=".$Peid."&tempid=".$tempid;
                $ch = curl_init("http://smsintegra.com/api/smsapi.aspx?");
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                //$sms_link = "https://www.fast2sms.com/dev/bulkV2?authorization=NmXuvhPO8nQ2bi6ZFMxYJdsL470jHlyqVEgfoU3wRAGp1BzCKcSlJyzk1LB8PiOjwMu3E6x9tCcNRWpG&route=dlt&sender_id=SRISOF&message=126873&variables_values=".$msg."|&flash=0&numbers=".$mobile_number;
                /*$fields = array(
                    "sender_id" => "SRISOF",
                    "message" => $sms_number,
                    "variables_values" => $sms,
                    "route" => "dlt",
                    "numbers" => $mobile_number,
                );
                
                //echo "sms_number - ".$sms_number.", mobile_number - ".$mobile_number.", sms - ".$sms."<br>";
                
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                 CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_ENCODING => "",
                 CURLOPT_MAXREDIRS => 10,
                 CURLOPT_TIMEOUT => 30,
                 CURLOPT_SSL_VERIFYHOST => 0,
                 CURLOPT_SSL_VERIFYPEER => 0,
                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                 CURLOPT_CUSTOMREQUEST => "POST",
                 CURLOPT_POSTFIELDS => json_encode($fields),
                 CURLOPT_HTTPHEADER => array(
                    "authorization: VFxWy81QjDk3S2b6qo0JRNHaYCcZs4nmA5Xl7KMuGtwpTIPiUBV6LM5aSg7x84mfP2XyJtshdoFGEBrK",
                    "cache-control: no-cache",
                    "content-type: application/json"
                 ),
                ));
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                
                curl_close($curl);*/
            }
            return $res;
        }
		public function getBillingYearList() {
			$list = array(); $select_query = ""; $year_list = array();
			$select_query = "SELECT YEAR(lr_date) as billing_year FROM ".$GLOBALS['lr_table']." GROUP BY YEAR(lr_date)";
			$list = $this->getQueryRecords($GLOBALS['lr_table'], $select_query);
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['billing_year'])) {
						$year_list[] = $data['billing_year'];
					}
				}
			}
			$year = date('Y'); $month = date("m");
			if(!empty($year) && !empty($month)) {
				$month = (int)$month;
				if($month <= 3) { $year = $year - 1; }
			}
			if(!empty($year) && !in_array($year, $year_list)) {
				$year_list[] = $year;
			}
			return $year_list;
		}
		public function getAllRecords($table, $column, $value) {
			$result = ""; $select_query = "";
			if(!empty($table)) {
				if($table == 'user'){
					if(!empty($column) && !empty($value)) {		
						$select_query = "SELECT * FROM ".$table." WHERE ".$column." = '".$value."' ORDER BY id DESC";	
					}
					else if(empty($column) && empty($value)) {		
						$select_query = "SELECT * FROM ".$table." ORDER BY id DESC";	
					}
				}
				else{
					if(!empty($column) && !empty($value)) {		
						$select_query = "SELECT * FROM ".$table." WHERE ".$column." = '".$value."' ORDER BY id DESC";	
					}
					else if(empty($column) && empty($value)) {		
						$select_query = "SELECT * FROM ".$table." ORDER BY id DESC";	
					}
				}
			}	
			if(!empty($select_query)) {
				$result = $this->getQueryRecords($table, $select_query);
			}
			return $result;
		}
		public function numberFormat($number, $decimals) {
			$is_negative = 0;
			if(strpos($number,'-') !== false) {
				$number = trim(substr($number, 1));
				$is_negative = 1;
			}
			$number = number_format($number, $decimals);
			$number = trim(str_replace(",", "", $number));
			
			if (strpos($number,'.') != null) {
				$decimalNumbers = substr($number, strpos($number,'.'));
				$decimalNumbers = substr($decimalNumbers, 1, $decimals);
			}
			else {
				$decimalNumbers = 0;
				for ($i = 2; $i <=$decimals ; $i++) {
					$decimalNumbers = $decimalNumbers.'0';
				}
			}    
			$number = (int) $number;
			// reverse
			$number = strrev($number);    
			$n = '';
			$stringlength = strlen($number);
		
			for ($i = 0; $i < $stringlength; $i++) {
				if ($i%2==0 && $i!=$stringlength-1 && $i>1) {
					$n = $n.$number[$i].',';
				}
				else {
					$n = $n.$number[$i];
				}
			}
		
			$number = $n;
			// reverse
			$number = strrev($number);
				
			($decimals!=0)? $number=$number.'.'.$decimalNumbers : $number ;
		
			$number = 'Rs.'.$number;
			if($is_negative == '1') {
				$number = '- '.$number;
			}
			return $number;
		}
		public function CompanyCount() {
			$select_query = ""; $list = array(); $count = 0;
			$select_query = "SELECT COUNT(id) as organization_count FROM ".$GLOBALS['organization_table']." WHERE deleted = '0'";
			$list = $this->getQueryRecords($GLOBALS['organization_table'], $select_query);
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['organization_count'])) {
						$count = $data['organization_count'];
						$count = trim($count);
					}
				}
			}
			return $count;
		}
		public function new_automate_number($table, $column) {
            $last_number = 0; $next_number = ""; $last_id_number = "";
            $prefix = "";
			
			if(!empty($table) && $table == $GLOBALS['voucher_table']) {
				$prefix = 'V';
			}
			if(!empty($table) && $table == $GLOBALS['receipt_table']) {
				$prefix = 'RCT';
			}
			if(!empty($table) && $table == $GLOBALS['expense_table']) {
				$prefix = 'EV';
			}
			if(!empty($table) && $table == $GLOBALS['suspense_voucher_table']) {
				$prefix = 'SV';
			}
			if(!empty($table) && $table == $GLOBALS['suspense_receipt_table']) {
				$prefix = 'SR';
			}
			if(!empty($table) && $table == $GLOBALS['invest_table']) {
				$prefix = 'IN';
			}
			if(!empty($table) && $table == $GLOBALS['return_table']) {
				$prefix = 'RN';
			}
			
            $current_year = date("y"); $next_year = date("y")+1;
            
            if(date("m") == date("01") || date("m") == date("02") || date("m") == date("03")) {
                $current_year = date("y") - 1; $next_year = date("y");
            }
			$bill_company_id = $GLOBALS['bill_company_id'];
            $select_query1 = "SELECT ".$column." as last_number FROM ".$table." where (".$column."!='".$GLOBALS['null_value']."' && ".$column."!='')  AND bill_company_id = '".$bill_company_id."' ORDER BY id DESC LIMIT 1";
            if(!empty($select_query1)) {
                $automate_number_list = array();
                $automate_number_list = $this->getQueryRecords($table, $select_query1);
                if(!empty($automate_number_list)) {
                    foreach($automate_number_list as $anumber) {
                        if(!empty($anumber['last_number']) && $anumber['last_number'] != $GLOBALS['null_value']) {
                            $last_number = $anumber['last_number'];
                            $last_id_number = $anumber['last_number'];
                        }
                    }
                }
            }
            
            if(strpos($last_number, '/') !== false){
                $last_number_array = array();
                $last_number_array = explode("/", $last_number);
                $last_number = $last_number_array[0];
				$last_number = trim($last_number);
                if(!empty($prefix)){
					if(!empty($table) && $table == $GLOBALS['voucher_table']) {
						$last_number = str_replace("V","",$last_number);
						$last_number = trim($last_number);
					}
					if(!empty($table) && $table == $GLOBALS['receipt_table']) {
						$last_number = str_replace("RCT","",$last_number);
						$last_number = trim($last_number);
					}
					if(!empty($table) && $table == $GLOBALS['expense_table']) {
						$last_number = str_replace("EV","",$last_number);
						$last_number = trim($last_number);
					}
					if(!empty($table) && $table == $GLOBALS['suspense_voucher_table']) {
						$last_number = str_replace("SV","",$last_number);
						$last_number = trim($last_number);
					}
					if(!empty($table) && $table == $GLOBALS['suspense_receipt_table']) {
						$last_number = str_replace("SR","",$last_number);
						$last_number = trim($last_number);
					}
					if(!empty($table) && $table == $GLOBALS['invest_table']) {
						$last_number = str_replace("IN","",$last_number);
						$last_number = trim($last_number);
					}
					if(!empty($table) && $table == $GLOBALS['return_table']) {
						$last_number = str_replace("RN","",$last_number);
						$last_number = trim($last_number);
					}
                }
                $next_number = $last_number + 1;
            }
            if(empty($last_number)){
                $next_number = 1;
            }
            if(!empty($next_number)) {
                if(date("m") == date("01") || date("m") == date("02") || date("m") == date("03")) {
                    $current_year = date("y") - 1; $next_year = date("y");
                }
                if(date("d-m-Y") >= date("01-04-Y")) {
                    if(strpos($last_id_number,($current_year.'-'.$next_year)) !== false){
                        
                    }
                    else{
                        $next_number = 1;
                    }
                }
                if(strlen($next_number) == "1"){
                    $next_number = '00'.$next_number;
                }
                else if(strlen($next_number) == "2"){
                    $next_number = '0'.$next_number;
                }
                
                if(!empty($prefix)) {
                    $next_number = $prefix.$next_number.'/'.$current_year.'-'.$next_year;
                }
                else{
                    $next_number = $next_number.'/'.$current_year.'-'.$next_year;
                }
            }
            return $next_number;
        }
		public function getOtherCityList($district) {
            $company_query = ""; $party_query = ""; $suspense_party_query = ""; $consignee_query = ""; $consignor_query = "";
            $select_query = ""; $list = array(); $account_party_query = ""; $branch_query ="";

            $company_query = "SELECT DISTINCT(city) as others_city FROM ".$GLOBALS['organization_table']." WHERE district = '".$district."' AND city != '".$GLOBALS['null_value']."' ORDER BY id DESC";
            
            $consignor_query = "SELECT DISTINCT(city) as others_city FROM ".$GLOBALS['consignor_table']." WHERE district = '".$district."' AND city != '".$GLOBALS['null_value']."' ORDER BY id DESC";

            $consignee_query = "SELECT DISTINCT(city) as others_city FROM ".$GLOBALS['consignee_table']." WHERE district = '".$district."' AND city != '".$GLOBALS['null_value']."' ORDER BY id DESC";

            $account_party_query = "SELECT DISTINCT(city) as others_city FROM ".$GLOBALS['account_party_table']." WHERE district = '".$district."' AND city != '".$GLOBALS['null_value']."' ORDER BY id DESC";

            $party_query = "SELECT DISTINCT(city) as others_city FROM ".$GLOBALS['party_table']." WHERE district = '".$district."' AND city != '".$GLOBALS['null_value']."' ORDER BY id DESC";

            $branch_query = "SELECT DISTINCT(branch_city) as others_city FROM ".$GLOBALS['branch_table']." WHERE district = '".$district."' AND branch_city != '".$GLOBALS['null_value']."' ORDER BY id DESC";

            $suspense_party_query = "SELECT DISTINCT(city) as others_city FROM ".$GLOBALS['suspense_party_table']." WHERE district = '".$district."' AND city != '".$GLOBALS['null_value']."' ORDER BY id DESC";

            $select_query = "SELECT DISTINCT(others_city) as city FROM ((".$company_query.") UNION ALL (".$party_query.") UNION ALL (".$suspense_party_query.") UNION ALL (".$consignor_query.") UNION ALL (".$consignee_query.") UNION ALL (".$account_party_query.") UNION ALL (".$branch_query.")) as g";

            $list = $this->getQueryRecords('', $select_query);

            return $list;
        }
		public function CheckRoleAccessPage($role_id, $permission_page) {
			$list = array(); $select_query = ""; $acccess_permission = 0;
			$select_query = "SELECT * FROM ".$GLOBALS['role_table']." WHERE role_id = '".$role_id."' AND deleted = '0'";
			$list = $this->getQueryRecords($GLOBALS['role_table'], $select_query);
			if(!empty($list)) {
				$access_pages = "";
				foreach($list as $data) {
					if(!empty($data['access_pages'])) {
						$access_pages = $data['access_pages'];
					}
				}

				if(!empty($access_pages)) {
					$access_pages = explode(",", $access_pages);
					if(!empty($permission_page)) {
						$permission_page = $this->encode_decode('encrypt', $permission_page);
						if(in_array($permission_page, $access_pages)) {
							$acccess_permission = 1;
						}
					}
				}
			}
			return $acccess_permission;
		}
	}	
?>