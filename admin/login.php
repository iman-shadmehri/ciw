<?php

$title = "صفحه ورود کاربران";
require_once( "functions.php" );
require( "header.php" );


    if( !isset( $_SESSION[ 'iman_project' ] ) )
    {

        if (user_input_check('POST ', 'login')) {
            if (user_input_check('POST ', 'username') and user_input_check('POST ', 'password')) {

                    $stmt = "SELECT * FROM users WHERE username=? AND password=?";
                    $row = sql_runner_fetch( $stmt , [ $_POST['username'], md5( $_POST['password'] ) ] );

                    if ( sql_runner_rowCount( 1 )) {
                        //$_SESSION['iman_project'] = $row['id'];
                        $_SESSION['iman_project'] = $row;
                        header('location:index.php');


                    } else {
                        ?>
                        <div class="uk-container uk-margin uk-alert-danger">
                            <a class="uk-alert-close" uk-close></a>
                            <p>نام کاربری یا رمزعبور اشتباه است!</p>
                        </div>
                        <?php
                    }

            }

        }

            ?>

            <body class="login-body">
            <div class="uk-container">
                <div class="login-form">
                    <h3>صفحه ورود کاربران</h3>
                    <form action="login.php" method="POST">

                        <div class="uk-margin">
                            <div class="uk-inline">
                                نام کاربری:
                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: user"></span>
                                <input class="uk-input" type="text" name="username">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-inline">
                                رمز عبور:
                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                <input class="uk-input" type="password" name="password">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <input type="submit" name="login" class="uk-button uk-button-primary" value="ورود">
                        </div>

                    </form>
                </div>
            </div>

            </body>
            <?php

    }
    else
    {
        header('location:index.php');
    }
?>