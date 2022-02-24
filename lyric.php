<?php if (!isset($_GET['e-lyrics'])) {
    //header("location: index.php");
    //exit;
} ?>
<?php
session_start();
include('includes/config.php');

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
    $_SESSION['cid'] = $_REQUEST['e-lyrics'];

    if (!isset($_SESSION['user-login'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: users/');
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
                $postid = intval($_GET['e-lyrics']);

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
<?php 
if (isset($_GET['e-lyrics'])) {
    $id = $_REQUEST['e-lyrics'];
}
else {
    $id = '0';
}

$query = "select tbllyrics.likes, tbllyrics.PostTitle as posttitle,tbllyrics.Artist,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblsubcategory.SubCategoryId as sid,tbllyrics.PostDetails as postdetails,tbllyrics.PostingDate as postingdate,tbllyrics.PostUrl as url from tbllyrics left join tblcategory on tblcategory.id=tbllyrics.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tbllyrics.SubCategoryId where tbllyrics.PostUrl='$id'";
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
 <?php $title ='E9ja Lyrics Updates'; ?>
		<?php include('includes/tag/lyric-tag.php'); ?>
	    <!-- Title -->
    <title>Explicit9ja.com | Song Lyrics</title>

    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">
    <link href="like/like.css" rel='stylesheet' type='text/css' />

</head>
<body>

	 <?php include('includes/share/lyric-share.php'); ?>
		<?php include('includes/header.php'); ?>

		
		    <!--update database on page views-->
    <!--<php require_once('includes/conn.php');-->
    <!--require_once('libs/functions.php');-->
    <!--$pn = updateCounter('' . $row['posttitle'] . ''); // Updates page hits-->
    <!--echo $pn;-->
    <!--//updateInfo(); // Updates hit info -->
    <!--?>-->

    <!-- Lyrics Details Post Thumbnail Area Start -->
	<section class="blog-details-post-thumbnail-area bg-overlay bg-img jarallax"
        style="background-image: url(img/images/lyrics-poster.png); margin:0,10px,0,0;">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="post-title-text">
                        <h2><?php if (isset($_GET['e-lyrics'])){ 
                            echo $row['posttitle']." --- <span style=\"color:red;\">".$row['Artist']."<span>";} else echo "&num; LYRICS POSTS"; ?></h2>
                        <div class="post-meta">
                            <a href="#"><?php echo str_replace(" ", " ... ", $row['postingdate']); ?></a>
                            <a href="#"><?php if ($id != '0'){echo 'Post by ADMIN'; } ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- News Details Post Thumbnail Area End -->


<?php if (isset($_GET['e-lyrics'])) { 
$id = $_REQUEST['e-lyrics'];
$query = "select tbllyrics.id, tbllyrics.likes, tbllyrics.PostTitle as posttitle,tbllyrics.Artist,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblsubcategory.SubCategoryId as sid,tbllyrics.PostDetails as postdetails,tbllyrics.PostingDate as postingdate,tbllyrics.PostUrl as url from tbllyrics left join tblcategory on tblcategory.id=tbllyrics.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tbllyrics.SubCategoryId where tbllyrics.PostUrl='$id'";
$result = mysqli_query($con, $query) or die(((is_object($con)) ? mysqli_error($con) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : true)));
$row = mysqli_fetch_assoc($result);

$res = $db_handle->runQuery($query);

//pageview count query
$page = $row['posttitle'];
$count = "SELECT * FROM tblpage_hits WHERE page='" . $page . "'";
$feedback = mysqli_query($con, $count) or die(((is_object($con)) ? mysqli_error($con) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : true)));
$roo = mysqli_fetch_assoc($feedback); ?>

    <!-- News Details Area Start -->
    <section class="blog-details-area section-padding-80">
        <div class="container">
            <!-- Post Details Text -->
            <div class="post-details-text">
                <div class="row justify-content-center">

<div class="col-12">
                    <div class="weekly-news-area mb-50">
                        <div class="section-heading text-center">
                        <h3>&num; LYRICS POST</h3>
                        </div>
                    </div>
                </div>

                    <div class="col-10 col-md-10 col-lg-9">
                        <?php echo $row['postdetails']; ?>
                        <!-- Post Catagories -->
                        <div class="d-flex align-items-center justify-content-between">
                            <!-- Post Catagories -->
                            <div class="post-catagories">
                                <ul class="d-flex flex-wrap align-items-center">
                                    <li><i class="fa fa-tag"></i> Tag: </li>
                                    <li><a
                                            href="tagline-postc?tag=<?php echo htmlentities($row['cid']) ?>"><?php echo htmlentities($row['category']); ?></a>
                                    </li>
                                    <li><a
                                            href="tagline-posts?tag=<?php echo htmlentities($row['sid']) ?>"><?php echo htmlentities($row['subcategory']); ?></a>
                                    </li>

                                    <li><div>
                                        <?php
                                        if(!empty($res)) {
                                        $ip_address = $_SERVER['REMOTE_ADDR'];
                                        ?>
                                        <div id="tutorial-<?php echo $res["id"]; ?>">
                                            <input type="hidden" id="likes-<?php echo $res["id"]; ?>" value="<?php echo $res["likes"]; ?>">
                                            <?php
                                            $query ="SELECT * FROM tbllyric_likes_map WHERE lyric_id = '" . $res["id"] . "' and ip_address = '" . $ip_address . "'";
                                            $count = $db_handle->numRows($query);
                                            $page = "lyric";
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
                            <h4 class="h">Share this lyrics:</h4>

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
                    </div>
                    <!--post share end-->

                        <!-- Comments Area -->
                        <div class="comment_area mb-50 clearfix">
                            <h5 class="title">
                                <?php $sts = 1;
                                $result = mysqli_query($con, "select * from tblcomments where postId='$id' and status='$sts'");
                                $total_rows = mysqli_num_rows($result);
                                if ($total_rows == 0) {
                                    echo 'No Comments on this post yet';
                                } else if ($total_rows == 1) {
                                    echo $total_rows . ' Comment';
                                } else {
                                    echo $total_rows . ' Comments';
                                } ?>
                            </h5>

                            <ol>
                                <!-- Single Comment Area -->

                                <?php
                                if (isset($_SESSION['user-login'])) {
                                    $username = $_SESSION['user-login'];
                                    $user_check_query = "SELECT * FROM tblusers WHERE username='$username' LIMIT 1";
                                    $res = mysqli_query($con, $user_check_query);
                                    $user = mysqli_fetch_array($res);

                                    $userid = $user['id'];
                                    echo $userid;
                                }
                                ?>

                                <?php
                                $sts = 1;
                                $query = mysqli_query($con, "select id,postId,userid,comment,postingDate from  tblcomments where postId='$id' and status='$sts'");
                                while ($row = mysqli_fetch_array($query)) {
                                    $userid = $row['userid'];

                                    $user_check_query = "SELECT * FROM tblusers WHERE id='$userid'";
                                    $res = mysqli_query($con, $user_check_query);
                                    $user = mysqli_fetch_array($res);

                                    $name = $user['username'];
                                    $email = $user['email'];

                                    $com_id = $row['id'];
                                    $type = -1;

                                    // Checking user status
                                    $status_query = "SELECT count(*) as cntStatus,type FROM tblcomment_likes WHERE userid=" . $userid . " and commentid=" . $com_id;
                                    $status_result = mysqli_query($con, $status_query);
                                    $status_row = mysqli_fetch_array($status_result);
                                    $count_status = $status_row['cntStatus'];
                                    if ($count_status > 0) {
                                        $type = $status_row['type'];
                                    }

                                    // Count post total likes and unlikes
                                    $like_query = "SELECT COUNT(*) AS cntLikes FROM tblcomment_likes WHERE type=1 and commentid=" . $com_id;
                                    $like_result = mysqli_query($con, $like_query);
                                    $like_row = mysqli_fetch_array($like_result);
                                    $total_likes = $like_row['cntLikes'];

                                    $unlike_query = "SELECT COUNT(*) AS cntUnlikes FROM tblcomment_likes WHERE type=0 and commentid=" . $com_id;
                                    $unlike_result = mysqli_query($con, $unlike_query);
                                    $unlike_row = mysqli_fetch_array($unlike_result);
                                    $total_unlikes = $unlike_row['cntUnlikes'];

                                ?>
                                <li class="single_comment_area">
                                    <!-- Comment Content -->
                                    <div class="comment-content d-flex">
                                        <!-- Comment Author -->
                                        <div class="comment-author">
                                            <img src="img/bg-img/15.jpg" alt="author">
                                        </div>
                                        <!-- Comment Meta -->
                                        <div class="comment-meta">
                                            <a href="#"
                                                class="author-name"><?php $result = mysqli_query($con, "select * from tblusers where id='$userid'");
                                                                                $user = mysqli_fetch_array($result);
                                                                                echo htmlentities($user['username']); ?>
                                                <span class="post-date"> #
                                                    <?php echo htmlentities($row['postingDate']); ?></span></a>
                                            <p><?php echo htmlentities($row['comment']); ?> </p>

                                            <input type="button" value="Like" id="like_<?php echo $com_id; ?>"
                                                class="like"
                                                style="<?php if ($type == 1) {
                                                                                                                                            echo "color: #dc2878;";
                                                                                                                                        } ?>" /><b>&nbsp;(<span
                                                    id="likes_<?php echo $com_id; ?>"><?php echo $total_likes; ?></span>)&nbsp;</b>

                                            <input type="button" value="Unlike" id="unlike_<?php echo $com_id; ?>"
                                                class="unlike"
                                                style="<?php if ($type == 0) {
                                                                                                                                                    echo "color: #dc2878;";
                                                                                                                                                } ?>" /><b>&nbsp;(<span
                                                    id="unlikes_<?php echo $com_id; ?>"><?php echo $total_unlikes; ?></span>)
                                            </b>

                                        </div>
                                    </div>

                                    <!--<ol class="children">
                                        <li class="single_comment_area"> -->
                                    <!-- Comment Content -->
                                    <!-- <div class="comment-content d-flex"> -->
                                    <!-- Comment Author -->
                                    <!-- <div class="comment-author">
                                                    <img src="img/bg-img/16.jpg" alt="author">
                                                </div> -->
                                    <!-- Comment Meta -->
                                    <!--<div class="comment-meta">
                                                    <a href="#" class="author-name">Milley Cyrus <span class="post-date">- May 20, 2018</span></a>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                                                    <a href="#" class="like">Like</a>
                                                    <a href="#" class="reply">Reply</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ol> -->
                                </li>

                                <?php } ?>

                            </ol>
                        </div>

                        <!-- Leave A Reply -->
                        <div class="razo-contact-form">
                            <h2 class="mb-4">Leave A Comment On Lyrics Post</h2>

                            <!-- Form -->
                            <form name="Comment" method="post">
                                <input type="hidden" name="csrftoken"
                                    value="<?php echo htmlentities($_SESSION['token']); ?>" />
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" name="name" class="form-control mb-30"
                                            placeholder="Full Name" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="email" name="email" class="form-control mb-30"
                                            placeholder="Valid Email" required>
                                    </div>
                                    <div class="col-12">
                                        <textarea name="comment" class="form-control mb-30" placeholder="Comment"
                                            required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" name="comment-submit"
                                            class="btn razo-btn btn-3 mt-15">Post Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- News Details Area End -->

