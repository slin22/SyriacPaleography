<?php
    $username = "reader"; 
    $password = "pennsyriac";   
    $host = "127.0.0.1:9999";
    $database="scribesqldatabase";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);

    $filename = $_GET["filename"];

    $myquery = "SELECT * FROM pagetable";


    if ($filename) {
       $myquery .= " WHERE Manuscript_No LIKE '%" . $filename . "%'";

    }

    $myquery .= " ORDER BY Manuscript_No LIMIT 10;";

    $query = mysql_query($myquery);
   

    if ( ! $query ) {
        echo mysql_error();
        die;
    }

    $data = array();
    
    for ($x = 0; $x < mysql_num_rows($query); $x++) {
        $data[] = mysql_fetch_assoc($query);
    }
    
    echo json_encode($data);    
     
    mysql_close($server);
?>