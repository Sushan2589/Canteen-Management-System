<?php
    require "connection.php" ;
    $username = $_POST['username'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'"; //OFC change in real world SQL injection hunxa
    $record = mysqli_query($conn,$sql);

    if(mysqli_num_rows($record)==1)
    {
        echo "LOGIN SUCCES"; //DASHBOARD HERE
    }

    else
    {
        echo "SOMETHING OFF";
    }



?> 