<?php } ?>



    <!-- Related News Area Start -->
    <section class="razo-blog-area section-padding-80-0">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="weekly-news-area mb-50">
                        <div class="section-heading text-center">
                        <h2><?php if (isset($_GET['e-lyrics'])){ 
                            echo "RELATED LYRICS POST";} else echo "LATEST LYRICS"; ?></h2>
                        </div>
                    </div>
                </div>
            </div>

 <!-- Blog Post -->
 <?php 
            if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 8;
                $offset = ($pageno-1) * $no_of_records_per_page;


                $total_pages_sql = "SELECT COUNT(*) FROM tbllyrics";
                $result = mysqli_query($con,$total_pages_sql);
                $total_rows = mysqli_fetch_array($result, MYSQLI_NUM)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                require_once('libs/functions.php');

        $query=mysqli_query($con,"select tbllyrics.id as pid,tbllyrics.PostTitle as posttitle,tbllyrics.Artist,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tbllyrics.PostDetails as postdetails,tbllyrics.PostingDate as postingdate,tbllyrics.PostUrl as url from tbllyrics left join tblcategory on tblcategory.id=tbllyrics.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tbllyrics.SubCategoryId where tbllyrics.Is_Active=1 order by tbllyrics.id desc LIMIT $offset, $no_of_records_per_page");
        while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        ?>

                <div class="col-12 col-md-12">
                <!-- Single Post Area -->         
                                <div class="razo-single-post d-flex mb-30">
                     
               <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <a href="lyric?e-lyrics=<?php echo $row['url'];?>"><img style="height:70px; width:140px;" src="img/images/lyrics-thumb.jpg" alt="<?php echo $row['posttitle'];?>"></a>
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <div class="post-meta">
                                                                </div>
                                        <a href="lyric?e-lyrics=<?php echo $row['url'];?>" class="post-title"><?php echo $row['posttitle'];?></a>
                                    </div>
                                    
                                </div>
                          <!--<span><hr></span>-->
                            </div>
                            
                <?php } ?>

            </div>


  <!-- Pagination -->

            <ul class="pagination justify-content-center mb-4">
                <li class="page-item"><a href="?pageno=1"  class="page-link">First</a></li>
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">Prev</a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">Next</a>
                </li>
                <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
            </ul>


    <?php include('includes/footer.php'); ?>

</body>

</html>
