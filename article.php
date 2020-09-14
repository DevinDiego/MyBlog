<?php 

require "includes/config.php";
require "includes/get_article.php";

$conn = getDB();

if(isset($_GET['id'])) {

	$article = getArticle($conn, $_GET['id']);		

} else {
	$article = null;
}

?>

<?php if($article === null): ?>
	<p>No article found!</p> 
	<?php else: ?>

		<?php require "includes/header.php"; ?>
		<article>
			<h2><?=htmlspecialchars($article['title']); ?></h2>
			<h4><?=htmlspecialchars($article['content']); ?></h4>
			<p><?=htmlspecialchars($article['published_at']); ?></p>
		</article>
	<?php endif; ?>



	<button><a href="edit_article.php?id=<?=$article['id'];?>">EDIT</a></button>

	<button><a href="delete_article.php?id=<?=$article['id'];?>">DELETE</a></button>
	
	<button><a href="index.php">ARCHIVE</a></button>

	<?php require "includes/footer.php"; ?>

