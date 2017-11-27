<?php

include 'functions.php';

$site_name = "Podcast Viewer";
$root_url = "http://cai.zone/podcast-viewer/";

$podcast_feed_url = $_SERVER[QUERY_STRING];
// TODO: Validation
// TODO: Error checking
$podcast_feed_xml = simplexml_load_file($podcast_feed_url);

// Channel info

$podcast_info = $podcast_feed_xml -> channel[0];

$podcast_title = $podcast_info -> title;
$podcast_homepage = $podcast_info -> link;
$podcast_image_url = (new SimpleXMLElement($podcast_info -> children('itunes', true) -> image -> asXML())) ['href'];
$podcast_description = $podcast_info -> description;

$last_updated = $podcast_info -> lastBuildDate;

?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title><?php echo($site_name . " &mdash; " . $podcast_title); ?></title>

  <link rel="stylesheet" href="styles.css">
  <script src="jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="view-podcast.js" type="text/javascript"></script>
</head>
<body>
	<div id="wrapper">
		<div class="masthead">
			<div class="site-title title"><a href="<?php echo($root_url); ?>">Podcast Viewer</a></div>
		</div>
		<div class="podcast-info-box box">
			<div class="podcast-title title"><a href="<?php echo($podcast_homepage); ?>"><?php echo($podcast_title); ?></a></div>
			<div class="podcast-image image">
				<img src="<?php echo($podcast_image_url); ?>" style="width:256px; height:256px;" />
			</div>
			<div class="podcast-details details">
				<div class="podcast-description description">
					<?php echo($podcast_description); ?>
				</div>
				<div class="metadata podcast-metadata">
					<ul>
						<li>Last updated: <?php echo($last_updated); ?>.</li>
						<li>Available episodes: <?php echo(sizeof($podcast_feed_xml -> channel -> item)) ?></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="episode-list">
			<?php
			$podcast_index = 0;
			foreach ($podcast_feed_xml -> channel -> item as $episode_info) {

				$episode_title = $episode_info -> title;
				$episode_description = $episode_info -> description;
				$episode_image = (new SimpleXMLElement($episode_info -> children('itunes', true) ->image -> asXml())) ['href'];
				$episode_timestamp = $episode_info -> pubDate;
				$episode_link = $episode_info -> link;

				# Try getting media info from media tag
				try {
					$content = new SimpleXMLElement($episode_info -> children('media', true) -> content -> asXML());
					$media_file_url = $content['url'];
					$media_file_type = $content['type'];
					$media_file_size = $content['fileSize'];
				}
				# Otherwise fall back to enclosure
				catch (Exception $ex) {
					$media_file_url = $episode_info -> enclosure['url'];
					$media_file_type = $episode_info -> enclosure['type'];
					$media_file_size = $episode_info -> enclosure['length'];
				
				}
			?>
			<div id="episode-entry-<?php echo($podcast_index); ?>" class="episode-entry box">
				<div class="episode-title title"><a href="<?php echo($episode_link); ?>"><?php echo($episode_title); ?></a></div>
				<div class="episode-image image">
					<a href="<?php echo($episode_link); ?>"><img src="<?php echo($episode_image); ?>" style="width:256px" /></a>
				</div>
				<div class="episode-details details">
					<div class="episode-description">
						<?php echo($episode_description); ?>
					</div>
					<div class="episode-links">
						<a id="podcast-download-link-<?php echo($podcast_index); ?>" class="podcast-media-link" href="<?php echo($media_file_url); ?>" type="<?php echo($media_file_type); ?>">Click to listen</a>.
					</div>
					<div class="metadata episode-metadata">
						<ul>
							<li>Published: <?php echo($episode_timestamp); ?></li>
						</ul>
					</div>
				</div>
			</div>
			<?php
				$podcast_index ++;
			} // foreach
			?>
		</div>
		<div class="footer">
			<ul>
				<li>All content seen here &copy; its creator.</li>
				<li>All code genreating this site is released as <a href="https://creativecommons.org/publicdomain/zero/1.0/">public domain</a>.</li>
				<li>Source code available <a href="#">on Github</a>.</li>
				<li>Please report any issues <a href="#">on Github</a>.</li>
				<li>Built and hosted by <a href="http://cai.zone">Cai</a>.</li>
			</ul>
		</div>
	</div>
</body>
</html>
