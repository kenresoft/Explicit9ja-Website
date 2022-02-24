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
    <title>Explicit9ja.com | Search</title>

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
                <li class="breadcrumb-item active">Search</li>
            </ul>

				<div class="row">

					<!-- Section Heading -->
					<div class="col-12">
                    
						<div class="section-heading text-center">
							<h2>Blog/Media Search</h2>
						</div>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="row razo-blog-masonary">

                        <?php 
                                if($_POST['searchtitle']!=''){
                        $st=$_SESSION['searchtitle']=$_POST['searchtitle'];
                        }
                        $st;
                                    

                            if (isset($_GET['pageno'])) {
                                    $pageno = $_GET['pageno'];
                                } else {
                                    $pageno = 1;
                                }
                                $no_of_records_per_page = 4;
                                $offset = ($pageno-1) * $no_of_records_per_page;


                                $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                                $result = mysqli_query($con,$total_pages_sql);
                                $total_rows = mysqli_fetch_array($result)[0];
                                $total_pages = ceil($total_rows / $no_of_records_per_page);


                        $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblcategory.CategoryName as category,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.PostTitle like '%$st%' and tblposts.Is_Active=1 LIMIT $offset, $no_of_records_per_page");

                        $rowcount=mysqli_num_rows($query);
                        if($rowcount==0)
                        {
                            echo "<div class=\"container search-result\"><p style=color:#E9573F><b>Sorry your search for:<u style=color:black>$st</u> returned zero results</b></p>";
    						echo "<p><b style=color:#4FC1E9>Suggestions<b><br>Your search item is not available on Our Website<br>Try being more specific with key words<br>Enter key word using title<br>Try search using category<br>Try again later<br></p>";
    						echo "<p><a href=\"http://www.google.com/search?q=" . $st . "\" target=\"_blank\" title=\"Look up " . $st . " on Google\" style=color:#37BC9B>Click here</a> to try the search on google</p></div>";
    					}
    					else{
                            
    						echo "<div class=\"container search-result\"><p style=color:#4FC1E9><b>You searched for: <a style=\"color:#dc2878;\"> $st </a></b></p>";
                            echo "<p style=color:#37BC9B><b>Results: <a style=\"color:#dc2878;\"> $rowcount </a></b></p></div>";
    					
                        while ($search_row=mysqli_fetch_array($query)) {


                        ?>

                        <!-- Single Blog Item -->
                        <div class="col-12 col-sm-6 col-lg-4 razo-blog-masonary-item mb-30">
                            <div class="razo-blog-masonary-single-item">
                                <!-- Post Thumbnail -->
                                <div class="post-thumbnail">
                                    <a href="single-blog.php?e-blog=<?php echo htmlentities($search_row['pid'])?>"><img src="admin/postimages/<?php echo htmlentities($search_row['PostImage']);?>" alt=""></a>
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-date"><i class="fa fa-calendar" aria-hidden="true"></i> 
                                    <?php echo htmlentities($search_row['postingdate']);?>
                                    </div>
                                    <a href="single-blog.php?e-blog=<?php echo htmlentities($search_row['pid'])?>" class="post-title"><?php echo htmlentities($search_row['posttitle']);?></a>
                                    <p><?php $pt=$search_row['postdetails']; echo (substr($pt,0,200));?><b>...</b></p>
                                    <a href="single-blog.php?e-blog=<?php echo htmlentities($search_row['pid'])?>" class="btn read-more-btn">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
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