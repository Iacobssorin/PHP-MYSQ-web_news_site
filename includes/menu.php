<?php
   
    if ( !isset($database_link))
    {
        die(header('location: ../index.php'));
    }

    echo '<ul class="nav nav-pills">';

    
    $active = ($page_frontend == 'frontpage.php' ? $active = ' class="active"' : '');
    echo '<li'.$active.'><a href="index.php?page=frontpage">Acasa</a></li>';

   
    $active = ($page_frontend == 'contact.php' ? $active = ' class="active"' : '');
    echo '<li'.$active.'><a href="index.php?page=contact">Contact</a></li>';

    $query = "  SELECT category_id, category_title
                FROM categories
                ORDER BY category_title ASC";
    $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), __LINE__, __FILE__, $query);
    while ($row = mysqli_fetch_assoc($result))
    {
        $active = (isset($_GET['category_id']) && $_GET['category_id'] == $row['category_id'] ? ' class="active"' : '');
        echo '<li'.$active.'><a href="index.php?page=categories&amp;category_id='.$row['category_id'].'">'.$row['category_title'].'</a></li>';
		

		
    } 
  
	  
    if (isset($_SESSION['user']))
    {
	
		echo"<h4 style='color:blue'; position: relative;
    left: -20px;>Bine a-ti venit ".  $_SESSION['user']['user_name']."</h4>"
;		
	
	    //  echo "<h5 style='color:blue'; >Bine ai venit </h5>";  			 
		//echo "<h4 style='color:red'; >" .$_SESSION['user']['user_name']."</h4>"; 	
        echo '<li><a href="index.php?page=login&amp;action=logout" onclick="return confirm(\'Sigur doriți să vă deconectați?\')">Logut <i class="icon-unlock"></i></a></li>';

        if ($_SESSION['user']['role_access'] >= 10)
        {
            echo '<li><a href="admin/index.php">Administrator <i class="icon-cogs"></i></a></li>';
        }
    }
    else
    {
       
        $active = ($page_frontend == 'login.php' ? ' class="active"' : '');
        echo '<li'.$active.'><a href="index.php?page=login">Login <i class="icon-lock"></i></a></li>';
    }

	

    echo '</ul>';
?>
