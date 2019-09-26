<?php

define( 'DB_NAME' , 'ciw' );
define( 'DB_USER' , 'root' );
define( 'DB_PASSWORD' , '' );
define( 'DB_HOST' , 'localhost' );
define( 'DB_CHARSET' , 'utf8' );

// Create connection to database using PDO
global $connection;
try 
{
    #$connection = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

    $connection = new PDO( "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, DB_USER, DB_PASSWORD );
//    var_dump ($connection);

    // Set PDO error mode to exception:
    $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//    echo "Conneted to DB Successfully";
}
catch( PDOException $e)
{
    echo "Connection failed: " .$e->getMessage();
}
