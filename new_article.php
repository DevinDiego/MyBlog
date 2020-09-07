<?php 

require "includes/config.php";

$errors = [];
$title = '';
$content = '';
$published_at = '';

if($_SERVER["REQUEST_METHOD"] == "POST") {	

	$title = $_POST['title'];
	$content = $_POST['content'];
	$published_at = $_POST['published_at'];

	if($title == '') {
		$errors[] = "Title is required";		
	}

	if($content == '') {
		$errors[] = "Content is required";
	}

	if($published_at == '') {
		$date_time = date_create_from_format('Y-m-d H:i:s', $published_at);

		if($date_time === false) {
			$errors = "Invalid date and time";
		} else {
			$date_errors = date_get_last_errors();

			if($date_errors['warning_count'] > 0) {
				$errors[] = "Invalid date and time";
			}
		}
	}

	if(empty($errors)) {

		$conn = getDB();

		$sql = "INSERT INTO article (title, content, published_at)
		VALUES (?, ?, ?)";

		$stmt = mysqli_prepare($conn, $sql);

		if($stmt === false) {
			echo mysqli_error($conn);
		} else {

			if($published_at == '') {
				$published_at = null;
			}

			mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);

			if(mysqli_stmt_execute($stmt)) {

				$id = mysqli_insert_id($conn);
				echo "Inserted id $id";
			} else {

				echo mysqli_stmt_error($stmt);
			}
		}
	} // END if(empty($errors))
} // END if($_SERVER["REQUEST_METHOD"] == "POST")

?>

<?php require "includes/header.php"; ?>

<h2>New Article</h2>

<?php if(!empty($errors)): ?>
	<ul>
		<?php foreach($errors as $error): ?>
			<li><?=$error ?></li>
		<?php endforeach; ?>
	</ul> 
<?php endif; ?>

<form method="post">
	<div>
		<label for="title">Title:&nbsp;</label>
		<input type="text" name="title" id="title" placeholder="Title" value="<?=htmlspecialchars($title);?>">
	</div>

	<div>
		<label for="content">Content:&nbsp;</label>
		<textarea name="content" rows="4" cols="40" id="content" placeholder="Article Content"><?=htmlspecialchars($content);?></textarea>
	</div>

	<div>
		<label for="published_at">Date/Time:&nbsp;</label>
		<input type="datetime-local" name="published_at" id="published_at" value="<?=htmlspecialchars($published_at); ?>">
	</div>

	<div>
		<button>Add Article</button>
	</div>
</form>

<a href="index.php">Return to Blog List...</a>

<?php require "includes/footer.php";

