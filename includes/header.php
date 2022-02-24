<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PXVDMNJ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Preloader -->
    <!--div id="preloader">
        <div>
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
            <span>Wait, please...</span>
        </div>
    </div-->
    <!-- /Preloader -->

    <!-- Top Search Area Start -->
    <div class="top-search-area">
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <!-- Close Button -->
                        <button type="button" class="btn close-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                        <!-- Form -->
                        <form name="search" action="search" method="post">
                            <input type="search" required="yes" type="text" name="searchtitle" class="form-control" placeholder="Type keywords and hit enter...">
                            <button type="submit" name="submit"><i class="fas fa-search"></i>Search</button>
                        </form>
                        <!-- Search Button -->
                        <div class="search-btn"><i class="icon_search"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Search Area End -->

    <!-- Social Share Area Start -->
    <div class="razo-social-share-area">
        <a href="<?php echo socialshare('facebook', $params); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="<?php echo socialshare('twitter', $params); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
        <a href="<?php echo socialshare('linkedin', $params); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a>
        <a href="<?php echo socialshare('google-plus', $params); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
        <a href="<?php echo socialshare('whatsapp', $params); ?>" class="whatsapp"><i class="fa fa-whatsapp"></i></a>
        <a href="#" class="ss-close-btn"><i class="arrow_right"></i></a>
    </div>
    <!-- Social Share Area End -->

    <!-- Header Area Start -->
    <header class="header-area">
        <!-- Main Header Start -->
        <div class="main-header-area">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Classy Menu -->
                    <nav class="classy-navbar justify-content-between" id="razoNav">

<!-- Logo -->
                        <a class="nav-brand" href="."><img src="./img/core-img/logo.png" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">
                            <!-- Menu Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul id="nav">
                                    <li><a href=".">Home</a></li>
                                   	<li><a href="./news">News</a></li>
                                    <li><a href="./music">Music</a></li>
                                    <li><a href="./video">Video</a></li>
                                    <li><a href="./blog">Blog</a></li>

                                    <li><a href="#">Pages</a>
                                        <ul class="dropdown">
                                            <li><a href="#">- About Us</a></li>
                                            <li><a href="#">- Contact Us</a></li>
                                   				 <li><a href="./lyric">- Lyrics</a></li>
                                   				 <li><a href="#">- Hits</a></li>
                                        </ul>
																</li>
																
                                    <li><a href="./users">Users Home</a></li>
                                    <li data-toggle="modal" data-target="#searchModal"><a>Search</a></li>
                                </ul>

                                <!-- Share Icon -->
                                <div class="social-share-icon">
                                    <i class="social_share"></i>
                                </div>

                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->
