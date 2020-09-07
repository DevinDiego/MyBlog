<?php 

require "includes/config.php";

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

		<a href="new_article.php">Post a new article</a>

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
	

	<?php require "includes/footer.php"; ?>
