<?php
$title = "همه کاربران";
require_once( "functions.php" );

/*****  DELETE user     *****/

if (isset($_GET['action']) == "delete") {
    if (isset($_GET['id']))
        $id = htmlspecialchars(trim($_GET['id']));

    $stmt = "DELETE FROM `users` WHERE `id`=$id";
    sql_runner( $stmt );
}

/*****  end of DELETE user     *****/

require_once( "header.php" );

require_once( "default-page.php" );



?>
    <div class="uk-child-width-expand@s uk-grid-match " uk-grid >

        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                <h3 class="uk-card-title"><?php echo $title; ?></h3>
                <!-----    TABLE    ----->
                <div class="uk-overflow-auto">
        <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
            <thead>
            <tr>
                <th class="uk-table-shrink">انتخاب</th>
                <th class="uk-table-shrink">آواتار</th>
                <th class="uk-table-shrink">نام کاربری</th>
                <th class="uk-width-small">نام و نام خانوادگی</th>
                <th class="uk-table-shrink uk-text-nowrap">ایمیل</th>
                <th class="uk-table-shrink uk-text-nowrap">تلفن</th>
            </tr>
            </thead>
            <tbody>
            <?php
            #####   CREATE QUERY AND RUN
            try
            {
                $query = $connection->prepare( "SELECT * FROM `users` " );
                $query->execute();
                //$row = $query->fetch( PDO::FETCH_ASSOC );

                while ( $row = $query->fetch( PDO::FETCH_ASSOC ) )
                {
                ?>
                    <tr>
                        <td><input class="uk-checkbox" type="checkbox"></td>
                        <td><img class="uk-preserve-width uk-border-circle" src="images/default.png" width="40" alt=""></td>
                        <td class="uk-table-link">
                            <a class="uk-link-reset" href=""><?php echo $row['username']; ?></a>
                            <div class="edit"><a href="<?php echo "users.php?action=update&id=".$row['id']; ?> ">ویرایش</a> | </div>
                            <div class="delete"><a href="<?php echo "users.php?action=delete&id=".$row['id']; ?>">حذف کاربر</a></div>
                        </td>
                        <td class="uk-text-truncate"><?php echo $row['first_name'] ." " .$row['last_name']; ?></td>
                        <td class="uk-text-nowrap"><?php echo $row['email']; ?></td>
                        <td class="uk-text-nowrap"><?php echo $row['phone']; ?></td>
                    </tr>
                <?php
                }
            }
            catch ( PDOException $e )
            {
                echo "Connection failed: " .$e->getMessage();
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
