<?php
    
    if ( !isset($database_link))
    {
        die(header('location: ../index.php'));
    }

   
    if (isset($_GET['page']))
    {
        $allowed_pages_frontend = array(
            'categories',
            'contact',
            'frontpage',
            'login',
            'news',
			'coment'
        );
        
        if (in_array($_GET['page'], $allowed_pages_frontend))
        {
           
            $page_frontend = $_GET['page'].'.php';
        }
        else
        {
            
            die(header('location: index.php'));
        }

    }
?>