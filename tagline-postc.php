<?php 
session_start();
error_reporting(0);
include('includes/config.php');

// require("libs/fetch_data.php");
?>
<?php
// define("ROW_PER_PAGE",6);
// require_once('database/db.php');//db config file
?>

<!DOCTYPE html>
<html lang="en">
<head>

		<?php include('includes/head-tag.php'); ?>
	    <!-- Title -->
    <title>Explicit9ja.com | Post Tags</title>

    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
	
		<?php include('includes/header.php'); ?>
		
    
    <!-- Latest News Area Start -->
    <section class="razo-latest-news-area bg-overlay bg-img jarallax" style="background-image: url(img/bg-img/32.jpg);">
        <!-- Razo Latest News Slide -->
        <div class="razo-latest-news-slide owl-carousel">


        <!-- Blog Post -->
        <?php 
            if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 4;
                $offset = ($pageno-1) * $no_of_records_per_page;


                $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
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
                    <a href="single-blog.php?e-blog=<?php echo htmlentities($row['pid'])?>" class="post-title"><?php echo htmlentities($row['posttitle']);?></a>
                    <p><?php $pt=$row['postdetails']; echo (substr($pt,0,230));?><b>... ...</b></p>
                </div>
                <!-- Post Date -->
                <div class="post-date">
                    <h2><?php echo htmlentities(str_replace("-","/",substr($row['postingdate'],6,4)));?></h2>
                    <p><?php echo htmlentities(substr($row['postingdate'],11,5));?></p>
                    
                </div>
                <!-- Read More -->
                <div class="read-more-btn">
                    <a href="single-blog.php?e-blog=<?php echo htmlentities($row['pid'])?>" class="btn">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </div>
            </div>

            <?php } ?>

        </div>
    </section>
    <!-- Latest News Area End -->

	<!-- News Area Start -->
	<section class="uza-news-area section-padding-80">
			<div class="container">

					<ul class="breadcrumb" style="background-color:#3498db;">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item"><a href="news.php">News</a></li>
                <li class="breadcrumb-item active">Tags</li>
            </ul>

				<div class="row">

					<!-- Section Heading -->
					<div class="col-12">
                    
						<div class="section-heading text-center">
							<h2>Post Tags</h2>
						</div>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="row razo-blog-masonary">

                        <!-- Blog Post -->
<?php 
        if($_GET['tag']!=''){
$_SESSION['tag']=intval($_GET['tag']);
}

if($_GET['video-tag']!=''){
$_SESSION['tag']=intval($_GET['video-tag']);
}

		if ($_GET['tag']) {
     if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 8;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
        $result = mysqli_query($con,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

		    $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.CategoryId='".$_SESSION['tag']."' and tblposts.Is_Active=1 order by tblposts.id desc LIMIT $offset, $no_of_records_per_page");
}

		if($_GET['tag']){
		 if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 8;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM tblvideos";
        $result = mysqli_query($con,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

		    $query=mysqli_query($con,"select tblvideos.id as pid,tblvideos.PostTitle as posttitle,tblvideos.PostImage,tblcategory.CategoryName as category,tblsubcategory.Subcategory as subcategory,tblvideos.PostDetails as postdetails,tblvideos.PostingDate as postingdate,tblvideos.PostUrl as url from tblvideos left join tblcategory on tblcategory.id=tblvideos.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblvideos.SubCategoryId where tblvideos.CategoryId='".$_SESSION['tag']."' and tblvideos.Is_Active=1 order by tblvideos.id desc LIMIT $offset, $no_of_records_per_page");
	}

$rowcount=mysqli_num_rows($query);
if($rowcount==0)
{
echo "No record found";
}
else {
while ($row=mysqli_fetch_array($query)) {


?>
                        <!-- Single Blog Item -->
                        <div class="col-12 col-sm-6 col-lg-4 razo-blog-masonary-item mb-30">
                            <div class="razo-blog-masonary-single-item">
                                <!-- Post Thumbnail -->
                                <div class="post-thumbnail">
                                    <a href="single-blog.php?e-blog=<?php echo htmlentities($row['pid'])?>"><img src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt=""></a>
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-date"><i class="fa fa-calendar" aria-hidden="true"></i> 
                                    <?php echo htmlentities($row['postingdate']);?>
                                    </div>
                                    <a href="single-blog.php?e-blog=<?php echo htmlentities($row['pid'])?>" class="post-title"><?php echo htmlentities($row['posttitle']);?></a>
                                    <p><?php $pt=$row['postdetails']; echo (substr($pt,0,200));?><b>...</b></p>
                                    <a href="single-blog.php?e-blog=<?php echo htmlentities($row['pid'])?>" class="btn read-more-btn">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>

                        <?php } ?>

                        </div>

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
                        <?php } ?>

				
							
			</div>
    </section>

    <?php include('includes/footer.php'); ?>

</body>

</html>