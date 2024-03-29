<?php
$title = "همه کاربران";
require_once( "functions.php" );

if( !isset( $_SESSION[ 'iman_project' ] ) ) {
    header( 'location:login.php' );
}
/*****  DELETE user     *****/

if( isset( $_REQUEST[ 'action' ] ) == "delete" && isset( $_REQUEST[ 'id' ] ) ) {
    $id = htmlspecialchars( trim( $_REQUEST[ 'id' ] ) );
    
    $stmt = "DELETE FROM `users` WHERE `id`=$id";
    sql_runner( $stmt );
}

// GET ALL USERS WITH THEIR AVATAR
$stmt = " SELECT *,`users`.`id` AS `users_id` FROM  `users` LEFT JOIN  `attachments` ON (`users`.avatar_id=`attachments`.id)";
$users = sql_runner_fetch_all( $stmt );

/*****  end of DELETE user     *****/
require_once( "header.php" );
require_once( "default-page.php" );


?>
<div class="uk-child-width-expand@s uk-grid-match " uk-grid>

    <div>
        <div class="uk-card uk-card-default uk-card-hover uk-card-body">
            <h3 class="uk-card-title"><?php echo $title; ?></h3>
            <!-----    TABLE    ----->
            <div class="uk-overflow-auto">
                <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                    <thead>
                    <tr>
                        <!--                        <th class="uk-table-shrink">انتخاب</th>-->
                        <th class="uk-table-shrink">آواتار</th>
                        <th class="uk-table-shrink">نام کاربری</th>
                        <th class="uk-width-small">نام و نام خانوادگی</th>
                        <th class="uk-table-shrink uk-text-nowrap">ایمیل</th>
                        <th class="uk-table-shrink uk-text-nowrap">تلفن</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach( $users as $user ) {
                        ?>
                        <tr>
                            <!--                            <td><input class="uk-checkbox" type="checkbox"></td>-->
                            <td><img class="uk-preserve-width uk-border-circle"
                                     src="<?= $user[ 'path' ] ? $user[ 'path' ] : "images/default.png" ?>"
                                     width="40px" height="40px" alt=""></td>
                            <td class="uk-table-link">
                                <a class="uk-link-reset" href=""><?php echo $user[ 'username' ]; ?></a>
                                <div class="edit"><a
                                            href="<?php echo "update-user.php?id=" . $user[ 'users_id' ]; ?> ">ویرایش</a>
                                    |
                                </div>
                                <div class="delete"><a
                                            href="<?php echo "users.php?action=delete&id=" . $user[ 'users_id' ]; ?>">حذف
                                        کاربر</a></div>
                            </td>
                            <td class="uk-text-truncate"><?php echo $user[ 'first_name' ] . " " . $user[ 'last_name' ]; ?></td>
                            <td class="uk-text-nowrap"><?php echo $user[ 'email' ]; ?></td>
                            <td class="uk-text-nowrap"><?php echo $user[ 'phone' ]; ?></td>
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

<?php
require_once( "footer.php" );
?>
