<?php 
	class Database {
		
		private $_host;
		private $_user;
		private $_pass;
		private $_dbname;
		
		public function __construct( $host, $user, $pass, $dbname ) {
			$this -> _host = $host;
			$this -> _user = $user;
			$this -> _pass = $pass;
			$this -> _dbname = $dbname;
		}
		
		public function get_connection() {
			try {
				$conn = new PDO( "mysql:host=" . $this -> _host . "; dbname=" . $this -> _dbname . "; charset=utf8", $this -> _user, $this -> _pass );
				$conn -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				return $conn;
			}
			catch ( PDOException $e ) {
				return $e -> getMessage();
			}
		}
		
		public function get_server() {
			try {
				$conn = new PDO( "mysql:host=" . $this -> _host . "; charset=utf8", $this -> _user, $this -> _pass );
				$conn -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				return $conn;
			}
			catch ( PDOException $e ) {
				return $e -> getMessage();
			}
		}
		
		public function create_database( $dbName ) {
			$sql = "CREATE SCHEMA IF NOT EXISTS " . $dbName . " CHARACTER SET utf8 COLLATE utf8_unicode_ci;";
			$server = $this -> get_server();
			$query = $server -> prepare( $sql );
			$r = $query -> execute();
			
			if( $r )
				return true;
			return false;
		}
		
		public function build_tables( $sqlFile ) {
			//Khai báo mảng chứa tất cả các câu lệnh sql
			$sqlArr = array();
			
			//Đọc file sql và đưa vô mảng
			$lines = file( $sqlFile, FILE_SKIP_EMPTY_LINES );
			
			$count = count( $lines );
			
			//Gỡ bỏ comments
			for( $i = 0; $i < $count ; $i++ ) {
				if( strpos( $lines[$i], '#' ) !== false ) {
					$start = strpos( $lines[$i], '#' );
					$lines[$i] = substr( $lines[$i], 0, $start );
				}
			}
			
			//Reindexing $lines
			$lines = array_values( $lines );
			$count = count( $lines );
			
			//Gỡ bỏ hàng trống
			for( $i = 0; $i < $count ; $i++ ) {
				//Gỡ bỏ comments
				if( empty( trim( $lines[$i] ) ) ) {
					unset( $lines[$i] );
				}
			}
			//Reindexing $lines
			$lines = array_values( $lines );
		
			$offsets = array();
			//Tách lệnh dựa theo dấu chấm phẩy
			for( $i = 0; $i < count( $lines ) ; $i++ ) {
				if( strpos( $lines[$i], ';' ) !== false ) {
					$offsets[] = $i;
				}
			}
			
			for( $i = 0; $i < count( $offsets ) ; $i++ ) {
				$sql = '';
				if( $i == 0 ) {
					for( $j = 0; $j <= $offsets[$i]; $j++ ) {
						$sql .= $lines[$j];
					}
					$sqlArr[] = $sql;
				}
				
				if( $i <> 0 ) {
					for( $j = (int)$offsets[$i - 1] + 1; $j <= $offsets[$i]; $j++ ) {
						$sql .= $lines[$j];
					}
					$sqlArr[] = $sql;
				}
			}
			
			//Tạo db
			//$database = new Database( $this -> _host, $this -> _user, $this -> _pass, $this -> _dbname );
			$conn = $this -> get_connection();
			$r = false;
			foreach( $sqlArr as $sql ) {
				$query = $conn -> prepare( $sql );
				$r = $query -> execute();
			}
			if( $r )
				return true;
			return false;
		}
	}
?>