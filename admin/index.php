<?php
$title = "داشبورد";
require_once( "functions.php" );

if( !isset( $_SESSION[ 'iman_project' ] ) ) {
    header( 'location:login.php' );
}

require_once( "header.php" );
require_once( "default-page.php" );
?>


    <p class="session">
        <?php var_dump( $_SESSION[ 'iman_project' ] ); ?>
    </p>


<?php
require_once( "footer.php" );
?>