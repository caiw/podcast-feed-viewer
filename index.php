<?php

require('functions.php');

$site_name = "Podcast Viewer";
$root_url = 'index.php';

$podcast_feed_url = $_GET['feed'];

if ($podcast_feed_url) {
	include 'view-podcast.php';
}
else {
	include 'home.php';
}

?>