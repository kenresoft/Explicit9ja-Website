<?php if (!isset($_GET['e-blog'])) {
    header("location: index.php");
    exit;
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
    $_SESSION['cid'] = $_REQUEST['e-blog'];

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
                $postid = intval($_GET['e-blog']);

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

$url = $_REQUEST['e-blog'];
$query = "select tblposts.id, tblposts.likes, tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblsubcategory.SubCategoryId as sid,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.PostUrl='$url'";
$result = mysqli_query($con, $query) or die(((is_object($con)) ? mysqli_error($con) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : true)));
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$res = $db_handle->runQuery($query);

if (!isset($_SESSION['recent_posts'][$id])) { mysqli_query($con,"UPDATE `tblposts` SET `views` = `views` + 1 WHERE `id`= $id"); $_SESSION['recent_posts'][$id] = 1; } ?>

<!DOCTYPE html>
<html lang="en">
<head>

	<?php include('includes/tag/blog-tag.php'); ?>
	<!-- Title -->
    <title>Explicit9ja.com | Blog Detail</title>

    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">
    <link href="like/like.css" rel='stylesheet' type='text/css' />

</head>
<body>
	
		<?php include('includes/share/blog-share.php') ?>
		<?php include('includes/header.php'); ?>

            
		    <!--update database on page views-->
    <!--?php require_once('includes/conn.php');
    require_once('libs/functions.php');
    $pn = updateCounter('' . htmlentities($row['posttitle'] . '')); // Updates page hits
    echo $pn;
    //updateInfo(); // Updates hit info 
    ?>

    <!-- News Details Post Thumbnail Area Start -->
	<section class="blog-details-post-thumbnail-area bg-overlay bg-img jarallax"
        style="background-image: url(admin/postimages/<?php echo htmlentities($row['PostImage']); ?>); margin:0,10px,0,0;">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="post-title-text">
                        <h2><?php echo htmlentities($row['posttitle']); ?></h2>
                        <div class="post-meta">
                            <a href="#"><?php echo str_replace(" ", " ... ", $row['postingdate']); ?></a>
                            <a href="#">Post by ADMIN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- News Details Post Thumbnail Area End -->

    <!-- Blog Details Area Start -->
    <section class="blog-details-area section-padding-80">
        <div class="container">
            <!-- Post Details Text -->
            <div class="post-details-text">
                <div class="row justify-content-center">
                    
                    <div class="col-10 col-md-10 col-lg-9">
                        <?php echo $row['postdetails']; ?>
                        <!-- Post Catagories -->
                        <div class="d-flex align-items-center justify-content-between">
                            <!-- Post Catagories -->
                            <div class="post-catagories">
                                <ul class="d-flex flex-wrap align-items-center">
                                    <li><i class="fa fa-tag"></i> Tag: </li>
                                    <li><a
                                            href="tagline-postc.php?tag=<?php echo htmlentities($row['cid']) ?>"><?php echo htmlentities($row['category']); ?></a>
                                    </li>
                                    <li><a
                                            href="tagline-posts.php?tag=<?php echo htmlentities($row['sid']) ?>"><?php echo htmlentities($row['subcategory']); ?></a>
                                    </li>
                                    <li><div>
                                        <?php
                        if(!empty($res)) {
                        $ip_address = $_SERVER['REMOTE_ADDR'];
                        ?>
                        <div id="tutorial-<?php echo $res["id"]; ?>">
                            <input type="hidden" id="likes-<?php echo $res["id"]; ?>" value="<?php echo $res["likes"]; ?>">
                            <?php
                            $query ="SELECT * FROM tblpost_likes_map WHERE post_id = '" . $res["id"] . "' and ip_address = '" . $ip_address . "'";
                            $count = $db_handle->numRows($query);
                            $page = "blog";
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
                            <h4 class="h">Share this post:</h4>

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
                            <h2 class="mb-4">Leave A Comment</h2>

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
    <!-- Blog Details Area End -->

    <!-- Related News Area Start -->
    <div class="related-news-area">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>RELATED STORIES</h2>
                    </div>
                </div>
            </div>

 			<!-- Blog Post -->
			<div class="row">
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
                require_once('libs/functions.php');

        $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
        while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        ?>
                <!-- Single Blog Item -->
                <div class="col-12 col-sm-6 col-lg-4 razo-blog-masonary-item mb-80">
                    <div class="razo-blog-masonary-single-item">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <a href="single-blog.php?e-blog=<?php echo htmlentities($row['url'])?>"><img src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt=""></a>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <div class="post-date"><i class="fa fa-calendar" aria-hidden="true"></i> 
                            <?php echo htmlentities($row['postingdate']);?>
                            </div>
                            <a href="single-blog.php?e-blog=<?php echo htmlentities($row['url'])?>" class="post-title"><?php echo htmlentities($row['posttitle']);?></a>
                            <p><?php $pt=$row['postdetails']; echo (substr($pt,0,200));?><b>...</b></p>
                            <a href="single-blog.php?e-blog=<?php echo htmlentities($row['url'])?>" class="btn read-more-btn">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <?php } ?>

            </div>
        </div>
    	</div>

    </div>
    <!-- Related News Area End -->

    <?php include('includes/footer.php'); ?>

</body>

</html>
