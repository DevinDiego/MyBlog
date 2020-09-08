<?php 

function getArticle($conn, $id) {

	$sql = "SELECT * FROM article WHERE id = ?";

	// Prepare an SQL statement for execution
	$stmt = mysqli_prepare($conn, $sql);

	if($stmt == false) {

		// Returns a string description of the last error
		echo mysqli_error($conn);

	} else {

		// Binds variables to a prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "i", $id);

		// Executes a prepared Query
		if(mysqli_stmt_execute($stmt)) {

			// Gets a result set from a prepared statement
			$result = mysqli_stmt_get_result($stmt);

			// Fetch a result row as an associative, a numeric array, or both
			return mysqli_fetch_array($result, MYSQLI_ASSOC);
		}
	}
}



function validateArticle($title, $content, $published_at) {

	$errors = [];

	if($title == '') {
		$errors[] = "Title is required";		
	}

	if($content == '') {
		$errors[] = "Content is required";
	}

	// if($published_at == '') {
	// 	$date_time = date_create_from_format('Y-m-d H:i:s', $published_at);

	// 	if($date_time === false) {
	// 		$errors = "Invalid date and time";
	// 	} else {
	// 		$date_errors = date_get_last_errors();

	// 		if($date_errors['warning_count'] > 0) {
	// 			$errors[] = "Invalid date and time";
	// 		}
	// 	}
	// }

	if($published_at == '') {

		$published_at = null;

	}

	return $errors;
}

?>