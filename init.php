<?php
/* first of all, fetch all settings and try to prevent any errors */
if(isset($_GET['type'])) {
	$type = htmlspecialchars(strip_tags(trim($_GET['type'])));
}
if(isset($_GET['user'])) {
	$user = htmlspecialchars(strip_tags(trim($_GET['user'])));
}
if(isset($_GET['c'])) {
	$c = htmlspecialchars(strip_tags(trim($_GET['c'])));
}

/* url to your homepage, should be the full url to your userrss.php, homerss.php and favoritesrss.php */
$url = "http://www.twitterrss.net"; /* remember NO ending / */

/* initialize simpleCache */
require('assets/php/simpleCache.php');
$cache = new SimpleCache();
$cache->cache_path = 'cache/'; /* cache directory should be where init.php is located or whatever file you call */
$cache->cache_time = 300; /* time is set to 5 min, do not set it too low, it will trigger Twitter's API request limit */

/* prepare the url and settings */
switch($type) {
	case "home":
		if(isset($user) && (isset($c))) {
			$latest_tweet = $cache->get_data($user, "$url/homerss.php?c=$c&user=$user");
		} elseif(isset($user)) {
			$latest_tweet = $cache->get_data($user, "$url/homerss.php?user=$user");
		} elseif(isset($c)) {
			$latest_tweet = $cache->get_data($user, "$url/homerss.php?c=$c");
		} else {
			$latest_tweet = $cache->get_data($user, "$url/homerss.php");
		}
	break;
	case "favorite":
		if(isset($user) && (isset($c))) {
			$latest_tweet = $cache->get_data($user, "$url/favoritesrss.php?c=$c&user=$user");
		} elseif(isset($user)) {
			$latest_tweet = $cache->get_data($user, "$url/favoritesrss.php?user=$user");
		} elseif(isset($c)) {
			$latest_tweet = $cache->get_data($user, "$url/favoritesrss.php?c=$c");
		} else {
			$latest_tweet = $cache->get_data($user, "$url/favoritesrss.php");
		}
	break;
	case "user":
		if(isset($user) && (isset($c))) {
			$latest_tweet = $cache->get_data($user, "$url/userrss.php?c=$c&user=$user");
		} elseif(isset($user)) {
			$latest_tweet = $cache->get_data($user, "$url/userrss.php?user=$user");
		} elseif(isset($c)) {
			$latest_tweet = $cache->get_data($user, "$url/userrss.php?c=$c");
		} else {
			$latest_tweet = $cache->get_data($user, "$url/userrss.php");
		}
	break;
	default:
		$latest_tweet = $cache->get_data('tweet', "$url/userrss.php"); /* load the default values set in userrss.php */
	break;
}
	
	/* echo out our feed */
	echo $latest_tweet;

?>