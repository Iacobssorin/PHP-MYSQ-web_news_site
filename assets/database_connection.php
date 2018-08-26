<?php
    $database_host = 'localhost';
    $database_user = 'root';
    $database_pass = '';
    $database_name = 'web_aplication';

   
    if ( !$database_link = @mysqli_connect($database_host, $database_user, $database_pass, $database_name))
    {
        die('<p class="alert alert-danger">
                 <strong>Eroare</strong> Conectarea la baza de date a eșuat... <br />
                
                 <strong>'.__FILE__.'</strong>
             </p>');
    }
?>