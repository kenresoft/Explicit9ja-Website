<?php

require_once("dbcontroller.php");
$db_handle = new DBController();

if($_POST["page"] == "news")
{
if(!empty($_POST["id"])) {
	switch($_POST["action"]){
		case "like":
			$query = "INSERT INTO tblnews_likes_map (ip_address,news_id) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "','" . $_POST["id"] . "')";
			$result = $db_handle->insertQuery($query);
			if(!empty($result)) {
				$query ="UPDATE tblnews SET likes = likes + 1 WHERE id='" . $_POST["id"] . "'";
				$result = $db_handle->updateQuery($query);				
			}			
		break;		
		case "unlike":
			$query = "DELETE FROM tblnews_likes_map WHERE ip_address = '" . $_SERVER['REMOTE_ADDR'] . "' and news_id = '" . $_POST["id"] . "'";
			$result = $db_handle->deleteQuery($query);
			if(!empty($result)) {
				$query ="UPDATE tblnews SET likes = likes - 1 WHERE id='" . $_POST["id"] . "' and likes > 0";
				$result = $db_handle->updateQuery($query);
			}
		break;		
	}
}

}



if($_POST["page"] == "blog")
{
if(!empty($_POST["id"])) {
	switch($_POST["action"]){
		case "like":
			$query = "INSERT INTO tblpost_likes_map (ip_address,post_id) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "','" . $_POST["id"] . "')";
			$result = $db_handle->insertQuery($query);
			if(!empty($result)) {
				$query ="UPDATE tblposts SET likes = likes + 1 WHERE id='" . $_POST["id"] . "'";
				$result = $db_handle->updateQuery($query);				
			}			
		break;		
		case "unlike":
			$query = "DELETE FROM tblpost_likes_map WHERE ip_address = '" . $_SERVER['REMOTE_ADDR'] . "' and post_id = '" . $_POST["id"] . "'";
			$result = $db_handle->deleteQuery($query);
			if(!empty($result)) {
				$query ="UPDATE tblposts SET likes = likes - 1 WHERE id='" . $_POST["id"] . "' and likes > 0";
				$result = $db_handle->updateQuery($query);
			}
		break;		
	}
}

}
 


if($_POST["page"] == "music")
{
if(!empty($_POST["id"])) {
	switch($_POST["action"]){
		case "like":
			$query = "INSERT INTO tblsong_likes_map (ip_address,song_id) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "','" . $_POST["id"] . "')";
			$result = $db_handle->insertQuery($query);
			if(!empty($result)) {
				$query ="UPDATE tblsongs SET likes = likes + 1 WHERE id='" . $_POST["id"] . "'";
				$result = $db_handle->updateQuery($query);				
			}			
		break;		
		case "unlike":
			$query = "DELETE FROM tblsong_likes_map WHERE ip_address = '" . $_SERVER['REMOTE_ADDR'] . "' and song_id = '" . $_POST["id"] . "'";
			$result = $db_handle->deleteQuery($query);
			if(!empty($result)) {
				$query ="UPDATE tblsongs SET likes = likes - 1 WHERE id='" . $_POST["id"] . "' and likes > 0";
				$result = $db_handle->updateQuery($query);
			}
		break;		
	}
}

}



if($_POST["page"] == "video")
{
if(!empty($_POST["id"])) {
	switch($_POST["action"]){
		case "like":
			$query = "INSERT INTO tblvideo_likes_map (ip_address,video_id) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "','" . $_POST["id"] . "')";
			$result = $db_handle->insertQuery($query);
			if(!empty($result)) {
				$query ="UPDATE tblvideos SET likes = likes + 1 WHERE id='" . $_POST["id"] . "'";
				$result = $db_handle->updateQuery($query);				
			}			
		break;		
		case "unlike":
			$query = "DELETE FROM tblvideo_likes_map WHERE ip_address = '" . $_SERVER['REMOTE_ADDR'] . "' and video_id = '" . $_POST["id"] . "'";
			$result = $db_handle->deleteQuery($query);
			if(!empty($result)) {
				$query ="UPDATE tblvideos SET likes = likes - 1 WHERE id='" . $_POST["id"] . "' and likes > 0";
				$result = $db_handle->updateQuery($query);
			}
		break;		
	}
}

}



if($_POST["page"] == "lyric")
{
if(!empty($_POST["id"])) {
	switch($_POST["action"]){
		case "like":
			$query = "INSERT INTO tbllyric_likes_map (ip_address,lyric_id) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "','" . $_POST["id"] . "')";
			$result = $db_handle->insertQuery($query);
			if(!empty($result)) {
				$query ="UPDATE tbllyrics SET likes = likes + 1 WHERE id='" . $_POST["id"] . "'";
				$result = $db_handle->updateQuery($query);				
			}			
		break;		
		case "unlike":
			$query = "DELETE FROM tbllyric_likes_map WHERE ip_address = '" . $_SERVER['REMOTE_ADDR'] . "' and lyric_id = '" . $_POST["id"] . "'";
			$result = $db_handle->deleteQuery($query);
			if(!empty($result)) {
				$query ="UPDATE tbllyrics SET likes = likes - 1 WHERE id='" . $_POST["id"] . "' and likes > 0";
				$result = $db_handle->updateQuery($query);
			}
		break;		
	}
}

}


?>
