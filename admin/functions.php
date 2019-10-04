<?php
session_start();
require_once( "../env.php" );
require_once( "../DatabaseConnection.php" );

# A Function to Check User Inputs (ISSET('') and EMPTY('')
function user_input_check( $input_name , $validation_type = "empty" , $validation_rule = "" )
{
    
    switch( $validation_type ) {
        case 'file':
            if( !empty( $_FILES[ "$input_name" ][ 'name' ] ) ) {
                return 1;
            }
            break;
        case 'empty':
            if( isset( $_REQUEST[ "$input_name" ] ) && !empty( $_REQUEST[ "$input_name" ] ) ) {
                return 1;
            }
            break;
        case 'equals':
            if( isset( $_REQUEST[ "$input_name" ] ) && $_REQUEST[ "$input_name" ] == $validation_rule ) {
                return 1;
            }
            break;
        case 'length':
            if( isset( $_REQUEST[ "$input_name" ] ) && strlen( $_REQUEST[ "$input_name" ] ) >= $validation_rule ) {
                return 1;
            }
            break;
        case 'regex':
            if( isset( $_REQUEST[ "$input_name" ] ) && preg_match( $validation_rule , $_REQUEST[ "$input_name" ] ) ) {
                return 1;
            }
            break;
        case 'email':
            if( isset( $_REQUEST[ "$input_name" ] ) && preg_match( '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD' , $_REQUEST[ "$input_name" ] ) ) {
                return 1;
            }
            break;
        
    }
    return 0;
}

#END of FUNCTION
function user_inputs_check( $inputs , $validation_type = "empty" , $validation_rule = "" )
{
    $validated = true;
    if( count( $inputs ) == 0 ) {
        return false;
    }
    foreach( $inputs as $input ) {
        if( user_input_check( $input , $validation_type , $validation_rule ) ) {
            $validated = false;
        }
    }
    return $validated;
}

#####   USER INPUT SECURITY CHECK!
/*
    function input_security_check( $input_name , $validation_type="empty" , $validation_rule="" ){
        switch ( $validation_rule){
            case 'empty':
                return htmlspecialchars($input_name);
                break;
            case 'trim':
                return htmlspecialchars(trim($input_name));
                break;
        }
    }
    */
function generate_alert_html( $text , $class = 'danger' )
{
    echo '<div class="uk-container uk-margin uk-alert-' . $class . '">
                            <a class="uk-alert-close" uk-close></a>
                            <p>' . $text . '</p>
                        </div>';
}


function sql_runner( $sql , $inputs = [] )
{
    global $connection , $lastQuery;
    
    try {
        
        $lastQuery = $connection -> prepare( $sql );
        $lastQuery -> execute( $inputs );
        return $lastQuery;
        
        
    } catch( PDOException $e ) {
        echo "Connection failed: " . $e -> getMessage();
    }
}

function sql_runner_fetch( $sql , $inputs = [] )
{
    return sql_runner( $sql , $inputs ) -> fetch( PDO::FETCH_ASSOC );
}

function sql_runner_fetch_all( $sql , $inputs = [] )
{
    return sql_runner( $sql , $inputs ) -> fetchAll( PDO::FETCH_ASSOC );
}

// return row counts if no parameter given
// if parameter send it will check that row count is equal to parameter or not
function sql_runner_rowCount( $count = -1 )
{
    global $lastQuery;
    try {
        if( $count == -1 ) {
            return $lastQuery -> rowCount();
        }
        return $lastQuery -> rowCount() == $count;
    } catch( PDOException $e ) {
        echo "Connection failed: " . $e -> getMessage();
    }
    
}

function lastInsertedID()
{
    global $connection;
    return $connection -> lastInsertId();
}

function is_unique( $table , $column , $value )
{
    $sql = "SELECT * FROM `$table` WHERE `$column` = ?";
    sql_runner_fetch_all( $sql , [ $value ] );
    
    if( sql_runner_rowCount( 0 ) ) {
        return true;
    }
}