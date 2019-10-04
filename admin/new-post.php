<?php
$title = "نوشته جدید";
require_once( "functions.php" );

if( !isset( $_SESSION[ 'iman_project' ] ) ) {
    header( 'location:login.php' );
}
require_once( "header.php" );
require_once( "../DatabaseConnection.php" );
require_once( "default-page.php" );


?>
<?php

if( user_input_check( 'POST' , 'sendpost' ) ) {
    if( user_input_check( 'POST' , 'post-title' ) ) {
        $post_title = $_POST[ 'post-title' ];
        try {
            #####   SEND NEW POST INFO  #####
            $query = $connection -> prepare( "INSERT INTO `posts`(`id`, `auther_id`, `created_at`, `updated_at`, `title`, `content`, `status`, `slug`) VALUES (null,[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8]) " );
            $query -> execute();
            $row = $query -> fetch( PDO::FETCH_ASSOC );
        } catch( PDOException $e ) {
        
        }
    }
    if( user_input_check( 'POST' , 'post-contetn' ) ) {
        $post_content = $_POST[ 'post-content' ];
    }
}

?>

<div id="admin-post">

    <!-----------------     Post Editor Form     ---------------->
    <div class="uk-container">
        <form class="editor">
            <div class="uk-margin">
                مطلب جدید
                <input class="uk-input" name="post-title" type="text" placeholder=" عنوان مطلب را وارد کنید">

            </div>
            <div class="uk-margin">
                <textarea class="uk-textarea" name="post-content" rows="20" id="textarea1"></textarea>
            </div>
            <div class="uk-margin">
                <input type="submit" name="sendpost" class="uk-button uk-button-danger" value="انتشار">
            </div>
        </form>
    </div>
    <!-----------------     End Post Editor Form     ---------------->
</div>


<!-------######################     Scripts here!     ######################-------->

<!-----------------     CKEditor4 activation Script     ---------------->
<script>
    CKEDITOR.replace('textarea1');
</script>
<!-----------------     End of CKEditor4 activation Script     ---------------->


<!-----------------     TinyMCE Editor activation Script     ---------------->
<!-----------------
<script>
    tinymce.init({
        selector: '#textarea1',
        directionality : 'rtl',
        plugins: [ 'link image imagetools table spellchecker directionality'],
        toolbar: "undo redo | styleselect | bold italic | link image | alignleft aligncenter alignright | ltr rtl",
        menubar: 'file edit insert view format table tools help',
        menu:
        {
            file: {title: 'File', items: 'newdocument'},
            edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
            insert: {title: 'Insert', items: 'link media | template hr'},
            view: {title: 'View', items: 'visualaid'},
            format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
            table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
            tools: {title: 'Tools', items: 'spellchecker code'}
        }
    });
</script>
---------------->
<!-----------------     End TinyMCE Editor activation Script     ---------------->

<!-----------------     CKEditor5 activation Script     ---------------->
<!-----------------
<script>
    ClassicEditor
      .create( document.querySelector( '#textarea2' ) )
      .catch( error => {
          console.error( error );
      } );
</script>
---------------->
<!-----------------     End TinyMCE Editor activation Script     ---------------->

<?php
require_once( "footer.php" );
?>
