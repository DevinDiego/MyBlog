<?php 

require "includes/config.php";

session_start();

$conn = getDB();

$sql = "SELECT * FROM article ORDER BY published_at";

$results = mysqli_query($conn, $sql);

if($results === false) {
	echo mysqli_error($conn);
} else {
	$articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

?>

<?php if(empty($articles)): ?>
	<p>No articles found!</p>
	<?php else: ?>

		<?php require "includes/header.php"; ?>

		<?php if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): ?>
			<p>You are logged in. <a href="logout.php">Log out</a></p>
			<?php else: ?>
				<p>You are not logged in. <a href="login.php">Log in</a></p>
			<?php endif; ?>

		<h2>Article Archive</h2>		

		<ul>
			<?php foreach($articles as $article): ?>
				<li>
					<article>
						<h2><a href="article.php?id=<?=$article['id']; ?>"><?=htmlspecialchars($article['title']); ?></a></h2>
						<h4><?=htmlspecialchars($article['content']); ?></h4>
						<p><?=htmlspecialchars($article['published_at']); ?></p>

					</article>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>	

	<button><a href="new_article.php">NEW</a></button>

	<?php require "includes/footer.php"; ?>
