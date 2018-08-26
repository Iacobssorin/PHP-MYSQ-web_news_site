<?php
   
    if ( !isset($database_link))
    {
        die(header('location: index.php?page=login'));
    }

    // am introdus emailul si parola pentru a putea testa aplicatia ca admin
    $email = "aa@aa.aa";
    $password = "1234";

    
    if (isset($_POST['login_submit']))
    {
        
        $email = mysqli_real_escape_string($database_link, $_POST['login_email']);
        $password = mysqli_real_escape_string($database_link, $_POST['login_password']);

        $query = "  SELECT user_id, user_name, user_email, role_access
                    FROM users
                    INNER JOIN roles ON role_id = users.fk_roles_id
                    WHERE user_email = '$email'";
        $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
        
        if (mysqli_num_rows($result) <> 1)
        {
            echo '<p class="alert alert-danger"><strong>EROARE</strong> Email sau parolă necunoscutA</p>';
        }
        else
        {
            $passchk = array_values(mysqli_fetch_array(mysqli_query($database_link, "SELECT user_password FROM users WHERE user_email ='$email' LIMIT 1")));
            $passchk = $passchk[0];
            if(password_verify($password, $passchk)) {
              
                $_SESSION['user'] = mysqli_fetch_assoc($result);
              
                die(header('location: index.php'));
            }
        }
    }

    
    if (isset($_GET['action']) && $_GET['action'] == 'logout')
    {
        
        unset($_SESSION['user']);
        die(header('location: index.php'));
    }
?>

<div class="row">
    <div class="col-5">
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label for="login_email" class="col-lg-2 control-label">Email</label>
                <div class="col-lg-4">
                    <input type="email" class="form-control" name="login_email" placeholder="Email" value="<?php echo $email ?>"  required autofocus  />
                </div>
            </div>
            <div class="form-group">
                <label for="login_password" class="col-lg-2 control-label">	Parolă</label>
                <div class="col-lg-4">
                    <input type="password" class="form-control" name="login_password" placeholder="parolă" value="<?php echo $password ?>" required />
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <input type="submit" class="btn btn-default" name="login_submit" value="Login">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row bottom">
    <ul class="breadcrumb">
        <li>
            <a href="index.php?page=frontpage">Acasa</a>
        </li>
        <li class="active">
            Login
        </li>
    </ul>
</div>