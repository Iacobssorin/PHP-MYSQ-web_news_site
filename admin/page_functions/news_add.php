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

    $news_title = '';
    $news_content = '';
    $user_id = $_SESSION['user']['user_id'];

  
    if (isset($_POST['news_submit']))
    {
        $form_ok = true;

        
        $news_title = mysqli_real_escape_string($database_link, $_POST['news_title']);
        $news_content = mysqli_real_escape_string($database_link, $_POST['news_content']);

       
        if ($news_title == '')
        {
            $form_ok = false;
            echo '<p class="alert alert-error">Completați titlul</p>';
        }
        if ($news_content == '')
        {
            $form_ok = false;
            echo '<p class="alert alert-error">Completați textul postari</p>';
        }

        //
        if ($form_ok)
        {
            $query = "
				INSERT INTO news
					(news_title, news_content, news_postdate, fk_users_id, fk_categories_id)
				VALUES
					('$news_title','$news_content', NOW(), '$user_id', '$category_id')";
            $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
           
            if ($result)
            {
                $_SESSION['message'] .= 'Postarea a fost creată<br />';
                include '../feeds/feedGen.php';
            }
        }
    }
?>
<div class="col-lg-12">
    <form method="post" role="form">
        <div class="form-group">
            <label for="news_title">Titlu Postare</label>
            <input type="text" class="form-control" name="news_title" id="news_title" placeholder="Titlu Postare" value="<?php echo $news_title; ?>" maxlength="64" required>
        </div>
        <div class="form-group ">
            <label for="news_content">Text Postare</label>
            <textarea class="form-control" name="news_content" id="news_content" placeholder="Text Postare" rows="10" required><?php echo $news_content; ?></textarea>
            <script>
                CKEDITOR.replace('news_content');
            </script>
        </div>
        <div class="form-group">
            <label for="category_id">Categorie</label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="0">Alegeți categoria</option>
                <?php
                    if($_SESSION['user']['role_access'] == 10) {
                        $query = "  SELECT * FROM category_editors
                                    JOIN users ON category_editors.fk_users_id=users.user_id
                                    JOIN categories ON category_editors.fk_categories_id=categories.category_id
                                    WHERE users.user_id=$uid ORDER BY category_title ASC";
                        $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
                        if (mysqli_num_rows($result) > 0)
                        {
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                $selected = ($category_id == $row['category_id'] ? ' selected="selected"' : '');
                                echo '<option value="'.$row['category_id'].'"'.$selected.'>'.$row['category_title'].'</option>';
                            }
                        }
                    } elseif($_SESSION['user']['role_access'] > 10) {
                        $query = "SELECT category_id, category_title FROM categories ORDER BY category_title ASC";
                        $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
                        if (mysqli_num_rows($result) > 0)
                        {
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                $selected = ($category_id == $row['category_id'] ? ' selected="selected"' : '');
                                echo '<option value="'.$row['category_id'].'"'.$selected.'>'.$row['category_title'].'</option>';
                            }
                        }
                    }
                ?>
            </select>
        </div>
        <input type="submit" class="btn btn-success" name="news_submit" value="Salveaza" />
        <a href="index.php?page=news&amp;category_id=<?php echo $category_id; ?>" class="btn btn-default" onclick="return confirm('Sigur doriți să anulați?')">Annuleaza</a>
    </form>
</div>
