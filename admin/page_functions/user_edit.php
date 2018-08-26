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

    
    $user_name = '';
    $user_email = '';
    $role_id = 1;

   
    if (isset($_POST['user_submit']))
    {
       
        $form_ok = true;

       
        $user_name = mysqli_real_escape_string($database_link, $_POST['user_name']);
        $user_email = mysqli_real_escape_string($database_link, $_POST['user_email']);
        $user_password = mysqli_real_escape_string($database_link, $_POST['user_password']);
        $user_password_repeat = mysqli_real_escape_string($database_link, $_POST['user_password_repeat']);
        $role_id = ($_POST['role_id'] * 1);

        //
        if ($user_name == '')
        {
            $form_ok = false;
            echo '<p class="alert alert-danger">Completați numele</p>';
        }
        if ($user_email == '')
        {
            $form_ok = false;
            echo '<p class="alert alert-danger">Completați e-mailul</p>';
        }
        else
        if ( !filter_var($user_email, FILTER_VALIDATE_EMAIL))
        {
            $form_ok = false;
            echo '<p class="alert alert-danger">E-mailul nu este valid</p>';
        }
        if ($role_id < 0)
        {
            $form_ok = false;
            echo '<p class="alert alert-danger">Alegeți ce rol ar trebui să aibă utilizatorul</p>';
        }

        
        if ($user_password != '' || $user_password_repeat != '')
        {
           
            if ($user_password != $user_password_repeat)
            {
                $form_ok = false;
                echo '<p class="alert alert-danger">Cele două parole nu corespund</p>';
            }
        }

       
        if ($form_ok)
        {
            $query = "
            	UPDATE 
            		users
        		SET 
            		user_name = '$user_name'
					, user_email = '$user_email'
        			, fk_roles_id = '$role_id'
				WHERE 
					user_id = '$user_id'";
            $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
            
            if ($result)
            {
                $_SESSION['message'] .= 'Utilizatorul a fost actualizat<br />';

               
                if ($user_password != '')
                {
                    // 
                    $encpass = password_hash($user_password, PASSWORD_BCRYPT);


                    $query = "UPDATE users SET user_password = '$encpass' WHERE user_id = '$user_id'";
                    $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
                   
                    if ($result)
                    {
                      
                        $_SESSION['message'] .= 'Noua parolă a fost salvată<br />';
                    }
                }
               
                die(header('location: index.php?page=users'));
            }
        }
    }
    else
    {
        
        $query = "SELECT user_name, user_email, fk_roles_id FROM users WHERE user_id = $user_id";
        $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
        if ($row = mysqli_fetch_assoc($result))
        {
            $user_name = $row['user_name'];
            $user_email = $row['user_email'];
            $role_id = $row['fk_roles_id'];
        }
    }
?>
<div class="col-lg-6">
    <form method="post" role="form">
        <div class="form-group">
            <label for="user_name">Nume</label>
            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Nume utilizator" value="<?php echo $user_name; ?>" maxlength="32" required>
        </div>
        <div class="form-group">
            <label for="user_email">Email</label>
            <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Email" value="<?php echo $user_email; ?>" maxlength="128" required>
        </div>
        <div class="form-group">
            <label for="user_password">Parolă <em class="label label-default"></em></label>
            <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Parolă" value="">
        </div>
        <div class="form-group">
            <label for="user_password_repeat"> reintroduce-ti parolă <em class="label label-default"></em></label>
            <input type="password" class="form-control" name="user_password_repeat" id="user_password_repeat" placeholder="Reintroduce-ti parola" value="">
        </div>
        <div class="form-group">
            <label for="role_id">Rol</label>
            <select class="form-control" name="role_id" id="role_id">
                <option value="0">Selecteaza Rol</option>
                <?php
                    $query = "SELECT role_id, role_title FROM roles ORDER BY role_access ASC";
                    $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
                    if (mysqli_num_rows($result) > 0)
                    {
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $selected = ($role_id == $row['role_id'] ? ' selected="selected"' : '');
                            echo '<option value="'.$row['role_id'].'"'.$selected.'>'.$row['role_title'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <input type="submit" class="btn btn-success" name="user_submit" value="Salveaza" />
        <a href="index.php?page=users" class="btn btn-default" onclick="return confirm('Sigur doriți să anulați?')">Anuleaza</a>
    </form>
</div>