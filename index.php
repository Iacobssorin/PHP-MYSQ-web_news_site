<?php
    
    ob_start();
   
    session_start();

   
    error_reporting(E_ALL);
   
    setlocale(LC_ALL, "romanian");
    require_once ('assets/database_connection.php');
   
    require_once ('assets/functions.php');

    
    $page_frontend = 'frontpage.php';

    require_once ('includes/page_frontend.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Web Application</title>
        <!-- http://www.bootstrapcdn.com/ -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.no-icons.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/bootswatch/3.0.0/flatly/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/frontend.css" rel="stylesheet" type="text/css" />
		
		<a href="./" class="f_left logo"><img src="assets/images/logo_main.png" alt=""></a>
		
    </head>
	
    <body>
        <div class="container wrapper">
            <header>
                <h1>Web Application</h1>
            </header>

            <nav class="top">
                <?php
                    
                    include ('includes/menu.php');
                ?>
            </nav>

            <section>
                <?php
                    
                    include ($page_frontend);
                ?>
            </section>
				
	<form action="index.html" method="POST">

		<input type="submit" value="Adauga un comentariu" name="save"/>
	</form>
		<div class="social">
			<h2>social</h2>
			<ul>
				<li><a href="http://delicious.com/">delicious</a></li>
				<li><a href="http://digg.com/">digg</a></li>
				<li><a href="http://facebook.com/">Facebook</a></li>
				<li><a href="http://www.last.fm">last.fm</a></li>
				<li><a href="http://website.com/feed/" rel="alternate">rss</a></li>
				<li><a href="http://twitter.com/">twitter</a></li>
			</ul>
		</div>
		  
          
            </section>
           <footer class="footer footer-main">
  <!--copyright part-->
  <div class="footer_bottom_part">
	<div class="container clearfix">
	  <p>&copy; <?php echo Date("Y") ?> Iacob Sorin Cristian.</p>
	</div>
  </div>
</footer>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  
    </body>
</html>

