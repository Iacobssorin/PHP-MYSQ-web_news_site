<?php
  
    if ( !isset($database_link))
    {
        die(header('location: index.php?page=editors'));
    }
?>

<h2> Administrare postari</h2>
<?php 
	if(isset($_POST['choose'])) {
		$_SESSION['category_id'] = $_POST['category_id'];
	}
	if(isset($_SESSION['category_id'])) {
		$category_id = $_SESSION['category_id'];
	}
?>
<form class="form-inline" method="post">
	<div class="form-group">
		<select class="form-control" name="category_id">
			<?php 
				$query = "SELECT * FROM categories";
				$result = mysqli_query($database_link, $query);
				while($row = mysqli_fetch_assoc($result)):
				$selected = ($category_id == $row['category_id'] ? ' selected="selected"' : '');
			?>
			<option value="<?= $row['category_id']; ?>" <?= $selected; ?>><?= $row['category_title']; ?></option>
			<?php
				endwhile;
			?>
		</select>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="choose" value="Alege">
	</div>
</form>
 <div class="panel panel-info">
	<p class="panel-heading">
		Trebuie să faceți asta 
	</p>
	<div class="panel-body">
		<ul>
			<li>
				Fiecare editor trebuie să aibă acces la una sau mai multe categorii.
			</li>
			<li>
				Dacă o categorie este ștearsă, atunci și accesul editorului trebuie eliminat
			</li>

		</ul>
	</div>
</div> 
<?php 
	if(isset($_POST['editors'])) {
		if (isset($_POST['not_editor']) && is_array($_POST['not_editor']))
		{
			foreach ($_POST['not_editor'] as $user)
			{
				$user = ($user * 1);  
				$query = "INSERT INTO category_editors VALUES($user ,$category_id  )";
				mysqli_query($database_link, $query) or die(mysqli_error($database_link));
			}
		}
		if (isset($_POST['is_editor']) && is_array($_POST['is_editor']))
		{
			foreach ($_POST['is_editor'] as $user)
			{
				$user = ($user * 1); 
				$query = "  DELETE FROM category_editors
							WHERE fk_users_id = $user
							AND fk_categories_id = $category_id";
				mysqli_query($database_link, $query) or die(mysqli_error($database_link));
			}
		}
	}
?>
<form method="post" class="row flex-row">
	<div class="col-md-5">
		<h3>Nu sunt autori</h3>
		<select class="form-control" name="not_editor[]" multiple="multiple" size="20">
			<?php 
				$query = "SELECT user_id, user_name FROM users WHERE user_id NOT IN (SELECT fk_users_id FROM category_editors WHERE fk_categories_id = '$category_id') AND fk_roles_id = 3";
				$result = mysqli_query($database_link, $query) or die(mysqli_error($database_link));
				while ($row = mysqli_fetch_assoc($result))
				{
					echo '<option value="'.$row['user_id'].'">'.$row['user_name'].'</option>';
				}
			?>
		</select>
	</div>
	<div class="col-md-2">
		<h3></h3>
		<div class="form-group">
			<button type="submit" name="editors" class="btn btn-lg btn-block btn-success">
				<span class="glyphicon glyphicon-refresh"></span>
			</button>
		</div>
	</div>
	<div class="col-md-5">
		<h3>Admin</h3>
		<select class="form-control" name="is_editor[]" multiple="multiple" size="20">
			<?php
				$query = "SELECT user_id, user_name FROM users INNER JOIN category_editors ON fk_users_id = user_id WHERE fk_categories_id = $category_id AND fk_roles_id = 3";// 3 == redaktør
				$result = mysqli_query($database_link, $query) or die(mysqli_error($database_link));
				while ($row = mysqli_fetch_assoc($result))
				{
					echo '<option value="'.$row['user_id'].'">'.$row['user_name'].'</option>';
				}
			?>
		</select>
	</div>
</form>

