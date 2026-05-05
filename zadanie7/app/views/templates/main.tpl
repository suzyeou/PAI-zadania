<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta charset="utf-8" />
	<title>MoodTrack - Twój Dziennik Muzyczny</title>
	<link rel="stylesheet" href="{$conf->app_url}/public/assets/css/main.css" />
</head>
<body class="is-preload">
	<div id="page-wrapper">

		<!-- Header -->
		<header id="header">
			<div class="logo container">
				<div>
					<h1><a href="{$conf->action_url}loginView" id="logo">MoodTrack</a></h1>
					<p>- Kataloguj utwory według emocji</p>
				</div>
			</div>
		</header>

		<!-- Nav -->
		<nav id="nav">
			<ul>
				<li>
					<a href="{$conf->action_url}{if \core\RoleUtils::inRole('Admin')}adminView{elseif isset($user)}userView{else}loginView{/if}">
						Strona główna
					</a>
				</li>
				
				{if isset($user) && isset($user->login)}
					<li class="current">
						<a href="#">Zalogowany: <strong>{$user->login}</strong></a>
					</li>
					<li>
						<a href="{$conf->action_url}logout" style="color: #d9534f;">Wyloguj</a>
					</li>
				{else}
					<li><a href="{$conf->action_url}loginView">Zaloguj się</a></li>
					<li><a href="{$conf->action_url}registerView">Rejestracja</a></li>
				{/if}
			</ul>
		</nav>

		<!-- Main Content Area -->
		<section id="main">
			<div class="container">
				<div class="row gtr-200">
					<div class="col-12">
						<div class="content">
							{block name=content}  {/block}
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Footer -->
            <footer id="footer">
                <div class="container">
                    <div id="copyright">
                        <ul class="menu">
                            <li>Zuzanna Brzozowska</li>
							<li> MoodTrack</li>
                            <li>Framework: <a href="https://amelia-framework.eu/">Amelia</li>
                            <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                        </ul>
                    </div>
                </div>
            </footer>

	</div>

	<!-- Scripts -->
	<script src="{$conf->app_url}/public/assets/js/jquery.min.js"></script>
	<script src="{$conf->app_url}/public/assets/js/main.js"></script>
</body>
</html>