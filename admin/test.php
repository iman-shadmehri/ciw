<?php
 if( user_input_check( 'POST ', 'login' ) )
    {
        if( user_input_check( 'POST ', 'username' )  and user_input_check( 'POST ', 'password' ) )
        {
            $username = $_POST['username'];
            $password = $_POST['password'];

            try
            {
                #  $conn is Created by dbconfig.php
                $query = $conn->prepare( "SELECT * FROM users WHERE username=? AND password=? " );
                $query->execute( array( $username, $password ) );
                $row = $query->fetch( PDO::FETCH_BOTH );

                if( $query->rowCount() == 1 )
                {
                    header( 'location:index.php');
                    echo "login";
                }

            }
            catch( PDOException $e ) 
            {
                echo "Error: " . $e->getMessage();
            }

        }
        
    }