<?php

$title = "ویرایش کاربر";
require_once( "functions.php" );

if( ! isset($_SESSION['iman_project'] ) ){
    header('location:login.php');
}

if( isset( $_REQUEST['id'] ) )
{
    $id = htmlspecialchars( trim( $_REQUEST['id'] ) );
    $stmt = "SELECT *, `users`.`id` AS `users_id`  FROM `users` LEFT JOIN  `attachments` ON (`users`.avatar_id=`attachments`.id)  WHERE `users`.`id`=? ";
    $user = sql_runner_fetch( $stmt , [ $id ] ); 
}
require_once( "header.php" );
require_once( "default-page.php" );
?>

    <div class="uk-child-width-expand@s uk-grid-match " uk-grid >

        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                <h3 class="uk-card-title">ویرایش کاربر</h3>
                <?php


                if ( isset( $_REQUEST[ "updateuser" ] ) && ! user_input_check('updateuser'))
                {
                    $validation_passed = true;
                    $password_change = true;
                    $file_upload = true;
                    if ( user_input_check('fname') )
                    {
                        $validation_passed = false;

                        generate_alert_html("لطفا نام را تکمیل کنید.");
                    }

                    if ( user_input_check('lname') )
                    {
                        $validation_passed = false;
                        generate_alert_html("لطفا نام خانوادگی را تکمیل کنید.");
                    }   

                    if ( user_input_check('gender') )
                    {
                        $validation_passed = false;
                        generate_alert_html("لطفا جنسیت خود را مشخص کنید.");
                    }  

                    if (  ! user_input_check('password', 'length', 3) ||  ! user_input_check('password', 'equals', $_REQUEST['repassword']))
                    {
                        if( ! user_input_check('password') ){
                            $validation_passed = false;
                            if ( ! user_input_check('password', 'length', 3) ){
                                generate_alert_html("پسورد کم تر از 3 کاراکتر می باشد.");
                            }
                            if(! user_input_check('password', 'equals', $_REQUEST['repassword'])){
                                generate_alert_html("پسورد هم خوانی ندارد.");
                            }
                        }

                        $password_change = false;
                    }  

                    if (  ! user_input_check('email', 'email') )
                    {
                        $validation_passed = false;
                        generate_alert_html("ایمیل وارد شده نادرست است.");
                    }   
                    
                    if (  ! user_input_check('phone', 'regex', '/^(\+98|0)?9\d{9}$/') )
                    {
                        $validation_passed = false;
                        generate_alert_html("شماره موبایل وارد شده نادرست است.");
                    }   
                    
                    if ( user_input_check('select1') )
                    {
                        $validation_passed = false;
                        generate_alert_html("لطفا نوع کاربر را مشخص کنید.");
                    }   

                    // check to see whether user wants to change his avatar or not
                    if (  ! user_input_check('profileimg', 'file') )
                    {
                        $file_upload = false;
                    }   

                    if($file_upload){
                        $user_file = $_FILES['profileimg'];
                        if( ! in_array( strtolower($user_file['type']), explode('|', ALLOWED_FILE_TYPE)) )
                        {
                            $validation_passed = false;
                            generate_alert_html("پسوند فایل باید یکی از این موارد باشد:jpeg, jpg, png, gif");
                        }  

                        if(  $user_file['size'] > PROFILE_FILE_SIZE  )
                        {
                            $validation_passed = false;
                            generate_alert_html("فایل شما بزرگتر از مقدار مجاز است. حداکثر سایز مجاز: 512KB");
                        }   

                        if(  $user_file['error']  )
                        {
                            $validation_passed = false;
                            generate_alert_html("آپلود انجام نشد. لطفا دوباره تلاش کنید.");
                        }   

                        $full_file_name = date("Y-m-d") ."-" .date("H-i-s") ."-" .$user_file["name"];
                        $full_path = PROFILE_PATH .$full_file_name ;

                        if( ! move_uploaded_file( $user_file['tmp_name'], "..".$full_path )  )
                        {
                            $validation_passed = false;
                            generate_alert_html("آپلود موفقیت آمیز نبود. لطفا دوباره تلاش کنید.");
                        } 

                    }

                    /************************* VALIDATION END **********************/
                   
                    if($validation_passed){
                        
                        if($file_upload){
                            if( !is_null( $user['path'] ) ) {
                                unlink("..".$user['path']);
                            }
                            if( $user['avatar_id'] > 0 ){
                                // update old attachment record
                                $sql = "UPDATE `attachments` SET `name`=?, `mime_type`=?, `size`=?, `path`=? WHERE `id`=?";
                                sql_runner($sql,  [ $full_file_name , $user_file['type'] , $user_file['size'] , $full_path , $user['avatar_id'] ] );
                            }
                            else{
                                $full_path = DIRECTORY_PATH .date("Y-m-d") ."-" .date("H-i-s") ."-" .$user_file['name'];
                                $sql = "INSERT INTO `attachments`( `name`, `mime_type`, `size`, `path`) VALUES (?,?,?,?)";
                                sql_runner($sql,  [ $full_file_name , $user_file['type'] , $user_file['size'] , $full_path ] );

                                // Update Users Table -> avatar_id
                                $sql = "UPDATE `users` SET `avatar_id`=? WHERE `id`=? ";
                                sql_runner( $sql , [ lastInsertedID() , $user['users_id'] ] );

                            }
                                generate_alert_html("آپلود موفقیت آمیز بود.", 'success');
                        }
                    
                        $gender = $_REQUEST['gender']=="F" ? 0 : 1 ;

                        // if user wanted to change password too
                        if($password_change){
                            $sql = "UPDATE  `users` SET `first_name`=?, `last_name`=?, `gender`=?, `password`=?, `email`=?, `phone`=? , `is_admin`=? WHERE `id`=?";
                            sql_runner($sql,  [ $_REQUEST['fname'] , $_REQUEST['lname'] , $gender , md5($_REQUEST['password']) , $_REQUEST['email'] , $_REQUEST['phone'] ,  1 , $_REQUEST['id'] ] );
                        }
                        else {
                            $sql = "UPDATE  `users` SET `first_name`=?, `last_name`=?, `gender`=?, `email`=?, `phone`=? , `is_admin`=? WHERE `id`=?";
                            sql_runner($sql,  [ $_REQUEST['fname'] , $_REQUEST['lname'] , $gender , $_REQUEST['email'] , $_REQUEST['phone'] ,  1 , $_REQUEST['id'] ] );
                        }
                        $id = htmlspecialchars( trim( $_REQUEST['id'] ) );
                        $stmt = "SELECT *, `users`.`id` AS `users_id`  FROM `users` LEFT JOIN  `attachments` ON (`users`.avatar_id=`attachments`.id)  WHERE `users`.`id`=? ";
                        $user = sql_runner_fetch( $stmt , [ $id ] ); 

                   }
                }
                ?>
                <div class="avatar">
                    <img src="<?= $user['path'] ? "../" . $user['path'] : "images/default.png" ?>" alt="<?= $user['first_name']." ".$user['last_name'] ?>">
                </div>

                <div class="uk-container uk-margin">
                    <form class="uk-form-horizontal" method="post" enctype="multipart/form-data">
                        <fieldset class="uk-fieldset">

                            <!-- FIRST NAME -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="fname">نام: </label>
                                <input class="uk-input uk-form-width-medium" id="fname" name="fname" type="text" placeholder="" value="<?php echo $user['first_name']; ?>">
                            </div>
                            <!-- LAST NAME -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="lname">نام خانوادگی: </label>
                                <input class="uk-input uk-form-width-medium" id="lname" name="lname" type="text" placeholder="" value="<?php echo $user['last_name']; ?>">
                            </div>
                            <!-- GENDER -->
                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                <label class="uk-form-label" >جنسیت: </label>
                                <label><input class="uk-radio" value="M" type="radio" name="gender" <?= $user['gender']==1? "checked":"" ?> > مرد</label>
                                <label><input class="uk-radio" value="F" type="radio" name="gender" <?= $user['gender']==0? "checked":"" ?> > زن</label>
                            </div>
                            <!-- USERNAME -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="username">نام کاربری: </label>
                                <input class="uk-input uk-form-width-medium" id="username" name="username" type="text" placeholder="" value="<?= $user['username'] ?>" disabled>
                            </div>
                            <!-- PASSWORD -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="password"> پسورد: </label>
                                <input class="uk-input uk-form-width-medium" id="password" name="password" type="password" placeholder="" value="" autocomplete="new-password">
                            </div>
                            <!-- RE-PASSWORD -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="re-password"> پسورد مجدد: </label>
                                <input class="uk-input uk-form-width-medium" id="re-password" name="repassword" type="password" placeholder="" value="" autocomplete="new-password">
                            </div>
                            <!-- EMAIL -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="Email">ایمیل: </label>
                                <input class="uk-input uk-form-width-medium"id="Email" name="email" type="text" placeholder="" value="<?php echo $user['email']; ?>">
                            </div>
                            <!-- PHONE -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="phone">شماره موبایل: </label>
                                <input class="uk-input uk-form-width-medium" id="phone" name="phone" type="text" placeholder="" value="<?php echo $user['phone']; ?>">
                            </div>
                            <!-- ROLE -->
                            <div class="uk-margin">
                                <label class="uk-form-label" for="select1">نقش کاربر: </label>
                                <select class="uk-select uk-form-width-medium" name="select1" id="user-role">
                                    <option value="subscriber" >کاربر ساده </option>
                                    <option value="superadmin">مدیر کل</option>
                                </select>
                            </div>
                            <!-- PROFILE IMAGE -->
                            <div class="uk-margin">
                                <label for="file" class="uk-form-label">تصویر جدید: </label>
                                <input type="file" class="uk-file" id="file" name="profileimg">
                            </div>
                            <div class="uk-margin">
                                <input type="submit" class="uk-button uk-button-primary" name="updateuser" value="بروز رسانی کاربر">
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