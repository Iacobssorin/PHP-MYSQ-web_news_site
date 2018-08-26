<?php
 
    if ( !isset($database_link))
    {
        die(header('location: index.php?page=news'));
    }

    if ( !isset($_GET['category_id']))
    {
        die(header('location: index.php?page=news'));
    }
    $category_id = ($_GET['category_id'] * 1);

    if ( !isset($_GET['news_id']))
    {
        die(header('location: index.php?page=news&category_id='.$category_id));
    }
    $news_id = ($_GET['news_id'] * 1);

    $query = "DELETE FROM news WHERE news_id = $news_id";
   
    if (mysqli_query($database_link, $query))
    {
      
        $_SESSION['message'] .= 'Postarea a fost ștearsă<br />';
        require '../feeds/feedGen.php';
    }
    else
    {
       
        echo format_error_message(mysqli_error($database_link), $query, __LINE__, __FILE__);
    }
?>

