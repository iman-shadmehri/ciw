<?php

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
    function secure_input( $input_name)
    {

    }


