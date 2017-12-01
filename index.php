<?php

require('functions.php');

if ($podcast_feed_url) {
	include 'view-podcast.php';
}
else {
	include 'home.php';
}

?>