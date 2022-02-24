<!-- Footer Area Start -->
    <footer class="footer-area">
        <!-- Main Footer Area -->
        <div class="main-footer-area section-padding-80-0">
            <div class="container">
                <div class="row justify-content-between">

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                        <div class="single-footer-widget mb-80">
                            <!-- Footer Logo -->
                          <!-- Widget Title -->
                            <h4 class="widget-title">Contact Us</h4>
								<?php 
								$pagetype='aboutus';
								$query="select PageTitle,Description from tblpages where PageName='$pagetype'";
								$result=mysqli_query($con,$query) or die ( ((is_object($con))? mysqli_error($con) : (($___mysqli_res = mysqli_connect_error()) ?$___mysqli_res : true))); 
								$row = mysqli_fetch_assoc($result);	?>
								
												 <h6><?php echo $row['PageTitle']; ?></h6>
                            <p class="mb-30"><?php echo $row['Description']; ?></p>

                            <!-- Footer Content -->
                            <div class="footer-content">

                                <!-- Single Contact Info -->
								<?php 
								$title='contact';
								$query="select * from tbllinks where Title='$title'";
								$result=mysqli_query($con,$query) or die ( ((is_object($con))? mysqli_error($con) : (($___mysqli_res = mysqli_connect_error()) ?$___mysqli_res : true))); 
								$link = mysqli_fetch_assoc($result);	?>
														
                                <div class="single-contact-info d-flex">
                                    <div class="icon">
                                        <i class="icon_pin"></i>
                                    </div>
                                    <div class="text">
                                        <p><?php echo htmlentities($link['Address']); ?></p>
                                    </div>
                                </div>

                                <!-- Single Contact Info -->
                                <div class="single-contact-info d-flex">
                                    <div class="icon">
                                        <i class="icon_phone"></i>
                                    </div>
                                    <div class="text">
                                        <p><?php echo htmlentities($link['Phone']); ?></p>
                                    </div>
                                </div>

                                <!-- Single Contact Info -->
                                <div class="single-contact-info d-flex">
                                    <div class="icon">
                                        <i class="icon_mail_alt"></i>
                                    </div>
                                    <div class="text">
                                        <p><?php echo htmlentities($link['Email']); ?></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                        <div class="single-footer-widget mb-80">

                            <!-- Widget Title -->
                            <h4 class="widget-title">Social Link Up</h4>

                            <!-- Single Twitter Feed -->
                            <div class="single-twitter-feed d-flex">
                                <div class="tweet-icon">
                                    <i class="fa fa-facebook"></i>
                                </div>
                                <div class="tweet">
                                    <p><a href="<?php echo htmlentities($link['Facebook']); ?>">Explicit9ja fb Page</a> Explicit9ja Entertainment</p>
                                </div>
                            </div>

                            <!-- Single Twitter Feed -->
                            <div class="single-twitter-feed d-flex">
                                <div class="tweet-icon">
                                    <i class="fa fa-twitter"></i>
                                </div>
                                <div class="tweet">
                                    <p><a href="<?php echo htmlentities($link['Tweeter']); ?>">Explicit9ja Tweet</a> @explicit9ja</p>
                                </div>
                            </div>

                            <!-- Single Twitter Feed -->
                            <div class="single-twitter-feed d-flex">
                                <div class="tweet-icon">
                                    <i class="fa fa-instagram"></i>
                                </div>
                                <div class="tweet">
                                    <p><a href="<?php echo htmlentities($link['Instagram']); ?>">E9ja Insta Page</a> Explicit9ja</p>
                                </div>
                            </div>

                             <!-- Single Twitter Feed -->
                            <div class="single-twitter-feed d-flex">
                                <div class="tweet-icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                                <div class="tweet">
                                    <p><a href="<?php echo htmlentities($link['WhatsApp']); ?>">Whatsapp Group</a> Explicit9ja Media</p>
                                </div>
                            </div>

                             <!-- Single Twitter Feed -->
                            <div class="single-twitter-feed d-flex">
                                <div class="tweet-icon">
                                    <i class="fa fa-google"></i>
                                </div>
                                <div class="tweet">
                                    <p><a href="<?php echo htmlentities($link['Google']); ?>">Google Plus Page</a> Explicit9ja google</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-md-4 col-xl-3">
                        <div class="single-footer-widget mb-80">
                            <!-- Widget Title -->
                            <h4 class="widget-title">Post Gallery</h4>

                            <!-- Instagram Area -->
                            <div class="razo-instagram-area d-flex flex-wrap">
                                <!-- Single Instagram Feed -->
                                
							<?php 
					        $pageno = 1;
                            $no_of_records_per_page = 9;
                            $offset = ($pageno-1) * $no_of_records_per_page;
                            $total_pages_sql = "SELECT COUNT(*) FROM tblgallery";
                            $result = mysqli_query($con,$total_pages_sql);
                            $total_rows = mysqli_fetch_array($result, MYSQLI_NUM)[0];
                            $total_pages = ceil($total_rows / $no_of_records_per_page);
                            $query=mysqli_query($con,"select * from tblgallery order by id desc LIMIT $offset, $no_of_records_per_page");
                            while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                            ?>

                                <div class="single-instagram-feed">
                                    <a href="#"><img style="height:90px; width:150px;" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt=""></a>
                                </div>

							<?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

			 <!-- Main Footer Area End -->
        
        <!-- Copywrite Text -->
        <div class="copywrite-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Copywrite Text -->
                        <div class="copywrite-text">
                         <p style="color:#1976D2;">
					        Copyright &copy; Explicit9ja Entertainment <script>document.write(new Date().getFullYear());</script> | All rights reserved <br /> Powered By <a href="http://linfglobe.xtgem.com">Kixfobby Networlds.&trade;</a> 
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

    <!-- All JS Files -->

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Popper -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- All Plugins -->
    <script src="js/razo.bundle.js"></script>
    <!-- Active -->
    <script src="js/default-assets/active.js"></script>
    <!-- Like -->
    <script src="like/like.js"></script>