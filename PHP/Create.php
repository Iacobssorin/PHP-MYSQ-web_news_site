<?php
	include 'connection.php';
	// $name=$_REQUEST[name];
	// $comment=$_REQUEST[comment];
	// mysql_query("INSERT INTO info (ID,Name,Comment) VALUES (NULL,'$name','$comment')");
	// echo 'Item has been added!';
	$sth = $dbh->prepare("INSERT INTO info (Name,Comment,Date_Created) VALUES (?,?,?)");
	$sth->bindParam(1,$name);
	$sth->bindParam(2,$comment);
	$sth->bindParam(3,$raw);
	
	$name=$_REQUEST[name];
	$comment=$_REQUEST[comment];
	$raw=date('l')." ".date('m-d-Y H:i');
    $sth->execute();
?>