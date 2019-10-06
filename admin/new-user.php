<?php

$title = "افزودن کاربر";
require_once( "functions.php" );

if( !isset( $_SESSION[ 'iman_project' ] ) ) {
    header( 'location:login.php' );
}
require_once( "header.php" );
require_once( "default-page.php" );
?>

    <div class="uk-child-width-expand@s uk-grid-match " uk-grid>

        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                <h3 class="uk-card-title">افزودن کاربر</h3>
                
                <?php
                ################    Form Processing    ################
                # Send button
                if( user_input_check( 'adduser' ) ) {
                    /************************* name check   **********************/
                    if( user_input_check( 'fname' ) ) {
                        if( strlen( $_POST[ 'fname' ] ) >= 6 ) {
                            $fname = $_POST[ 'fname' ];
                            echo $fname;
                        }
                    }
                    else {
                        generate_alert_html( 'لطفا نام را تکمیل کنید.' );
                    }
                    if( user_input_check( 'lname' ) ) {
                        if( strlen( $_POST[ 'lname' ] ) >= 6 ) {
                            $lname = $_POST[ 'lname' ];
                            echo $lname;
                        }
                    }
                    else {
                        generate_alert_html( 'لطفا نام خانوادگی را تکمیل کنید.' );
                    }
                    /************************* end name check **********************/
                    
                    /*************************  Gender check **************************/
                    if( user_input_check( 'gender' ) ) {
                        $gender = $_POST[ 'gender' ];
                        if( $gender == 'M' )
                            echo( "مرد" );
                        else if( $gender == 'F' )
                            echo( "زن" );
                        else {
                            generate_alert_html( ' لطفا جنسیت خود را مشخص کنید.' );
                        }
                    }
                    /*************************  End of Gender check **************************/
                    
                    /*************************  USERNAME + PASSWORD check   **********************/
                    if( user_input_check( 'username' ) ) {
                        if( strlen( $_POST[ 'username' ] ) >= 3 ) {
                            $username = $_POST[ 'username' ];
                            echo $username;
                        }
                    }
                    else {
                        generate_alert_html( 'نام کاربری دیگری انتخاب کنید.' );
                    }
                    if( user_input_check( 'password' ) ) {
                        if( strlen( $_POST[ 'password' ] ) >= 3 ) {
                            $password = $_POST[ 'password' ];
                            echo $password;
                            $password = md5( $password );
                        }
                    }
                    else {
                        generate_alert_html( 'پسورد دیگری انتخاب کنید.' );
                    }
                    
                    /************************* end   USERNAME + PASSWORD check  **********************/
                    
                    /*************************  Email Check **********************/
                    if( user_input_check( 'email' ) ) {
                        $email = $_POST[ 'email' ];
                        if( preg_match( '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD' , $email ) ) {
                            $email = $_POST[ 'email' ];
                            echo $email;
                        }
                    }
                    else {
                        generate_alert_html( ' ایمیل وارد شده نادرست است.' );
                    }
                    /*************************  end of Email check **************************/
                    
                    /*************************  phone Check **********************/
                    // regex ^(\+98|0)?9\d{9}$
                    if( user_input_check( 'phone' ) ) {
                        $phone = $_POST[ 'phone' ];
                        
                        if( preg_match( '/^(\+98|0)?9\d{9}$/' , $phone ) ) {
                            $phone = $_POST[ 'phone' ];
                            echo $phone;
                        }
                    }
                    else {
                        generate_alert_html( 'شماره موبایل وارد شده نادرست است.' );
                    }
                    /*************************  end of Phone Check **********************/
                    
                    /*************************  ROLE Selection check **************************/
                    if( user_input_check( 'select1' ) ) {
                        $role = $_POST[ 'select1' ];
                        if( $role == 'subscriber' )
                            echo( "کاربر ساده" );
                        else if( $role == 'superadmin' )
                            echo( "مدیر کل" );
                        else {
                            generate_alert_html( 'لطفا نوع کاربر را مشخص کنید.' );
                        } //else
                    }
                    /************************* End of ROLE Selection check **************************/
                    
                    /************************* Upload check **************************/
                    if( isset( $_FILES[ 'profileimg' ] ) ) {
                        // empty check
                        if( empty( $_FILES[ 'profileimg' ] ) ) {
                            generate_alert_html( 'لطفا یک فایل را برای آپلود انتخاب کنید!' );
                        }
                        // empty check if
                        else {
                            $user_file = $_FILES[ 'profileimg' ];
                            //    var_dump ($user_file);
                            
                            //check file name length (it must be more than 3 charecters)
                            // file name check
                            if( strlen( $user_file[ 'name' ] ) >= 5 ) {
                                // file type check
                                if( in_array( strtolower( $user_file[ 'type' ] ) , explode( '|' , ALLOWED_FILE_TYPE ) ) ) {
                                    // File size check
                                    if( $user_file[ 'size' ] <= PROFILE_FILE_SIZE ) {
                                        //Error Check
                                        if( !$user_file[ 'error' ] ) {
                                            //  File Existance check
                                            $full_file_name = date( "Y-m-d" ) . "-" . date( "H-i-s" ) . "-" . $user_file[ "name" ];
                                            if( !file_exists( PROFILE_PATH . $full_file_name ) ) {
                                                // move file to directory
                                                if( move_uploaded_file( $user_file[ 'tmp_name' ] , ".." . PROFILE_PATH . $full_file_name ) ) {
                                                    global $connection;
                                                    $full_path = ".." . DIRECTORY_PATH . date( "Y-m-d" ) . "-" . date( "H-i-s" ) . "-" . $user_file[ 'name' ];
                                                    $sql = "INSERT INTO `attachments`( `name`, `mime_type`, `size`, `path`) VALUES (?,?,?,?)";
                                                    $avatar = sql_runner( $sql , [ $full_file_name , $user_file[ 'type' ] , $user_file[ 'size' ] , $full_path ] );
                                                    
                                                    generate_alert_html( 'آپلود موفقیت آمیز بود.' , 'success' );
                                                    
                                                    $sql = "INSERT INTO `users`(`first_name`, `last_name`, `gender`, `username`, `password`, `email`, `phone` , `is_admin`, `avatar_id` ) VALUES (?,?,?,?,?,?,?,?,?)";
                                                    sql_runner( $sql , [ $fname , $lname , $gender , $username , $password , $email , $phone , 1 , lastInsertedID() ] );
                                                    
                                                }
                                                else {
                                                    generate_alert_html( 'آپلود موفقیت آمیز نبود. لطفا دوباره تلاش کنید.' );
                                                } // upload faild
                                            }
                                            //  File Existance check
                                            else {
                                                generate_alert_html( 'فایلی با این نام در سرور موجود است.' );
                                            }   //end of Existance check
                                        }
                                        else {
                                            echo( $user_file[ 'error' ] );
                                            generate_alert_html( 'آپلود انجام نشد. لطفا دوباره تلاش کنید.' );
                                        }// end of error check
                                    }
                                    else {
                                        generate_alert_html( 'فایل شما بزرگتر از مقدار مجاز است. حداکثر سایز مجاز: 512KB' );
                                    }
                                    // end of file size check
                                }
                                // file type check if
                                
                                else {
                                    generate_alert_html( 'پسوند فایل باید یکی از این موارد باشد:jpeg, jpg, png, gif' );
                                }
                                // file type check
                            }
                            else {
                                generate_alert_html( 'نام فایل شما حداقل باید 5 کارکتر باشد' );
                            }
                            // file name check
                        }
                        // empty check
                    }
                    /*************************  End of Upload check **************************/
                }
                ################    END Form Processing    ################
                ?>

                <div class="uk-container uk-margin">
                    <form class="uk-form-horizontal" action="new-user.php" method="post" enctype="multipart/form-data">
                        <fieldset class="uk-fieldset">

                            <!-- FIRST NAME -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="fname">نام: </label>
                                <input class="uk-input uk-form-width-medium" id="fname" name="fname" type="text"
                                       placeholder="">
                            </div>
                            <!-- LAST NAME -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="lname">نام خانوادگی: </label>
                                <input class="uk-input uk-form-width-medium" id="lname" name="lname" type="text"
                                       placeholder="">
                            </div>
                            <!-- GENDER -->
                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                <label class="uk-form-label">جنسیت: </label>
                                <label><input class="uk-radio" value="M" type="radio" name="gender" checked> مرد</label>
                                <label><input class="uk-radio" value="F" type="radio" name="gender"> زن</label>
                            </div>
                            <!-- USERNAME -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="username">نام کاربری: </label>
                                <input class="uk-input uk-form-width-medium" id="username" name="username" type="text"
                                       placeholder="">
                            </div>
                            <!-- PASSWORD -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="password"> پسورد: </label>
                                <input class="uk-input uk-form-width-medium" id="password" name="password"
                                       type="password" placeholder="">
                            </div>
                            <!-- EMAIL -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="Email">ایمیل: </label>
                                <input class="uk-input uk-form-width-medium" id="Email" name="email" type="text"
                                       placeholder="">
                            </div>
                            <!-- PHONE -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="phone">شماره موبایل: </label>
                                <input class="uk-input uk-form-width-medium" id="phone" name="phone" type="text"
                                       placeholder="">
                            </div>
                            <!-- ROLE -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="select1">نقش کاربر: </label>
                                <select class="uk-select uk-form-width-medium" name="select1" id="user-role">
                                    <option value="subscriber">کاربر ساده</option>
                                    <option value="superadmin">مدیر کل</option>
                                </select>
                            </div>
                            <!-- PROFILE IMAGE -->
                            <div class="uk-margin">
                                <label for="file" class="uk-form-label">تصویر کاربر: </label>
                                <input type="file" class="uk-file" id="file" name="profileimg">
                            </div>
                            <!-----
                            <div class="uk-margin uk-form-width-large">
                                <textarea class="uk-textarea" name="massage" rows="5" placeholder="متن پیام..."></textarea>
                            </div>

                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                <label>
                                    <input class="uk-checkbox" name="rules" type="hidden" value="0" >
                                    <input class="uk-checkbox" name="rules" type="checkbox" value="I_do"> شرایط و قوانین را قبول دارم.
                                </label>
                            </div>
                            ------>
                            <!-- ADD BUTTON -->
                            <div class="uk-margin">
                                <input type="submit" class="uk-button uk-button-primary" name="adduser"
                                       value="افزودن کاربر">
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
require_once( "footer.php" );
?>