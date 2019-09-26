        <nav class="uk-navbar-container">
            <div class=" uk-container uk-flex ">
                <div class="uk-navbar-left uk-width-1-6">
                    <a class="uk-navbar-item uk-logo" href="#">
                        <img src="files/images/owl.png" alt="logo" height="64px" width="61px">    
                    </a>
                </div>
                <div class="uk-navbar-right uk-width-4-6">
                    <ul class="uk-navbar-nav">
                        <?php
                            $menu_items = array ( 
                                "صفحه نخست" => "index.php",
                                "درباره ما" => "about.php",
                                "مقالات" => "blog.php",
                                "تماس با ما" => "contact.php",
                                "ورود کاربران" => "admin/login.php"
                            );

                            foreach ( $menu_items as $item => $link)
                                echo ( '<li><a href="'.$link .'">' .$item .'</a></li>'); 
                        ?>
                    </ul>
                </div>
                <div class=" uk-navbar-left uk-width-1-6">
                <?php require ( "search.php" ); ?>  
                </div>
                
            </div>
            
            
        </nav>