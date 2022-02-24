<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$query ="SELECT * FROM tutorial WHERE id = 1";
$tutorial = $db_handle->runQuery($query);
?>
<HTML>
<HEAD>
<TITLE>PHP Dynamic Star Rating using jQuery</TITLE>
<link href="like.css" rel='stylesheet' type='text/css' />
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="like.js"></script>

</HEAD>
<BODY>
<table class="demo-table">
<tbody>
<tr>
<th><strong>Tutorials</strong></th>
</tr>
<?php
if(!empty($tutorial)) {
$ip_address = $_SERVER['REMOTE_ADDR'];
?>
<tr>
<td valign="top">
<div class="feed_title"><?php echo $tutorial["title"]; ?></div>
<div id="tutorial-<?php echo $tutorial["id"]; ?>">
<input type="hidden" id="likes-<?php echo $tutorial["id"]; ?>" value="<?php echo $tutorial["likes"]; ?>">
<?php
$query ="SELECT * FROM ipaddress_likes_map WHERE tutorial_id = '" . $tutorial["id"] . "' and ip_address = '" . $ip_address . "'";
$count = $db_handle->numRows($query);
$str_like = "like";
if(!empty($count)) {
$str_like = "unlike";
}
?>
<div class="btn-likes"><input type="button" title="<?php echo ucwords($str_like); ?>" class="<?php echo $str_like; ?>" onClick="addLikes(<?php echo $tutorial["id"]; ?>,'<?php echo $str_like; ?>')" /></div>
<div class="label-likes"><?php if(!empty($tutorial["likes"])) { echo $tutorial["likes"] . " Like(s)"; } ?></div>
</div>
<div class="desc"><?php echo $tutorial["description"]; ?></div>
</td>
</tr>
<?php		
}
?>
</tbody>
</table>
</BODY>
</HTML>
