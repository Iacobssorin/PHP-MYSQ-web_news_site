<?php

    if ( !isset($database_link))
    {
        die(header('location: index.php?page=categories'));
    }
?>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th colspan="2"><a href="index.php?page=categories&amp;action=add" class="btn btn-success btn-xs" title="Creeaza"><i class="icon-plus"></i> Creeaza</a></th>
            <th>Id</th>
            <th>Titlu</th>
            <th>Descriere</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th colspan="5"><a href="index.php?page=categories&amp;action=add" class="btn btn-success btn-xs" title="Creeaza"><i class="icon-plus"></i> Creeaza</a></th>
        </tr>
    </tfoot>
    <tbody>
        <?php
            $query = "SELECT * FROM categories";
            $result = mysqli_query($database_link, $query) or if_sql_error_then_die(mysqli_error($database_link), $query, __LINE__, __FILE__);
            if (mysqli_num_rows($result) > 0)
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                    echo '
			            <tr>
			                <td style="width:30px;">
			                	<a 	href="index.php?page=categories&amp;action=edit&amp;category_id='.$row['category_id'].'" 
			            			class="btn btn-primary btn-xs" 
			            			title="Editeaza">
			            				<i class="icon-pencil"></i>
			    				</a>
							</td>
			                <td style="width:30px;">
			                	<a 	href="index.php?page=categories&amp;action=delete&amp;category_id='.$row['category_id'].'" 
			                		class="btn btn-danger btn-xs" 
			                		title="Slet" 
			                		onclick="return confirm(\'Sigur doriți să ștergeți?\')">
			                			<i class="icon-trash"></i>
			        			</a>
			    			</td>
			                <td style="width:50px;">'.$row['category_id'].'</td>
			                <td>'.$row['category_title'].'</td>
			                <td>'.$row['category_description'].'</td>
			            </tr>';
                }
            }
            else
            {
                echo '<tr><td colspan="5">Nu au fost create încă categorii</td></tr>';
            }
        ?>
    </tbody>
</table>

