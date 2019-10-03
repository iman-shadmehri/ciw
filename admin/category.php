<?php
$title = "دسته ها";
require_once( "functions.php" );

if( !isset( $_SESSION[ 'iman_project' ] ) ) {
    header( 'location:login.php' );
}
/***** INSERT CATEGORY *****/
if( user_inputs_check( $_POST ) ) {
    
    $category_title = htmlspecialchars( $_POST[ 'category-title' ] );
    $category_slug = htmlspecialchars( str_replace( ' ' , '-' , $_POST[ 'category-slug' ] ) );
    
    //slug is uniqe
    if( is_unique( $categories , "slug" , $category_slug ) ) {
        $sql = "INSERT INTO `categories` (`name`,`slug`) VALUES (?,?)";
        sql_runner( $sql , [ $category_title , $category_slug ] );
    }
    else {
        $i = 1;
        $category_slug = $category_slug . "-" . $i;
        while( !is_unique( $categories , "slug" , $category_slug ) ) {
            $i++;
        }
        $sql = "INSERT INTO `categories` (`name`,`slug`) VALUES (?,?)";
        sql_runner( $sql , [ $category_title , $category_slug ] );
    }
}
/***** END INSERT CATEGORY *****/
$sql = "SELECT * FROM `categories` ORDER BY `name`";
$categories = sql_runner_fetch_all( $sql , [] );


require_once( "header.php" );
require_once( "../DatabaseConnection.php" );
require_once( "default-page.php" );
?>

    <div id="admin-category">

        <!-----------------     CATEGORY     ---------------->
        <div class="uk-container">
            <form class="category-form" method="POST">
                <div class="uk-margin">
                    نام دسته
                    <input class="uk-input" name="category-title" type="text" placeholder=" نام">
                </div>
                <div class="uk-margin">
                    نامک
                    <input class="uk-input" name="category-slug" type="text" placeholder="نامک">
                </div>
                <div class="uk-margin">
                    <input type="submit" name="create-category" class="uk-button uk-button-danger"
                           value="ایجاد دسته تازه">
                </div>
            </form>
            <hr>
            <!-----------------     SHOW CATEGORY     ---------------->

            <div class="uk-child-width-expand@s uk-grid-match " uk-grid>

                <div>
                    <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                        <h3 class="uk-card-title"><?php echo $title; ?></h3>
                        <!-----    TABLE    ----->
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                                <thead>
                                <tr>
                                    <th class="uk-table-shrink">نام دسته</th>
                                    <th class="uk-width-small">نامک</th>
                                    <th class="uk-table-shrink">شناسه</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach( $categories as $category ) {
                                    ?>
                                    <tr>
                                        <td class="uk-table-link">
                                            <a class="uk-link-reset" href=""><?php echo $category[ 'name' ]; ?></a>
                                            <div class="edit"><a
                                                        href="<?php echo "category.php?id=" . $category[ 'id' ]; ?> ">ویرایش</a>
                                                |
                                            </div>
                                            <div class="delete"><a
                                                        href="<?php echo "category.php?action=delete&id=" . $category[ 'id' ]; ?>">حذف
                                                    دسته</a></div>
                                        </td>
                                        <td class="uk-text-nowrap"><?php echo $category[ 'slug' ]; ?></td>
                                        <td class="uk-text-nowrap"><?php echo $category[ 'id' ]; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-----------------     SHOW CATEGORY     ---------------->

        </div>
        <!-----------------     CATEGORY     ---------------->
    </div>


<?php
require_once( "footer.php" );
?>