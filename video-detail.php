<?php if (!isset($_GET['e-info'])) {
    header("location: index.php");
    exit;
} ?>
<?php
session_start();
include('includes/config.php');
include("plugins/getid3/getid3.php");

//Genrating CSRF Token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if (isset($_SESSION['comment'])) {
    $_POST['comment'] = $_SESSION['comment'];
    unset($_SESSION['comment']);
}

if (isset($_POST['comment'])) {
    $_SESSION['comment'] = $_POST['comment'];
    $_SESSION['cid'] = $_REQUEST['e-info'];

    if (!isset($_SESSION['user-login'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: users/index.php');
    } else {
        $username = $_SESSION['user-login'];

        $user_check_query = "SELECT * FROM tblusers WHERE username='$username' LIMIT 1";
        $res = mysqli_query($con, $user_check_query);
        $user = mysqli_fetch_assoc($res);

        $userid = $user['id'];

        //Verifying CSRF Token
        if (!empty($_POST['csrftoken'])) {
            if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {

                $comment = $_POST['comment'];
                $postid = intval($_GET['e-info']);

                $st1 = '0';

                $query = mysqli_query($con, "insert into tblcomments(postId,userid,comment,status) values('$postid','$userid','$comment','$st1')");
                if ($query) :
                    echo "<script>alert('comment successfully submit. Comment will be display after admin review ');</script>";
                    unset($_SESSION['token']);
                else :
                    echo "<script>alert('Something went wrong. Please try again.');</script>";

                endif;
            }
        }
    }
}
?>

<?php //code to get the item using its id

$id = $_REQUEST['e-info'];
$query = "select tblvideos.id, tblvideos.likes, tblvideos.PostTitle as posttitle,tblvideos.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblsubcategory.SubCategoryId as sid,tblvideos.PostDetails as postdetails,tblvideos.PostingDate as postingdate,tblvideos.PostUrl as url,tblvideos.File as file, tblvideos.Artist from tblvideos left join tblcategory on tblcategory.id=tblvideos.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblvideos.SubCategoryId where tblvideos.id='$id'";
$result = mysqli_query($con, $query) or die(((is_object($con)) ? mysqli_error($con) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : true)));
$row = mysqli_fetch_assoc($result);
$res = $db_handle->runQuery($query);

//pageview count query
$page = $row['posttitle'];
$count = "SELECT * FROM tblpage_hits WHERE page='" . $page . "'";
$feedback = mysqli_query($con, $count) or die(((is_object($con)) ? mysqli_error($con) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : true)));
$roo = mysqli_fetch_assoc($feedback); ?>

<!DOCTYPE html>
<html lang="en">
<head>

		<?php include('includes/head-tag.php'); ?>
	    <!-- Title -->
    <title>Explicit9ja.com | Video Detail</title>

    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">
    <link href="like/like.css" rel='stylesheet' type='text/css' />

