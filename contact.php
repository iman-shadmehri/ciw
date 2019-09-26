<?php
    $title = "تماس با ما";

    require ("theme/header.php");
    require ("theme/content.php");
    //require ("theme/functions.php");
    require ("theme/navbar.php");


    ################    Form Processing    ################
    
    # Send button    
    if (isset( $_POST['senddata']) && !empty( $_POST['senddata'])) 
    //if ( siman_check( $_POST['senddata'] ) )
    {
        /************************* Rule Checkbox   **********************/    
        if( isset( $_POST['rules'] ) and !empty( $_POST['rules'] ) )
        //if ( siman_check( $_POST['rules']) )
        {
            #user is accepted the rules
            //var_dump( $_POST['rules']);
            if( $_POST['rules'] == "I_do" )
            {
                    /************************* name check   **********************/
                if (isset( $_POST['flname']) && !empty( $_POST['flname'])) 
                {
                    if (strlen( $_POST['flname']) >= 6 ) 
                    {
                        $flname = $_POST['flname'];
                        echo $flname;
                    }
                }
                else 
                {
                    ?>
                    
                    <div class="uk-container uk-margin uk-alert-danger">
                        <a class="uk-alert-close" uk-close></a>
                        <p>لطفا نام و نام خانوادگی را تکمیل کنید.</p>
                    </div>
                    
                    <?php 
                } /************************* end name check **********************/
                
                
                /*************************  phone Check **********************/
                // regex ^(\+98|0)?9\d{9}$
                if (isset($_POST['phone']) and !empty($_POST['phone'])) 
                {
                    $phone = $_POST['phone'];

                    if (preg_match('/^(\+98|0)?9\d{9}$/', $phone)) 
                    {
                        $phone = $_POST['phone'];
                        echo $phone;
                    }
                }
                else
                {
                    ?>
                    
                        <div class="uk-container uk-margin uk-alert-danger">
                            <a class="uk-alert-close" uk-close></a>
                            <p>شماره موبایل وارد شده نادرست است.</p>
                        </div>
                    
                    <?php
                } /*************************  end of Phone Check **********************/ 

                /*************************  Email Check **********************/ 
                if (isset($_POST['email']) and !empty($_POST['email']))
                {
                    $email = $_POST['email'];
                    if( preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $email))
                    {
                        $email = $_POST['email'];
                        echo $email;
                    }
                }
                else
                {
                    ?>
                    
                        <div class="uk-container uk-margin uk-alert-danger">
                            <a class="uk-alert-close" uk-close></a>
                            <p> ایمیل وارد شده نادرست است.</p>
                        </div>
                    
                    <?php
                }   /*************************  end of Email check **************************/

                /*************************  Gender check **************************/
                if(isset($_POST['radio2']) and !empty($_POST['radio2']))
                {
                    $gender = $_POST['radio2'];
                    if ($gender == 'M')
                        echo("مرد");
                    else if ($gender == 'F')
                        echo("زن");
                    else {
                        ?>
                    
                        <div class="uk-container uk-margin uk-alert-danger">
                            <a class="uk-alert-close" uk-close></a>
                            <p> لطفا جنسیت خود را مشخص کنید.</p>
                        </div>
                    
                    <?php
                    }
                        
                }   /*************************  End of Gender check **************************/

                /*************************  Selection check **************************/
                if (isset($_POST['select1']) and !empty($_POST['select1']))
                {
                    $Send_to = $_POST['select1'];
                    if ( $Send_to == 'sale')
                        echo ("ارسال شود به واحد فروش");
                    else if ( $Send_to == 'support')
                        echo ("ارسال شود به واحد پشتیبانی");
                    else if ( $Send_to == 'management')
                        echo ("ارسال شود به واحد مدیریت");
                    else 
                    {
                        ?>
                    
                        <div class="uk-container uk-margin uk-alert-danger">
                            <a class="uk-alert-close" uk-close></a>
                            <p>مقصد ارسال پیام به درستی انتخاب نشده است.</p>
                        </div>
                    
                    <?php
                    } //else
                }   /************************* End of Selection check **************************/

                /************************* Upload check **************************/
                if (isset($_FILES['image1']))
                {
                    if (empty($_FILES['image1']))
                    {
                        ?>
                    
                        <div class="uk-container uk-margin uk-alert-danger">
                            <a class="uk-alert-close" uk-close></a>
                            <p>لطفا یک فایل را برای آپلود انتخاب کنید!</p>
                        </div>

                        <?php
                    } // empty check
                    else
                    {
                        $user_file = $_FILES['image1'];
                    //    var_dump ($user_file);

                        //check file name length (it must be more than 3 charecters)
                        if ( strlen( $user_file['name']) >= 5)
                        {
                            // file type check
                            if( $user_file['type'] == 'image/jpeg' ||
                                $user_file['type'] == 'image/jpg' ||
                                $user_file['type'] == 'image/png' ||
                                $user_file['type'] == 'image/gif' )
                            {
                                // File size check
                                if ( $user_file['size'] <= 512000 )
                                {
                                    //Error Check
                                    if ( !$user_file['error'] )
                                    {
                                        
                                        //  File Existance check
                                        if( !file_exists( "files/upload/".date("Y-m-d") ."-".$user_file['name'] ) )
                                        {    
                                            // move file to directory
                                            if( move_uploaded_file( $user_file['tmp_name'], "files/upload/".date("Y-m-d") ."-".$user_file['name'] ) ) 
                                            {
                                                ?>
                            
                                                <div class="uk-container uk-margin uk-alert-success">
                                                    <a class="uk-alert-close" uk-close></a>
                                                    <p>آپلود موفقیت آمیز بود.</p>
                                                </div>

                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                            
                                                <div class="uk-container uk-margin uk-alert-danger">
                                                    <a class="uk-alert-close" uk-close></a>
                                                    <p>آپلود موفقیت آمیز نبود. لطفا دوباره تلاش کنید.</p>
                                                </div>

                                                <?php
                                            } // upload faild
                                        }
                                        else
                                        {
                                            ?>
                            
                                            <div class="uk-container uk-margin uk-alert-danger">
                                                <a class="uk-alert-close" uk-close></a>
                                                <p>فایلی با این نام در سرور موجود است.</p>
                                            </div>

                                            <?php 
                                        }   //end of Existance check


                                    }
                                    else
                                    {
                                        echo ( $user_file['error'] );
                                        ?>
                        
                                        <div class="uk-container uk-margin uk-alert-danger">
                                            <a class="uk-alert-close" uk-close></a>
                                            <p>آپلود انجام نشد. لطفا دوباره تلاش کنید.</p>
                                        </div>

                                        <?php
                                    }// end of error check
                                }
                                else
                                {
                                    ?>
                        
                                    <div class="uk-container uk-margin uk-alert-danger">
                                        <a class="uk-alert-close" uk-close></a>
                                        <p>فایل شما بزرگتر از مقدار مجاز است. حداکثر سایز مجاز: 512KB</p>
                                    </div>

                                    <?php
                                }// end of file size check
                            }// file type
                            else
                            {
                                ?>
                    
                                <div class="uk-container uk-margin uk-alert-danger">
                                    <a class="uk-alert-close" uk-close></a>
                                    <p>پسوند فایل باید یکی از این موارد باشد:jpeg, jpg, png, gif</p>
                                </div>

                            <?php
                            }
                        } // file name check
                        else
                        {
                            ?>
                    
                            <div class="uk-container uk-margin uk-alert-danger">
                                <a class="uk-alert-close" uk-close></a>
                                <p>نام فایل شما حداقل باید 5 کارکتر باشد</p>
                            </div>

                            <?php
                        } // file name check
                    }
                }   /*************************  End of Upload check **************************/

                /*************************  Text Area check **************************/
                if( isset( $_POST['massage'] ) )
                {
                    if( !empty( $_POST['massage'] ) )
                    {
                        $massage = $_POST['massage'];
                        echo( "<br>پیام شما: " .$massage );
                    }
                    else
                    {
                        ?>
                    
                        <div class="uk-container uk-margin uk-alert-danger">
                            <a class="uk-alert-close" uk-close></a>
                            <p>لطفا پیام خود را بنویسید.</p>
                        </div>

                        <?php
                    }
                }   /*************************  End of Text Area check **************************/

            }   // user is accpted the rules
            
        
        }
        else
        {
            ?>
            
                <div class="uk-container uk-margin uk-alert-danger">
                    <a class="uk-alert-close" uk-close></a>
                    <p>شما قوانین را نپذیرفتید!</p>
                </div>

            <?php
        }   /*************************  End of Rules Checkbox Check **************************/  
        //var_dump( $_POST['rules']);
        
    }   ################    Form Processing    ################
    

 

