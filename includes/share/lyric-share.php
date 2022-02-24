
<?php 
 require('plugins/html2text/html2text.php');

	$page_tags = 'e9ja';
	$page_title = $row['posttitle'];
	$page_link = 'http://explicit9ja.com'.$_SERVER['REQUEST_URI'];
	$page_post = convert_html_to_text($row['postdetails']). '%20%0A%0A'. 'Click link below to read full news content.';

	$params=array( 'url'=>$page_link, 'title'=>$page_title, 'tags'=>$page_tags, 'post'=>$page_post ); 
?>

<?php 
function socialshare($social='', $params=''){ 
		$button= ''; 
		switch ($social) { 
				case 'facebook': $button='http://www.facebook.com/share.php?u='. $params['url']; 
				break; 
				
				case 'twitter': $button='https://twitter.com/share?url='.$params['url'].'&amp;text='. $params['title'] .'&amp;hashtags='. $params['tags']; 
				break; 
				
				case 'google-plus': $button='https://plus.google.com/share?url='. $params['url']; 
				break; 
				
				case 'whatsapp': if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])){ 
						$button='whatsapp://send?text='. '*'. $params['title']. '*'. '%20%0A%0A'. $params['post']. '%20%0A%0A'. '_'. $params['url']. '_'. '%20' ; 
						}
						else{ 
						$button='https://web.whatsapp.com/send?text='. '*'. $params['title']. '*'. '%20%0A%0A'. $params['post']. '%20%0A%0A'. '_'. $params['url']. '_'. '%20' ; 
						} 
				break; 
				
				case 'linkedin': $button='http://www.linkedin.com/shareArticle?mini=true&amp;url='. $params['url']; 
				break; 
				
				case 'ttumblr': $button='https://www.tumblr.com/widgets/share/tool?canonicalUrl='. $params['url']. '&amp;title='. $params['title']. '&amp;caption='. $params['post']. '&amp;tags='. $params['tags'];
				break;
				
				case 'pinterest': $button='http://pinterest.com/pin/create/button/?url='. $params['url'];
				break;
				
				case 'telegram': $button='https://t.me/share/url?url='. $params['url']. '&amp;text='. $params['post'];
				break;
				
				case 'skype': $button='https://web.skype.com/share?url'. $params['url']. '&amp;text='. $params['post'];
				break;
				
				default: 
				break; 
		} 
		return $button; 
}

?>