</head>
<body>
	
		<?php include('includes/share/video-share.php') ?>
		<?php include('includes/header.php'); ?>
		

    <!-- Podcast Thumbnail Area Start -->
    <section class="podcast-hero-area section-padding-80 bg-overlay bg-img jarallax"
        style="background-image: url(admin/postimages/<?php echo htmlentities($row['PostImage']); ?>);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="podcast-hero-text section-padding-80 d-flex align-items-center">
                        <div class="podcast-txt- pr-5">
                            <h2><?php echo htmlentities($row['posttitle']); ?></h2>

													<video class="img-thumbnail" preload="auto" controls>
                          	  <source src="admin/videos/<?php echo htmlentities($row['file']); ?>">
                      			  </video>
			
                            <div class="podcast-meta-data">
                                <a href="#" class="event-date"><i class="icon_calendar"></i>
                                    <?php echo htmlentities($row['postingdate']); ?></a>
                                <a href="#" class="event-time"><i class="icon_clock_alt"></i>
                                    <?php
                                    $file = $row["file"];
                                    $filepath = 'admin/videos/' . $file;
                                    $getID3 = new getID3;
                                    $fileinfo = $getID3->analyze($filepath);
                                    $getID3->CopyTagsToComments($fileinfo);
                                    $playtime_seconds = $fileinfo['playtime_seconds'];

                                    #echo number_format($fileinfo['filesize']) . " KB  ";
                                    #echo implode('<br>', $fileinfo['comments_html']['artist']) . " ";
                                    #echo implode('<br>', $fileinfo['comments_html']['title']) . " ";
                                    #echo implode(', ', array_keys($fileinfo['tags'])) . " ";
                                    echo gmdate("H:i:s", $playtime_seconds);

                                    ?>
                                </a>
                                <a href="#" class="event-time"><i class="icon_heart_alt"></i> 38</a>
                                <a href="#" class="event-address"><i class="icon_chat_alt"></i> 23</a>
                            </div>
                        </div>
                        <!--a href="#" class="pt-5 pt-md-0 pl-md-5"><img src="img/core-img/itunes.png" alt=""></a-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Podcast Thumbnail Area End -->

    <!-- Blog Details Area Start -->
    <section class="blog-details-area section-padding-80">
        <div class="container">
				<div clasd="row">

					<ul class="breadcrumb" style="background-color:#3498db;">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item"><a href="video.php">Video</a></li>
                <li class="breadcrumb-item active"><?php echo htmlentities($row['posttitle']); ?></li>
            </ul>
					</div>
					
            <!-- Post Details Text -->
            <div class="post-details-text">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-2 col-xl-1">

                        <!-- Post Share -->
                        <div class="razo-author-avatar">
                            <img src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>;" alt="">
                            <h6>John Milley</h6>
                        </div>
                    </div>

                    <div class="col-12 col-sm-10 col-xl-9">
                        <?php echo $row['postdetails']; ?>
                        <!-- Post Catagories -->
                        <div class="d-flex align-items-center justify-content-between">
                            <!-- Post Catagories -->
                            <div class="post-catagories">
                                
                                <ul class="d-flexb flex-wrap align-items-center">
                                    <li><i class="fa fa-tag"></i> Media Info: </li>
                                    <li>
                                        <a style="color:#3498db;">FILE TITLE : </a>
                                        <span style="color:#ffc400;"><?php echo htmlentities($row['posttitle']); ?></span>
                                    </li>
                                    <li><a style="color:#3498db;">FILE SIZE : </a>
                                        <span
                                            style="color:#ffc400;"><?php echo number_format($fileinfo['filesize']) . " Bytes "; ?></span>
                                    </li>
                                    <li>
                                        <a style="color:#3498db;">FILE FORMAT : </a>
                                        <span style="color:#ffc400;"><?php echo $fileinfo['fileformat']; ?></span>
                                    </li>
                                    <li><a style="color:#3498db;">FILE NAME : </a>
                                        <span style="color:#ffc400;"><?php echo htmlentities($fileinfo['filename']); ?></span>
                                    </li>
                                    <li>
                                        <a style="color:#3498db;">ARTIST :</a>
                                        <span style="color:#ffc400;"><?php echo htmlentities($row['Artist']); ?></span>
                                    </li>
                                    <li><a style="color:#3498db;">ALBUM :</a>
                                        <span style="color:#ffc400;">Unknown</span>
                                    </li>
                                </ul>
                                
                                <ul class="d-flex flex-wrap align-items-center">
                                    <li><i class="fa fa-tag"></i> Tag: </li>
                                    <li><a
                                            href="tagline-postc.php?video-tag=<?php echo htmlentities($row['cid']) ?>"><?php echo htmlentities($row['category']); ?></a>
                                    </li>
                                    <li><a
                                            href="tagline-posts.php?video-tag=<?php echo htmlentities($row['sid']) ?>"><?php echo htmlentities($row['subcategory']); ?></a>
                                    </li>
                                    
                                    <li><div>
                                        <?php
                                        if(!empty($res)) {
                                        $ip_address = $_SERVER['REMOTE_ADDR'];
                                        ?>
                                        <div id="tutorial-<?php echo $res["id"]; ?>">
                                            <input type="hidden" id="likes-<?php echo $res["id"]; ?>" value="<?php echo $res["likes"]; ?>">
                                            <?php
                                            $query ="SELECT * FROM tblvideo_likes_map WHERE video_id = '" . $res["id"] . "' and ip_address = '" . $ip_address . "'";
                                            $count = $db_handle->numRows($query);
                                            $page = "video";
                                            $str_like = "like";
                                            if(!empty($count)) {
                                            $str_like = "unlike";
                                            }
                                            ?>
                                            <div class="btn-likes" style="float:left;"><input type="button" title="<?php echo ucwords($str_like); ?>" class="<?php echo $str_like; ?> " onClick="addLikes(<?php echo $res["id"]; ?>,'<?php echo $str_like; ?>', '<?php echo $page; ?>')" /></div>
                                            <div class="label-likes" style="float:right; margin-top:3px;"><?php if(!empty($res["likes"])) { echo $res["likes"] . " Like(s)"; } else{echo "No Likes on this post yet";} ?></div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    </li>

                                </ul>

                            </div>
                        </div>
                        
                        
                        <!-- Post Share -->
                           <div class="social-btns"> 
                            <h4 class="h">Share this video:</h4>

                            <a href="<?php echo socialshare('facebook', $params); ?>" target="blank" class="social-margin"> 
                              <div class="social-icon facebook-icon">
                                <i class="fa fa-facebook" aria-hidden="true"></i> 
                              </div>
                            </a>
                            <a href="<?php echo socialshare('pinterest', $params); ?>" target="blank"  class="social-margin">
                              <div class="social-icon pinterest-icon">
                                <i class="fa fa-pinterest" aria-hidden="true"></i>
                              </div>
                            </a>
                            <a href="<?php echo socialshare('linkedin', $params); ?>" class="social-margin" target="blank">
                              <div class="social-icon linkedin-icon">
                                <i class="fa fa-linkedin" aria-hidden="true"></i>
                              </div> 
                            </a>
                            <a href="<?php echo socialshare('whatsapp', $params); ?>"  target="blank"  class="social-margin">
                              <div class="social-icon whatsapp-icon">
                                <i class="fa fa-whatsapp" aria-hidden="true"></i>
                              </div>
                            </a>
                            <a href="<?php echo socialshare('tumblr', $params); ?>" target="blank"  class="social-margin">
                              <div class="social-icon tumblr-icon">
                                <i class="fa fa-tumblr" aria-hidden="true"></i>
                              </div> 
                            </a>
                            <a href="<?php echo socialshare('telegram', $params); ?>"  target="blank" class="social-margin">
                              <div class="social-icon telegram-icon">
                                <i class="fa fa-telegram" aria-hidden="true"></i>
                              </div>
                            </a>
                            <a href="<?php echo socialshare('skype', $params); ?>" target="blank" class="social-margin">
                              <div class="social-icon skype-icon">
                                <i class="fa fa-skype" aria-hidden="true"></i>
                              </div> 
                            </a>
                            <a href="<?php echo socialshare('twitter', $params); ?>" target="blank" class="social-margin">
                              <div class="social-icon twitter-icon">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                              </div> 
                            </a>
                    </div><br />
                    <!--post share end-->

                        <a href="media-download-video.php?remote_file_id=<?php echo $id; ?>">
                            <button class=" button btn">
                                <i class="fa fa-download"></i> Download
                            </button>
                        </a>

                        <div class="razo-next-prev-pager mb-80 d-flex align-items-center justify-content-between">
                            <div class="prev-pager">
                                <a href="#"><span>Previous</span>
                                    <h6><i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                        Episode
                                        3- Does our
                                        economic model</h6>
                                </a>
                            </div>
                            <div class="next-pager text-right">
                                <a href="#"><span>Next</span>
                                    <h6>Episode 1 - Departure cards deported <i class="fa fa-long-arrow-right"
                                            aria-hidden="true"></i>
                                    </h6>
                                </a>
                            </div>
                        </div>

                        <!-- Leave A Reply -->
                        <div class="razo-contact-form">
                            <h2 class="mb-4">Leave A Comment</h2>

                            <!-- Form -->
                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" name="message-name" class="form-control mb-30"
                                            placeholder="Name">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="email" name="message-email" class="form-control mb-30"
                                            placeholder="Email">
                                    </div>
                                    <div class="col-12">
                                        <textarea name="message" class="form-control mb-30"
                                            placeholder="Comment"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn razo-btn btn-3 mt-15">Post
                                            Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Area End -->

    <?php include('includes/footer.php'); ?>

</body>

</html>
