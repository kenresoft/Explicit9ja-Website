<?php
 if (!isset($_GET['remote_file_id'])) {
    header("location: index.php");
    exit;
  }
include('includes/config.php');

$id = $_GET['remote_file_id'];
$query = "select tblsongs.PostTitle as posttitle,tblsongs.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblsubcategory.SubCategoryId as sid,tblsongs.PostDetails as postdetails,tblsongs.PostingDate as postingdate,tblsongs.PostUrl as url,tblsongs.File as file from tblsongs left join tblcategory on tblcategory.id=tblsongs.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblsongs.SubCategoryId where tblsongs.id='$id'";
$result = mysqli_query($con, $query) or die(((is_object($con)) ? mysqli_error($con) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : true)));
$row = mysqli_fetch_assoc($result);

$filename = $row['file'];
$path = 'admin/songs/';
$file = $path . $filename;

if (!file_exists($file)) {
    http_response_code(404);
    die();
}

header('Content-Type: octet/stream');
header('Content-Description: File Transfer');
header("Content-Disposition: attachment; filename=" . $filename);
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . filesize($file));
header("Cache-Control: private");
header('Expires: 0');
header('Pragma: public');
ob_clean();
flush();
readfile($file);
exit;