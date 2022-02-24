<?php

include "includes/config.php";

$userid = 1;
$comid = $_POST['id'];
$type = $_POST['type'];

// Check entry within table
$query = "SELECT COUNT(*) AS cntpost FROM tblcomment_likes WHERE commentid=".$comid." and userid=".$userid;

$result = mysqli_query($con,$query);
$fetchdata = mysqli_fetch_array($result);
$count = $fetchdata['cntpost'];


if($count == 0){
    $insertquery = "INSERT INTO tblcomment_likes(userid,commentid,type) values(".$userid.",".$comid.",".$type.")";
    mysqli_query($con,$insertquery);
}else {
    $updatequery = "UPDATE tblcomment_likes SET type=" . $type . " where userid=" . $userid . " and commentid=" . $comid;
    mysqli_query($con,$updatequery);
}


// count numbers of like and unlike in post
$query = "SELECT COUNT(*) AS cntLike FROM tblcomment_likes WHERE type=1 and commentid=".$comid;
$result = mysqli_query($con,$query);
$fetchlikes = mysqli_fetch_array($result);
$totalLikes = $fetchlikes['cntLike'];

$query = "SELECT COUNT(*) AS cntUnlike FROM tblcomment_likes WHERE type=0 and commentid=".$comid;
$result = mysqli_query($con,$query);
$fetchunlikes = mysqli_fetch_array($result);
$totalUnlikes = $fetchunlikes['cntUnlike'];


$return_arr = array("likes"=>$totalLikes,"unlikes"=>$totalUnlikes);

echo json_encode($return_arr);