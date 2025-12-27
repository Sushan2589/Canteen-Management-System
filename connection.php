<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "canteenmanagementsys";

    $conn = mysqli_connect($servername,$username,$password,$database);

    if($conn)
    {
        // echo "Server Connected";
        
    }

    else
    {
        echo "Failed conn";
    }

?>