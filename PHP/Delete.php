<?php
header('Content-type: text/html');
header('Access-Control-Allow-Origin: *');

  include 'connection.php';
  $sql = "DELETE FROM info WHERE ID =  :delID";
  $sth = $dbh->prepare($sql);
  $sth->bindParam(':delID', $_GET['deleteItem'], PDO::PARAM_INT);   
  $sth->execute();
?>