<?php
    session_start();
    require_once ( "../dbconfig.php" );

    # A Function to Check User Inputs (ISSET('') and EMPTY('')
    function user_input_check( $method, $input_name )
    {
        if( $method = 'POST' or $method = 'post')
        {
            if( isset(  $_POST[ "$input_name" ] ) and !empty( $_POST[ "$input_name" ] ) ) 
                return 1;
            else
                return 0;
        }
        else if( $method = 'GET' or $method = 'get')
        {
            if( isset(  $_GET[ "$input_name" ] ) and !empty( $_GET[ "$input_name" ] ) ) 
                return 1;
            else
                return 0;
        }
        else {
            echo "Method is not Correct!";
        }
        
    }
    #END of FUNCTION

    #####   USER INPUT SECURITY CHECK!
    function sql_runner( $sql, $inputs=[] )
    {
        global $connection;

        try {

            $connection = $connection->prepare($sql);
            $connection->execute( $inputs );
            return $connection;


        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function sql_runner_fetch(  $sql, $inputs=[] )
    {
        return sql_runner( $sql, $inputs )->fetch( PDO::FETCH_ASSOC );
    }

    function sql_runner_rowCount( $count = -1 )
    {
        global $connection;
        try{
            if( $count == -1 )
            {
                return $connection->rowCount();
            }
            return $connection->rowCount() == $count;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }