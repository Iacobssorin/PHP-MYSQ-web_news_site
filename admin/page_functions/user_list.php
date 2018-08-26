<?php
   
    if ( !isset($database_link))
    {
        die(header('location: index.php?page=users'));
    }
?>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th colspan="2" ><a href="index.php?page=users&amp;action=add" class="btn btn-success btn-xs" title="Creeaza"><i class="icon-plus"></i> Creeaza</a></th>
			<th>Id</th>
			<th>Nume</th>
			<th>Email</th>
			<th>Rol</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th colspan="6"><a href="index.php?page=users&amp;action=add" class="btn btn-success btn-xs" title="Creeaza"><i class="icon-plus"></i> Creeaza</a></th>
		</tr>
	</tfoot>
	<tbody>
		<?php
            $query = "	SELECT user_id, user_name, user_email, role_title 
            			FROM users 
            			INNER JOIN roles ON role_id = fk_roles_id
            			ORDER BY role_access DESC, user_name ASC";
            $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
            if (mysqli_num_rows($result) > 0)
            {
                
                while ($row = mysqli_fetch_assoc($result))
                {
                    echo '
			            <tr>
			                <td style="width:30px;">
			                	<a 	href="index.php?page=users&amp;action=edit&amp;user_id='.$row['user_id'].'" 
			            			class="btn btn-primary btn-xs" 
			            			title="Editeaza">
			            				<i class="icon-pencil"></i>
			    				</a>
							</td>
			                <td style="width:30px;">
			                	<a 	href="index.php?page=users&amp;action=delete&amp;user_id='.$row['user_id'].'" 
			                		class="btn btn-danger btn-xs" 
			                		title="Sterge" 
			                		onclick="return confirm(\'Sigur doriți să ștergeți?\')">
			                			<i class="icon-trash"></i>
			        			</a>
			    			</td>
			                <td style="width:50px;">'.$row['user_id'].'</td>
			                <td>'.$row['user_name'].'</td>
			                <td>'.$row['user_email'].'</td>
			                <td>'.$row['role_title'].'</td>
			            </tr>';
                }
            }
            else
            {
                echo '<tr><td colspan="6">Nu s-au creat încă utilizatori</td></tr>';
            }
		?>
	</tbody>
</table>

