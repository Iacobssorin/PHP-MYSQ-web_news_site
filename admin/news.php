<?php
   
    if ( !isset($database_link))
    {
        die(header('location: index.php?page=news'));
    }

   

    if (isset($_GET['category_id']))
    {
        $category_id = ($_GET['category_id'] * 1);
        if($_SESSION['user']['role_access'] === 10) {
            $uid = $_SESSION['user']['user_id'];
            $chrights = mysqli_query($database_link, "SELECT * FROM category_editors WHERE fk_categories_id=$category_id AND fk_users_id=$uid");
            if(mysqli_num_rows($chrights) === 0) {
                header("Location: index.php");
            }
        }
        $category_title = 'Noutati';
        $query = "SELECT category_title FROM categories WHERE category_id = '$category_id'";
        $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            $category_title = $row['category_title'];
        }
        echo '<h2>'.$category_title.'Noutati</h2>';
    }
    else
    {
        echo '<h2> Administrare Noutati</h2>';
    }

  
    if (isset($_GET['action']))
    {
        switch($_GET['action'])
        {
            case 'add' :
                include ('page_functions/news_add.php');
                break;
            case 'edit' :
                include ('page_functions/news_edit.php');
                break;
            case 'delete' :
                include ('page_functions/news_delete.php');
                break;
        }
    }
    else
    {
       
        include ('page_functions/news_list.php');
    }
?>
