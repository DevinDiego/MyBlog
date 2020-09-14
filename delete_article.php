<?php 

require "includes/config.php";
require "includes/get_article.php";

$conn = getDB();

if(isset($_GET['id'])) {

	$article = getArticle($conn, $_GET['id']);

	if($article) {

		$id = $article['id'];
		$title = $article['title'];
		$content = $article['content'];
		$published_at = $article['published_at'];

	} else {

		die("Article not found!");

	}
} else {

	die("id not supplied, article not found!");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

	$stmt = mysqli_prepare($conn, "DELETE FROM article WHERE id = ?");

	if($stmt === false) {

		echo mysqli_error($conn);

	} else {			

		mysqli_stmt_bind_param($stmt, "i", $id);

		if(mysqli_stmt_execute($stmt)) {

			header("Location: index.php");
			exit;

		} else {

			echo mysqli_stmt_error($stmt);
		}
	}
}

?>

<?php require "includes/header.php" ?>

<h2>Delete Article</h2>

<form method="post">
<h3>Are you sure?</h3>
	<button>DELETE</button>
</form>

<button><a href="article.php?id=<?=$article['id'];?>">CANCEL</a></button>

<?php require "includes/footer.php"; ?>