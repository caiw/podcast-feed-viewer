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
					Enter a podcast feed URL here to view and listen to the available episodes.
				</div>
				<div class="feed-form">
					<form action="index.php" method="GET">
						<input type="text" name="feed" placeholder="http://example.com/podcast.rss">
						<button type="submit">View podcast feed</button>
					</form>
				</div>
			</div>
		</div>
		<?php include 'footer.php'; ?>
	</div>
</body>
</html>
