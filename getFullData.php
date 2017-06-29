<?php
    $username = "reader"; 
    $password = "pennsyriac";   
    $host = "127.0.0.1:9999";
    $database="scribesqldatabase";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);

    $date_min = $_GET["min"];
    $date_max = $_GET["max"];

    $myquery = "SELECT * FROM `pagetable` LEFT JOIN `manuscripttable` ON manuscripttable.Manuscript_no = pagetable.Manuscript_No";

    if ($date_min) {
         $myquery .= " WHERE manuscripttable.Date BETWEEN " . $date_min . " AND " . $date_max . "";
    }

    $query = mysql_query($myquery);
   

    if ( ! $query ) {
        echo mysql_error();
        die;
    }

    $data = array();
    //echo $myquery;
    for ($x = 0; $x < mysql_num_rows($query); $x++) {
        $data[] = mysql_fetch_assoc($query);
    }
    
    echo json_encode($data);    
     
    mysql_close($server);
?>
