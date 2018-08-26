 <?php

    if ( !isset($database_link))
    {
        die(header('location: index.php?page=categories'));
    }

   
    if ( !isset($_GET['category_id']))
    {
       
        echo '<p class="alert alert-info"><strong>INFO</strong> Nu a fost selectată nicio categorie...</p>';
    }
    else
    {
        $news_pr_page = 5;
        $current_page = 1;
        if (isset($_GET['pagenr']) && is_int($_GET['pagenr'] * 1))
        {
            $current_page = ($_GET['pagenr'] * 1);
        }
        $category_id = ($_GET['category_id'] * 1);
        $offset = ($current_page - 1) * $news_pr_page;
        $query = "SELECT news_id, news_title, news_content, news_postdate, user_name
                    FROM news
                    INNER JOIN categories ON category_id = news.fk_categories_id
                    INNER JOIN users ON user_id = news.fk_users_id
                    WHERE news.fk_categories_id = $category_id
                    ORDER BY news_postdate DESC
                    LIMIT $news_pr_page OFFSET $offset";
        $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);

        if (mysqli_num_rows($result) <= 0)
        {
           
            echo '<p class="alert alert-info"><strong>INFO</strong> Nu a fost creată nicio știre în această categorie...</p>';
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

                echo '  <section class="news_category">
                            <h3>'.$news_title.'</h3>
                            <p>
                                <a href="index.php?page=news&amp;category_id='.$category_id.'&amp;news_id='.$news_id.'">'.$news_content.'</a>
                            </p>
                            <em>'.$user_name.' - '.$news_postdate.'</em><hr />
                        </section>';
            }


            $query = "SELECT COUNT(news_id) AS numar FROM news WHERE fk_categories_id = '$category_id'";
            $result = mysqli_query($database_link, $query) or die;
            $row = mysqli_fetch_assoc($result);
            $news_in_category = $row['numar'];
            $total_pages = ceil($news_in_category / $news_pr_page);

            echo '<ul class="pagination">';
            for ($i = 1; $i <= $total_pages; $i++)
            {
                $active = ($current_page == $i ? 'class="active"' : '');
                $href = "?page=categories&category_id=$category_id&amp;pagenr=$i";
                echo "<li $active><a href='$href'>$i</a></li>";
            }
            echo '</ul>';

    
            $query = "  SELECT category_title
                        FROM categories
                        WHERE category_id = $category_id";
            $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
            $row = mysqli_fetch_assoc($result);
            echo '  <div class="bottom">
                        <ul class="breadcrumb">
                            <li><a href="feeds/feed_'.$row["category_title"].'.xml" title="RSS Feed" target="_blank"><i class="icon-rss"></i></a></li>
                            <li><a href="index.php?page=frontpage">Acasa</a></li>
                            <li class="active">'.$row['category_title'].'</li>
                        </ul>
                    </div>';
        }
    }
?>