?>

    <div class="uk-container uk-margin">
        <form class="uk-form-horizontal" action="contact.php" method="post" enctype="multipart/form-data">
            <fieldset class="uk-fieldset">

                <legend class="uk-legend">فرم تماس با ما</legend>

                <div class="uk-margin">
                    <label class="uk-form-label" for="flname">نام و نام خانوادگی: </label>
                    <input class="uk-input uk-form-width-medium" id="flname" name="flname" type="text" placeholder="">
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="phone">شماره موبایل: </label>
                    <input class="uk-input uk-form-width-medium" id="phone" name="phone" type="text" placeholder="">
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="Email">ایمیل: </label>
                    <input class="uk-input uk-form-width-medium"id="Email" name="email" type="text" placeholder="">
                </div>

                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                    <label class="uk-form-label" >جنسیت: </label>
                    <label><input class="uk-radio" value="M" type="radio" name="radio2" checked> مرد</label>
                    <label><input class="uk-radio" value="F" type="radio" name="radio2"> زن</label>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="select1">ارسال پیام به: </label>
                    <select class="uk-select uk-form-width-medium" name="select1" id="select1">
                        <option value="sale" >واحد فروش </option>
                        <option value="support">پشتیبانی فنی</option>
                        <option value="management">مدیریت</option>
                    </select>
                </div>

                <div class="uk-margin">
                    <label for="file" class="uk-form-label">آپلود تصویر: </label>
                    <input type="file" class="uk-file" id="file" name="image1">
                </div>

                <div class="uk-margin uk-form-width-large">
                    <textarea class="uk-textarea" name="massage" rows="5" placeholder="متن پیام..."></textarea>
                </div>

                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                    <label>
                    <input class="uk-checkbox" name="rules" type="hidden" value="0" >
                    <input class="uk-checkbox" name="rules" type="checkbox" value="I_do"> شرایط و قوانین را قبول دارم.
                    </label>
                </div>

                <div class="uk-margin">
                    <input type="submit" class="uk-button uk-button-primary" name="senddata" value="ارسال پیام">
                </div>

            </fieldset>
        </form>
    </div>

<?php
    require ("theme/footer.php");
?>