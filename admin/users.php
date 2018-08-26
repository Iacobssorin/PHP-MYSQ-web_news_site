<?php
  
    if ( !isset($database_link))
    {
        die(header('location: index.php?page=users'));
    }

    echo '<h2> Administrare Utilizator</h2>';


    if (isset($_GET['action']))
    {
        switch($_GET['action'])
        {
            case 'add' :
                include ('page_functions/user_add.php');
                break;
            case 'edit' :
                include ('page_functions/user_edit.php');
                break;
            case 'delete' :
                include ('page_functions/user_delete.php');
                break;
        }
    }
    else
    {
       
        include ('page_functions/user_list.php');
    }
?>