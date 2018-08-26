<?php
  
    if ( !isset($database_link))
    {
        die(header('location: index.php?page=users'));
    }

  
    if ( !isset($_GET['user_id']))
    {
        die(header('location: index.php?page=users'));
    }

 
    $user_id = ($_GET['user_id'] * 1);

    $query = "DELETE FROM users WHERE user_id = $user_id";
   
    if (mysqli_query($database_link, $query))
    {
        $_SESSION['message'] .= 'Utilizatorul a fost șters<br />';
        die(header('location: index.php?page=users'));
    }
    else
    {
       
        echo format_error_message(mysqli_error($database_link), $query, __LINE__, __FILE__);
    }
?>

