<?php 

require "includes/config.php";

$conn = getDB();

if(isset($_GET['id']) && is_numeric($_GET['id'])) {

	$sql = "SELECT * FROM article WHERE id = " . $_GET['id'];

	$results = mysqli_query($conn, $sql);

	if($results === false) {
		echo mysqli_error($conn);
	} else {
		$article = mysqli_fetch_assoc($results);
	}

} // END if(isset($_GET['id']) && is_numeric($_GET['id']))

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

 <a href="index.php">Return to Blog List...</a>

 <?php require "includes/footer.php"; ?>

 