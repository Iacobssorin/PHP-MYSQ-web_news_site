<?php
  
    if ( !isset($database_link))
    {
        die(header('location: ../index.php'));
    }

   
    if (isset($_GET['page']))
    {
       
        $allowed_pages_backend = array(
            'backend',
            'categorii',
            'editors',
            'users',
            'news'
        );
        
        if (in_array($_GET['page'], $allowed_pages_backend))
        {
           
            $page_backend = $_GET['page'].'.php';
        }
        else
        {
            
            die(header('location: index.php'));
        }
    }
?>