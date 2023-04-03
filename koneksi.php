<?php
    class Koneksi{
        public function DBConnect(){
			$dbhost = 'localhost'; // set the hostname
			$dbname = 'kelompok3'; // set the database name
			$dbuser = 'userkelompok3'; // set the mysql username
            $dbpass = 'passkelompok3';  // set the mysql password

			try {
				$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
				$dbConnection->exec("set names utf8");
                $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return  $dbConnection;
			}
			catch (PDOException $e) {
				return 'Connection failed: ' . $e->getMessage();
			}
		}
	}
?>
