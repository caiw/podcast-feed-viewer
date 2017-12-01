<?php
require('functions.php');
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title><?php echo($site_name); ?></title>

  <link rel="stylesheet" href="styles.css">
  <script src="jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="view-podcast.js" type="text/javascript"></script>
</head>
<body>
	<div id="wrapper">
		<?php include 'header.php' ?>
		<div class="viewer-info-box box">
			<div class="box-body">
				<div class="viewer-blurb">
					The URL "<?php echo($podcast_feed_url); ?>" did not resolve to a valid podcast RSS feed.
					If you think this message is in error, please report it using the link below, including the problematic URL.
				</div>
				<div class="try-again-link">
					<a href="<?php echo('./' . $root_url . '?feed=' . $podcast_feed_url); ?>">Try again</a>.
				</div>
			</div>
		</div>
		<?php include 'footer.php'; ?>
	</div>
</body>
</html>
