<?php 
session_start();
include('includes/config.php');?>

<?php 
$query=mysqli_query($con,"select tblnews.id as pid,tblnews.PostTitle as posttitle,tblnews.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblnews.PostDetails as postdetails,tblnews.PostingDate as postingdate,tblnews.PostUrl as url from tblnews left join tblcategory on tblcategory.id=tblnews.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblnews.SubCategoryId where tblnews.Is_Active=1");
$row=mysqli_fetch_assoc($query);?>

<!DOCTYPE html>
<html lang="en">
<head>
 <?php 
     $title ='E9ja News Updates';
     $image='img/news.jpg';
     ?>
     
	<?php include('includes/tag/news-tag.php'); ?>
    <!-- Title -->
    <title>Explicit9ja.com | News</title>

    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>
<body>

	 <?php include('includes/share/news-share.php'); ?>
		<?php include('includes/header.php'); ?>

    
    <!-- Latest News Area Start -->
    <section class="razo-latest-news-area bg-overlay bg-img jarallax">
        <!-- Razo Latest News Slide -->
        <div class="razo-latest-news-slide owl-carousel">


        <!-- Blog Post -->
        <?php 
					  		 $pageno = 1;
                $no_of_records_per_page = 8;
                $offset = ($pageno-1) * $no_of_records_per_page;
                $total_pages_sql = "SELECT COUNT(*) FROM tblnews";
                $result = mysqli_query($con,$total_pages_sql);
                $total_rows = mysqli_fetch_array($result, MYSQLI_NUM)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                require_once('libs/functions.php');

        $query=mysqli_query($con,"select tblnews.id as pid,tblnews.PostTitle as posttitle,tblnews.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblnews.PostDetails as postdetails,tblnews.PostingDate as postingdate,tblnews.PostUrl as url from tblnews left join tblcategory on tblcategory.id=tblnews.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblnews.SubCategoryId where tblnews.Is_Active=1 order by tblnews.id desc  LIMIT $offset, $no_of_records_per_page");
        while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $mpage = htmlentities($row['posttitle']);
        ?>

            <!-- Single Latest News Area -->
            <div class="razo-single-latest-news-area bg-overlay bg-img" style="background-image: url(admin/postimages/<?php echo htmlentities($row['PostImage']);?>);">
                <!-- Post Content -->
                <div class="post-content">
                    <a href="single-news?e-news=<?php echo htmlentities($row['url'])?>" class="post-title"><?php echo htmlentities($row['posttitle']);?></a>
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

     <!-- Blog Area Start -->
    <section class="razo-blog-area section-padding-80-0">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="weekly-news-area mb-50">
                        <div class="section-heading text-center">
                        <h2>&num; Latest News </h2>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
            <!--span><hr></span-->
             <!-- Blog Post -->
             <?php 
                if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }
                    $no_of_records_per_page = 10;
                    $offset = ($pageno-1) * $no_of_records_per_page;
                    $total_pages_sql = "SELECT COUNT(*) FROM tblnews";
                    $result = mysqli_query($con,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result, MYSQLI_NUM)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);
                    require_once('libs/functions.php');
    
            $query=mysqli_query($con,"select tblnews.views, tblnews.id as pid,tblnews.PostTitle as posttitle,tblnews.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblnews.PostDetails as postdetails,tblnews.PostingDate as postingdate,tblnews.PostUrl as url from tblnews left join tblcategory on tblcategory.id=tblnews.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblnews.SubCategoryId where tblnews.Is_Active=1 order by tblnews.id desc  LIMIT $offset, $no_of_records_per_page");
            while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $mpage = $row['posttitle'];
                $id = $row['pid'];
            ?>
            <div class="col-12 col-md-12">
                <!-- Single Post Area -->         
                                <div class="razo-single-post d-flex mb-30">
                     
               <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <a href="single-news?e-news=<?php echo $row['url'];?>"><img style="height:70px; width:140px;" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo $row['posttitle'];?>"></a>
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="single-news.php?e-news=<?php echo $row['url'];?>" class="post-title"><?php echo $row['posttitle'];?></a>
                                        <div class="post-meta">
                                            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> <?php $count="SELECT * FROM tblposts WHERE pid=$id;"; echo $row['views']; if($row['views']>1) echo " views"; else{ echo " view";} ?></a>
                                        </div>
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


        </div>
    </section>
    <!-- News Area End -->

    <?php include('includes/footer.php'); ?>

</body>

</html>
