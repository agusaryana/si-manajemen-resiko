<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title><?php echo $dataorg['short_org'].' - '.$title ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="<?php echo base_url() ?>asset/spectral/assets/css/main.css" />
        <link rel="icon" href="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['favicon_org'] ?>" type="image/x-icon" />
		<noscript><link rel="stylesheet" href="<?php echo base_url() ?>asset/spectral/assets/css/noscript.css" /></noscript>
	</head>
	<body class="landing is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">
				<!-- Banner -->
					<section id="banner">
						<div class="inner">
							<h2>Ticket Telah Terkirim!</h2>
							<p>Silakan cek email anda secara berkala untuk mendapatkan update progres.<br /></p>
							<ul class="actions special">
								<li><a href="<?php echo base_url() ?>" class="button primary">Home</a></li>
							</ul>
						</div>
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li>&copy; 2023</li><li> <?php echo $dataorg['nama_org']?></li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="<?php echo base_url() ?>asset/spectral/assets/js/jquery.min.js"></script>
			<script src="<?php echo base_url() ?>asset/spectral/assets/js/jquery.scrollex.min.js"></script>
			<script src="<?php echo base_url() ?>asset/spectral/assets/js/jquery.scrolly.min.js"></script>
			<script src="<?php echo base_url() ?>asset/spectral/assets/js/browser.min.js"></script>
			<script src="<?php echo base_url() ?>asset/spectral/assets/js/breakpoints.min.js"></script>
			<script src="<?php echo base_url() ?>asset/spectral/assets/js/util.js"></script>
			<script src="<?php echo base_url() ?>asset/spectral/assets/js/main.js"></script>

	</body>
</html>