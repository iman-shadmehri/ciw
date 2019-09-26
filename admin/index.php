<?php
session_start();
    $title = "داشبورد";
    require_once( "header.php" );
    require_once( "../dbconfig.php" );
    require_once( "default-page.php" );
?>


<p class="session">
    <?php  var_dump( $_SESSION[ 'iman_project' ] ); ?>
</p>


<?php    
    require_once( "footer.php" );
?>