<?php
 
    if ( !isset($database_link))
    {
        die(header('location: index.php?page=categories'));
    }

   
    if ( !isset($_GET['category_id']))
    {
        die(header('location: index.php?page=categories'));
    }

  
    $category_id = ($_GET['category_id'] * 1);

    $result = mysqli_fetch_assoc(mysqli_query($database_link, "SELECT * FROM categories WHERE category_id = $category_id"));

    $name = $result['category_title']; 

    $file = "../feeds/feed_".$name.".xml";

    unlink($file);

    $query = "DELETE FROM categories WHERE category_id = $category_id";
  
    if (mysqli_query($database_link, $query))
    {
        
        $_SESSION['message'] .= 'Categoria a fost ștearsă<br />';
        die(header('location: index.php?page=categories'));
    }
    else
    {
      
        echo format_error_message(mysqli_error($database_link), $query, __LINE__, __FILE__);
    }
?>

