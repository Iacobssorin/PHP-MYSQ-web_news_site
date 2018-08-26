<?php
    
    ob_start();
 
    session_start();
  
    error_reporting(E_ALL);
    
    require_once ('../assets/database_connection.php');
   
    require_once ('../assets/functions.php');


  
    if ( !isset($_SESSION['user']))
    {
        die('<p class="alert alert-danger">
                 <strong>ATENȚIE</strong> Trebuie să fiți conectat ;, pentru a vedea această pagină.
                 <a href="../index.php?page=login" class="btn btn-primary"> Apasati pentru a vă conecta</a>
             </p>');
    }

  
    if ($_SESSION['user']['role_access'] < 10)
    {
        die('<p class="alert alert-danger">
                 <strong>ATENȚIE</strong>Trebuie sa fi moderator sau administrator pentru a vedea această pagină.
                 <a href="../index.php?page=login" class="btn btn-primary">Apasati pentru a vă loga</a>
             </p>');
    }

   
    $page_backend = 'backend.php';
   
    require_once ('includes/page_backend.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<title>Web Application</title>
		<!-- http://www.bootstrapcdn.com/ -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.no-icons.min.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/bootswatch/3.0.0/slate/bootstrap.min.css" rel="stylesheet">
		<!-- Særlige styles der overskriver Bootstrap -->
		<link href="../assets/css/backend.css" rel="stylesheet" type="text/css" />
        <script src="../assets/ckeditor/ckeditor.js"></script>
        <style>
            .flex-row {
                display: flex !important;
                align-items: center !important;
            }
        </style>
	</head>
	<body>
		<div class="container">
			<header>
				<h1 class="well">Administrare WebApplication</h1>
			</header>

			<div class="row">
				<nav class="col-lg-3 ">
					<?php
                      
                        include ('includes/menu.php');
					?>
				</nav>

				<section class="col-lg-9">
					<?php
                        
                        include ($page_backend);

                      
                        if (isset($_SESSION['message']))
                        {

                            echo '
                            	<div class="alert alert-info alert-dismissable">
                            		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            		<p>'.$_SESSION['message'].'</p>
                        		</div>';
                           
                            unset($_SESSION['message']);
                        }
					?>
				</section>
			</div>

			<footer>
				<p>
					 News - <?php echo date('Y');?>
				</p>
			</footer>
		</div>
	
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	</body>
</html>
