<?php
	include 'connection.php';
	$sth = $dbh->query('SELECT * FROM info ORDER BY ID DESC');  
	$sth->setFetchMode(PDO::FETCH_ASSOC);  
?>
<?php
while($rows = $sth->fetch()) { 
?>

	<li id='msg<?php echo $rows['ID']; ?>'>
		<closetab id='<?php echo $rows['ID']; ?>' class="close" onclick="deleteMsg(<?php echo $rows['ID']; ?>)">X</closetab>
		<h2><span><?php echo $rows['Comment']; ?></span></h2>
		<h4><span>Data: <?php echo $rows['Date_Created']; ?></span></h4>
		<h4><span>Expeditor: <?php echo $rows['Name']; ?></span></h4>
	</li>
<?php
}
?>






