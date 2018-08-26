<?php
  
    if ( !isset($database_link))
    {
        die(header('location: index.php'));
    }

  
    $query = "  SELECT news_id, news_title, news_content, news_postdate, category_id, category_title, user_name 
	            FROM news
	            INNER JOIN categories ON categories.category_id = news.fk_categories_id
	            INNER JOIN users ON users.user_id = news.fk_users_id
	            ORDER BY news_postdate DESC
	            LIMIT 5";
    $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
    if (mysqli_num_rows($result) <= 0)
    {
        
        echo '  <p class="alert alert-info">Nu există știri de afișat...</p>';
    }
    else
    {
       
        while ($row = mysqli_fetch_assoc($result))
        {
            $news_id = $row['news_id'];
            $news_title = $row['news_title'];
           
            $news_content = substr(strip_tags($row['news_content']), 0, 247).'...';
            
            $news_postdate = strftime('%d. %B %Y - %H:%M', strtotime($row['news_postdate']));
            $user_name = $row['user_name'];
            $category_id = $row['category_id'];
            $category_title = $row['category_title'];
            echo '
            		<section class="news_category">
                        <h3>'.$news_title.'</h3>
                        <p><a href="index.php?page=news&amp;category_id='.$category_id.'&amp;news_id='.$news_id.'">'.$news_content.'</a></p>
                        <em>de: '.$user_name.', in categoria: '.$category_title.', la data. '.$news_postdate.'</em><hr />
                    </section>';
        }
    }
?>