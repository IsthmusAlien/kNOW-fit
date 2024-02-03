<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kNOW fit</title>
    <link rel="stylesheet" href="css/extra.css">
    <link rel="icon" sizes="180x180" href="imgs/tab_logo.png" type="image/png"> 
  </head>
  <body>
    <div class="fitter">
        <div class="header_box_mob">
            <header>
                <nav class="head_nav_mob">
                    <div class="straighter">
                        <button class="button_transper" onclick="drop_mob()">
                            <span>
                                <img class="head_menu_icon_mob" src="imgs/menu_icon_mob.png" alt="MENU">
                            </span>
                        </button>
                        <ul class="list_cleaner">
                            <div class="header_buttons_mob">
                                <a href="register.php">
                                    <button class="button_centerer">
                                        <span class="button_text"><h4>Register</h4></span>
                                    </button>
                                </a>
                            </div>
                            <div class="header_buttons_mob">
                                <a href="/Sign In">
                                    <button class="button_centerer">
                                        <span class="button_text"><h4>Sign In</h4></span>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="header_dropdown_mob" style="display: none;">
                            <a class="header_links_tab" href="/Loose Weight" tabindex="-1"><h5 class="header_texts">Loose Weight</h5></a>
                            <a class="header_links_tab" href="/Get Active" tabindex="-1"><h5 class="header_texts">Get Active</h5></a>
                            <a class="header_links_tab" href="/Improve Lifestyle" tabindex="-1"><h5 class="header_texts">Improve Lifestyle</h5></a>
                        </div>
                    </ul>
                </nav>
            </header>
        </div>
        <div class="header_box_tab">
            <header>
                <nav class="head_nav_tab">
                    <button class="button_transper" onclick="drop_tab()">
                        <span>
                            <img class="head_menu_icon_tab" src="imgs/menu_icon_tab.png" alt="MENU">
                        </span>
                    </button>
                    <div class="header_dropdown_tab" style="display: none;">
                    <a class="header_links_tab" href="/Loose Weight" tabindex="-1"><h5 class="header_texts">Sign In</h5></a>
                    <a class="header_links_tab" href="register.php" tabindex="-1"><h5 class="header_texts">Register</h5></a>
                    <a class="header_links_tab" href="/Loose Weight" tabindex="-1"><h5 class="header_texts">Loose Weight</h5></a>
                    <a class="header_links_tab" href="/Get Active" tabindex="-1"><h5 class="header_texts">Get Active</h5></a>
                    <a class="header_links_tab" href="/Improve Lifestyle" tabindex="-1"v><h5 class="header_texts">Improve Lifestyle</h5></a>
                    </div>
                </nav>
            </header>
        </div>
        <div class="header_box_des">
            <header>
                <div class="flexer">
                    <div class="flexer">
                        <a href="home.php" tabindex="-1"><img class="head_logo_img" src="imgs/hefo_logo.png" alt="LOGO"></a>
                        <a class="header_links_des" href="/Loose Weight" tabindex="1"><h5 class="header_texts">Loose Weight</h5></a>
                        <a class="header_links_des" href="/Get Active" tabindex="2"><h5 class="header_texts">Get Active</h5></a>
                        <a class="header_links_des" href="/Improve Lifestyle" tabindex="3"><h5 class="header_texts">Improve Lifestyle</h5></a>
                    </div>
                    <div class="flexer">
                        <div class="header_buttons_des">
                            <a href="register.php" tabindex="-1">
                                <button class="button_centerer" tabindex="-1">
                                    <span class="button_text"><h3>Register</h3></span>
                                </button>
                            </a>
                        </div>
                        <div class="header_buttons_des">
                            <a href="/Sign In" tabindex="-1">
                                <button class="button_centerer" tabindex="-1">
                                    <span class="button_text"><h3>Sign In</h3></span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <main>
            
        </main>
        <div class="footer_box_des_tab">
            <footer>
                <div class="flexer"> 
                    <a href="home.php" tabindex="-1"><img class="footer_logo_img_des_tab" src="imgs/hefo_logo.png" alt="LOGO"></a>
                    <a class="footer_links_des_tab" href="about.php" tabindex="4"><h5 class="footer_texts_des_tab">About Us</h5></a>
                </div>
            </footer>    
        </div>
        <div class="footer_box_mob">
            <footer>
                <div>
                    <a href="home.php"><img class="footer_logo_img_mob" src="imgs/hefo_logo.png" alt="LOGO"></a>
                    <div class="divider"></div>
                    <a class="footer_links_mob" href="about.php"><h5 class="footer_texts_mob">About Us</h5></a>
                </div>
            </footer>
        </div>
    </div>
  </body>
  <script src="js/dropdown_global.js"></script>  
</html>