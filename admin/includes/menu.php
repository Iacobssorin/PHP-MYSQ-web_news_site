<?php
 
    if ( !isset($database_link))
    {
        die(header('location: index.php'));
    }

    
    echo '<ul class="nav nav-pills nav-stacked">';
    echo '<li><h2>Administrator</h2></li>';

   
    if ($_SESSION['user']['role_access'] > 10)
    {
        
        $active = ($page_backend == 'backend.php' ? ' class="active"' : '');
        echo '<li'.$active.'><a href="index.php">Admin</a></li>';

       
        $active = ($page_backend == 'users.php' ? ' class="active"' : '');
        echo '<li'.$active.'><a href="index.php?page=users">Utilizatori</a></li>';

        
        $active = ($page_backend == 'categories.php' ? ' class="active"' : '');
        echo '<li'.$active.'><a href="index.php?page=categories">Categorii</a></li>';

      
        $active = ($page_backend == 'editors.php' ? ' class="active"' : '');
        echo '<li'.$active.'><a href="index.php?page=editors">Redactor</a></li>';
    } elseif($_SESSION['user']['role_access'] <= 10)
    {
        $active = ($page_backend == 'backend.php' ? ' class="active"' : '');
        echo '<li'.$active.'><a href="index.php">Admin</a></li>';

        
        $active = ($page_backend == 'categories.php' ? ' class="active"' : '');
        echo '<li'.$active.'><a href="index.php?page=categories">Categorii</a></li>';
    }

   
    echo '<li ><a href="../index.php?page=login&amp;action=logout" onclick="return confirm(\'Sigur doriți să vă deconectați?\')">Log out <i class="icon-unlock"></i></a></li>';

   
    echo '<li><a href="../index.php" target="_blank">Vedeți postari <i class="icon-share-alt"></i></a></li>';


    echo '</ul>';

 
    if ($_SESSION['user']['role_access'] > 10)
    {
        echo '<ul class="nav nav-pills nav-stacked">';
        echo '<li><h2>Categorii Noutati</h2></li>';

        $query = "  SELECT category_id, category_title
					FROM categories
					ORDER BY category_title ASC";
        $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
        while ($category = mysqli_fetch_assoc($result))
        {
          
            $active = ($page_backend == 'news.php' && isset($_GET['category_id']) && $_GET['category_id'] == $category['category_id'] ? ' class="active"' : '');
            echo '<li'.$active.'><a href="index.php?page=news&amp;category_id='.$category['category_id'].'">'.$category['category_title'].'</a></li>';
        }
        echo '</ul><br />';
    } elseif($_SESSION['user']['role_access'] == 10)
    {
        $uid = $_SESSION['user']['user_id'];
        echo '<ul class="nav nav-pills nav-stacked">';
        echo '<li><h2>Categorii Noutati</h2></li>';

        $query = "  SELECT * FROM category_editors
                    JOIN users ON category_editors.fk_users_id=users.user_id
                    JOIN categories ON category_editors.fk_categories_id=categories.category_id
                    WHERE users.user_id=$uid ORDER BY category_title ASC";
        $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
        while ($category = mysqli_fetch_assoc($result))
        {
          
            $active = ($page_backend == 'news.php' && isset($_GET['category_id']) && $_GET['category_id'] == $category['category_id'] ? ' class="active"' : '');
            echo '<li'.$active.'><a href="index.php?page=news&amp;category_id='.$category['category_id'].'">'.$category['category_title'].'</a></li>';
        }
        echo '</ul><br />';
    }
?>
