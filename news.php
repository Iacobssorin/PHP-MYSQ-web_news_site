<?php
  
    if ( !isset($database_link))
    {
        die(header('location: index.php?page=news'));
    }

   
    if ( !isset($_GET['news_id']))
    {
        echo '  <p class="alert alert-info">
                    <strong>INFO</strong> Nu a fost selectată nicio știre... 
                    <a href="index.php?page=frontpage" class="btn btn-primary">Accesați pagina principală</a>
                </p>';
    }
    else
    {
     
        $query = "  SELECT news.*, user_name 
                    FROM news
                    INNER JOIN users ON user_id = news.fk_users_id 
                    WHERE news_id = ".($_GET['news_id'] * 1);
        $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);

     
        if (mysqli_num_rows($result) <= 0)
        {
            echo '  <p class="alert alert-info">
                        <strong>INFO</strong> Știrile solicitate nu au putut fi găsite... 
                        <a href="index.php?page=frontpage" class="btn btn-primary">Accesați pagina principală</a>
                    </p>';
        }
        else
        {
         
            $row = mysqli_fetch_assoc($result);
            echo '  <h1>'.$row['news_title'].'</h1>
                    '.$row['news_content'].'<br /><br />
                    <em class="text-muted">Scris de: '.$row['user_name'].', in: '.$row['news_postdate'].'</em>';
          
            $news_title = $row['news_title'];

            $query = "  SELECT category_title 
                        FROM categories 
                        WHERE category_id = ".($_GET['category_id'] * 1);
            $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
            $row = mysqli_fetch_assoc($result);
            echo '  <div class="bottom">
                        <ul class="breadcrumb">
                            <li><a href="index.php?page=frontpage">Home</a></li>
                            <li><a href="index.php?page=categories&amp;category_id='.$_GET['category_id'].'">'.$row['category_title'].'</a></li>
                            <li class="active">'.$news_title.'</li>
                        </ul>
                    </div>';
        }
    }
?>