<?php
ini_set("include_path", getenv("DOCUMENT_ROOT"). "/function");
include 'connected.php';
include 'form.php';
if (!empty($_SESSION['id'])) {
	if (!empty($_POST['news_name']) && !empty($_POST['news_text'])) {
		$id =  intval($_GET['news']);
		$news_name = strip_tags($_POST['news_name']);
		$news_text = strip_tags($_POST['news_text']);
		$time = date('H:i:s d F Y');
		try {
			$statement_handle = $database_handle->prepare('UPDATE table_news SET news_name=:news_name, news_text = :news_text, time = :time WHERE id = :id_name');
			$statement_handle -> bindParam('news_name', $news_name,PDO::PARAM_STR);
		  $statement_handle -> bindParam('news_text', $news_text,PDO::PARAM_STR);
		  $statement_handle -> bindParam('id_name', $id, PDO::PARAM_INT);
		  $statement_handle -> bindParam('time', $time, PDO::PARAM_STR);
		  $statement_handle -> execute();
		} catch (Exception $e) {
			print($e);
		}
		header('Location:index.php');
	}
	else {
		try {
		$statement_handle2 = $database_handle->prepare('SELECT * FROM table_news WHERE id = :id_news ');
		$statement_handle2 -> bindParam('id_news',$_GET['news'],PDO::PARAM_INT);
		$statement_handle2 -> execute();
		$mas_news = $statement_handle2 -> fetch();
		} catch (Exception $e) {
			print($e);
		}
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
	<?php include 'form.html'; ?>
	<?php
	if (!empty($_SESSION['id'])){ ?>

	<div class = "add">
	<a href = "index.php">
		<div class = back>BACK</div>
	</a>
		<form method="POST">
			NEWS NAME
			<input type="text" name="news_name" size="119" maxlength="100" value="<?php print $mas_news['news_name']; ?>">
			<br >
			<textarea name="news_text" cols="100" rows="20"><?php print $mas_news['news_text']; ?></textarea>
			<input type='submit' value='edit'>
		</form>
	</div>
<?php
	}
	else { ?>
		<div class = "error">For future work please login!</div>
	<?php
	}
?>
</body>
</html>