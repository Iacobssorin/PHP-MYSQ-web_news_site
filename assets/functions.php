<?php
   
    function if_sql_error_then_die($error_message, $query, $line_number, $file_name)
    {
        die(format_error_message($error_message, $query, $line_number, $file_name));
    }

    function format_error_message($error_message, $query, $line_number, $file_name)
    {
        return '
            <div class="alert alert-danger">
                <strong> eroare SQL:</strong> '.$error_message.'<br />
                <strong>Linie:</strong> '.$line_number.'<br />
                <strong>Introdu:</strong> '.$file_name.'<br />
                <pre>'.preg_replace('/\s\s+/', ' ', nl2br($query)).'</pre>
            </div>';

    }

   
    function print_array($array, $title = '')
    {
        if (sizeof($array) > 0)
        {
            echo '<pre>';
           
            if ($title != '')
            {
                echo '['.$title.'] => ';
            }
            
            print_r($array);
            echo '</pre>';
        }
        else
        {
          
            if ($title != '')
            {
                echo '<pre>['.$title.'] => Empty</pre>';
            }
        }
    }

    

?>