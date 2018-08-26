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
        if ($category_description == '')
        {
            $form_ok = false;
            echo '<p class="alert alert-error">Completați descrierea</p>';
        }

        
        if ($form_ok)
        {
            $query = "
            	UPDATE categories SET
            		category_title='$category_title'
            		, category_description = '$category_description'
				WHERE
					category_id = $category_id";
            $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
            include '../feeds/feedGen.php';
         
            if ($result)
            {
                $_SESSION['message'] .= 'Categoria a fost actualizată<br />';
                die(header('location: index.php?page=categories'));
            }
        }
    }
    else
    {
        $query = "SELECT category_title, category_description FROM categories WHERE category_id = $category_id";
        $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
        if ($row = mysqli_fetch_assoc($result))
        {
            $category_title = $row['category_title'];
            $category_description = $row['category_description'];
        }
    }
?>

<div class="col-lg-6">
	<form method="post" role="form">
		<div class="form-group">
			<label for="category_title"> Titlu Categorie</label>
			<input type="text" class="form-control" name="category_title" id="category_title" placeholder="Titlu Categorie" value="<?php echo $category_title; ?>" maxlength="32" required>
		</div>
		<div class="form-group">
			<label for="category_description">descriere</label>
			<input type="text" class="form-control" name="category_description" id="category_description" placeholder="descriere" value="<?php echo $category_description; ?>" maxlength="200" />
		</div>
		<input type="submit" class="btn btn-success" name="category_submit" value="Salveaza" />
		<a href="index.php?page=categories" class="btn btn-default" onclick="return confirm('Sigur doriți să anulați?')">Annuleaza</a>
	</form>
</div>
