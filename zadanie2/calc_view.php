<!DOCTYPE HTML>
<!--
	TXT by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Kalkulator Kredytowy</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">
		<div id="page-wrapper">

			<header id="header">
				<div class="logo container">
					<div>
						<h1><a href="index.php" id="logo">Zadanie 2: </a></h1>
						<p>Szablonowanie - Kalkulator</p>
					</div>
				</div>
			</header>

			<nav id="nav">
				<ul>
					<li class="current"><a href="index.php">Strona Główna</a></li>
				</ul>
			</nav>

			<!-- Main -->
				<section id="main">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="content">

									<!-- Content -->

										<article class="box page-content">

											<header>
												<h2>Kalkulator Kredytowy</h2>
												<p>Wypełnij formularz, aby poznać wysokość swojej raty.</p>
											</header>

											<section>
												<?php if (isset($messages) && count($messages) > 0) { ?>
													<div style="margin: 20px 0; padding: 15px; background: #FF8888; color: white; border-radius: 5px;">
														<ol style="margin: 0; padding-left: 20px;">
															<?php foreach ($messages as $msg) { echo '<li>'.$msg.'</li>'; } ?>
														</ol>
													</div>
												<?php } ?>

												<form method="get" action="calc.php">
													<div class="row gtr-50">
														<div class="col-4 col-12-mobile">
															<label>Kwota kredytu:</label>
															<input type="text" name="amount" value="<?php echo htmlspecialchars($amount ?? ''); ?>" />
														</div>
														<div class="col-4 col-12-mobile">
															<label>Liczba lat:</label>
															<input type="text" name="years" value="<?php echo htmlspecialchars($years ?? ''); ?>" />
														</div>
														<div class="col-4 col-12-mobile">
															<label>Oprocentowanie:</label>
															<select name="interest">
																<option value="2" <?php if(($interest ?? '') == '2') echo 'selected'; ?>>2%</option>
																<option value="4" <?php if(($interest ?? '') == '4') echo 'selected'; ?>>4%</option>
																<option value="6" <?php if(($interest ?? '') == '6') echo 'selected'; ?>>6%</option>
																<option value="8" <?php if(($interest ?? '') == '8') echo 'selected'; ?>>8%</option>
															</select>
														</div>
														<div class="col-12">
															<ul class="actions">
																<li><input type="submit" value="Oblicz ratę" class="button alt" /></li>
															</ul>
														</div>
													</div>
												</form>

												<?php if (isset($result)){ ?>
													<div style="margin-top: 30px; padding: 20px; background: #ebed6a; border-radius: 5px; color: #333;">
														<h3 style="margin: 0;">
															Miesięczna rata: 
															<strong><?php echo number_format((float)$result, 2, ',', ' '); ?> PLN</strong>
														</h3>
													</div>
												<?php } ?>
											</section>
										</article>

								</div>
							</div>
						</div>
					</div>
				</section>

			<!-- Footer -->
				<footer id="footer">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div id="copyright">
									<ul class="menu">
										<li>&copy; 2026 Zuzanna Brzozowska</li>
										<li>Przedmiot: Projektowanie Aplikacji Internetowych</li>
										<li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>