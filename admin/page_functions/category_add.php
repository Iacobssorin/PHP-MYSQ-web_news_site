<?php
    
    if ( !isset($database_link))
    {
        die(header('location: index.php?page=categories'));
    }

    $category_title = '';
    $category_description = '';

    if (isset($_POST['category_submit']))
    {
        
        $form_ok = true;

        $category_title = mysqli_real_escape_string($database_link, $_POST['category_title']);
        $category_description = mysqli_real_escape_string($database_link, $_POST['category_description']);

        if ($category_title == '')
        {
            $form_ok = false;
            echo '<p class="alert alert-error">Completați titlul</p>';
        }

        
        if ($form_ok)
        {
            $query = "
				INSERT INTO categories
					(category_title, category_description)
				VALUES
					('$category_title','$category_description')";
            $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
            include '../feeds/feedGen.php';
          
            if ($result)
            {
                $_SESSION['message'] .= 'Categoria a fost creată<br />';
                die(header('location: index.php?page=categories'));
            }
        }
    }
?>
<div class="col-lg-6">
    <form method="post" role="form">
        <div class="form-group">
            <label for="category_title"> Titlu Categorie</label>
            <input type="text" class="form-control" name="category_title" id="category_title" placeholder="Titlu Categorie" value="<?php echo $category_title; ?>" maxlength="32" required>
        </div>
        <div class="form-group ">
            <label for="category_description">Descriere</label>
            <input type="text" class="form-control" name="category_description" id="category_description" placeholder="Descriere" value="<?php echo $category_description; ?>" maxlength="200" />
        </div>
        <input type="submit" class="btn btn-success" name="category_submit" value="Salveaza" />
        <a href="index.php?page=categories" class="btn btn-default" onclick="return confirm('Sigur doriți să anulați?')">Annuleaza</a>
    </form>
</div>
