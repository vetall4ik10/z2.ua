<?php
ini_set ('include_path', getenv('DOCUMENT_ROOT'));
include 'function/connected.php';
include 'form.php';
if (!empty($_GET['news'])) {
		$statement_handle2 = $database_handle->prepare('SELECT * FROM table_news WHERE id = :id_news ');
		$statement_handle2 -> bindParam('id_news',$_GET['news'],PDO::PARAM_STR);
		$statement_handle2 -> execute();
		$mas_news = $statement_handle2 -> fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>MOBILE</header>
	<?php include 'form.html'; ?>
	<div class = "news_read">
	<a href = "index.php">
		<div class = back>BACK</div>
	</a>
				<h1><?php print $mas_news['news_name']; ?></h1>
				<i><a href = "edit.php?news=<?php print $_GET['news']?>&site=<?php print $_SERVER['SCRIPT_NAME'] ?>">Edit</a></i>
				<br >
				 <p><?php print $mas_news['time']; ?></p>
				<?php print $mas_news['news_text']; ?>
				<?php print $mas_news['author']; ?>
		</div>

</body>
</html>