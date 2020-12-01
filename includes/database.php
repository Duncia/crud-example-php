<?php
/*
* DB connection.
*/

function getDB()
{
    $db_host = "localhost";
    $db_name = "phpcrudexample";
    $db_user = "phpcrud";
    $db_pass = "vertimai";

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }

    return $conn;
    
}