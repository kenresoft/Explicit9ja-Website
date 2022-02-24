<?php
session_start();
include('includes/config.php');
include("plugins/getid3/getid3.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php 
     $title ='E9ja Video Updates';
     $image='img/video.png';
     ?>
 
	<?php include('includes/head-tag.php'); ?>
    <!-- Title -->
    <title>Explicit9ja.com | Video</title>

    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>
<body>

	 <?php include('includes/share.php'); ?>
		<?php include('includes/header.php'); ?>
		

    	<?php //code to get the item using its id
		if (isset($_REQUEST['media-preview'])) {
				$id = $_REQUEST['media-preview'];
				$query = "select tblvideos.PostTitle as posttitle,tblvideos.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblsubcategory.SubCategoryId as sid,tblvideos.PostDetails as postdetails,tblvideos.PostingDate as postingdate,tblvideos.PostUrl as url,tblvideos.File as file from tblvideos left join tblcategory on tblcategory.id=tblvideos.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblvideos.SubCategoryId where tblvideos.id='$id'";
				$result = mysqli_query($con, $query) or die(((is_object($con)) ? mysqli_error($con) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : true)));
				$row = mysqli_fetch_assoc($result);
			}
		else {
    $pageno = 1;
    $no_of_records_per_page = 1;
    $offset = ($pageno - 1) * $no_of_records_per_page;

    $total_pages_sql = "SELECT COUNT(*) FROM tblvideos";
    $result = mysqli_query($con, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result, MYSQLI_NUM)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    require_once('libs/functions.php');

	  $query = mysqli_query($con, "select tblvideos.id as pid,tblvideos.PostTitle as posttitle,tblvideos.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblvideos.PostDetails as postdetails,tblvideos.PostingDate as postingdate,tblvideos.PostUrl as url,tblvideos.File as file from tblvideos left join tblcategory on tblcategory.id=tblvideos.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblvideos.SubCategoryId where tblvideos.Is_Active=1 order by tblvideos.id asc  LIMIT $offset, $no_of_records_per_page");
 		$row = mysqli_fetch_array($query, MYSQLI_ASSOC); 
	  } ?>

    <!-- Podcast Thumbnail Area Start -->
    <section class="podcast-hero-area section-padding-80 bg-overlay bg-img "
        style="background-image: url(img/images/video.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="podcast-hero-text section-padding-80 d-flex align-items-center">
                        <div class="podcast-txt- pr-md-5">

                            <h5>Video Features</h5>
                            <h2>&num; VIDEO HOME</h2>

												  <!--<video class="img-thumbnail" preload="auto" controls>-->
              <!--            	  <source src="admin/videos/<php echo htmlentities($row['file']); ?>">-->
              <!--        			  </video>-->
			
              <!--              <div class="podcast-meta-data">-->
              <!--                  <a href="#" class="event-date"><i class="icon_calendar"></i>-->
              <!--                      <php echo htmlentities($row['postingdate']); ?></a>-->
              <!--                  <a href="#" class="event-time"><i class="icon_clock_alt"></i>-->
              <!--                      <php-->
              <!--                          $filepath = 'admin/videos/' . $row["file"];-->
              <!--                          $getID3 = new getID3;-->
              <!--                          $file = $getID3->analyze($filepath);-->
              <!--                          $playtime_seconds = $file['playtime_seconds'];-->
              <!--                          echo gmdate("H:i:s", $playtime_seconds); ?>-->
              <!--                  </a>-->
              <!--                  <a href="#" class="event-time"><i class="icon_heart_alt"></i> 38</a>-->
              <!--                  <a href="#" class="event-address"><i class="icon_chat_alt"></i> 23</a>-->
              <!--              </div>-->
                        </div>
                        <!--<a href="#" class="pt-5 pt-md-0 pl-md-5"><img src="img/core-img/itunes.png" alt=""></a>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Podcast Thumbnail Area End -->

    <!-- Latest Podcast Area Start -->
    <!--<section class="razo-latest-podcast-area section-padding-80">-->
    <!--    <div class="container">-->
     <!--       <div class="row">-->
     <!--           <div class="col-12">-->

					<!--<ul class="breadcrumb" style="background-color:#3498db;">-->
     <!--           <li class="breadcrumb-item"><a href="index.php">Home</a></li>-->
     <!--           <li class="breadcrumb-item active">Video</li>-->
     <!--       </ul>-->

                   <!-- Section Heading -->
     <!--               <div class="section-heading">-->
     <!--                   <h2>Latest on Video:</h2>-->
     <!--               </div>-->
     <!--           </div>-->
     <!--       </div>-->

            <!-- Latest Podcast Area Start -->
    <section class="razo-music-charts-area section-padding-80 bg-overlay bg-img" style="background-image: url(img/images/bbg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading">
                        <h2>Latest on VIDEO:</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-12">

                <?php
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 8;
                $offset = ($pageno - 1) * $no_of_records_per_page;


                $total_pages_sql = "SELECT COUNT(*) FROM tblvideos";
                $result = mysqli_query($con, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result, MYSQLI_NUM)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                require_once('libs/functions.php');

                $query = mysqli_query($con, "select tblvideos.id as pid,tblvideos.PostTitle as posttitle,tblvideos.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblvideos.PostDetails as postdetails,tblvideos.PostingDate as postingdate,tblvideos.PostUrl as url,tblvideos.File as file from tblvideos left join tblcategory on tblcategory.id=tblvideos.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblvideos.SubCategoryId where tblvideos.Is_Active=1 order by tblvideos.id desc  LIMIT $offset, $no_of_records_per_page");
                    $i=0;
                    while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                    $mpage = htmlentities($row['posttitle']);
                    $i++;
                ?>
                
                <!--<div class="col-12 col-md-12">-->
                    <div class="single-music-chart d-flex align-items-center justify-content-between wow fadeInUp" data-wow-delay="100ms">
                        <!-- Music Content -->
                        <div class="music-content d-flex align-items-center">
                            <div class="sl-number">
                                <h5><?php echo $i;?>.</h5>
                            </div>
                            <div class="music-thumb">
                                <img style="height:70px; width:140px;"  src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="">
                            </div>
                            <!--<div class="audio-player">-->
                            <!--    <audio preload="auto" controls>-->
                            <!--        <source src="admin/songs/<?php echo htmlentities($row['file']); ?>">-->
                            <!--    </audio>-->
                            <!--</div>-->
                            <div class="music-title">
                                <h5><?php echo htmlentities($row['posttitle']); ?> - <span><?php echo htmlentities($row['file']); ?></span></h5>
                            </div>
                        </div>
                        <!-- Music Price -->
                        <div class="music-price">
                            <a href="video-detail.php?e-info=<?php echo htmlentities($row['pid']) ?>" class="btn razo-btn btn-2">Preview/Download</a>
                        </div>
                    </div>
								
                <!-- Single Podcast Area -->
                <!--<div class="col-12 col-md-6 col-xl-3">-->
                <!--    <div class="single-podcast-area mb-30 wow fadeInUp" data-wow-delay="100ms">-->
                        <!-- Thumbnail -->
                <!--        <div class="podcast-thumb">-->
                <!--            <img src="admin/postimages/<php echo htmlentities($row['PostImage']); ?>" alt="">-->
                <!--            <div class="like-comment">-->
                <!--                <a href="#" class="like">2 <i class="icon_heart"></i></a>-->
                <!--                <a href="#" class="like">2 <i class="icon_chat"></i></a>-->
                <!--            </div>-->
                <!--        </div>-->
                        <!-- Content -->
                <!--        <div class="podcast-content">-->
                <!--            <div class="podcast-meta">-->
                <!--                <a href="#"><i class="icon_calendar"></i>-->
                <!--                    <php echo htmlentities($row['postingdate']); ?></a>-->
                <!--                <a href="#"><i class="icon_clock_alt"></i>-->
                <!--                    <php-->
                <!--                        $filepath = 'admin/videos/' . $row["file"];-->
                <!--                        $getID3 = new getID3;-->
                <!--                        $file = $getID3->analyze($filepath);-->
                <!--                        $playtime_seconds = $file['playtime_seconds'];-->
                <!--                        echo gmdate("H:i:s", $playtime_seconds); ?>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <h5><php echo htmlentities($row['posttitle']); ?></h5>-->
                <!--            <div class="border-line"></div>-->
                <!--            <p><php $pt = $row['postdetails'];-->
                <!--                    echo (substr($pt, 0, 180)); ?><b>...</b></p>-->
                <!--            <div class="border-line"></div>-->
                <!--            <div class="play-download-btn d-flex align-items-center justify-content-between">-->
                <!--                <a href="video.php?media-preview=<php echo htmlentities($row['pid']) ?>" class="btn razo-btn btn-sm">preview now</a>-->
                <!--                <a href="video-detail.php?e-info=<php echo htmlentities($row['pid']) ?>"-->
                <!--                    class="music-download-btn"><i class="icon_download"></i></a>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <?php } ?>
        </div>
            </div>

           <div class="row">
                <div class="col-12">
                    <div class="view-more-button text-center">
                        <a href="#" class="btn razo-btn mt-50">View More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Podcast Area End -->

    <?php include('includes/footer.php'); ?>

</body>

</html>
