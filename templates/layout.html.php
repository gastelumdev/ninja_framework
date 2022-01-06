<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="jokes.css">
		<title><?=$title?></title>
	</head>
	<body>
	<nav>
		<header>
			<h1>Internet Joke Database</h1>
		</header>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="index.php?joke/list">Jokes List</a></li>
			<li><a href="index.php?joke/edit">Add a new Joke</a></li>
			<?php if ($loggedIn): ?>
			<li><a href="index.php?logout">Log out</a></li>
			<?php else: ?>
			<li><a href="index.php?login">Log in</a></li>
			<?php endif; ?>
		</ul>
	</nav>

	<main>
	<?=$output?>
	</main>

	<footer>
	&copy; IJDB 2017
	</footer>
	</body>
</html>