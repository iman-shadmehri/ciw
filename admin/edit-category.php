<?php
$title = "ویرایش دسته ها";
require_once( "functions.php" );

if( !isset( $_SESSION[ 'iman_project' ] ) ) {
    header( 'location:login.php' );
}

/***** FETCH CATEGORY *****/
if( !user_input_check( $_GET[ 'id' ] ) ) {
    header( 'location:category.php' );
}
$id = htmlspecialchars( trim( $_GET[ 'id' ] ) );


require_once( "header.php" );
require_once( "../DatabaseConnection.php" );
require_once( "default-page.php" );

/***** UPDATE CATEGORY *****/
if( user_inputs_check( $_POST ) ) {
    $category_title = htmlspecialchars( $_POST[ 'category-title' ] );
    $category_slug = htmlspecialchars( str_replace( ' ' , '-' , $_POST[ 'category-slug' ] ) );
    
    //slug is unique
    if( is_unique( 'categories' , "slug" , $category_slug ) ) {
        $sql = "UPDATE `categories` SET `name`=? , `slug`=? WHERE `id` = ?";
        sql_runner( $sql , [ $category_title , $category_slug , $id ] );
    }
    else {
        $i = 1;
        $category_slug = $category_slug . "-" . $i;
        while( !is_unique( 'categories' , "slug" , $category_slug ) ) {
            $i++;
        }
        $sql = "UPDATE `categories` SET `name`=? , `slug`=? WHERE `id` = ?";;
        sql_runner( $sql , [ $category_title , $category_slug , $id ] );
    }
}


$sql = "SELECT * FROM `categories` WHERE `id` = ?";
$category = sql_runner_fetch( $sql , [ $id ] );
?>

    <div id="admin-category">

    <!-----------------     CATEGORY     ---------------->
    <div class="uk-container">
    <form class="category-form" method="POST">
        <div class="uk-margin">
            نام دسته
            <input class="uk-input" name="category-title" type="text" placeholder=" نام"
                   value="<?= $category[ 'name' ] ?>">
        </div>
        <div class="uk-margin">
            نامک
            <input class="uk-input" name="category-slug" type="text" placeholder="نامک"
                   value="<?= $category[ 'slug' ] ?>">
        </div>
        <div class="uk-margin">
            <input type="submit" name="update-category" class="uk-button uk-button-danger"
                   value="به روزرسانی">
        </div>
    </form>
    <hr>
    <!-----------------     SHOW CATEGORY     ---------------->

<?php
require_once( "footer.php" );
?>