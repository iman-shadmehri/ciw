<?php

define( 'DB_NAME' , 'ciw' );
define( 'DB_USER' , 'root' );
define( 'DB_PASSWORD' , '' );
define( 'DB_HOST' , 'localhost' );
define( 'DB_CHARSET' , 'utf8' );

// Create connection to database using PDO

try 
{
    #$conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn = new PDO( "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, DB_USER, DB_PASSWORD );
//    var_dump ($conn);

    // Set PDO error mode to exception:
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//    echo "Conneted to DB Successfully";
}
catch( PDOException $e)
{
    echo "Connection failed: " .$e->getMessage();
}
