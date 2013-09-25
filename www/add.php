<?php
ini_set("include_path", getenv("DOCUMENT_ROOT"). "/function");
include 'connected.php';
include 'form.php';
if (!empty($_SESSION['id'])){
	if ($_POST['news_name'] && $_POST['news_text']) {
		$time = date('H:i:s d F Y');
		 $statement_handle = $database_handle -> prepare('INSERT INTO table_news(news_name, news_text, news_author, time) VALUES (:news_name, :news_text, :news_author, :time) ');
		 $statement_handle -> bindParam('news_name', strip_tags($_POST['news_name']) );
		 $statement_handle -> bindParam('news_text', strip_tags($_POST['news_text']) );
		 $statement_handle -> bindParam('news_author', $_SESSION['login']);
		 $statement_handle -> bindParam('time', $time);
		 $statement_handle -> execute();
	   header("Location:index.php");
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header >MOBILE</header>

	<?php
	include 'form.html';
	if (!empty($_SESSION['id'])){
	 ?>
	<div class = "add">
	<a href = "index.php">
		<div class = back>BACK</div>
	</a>
		<form method = "POST">
			NEWS NAME
			<input type = text name = "news_name" size = "119" maxlength="100">
			<br >
			<textarea name = "news_text" cols = "100" rows = "20" placeholder = "News content"></textarea>
			<br >
			<input type = 'submit' value = 'add'>
		</form>
	</div>
<?php
	} else {?>
		<div class = "error">For future work please login!</div>
	<?php
	}
?>
</body>
</html>