<?php
    
    if ( !isset($database_link))
    {
        die(header('location: index.php?page=categoriii'));
    }

    
    if($_SESSION['user']['role_access'] === 10)
    {
        $uid = $_SESSION['user']['user_id'];
        $cid = $_GET['category_id'];
        $permcheck = mysqli_query($database_link, "SELECT * FROM category_editors WHERE fk_users_id='$uid' AND fk_category_id='$cid'");
        if(mysqli_num_rows($permcheck) < 1) {
            header("Location: index.php");
        }
    }
   

    echo '<h2>Categorie Administrator</h2>';

  
    if (isset($_GET['action']))
    {
        switch($_GET['action'])
        {
            case 'add' :
                include ('page_functions/category_add.php');
                break;
            case 'edit' :
                include ('page_functions/category_edit.php');
                break;
            case 'delete' :
                include ('page_functions/category_delete.php');
                break;
        }
    }
    else
    {
        
        include ('page_functions/category_list.php');
    }
?>

