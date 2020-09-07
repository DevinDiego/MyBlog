<?php 

require "includes/config.php";
require "includes/get_article.php";

$conn = getDB();

if(isset($_GET['id'])) {

	$article = getArticle($conn, $_GET['id']);		

} else {
	$article = null;
}

var_dump($article);