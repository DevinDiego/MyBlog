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
	
	$title = $_POST['title'];
	$content = $_POST['content'];
	$published_at = $_POST['published_at'];

	$errors = validateArticle($title, $content, $published_at);

	if(empty($errors)) {
		
		$stmt = mysqli_prepare($conn, "UPDATE article SET title = ?, content = ?, published_at = ? WHERE id = ?");

		if($stmt === false) {

			echo mysqli_error($conn);

		} else {

			if($published_at == '') {

				$published_at = null;
			}

			mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $published_at, $id);

			if(mysqli_stmt_execute($stmt)) {
				
				header("Location: index.php");
				exit;

			} else {

				echo mysqli_stmt_error($stmt);
			}
		}
	} // END if(empty($errors))
}

?>

<?php require "includes/header.php"; ?>


<h2>Edit Article</h2>

<?php require "includes/reusable_article_form.php"; ?>
<br>
<button><a href="index.php">CANCEL</a></button>

<?php require "includes/footer.php"; ?>