<?php
/*
|
| FusionInvoice to InvoicePlane
| Database conversion tool
|
*/
session_start();

function backup_tables($host,$user,$pass,$name,$tables = '*')
{

    $link = mysql_connect($host,$user,$pass);
    mysql_select_db($name,$link);

    $return = '';

    // Get all of the tables
    if($tables == '*')
    {
        $tables = array();
        $result = mysql_query('SHOW TABLES');
        while($row = mysql_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }
    else
    {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }

    // Cycle through
    foreach($tables as $table)
    {
        $result = mysql_query('SELECT * FROM '.$table);
        $num_fields = mysql_num_fields($result);

        $return.= 'DROP TABLE '.$table.';';
        $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";

        for ($i = 0; $i < $num_fields; $i++)
        {
            while($row = mysql_fetch_row($result))
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';
                for($j=0; $j<$num_fields; $j++)
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = preg_replace("#\n#", "\\n", $row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";
    }

    // Save file
    //$handle = fopen('backup_'.$name.'.sql','w+');
    //fwrite($handle,$return);
    //fclose($handle);

    header('Content-Disposition: attachment; filename="backup_'.$name.'.sql"');
    header('Content-Type: text/plain');
    header('Connection: close');
    echo $return;
}

backup_tables(
    $_SESSION['connection']['host'],
    $_SESSION['connection']['user'],
    $_SESSION['connection']['password'],
    $_SESSION['connection']['name']
);