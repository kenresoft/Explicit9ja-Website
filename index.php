<?php 
session_start();
include('includes/config.php'); ?>
<?php //Code for Page/Post Hits
$query="SELECT * from tblposts"; $result=mysqli_query($con,$query) or die ( ((is_object($con))? mysqli_error($con) : (($___mysqli_res = mysqli_connect_error()) ?$___mysqli_res : true))); 
$row = mysqli_fetch_assoc($result);
//pageview count query
//$page=$row['PostTitle'];
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<?php include('includes/head-tag.php'); ?>
    <!-- Title -->
    <title>Explicit9ja.com | Home</title>

    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
	
  <?php include('includes/share.php'); ?>
		<?php include('includes/header.php'); ?>

	
    <!-- Welcome Area Start -->
    <section class="welcome-area">
        <div class="welcome-slides owl-carousel">

            <!-- Single Welcome Slide -->
            <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url(img/bg-img/1.jpg);">
                <!-- Welcome Content -->
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center justify-content-center">
                            <!-- Welcome Text -->
                            <div class="col-12 col-md-9 col-lg-6">
                                <div class="welcome-text text-center">
                                    <h2 data-animation="fadeInUpBig" data-delay="100ms">Welcome To Explicit9ja!</h2> <h5 data-animation="fadeInUpBig" data-delay="400ms">Your Entertainment World.</h5>
                                    <a href="./users" class="btn razo-btn btn-2" data-animation="fadeInUpBig" data-delay="700ms">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Welcome Slide -->
            <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url(img/bg-img/30.jpg);">
                <!-- Welcome Content -->
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center justify-content-center">
                            <!-- Welcome Text -->
                            <div class="col-12 col-md-10 col-lg-6">
                                <div class="welcome-text text-center">
                                    <h2 data-animation="fadeInUpBig" data-delay="100ms">Welcome To Explicit9ja!</h2> <h5 data-animation="fadeInUpBig" data-delay="400ms">Your Entertainment World.</h5>
                                    <a href="./users" class="btn razo-btn btn-2" data-animation="fadeInUp" data-delay="700ms">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Welcome Slide -->
            <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url(img/bg-img/32.jpg);">
                <!-- Welcome Content -->
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center justify-content-center">
                            <!-- Welcome Text -->
                            <div class="col-12 col-md-10 col-lg-6">
                                <div class="welcome-text text-center">
                                    <h2 data-animation="fadeInUpBig" data-delay="100ms">Welcome To Explicit9ja!</h2> <h5 data-animation="fadeInUpBig" data-delay="400ms">Your Entertainment World.</h5>
                                    <a href="./users" class="btn razo-btn btn-2" data-animation="fadeInUp" data-delay="700ms">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Welcome Slide -->
            <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url(img/bg-img/33.jpg);">
                <!-- Welcome Content -->
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center justify-content-center">
                            <!-- Welcome Text -->
                            <div class="col-12 col-md-10 col-lg-6">
                                <div class="welcome-text text-center">
                                    <h2 data-animation="fadeInUpBig" data-delay="100ms">Welcome To Explicit9ja!</h2> <h5 data-animation="fadeInUpBig" data-delay="400ms">Your Entertainment World.</h5>
                                    <a href="./users" class="btn razo-btn btn-2" data-animation="fadeInUp" data-delay="700ms">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Welcome Area End -->

    <!-- Blog Area Start -->
    <section class="razo-blog-area section-padding-80-0">
        <div class="container">
            <div class="row">
                <!-- Weekly News Area -->
                <div class="col-12 col-md-8">
                    <div class="weekly-news-area mb-50">
                        <!-- Section Heading -->
                        <div class="section-heading">
                            <h2>Latest News</h2>
                        </div>

                        <!-- Featured Post Area -->
                        <?php 
                            $offset = 0;
                            $no_of_records_per_page = 1;
                            $query=mysqli_query($con,"select tblnews.views, tblnews.id as pid,tblnews.PostTitle as posttitle,tblnews.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblnews.PostDetails as postdetails,tblnews.PostingDate as postingdate,tblnews.PostUrl as url from tblnews left join tblcategory on tblcategory.id=tblnews.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblnews.SubCategoryId where tblnews.Is_Active=1 order by tblnews.id desc  LIMIT $offset, $no_of_records_per_page");
                            while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                $mpage = htmlentities($row['posttitle']);
                                $id = $row['pid'];
                            ?>
                        <div class="featured-post-area bg-img bg-overlay mb-30" style="background-image: url(admin/postimages/<?php echo htmlentities($row['PostImage']);?>);">
                            <!-- Post Overlay -->
                            <div class="post-overlay">
                                <div class="post-meta">
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 2.1k</a>
                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i><?php $count="SELECT * FROM tblnews WHERE pid=$id;"; echo $row['views'];?> </a>
                                </div>
                                <a href="single-news?e-news=<?php echo $row['url'];?>" class="post-title"><?php echo htmlentities($row['posttitle']);?></a>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="row">

                          <!-- Blog Post -->
                          <?php 
                    	    if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }
                            $no_of_records_per_page = 8;
                            $offset = ($pageno-1) * $no_of_records_per_page;
                            $total_pages_sql = "SELECT COUNT(*) FROM tblnews";
                            $result = mysqli_query($con,$total_pages_sql);
                            $total_rows = mysqli_fetch_array($result, MYSQLI_NUM)[0];
                            $total_pages = ceil($total_rows / $no_of_records_per_page);
                            $query=mysqli_query($con,"select tblnews.views, tblnews.id as pid,tblnews.PostTitle as posttitle,tblnews.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblnews.PostDetails as postdetails,tblnews.PostingDate as postingdate,tblnews.PostUrl as url from tblnews left join tblcategory on tblcategory.id=tblnews.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblnews.SubCategoryId where tblnews.Is_Active=1 order by tblnews.id desc  LIMIT $offset, $no_of_records_per_page");
                            while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                $mpage = htmlentities($row['posttitle']);
                                $id = $row['pid'];
                            ?>

                            <!-- Single Post Area -->
                            <div class="col-12 col-md-6">
                                <div class="razo-single-post d-flex mb-30">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <a href="single-news?e-news=<?php echo $row['url'];?>"><img style="height:70px; width:140px;" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>"></a>
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <div class="post-meta">
                                            <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 2.1k</a>
                                            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> <?php $count="SELECT * FROM tblnews WHERE pid=$id;"; echo $row['views'];?></a>
                                        </div>
                                        <a href="single-news?e-news=<?php echo $row['url'];?>" class="post-title"><?php echo htmlentities($row['posttitle']);?></a>
                                    </div>
                                </div>
                            </div>
                            
                            <?php } ?>

                        </div>
                    </div>
                </div>

                <!-- Trending News Area -->
                <div class="col-12 col-md-4">
                    <div class="trending-news-area mb-50">

                        <!-- Section Heading -->
                        <div class="section-heading">
                            <h2>Trending</h2>
                        </div>

                        <!-- Featured Post Area -->
                        <?php 
                            $offset = 0;
                            $no_of_records_per_page = 1;
                            $query=mysqli_query($con,"select tblposts.views, tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
                            while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                $mpage = htmlentities($row['posttitle']);
                                $id = $row['pid'];
                            ?>
                        <div class="featured-post-area small-featured-post bg-img bg-overlay mb-30" style="background-image: url(admin/postimages/<?php echo htmlentities($row['PostImage']);?>);">
                            <!-- Post Overlay -->
                            <div class="post-overlay">
                                <div class="post-meta">
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 2.1k</a>
                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> <?php $count="SELECT * FROM tblposts WHERE pid=$id;"; echo $row['views'];?></a>
                                </div>
                                <a href="single-blog?e-blog=<?php echo $row['url'];?>" class="post-title"><?php echo htmlentities($row['posttitle']);?></a>
                            </div>
                        </div>

                        <?php } ?>

                        <!-- Blog Post -->
                        <?php 
                        if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }
                            $no_of_records_per_page = 8;
                            $offset = ($pageno-1) * $no_of_records_per_page;
                            $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                            $result = mysqli_query($con,$total_pages_sql);
                            $total_rows = mysqli_fetch_array($result, MYSQLI_NUM)[0];
                            $total_pages = ceil($total_rows / $no_of_records_per_page);
                            $query=mysqli_query($con,"select tblposts.views, tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
                            while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                $mpage = htmlentities($row['posttitle']);
                                $id = $row['pid'];
                            ?>

                        <!-- Single Post Area -->
                        <div class="razo-single-post d-flex mb-30">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <a href="single-blog?e-blog=<?php echo $row['url'];?>"><img style="height:70px; width:140px;" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>"></a>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <div class="post-meta">
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 2.1k</a>
                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> <?php $count="SELECT * FROM tblposts WHERE pid=$id;"; echo $row['views'];?></a>
                                </div>
                                <a href="single-blog.php?e-blog=<?php echo $row['url'];?>" class="post-title"><?php echo htmlentities($row['posttitle']);?></a>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Area End -->

    <!-- Music Charts Area Start -->
    <section class="razo-music-charts-area section-padding-80 bg-overlay bg-img jarallax" style="background-image: url(img/bg-img/31.jpg);">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-sm-6">
                    <div class="section-heading white">
                        <h2>Music Chart</h2>
                    </div>
                </div>
                <!-- Show All Button -->
                <div class="col-sm-6">
                    <div class="show-all-button mb-50 text-right">
                        <a href="music" class="btn show-all-btn">Show All Trending (Top 10)</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    <!-- Single Music Chart -->
									<?php 
                        if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }
                            $no_of_records_per_page = 5;
                            $offset = ($pageno-1) * $no_of_records_per_page;
                            $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                            $result = mysqli_query($con,$total_pages_sql);
                            $total_rows = mysqli_fetch_array($result, MYSQLI_NUM)[0];
                            $total_pages = ceil($total_rows / $no_of_records_per_page);
                            $query=mysqli_query($con,"select tblsongs.id as pid,tblsongs.PostTitle as posttitle,tblsongs.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblsongs.PostDetails as postdetails,tblsongs.PostingDate as postingdate,tblsongs.PostUrl as url,tblsongs.File as file from tblsongs left join tblcategory on tblcategory.id=tblsongs.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblsongs.SubCategoryId where tblsongs.Is_Active=1 order by tblsongs.id desc  LIMIT $offset, $no_of_records_per_page");
                            $i=0;
                            while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                            $mpage = htmlentities($row['posttitle']);
                            $i++;
                         ?>
                    <div class="single-music-chart d-flex align-items-center justify-content-between wow fadeInUp" data-wow-delay="100ms">
                        <!-- Music Content -->
                        <div class="music-content d-flex align-items-center">
                            <div class="sl-number">
                                <h5><?php echo $i;?>.</h5>
                            </div>
                            <div class="music-thumb">
                                <img style="height:70px; width:140px;"  src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="">
                            </div>
                            <div class="audio-player">
                                <audio preload="auto" controls>
                                    <source src="admin/songs/<?php echo htmlentities($row['file']); ?>">
                                </audio>
                            </div>
                            <div class="music-title">
                                <h5 class="wordwrap"><?php echo htmlentities($row['posttitle']); ?> - <span><?php echo htmlentities($row['file']); ?></span></h5>
                            </div>
                        </div>
                        <!-- Music Price -->
                        <div class="music-price">
                            <a href="music-detail?e-info=<?php echo htmlentities($row['pid']) ?>" class="btn razo-btn btn-2">Preview/Download</a>
                        </div>
                    </div>

								 <?php } ?>

                </div>
            </div>
        </div>
    </section>
    <!-- Music Charts Area End -->

    <!-- Trending Video Area Start -->
    <section class="razo-trending-video-area section-padding-80-0 mb-50">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Trending Video</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Featured Trending Video -->
            <?php 
                $offset = 0;
                $no_of_records_per_page = 1;
                $query=mysqli_query($con,"select tblvideos.id as pid,tblvideos.PostTitle as posttitle,tblvideos.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblvideos.PostDetails as postdetails,tblvideos.PostingDate as postingdate,tblvideos.PostUrl as url,tblvideos.File as file from tblvideos left join tblcategory on tblcategory.id=tblvideos.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblvideos.SubCategoryId where tblvideos.Is_Active=1 order by tblvideos.id desc  LIMIT $offset, $no_of_records_per_page");
                while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                    $mpage = htmlentities($row['posttitle']);
                ?>
                <div class="col-12">
                    <div class="featured-trending-video mb-30 wow fadeInUp" data-wow-delay="100ms">
                       <video class="img-thumbnail" preload="auto" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen controls>
                          	  <source src="admin/videos/<?php echo htmlentities($row['file']); ?>">
                      	 </video>
                    </div>
                </div>
                <?php } ?>

                <!-- Single Post Area -->
  							     <?php 
                        if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }
                            $no_of_records_per_page = 5;
                            $offset = ($pageno-1) * $no_of_records_per_page;
                            $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                            $result = mysqli_query($con,$total_pages_sql);
                            $total_rows = mysqli_fetch_array($result, MYSQLI_NUM)[0];
                            $total_pages = ceil($total_rows / $no_of_records_per_page);
                            $query=mysqli_query($con,"select tblvideos.id as pid,tblvideos.PostTitle as posttitle,tblvideos.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblvideos.PostDetails as postdetails,tblvideos.PostingDate as postingdate,tblvideos.PostUrl as url,tblvideos.File as file from tblvideos left join tblcategory on tblcategory.id=tblvideos.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblvideos.SubCategoryId where tblvideos.Is_Active=1 order by tblvideos.id desc  LIMIT $offset, $no_of_records_per_page");
                            while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                            $mpage = htmlentities($row['posttitle']);
                         ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="razo-single-post d-flex mb-30 wow fadeInUp" data-wow-delay="100ms">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                              <a href="video-detail?e-info=<?php echo $row['pid'];?>"><img style="height:70px; width:140px;" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>"></a>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <div class="post-meta">
                                <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 2.1k</a>
                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> <?php $count="SELECT * FROM tblpage_hits WHERE page='$mpage'";
                                    $feedback=mysqli_query($con,$count) or die (((is_object($con))? mysqli_error($con) : (($___mysqli_res = mysqli_connect_error()) ?$___mysqli_res : true)));
                                    if ($hit_row=mysqli_fetch_assoc($feedback)) {echo $hit_row['count'];} else {echo 0;} ?></a>
                                </div>
                                <a href="video-detail?e-info=<?php echo $row['pid'];?>" class="post-title"><?php echo htmlentities($row['posttitle']);?></a>
                            </div>
                    </div>
                </div>

							<?php } ?>
							
            </div>
        </div>
    </section>
    <!-- Trending Video Area End -->

    <!-- App Download Area Start -->
    <section class="razo-app-download-area section-padding-80-0 bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/21.jpg);">
        <div class="container">
            <div class="row align-items-center">
                <!-- App Thumbnail -->
                <div class="col-12 col-md-6">
                    <div class="app-thumbnail mb-80">
                        <img src="img/bg-img/mockup-iphone.png" alt="">
                    </div>
                </div>
                <!-- App Download Text -->
                <div class="col-12 col-md-6">
                    <div class="app-download-text mb-80">
                        <span>Download app and Enjoy radio &amp; music</span>
                        <h2>Radio Music</h2>
                        <p>Radio app plus is a app that lets you download videos and music from social network, Youtube, etc. You may also download and play the latest HD series and movies, and also watch free live television. This app is also available for Android and Ios.</p>
                        <div class="app-download-btn">
                            <a href="#"><img src="img/core-img/google-play.png" alt=""></a>
                            <a href="#"><img src="img/core-img/app-store.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- App Download Area End -->

    <!-- Weekly Sehedule Area Start -->
    <section class="razo-weekly-schedule-area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="weekly-schedule-table table-responsive">
                        <!-- Section Heading -->
                        <div class="col-12">
                            <div class="section-heading text-center">
                                <h2>E9ja Entertainment World</h2>
                            </div>
                        </div>

                   			

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Weekly Sehedule Area End -->

    <!-- Latest News Area Start -->
    <section class="razo-latest-news-area section-padding-80 bg-overlay bg-img jarallax" style="background-image: url(img/bg-img/32.jpg);">
        <div class="container">
            <div class="row align-items-end">
                <!-- Section Heading -->
                <div class="col-sm-6">
                    <div class="section-heading white">
                        <h2>Blog New</h2>
                    </div>
                </div>
                <!-- Show All Button -->
                <div class="col-sm-6">
                    <div class="show-all-button mb-50 text-right">
                        <a href="news" class="btn show-all-btn">Show All Blog Posts</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Razo Latest News Slide -->
        <div class="razo-latest-news-slide owl-carousel">

            <!-- Blog Post -->
            <?php 
                if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }
                    $no_of_records_per_page = 8;
                    $offset = ($pageno-1) * $no_of_records_per_page;


                    $total_pages_sql = "SELECT COUNT(*) FROM tblnews";
                    $result = mysqli_query($con,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result, MYSQLI_NUM)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);
                    require_once('libs/functions.php');

            $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
            while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            ?>

            <!-- Single Latest News Area -->
            <div class="razo-single-latest-news-area bg-overlay bg-img" style="background-image: url(admin/postimages/<?php echo htmlentities($row['PostImage']);?>);">
                <!-- Post Content -->
                <div class="post-content">
                    <a href="single-blog?e-blog=<?php echo htmlentities($row['url'])?>" class="post-title"><?php echo htmlentities($row['posttitle']);?></a>
                    <p><?php $pt=$row['postdetails']; echo (substr($pt,0,230));?><b>... ...</b></p>
                </div>
                <!-- Post Date -->
                <div class="post-date">
                    <h2><?php echo htmlentities(str_replace("-","/",substr($row['postingdate'],6,4)));?></h2>
                    <p><?php echo htmlentities(substr($row['postingdate'],11,5));?></p>
                    
                </div>
                <!-- Read More -->
                <div class="read-more-btn">
                    <a href="single-news?e-news=<?php echo htmlentities($row['url'])?>" class="btn">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </div>
            </div>

            <?php } ?>

        </div>
    </section>
    <!-- Latest News Area End -->

    <?php include('includes/footer.php'); ?>

</body>

</html>

    
