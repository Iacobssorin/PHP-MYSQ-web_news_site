<?php
	// $dbhost='localhost';
	// $dbuser='root';
	// $dbpass='';
	// $db='php5test_db';
	// $conn=mysql_connect($dbhost,$dbuser,$dbpass) or die ('cannot connect to db');
	// mysql_select_db($db) or die ('no database');
	// //echo "Sucessful Connection";
try{
	$dbh = new PDO("mysql:host=localhost;dbname=web_aplication", 'root', '');
}catch (PDOException $e){
	echo $e->getMessage();
}
//set class
$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );  
$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );  
$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 

?> 