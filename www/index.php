<?php
ini_set('include_path', getenv('DOCUMENT_ROOT'));
include 'function/connected.php';
include 'form.php';
if (!empty($_POST['current_page'])) {
	$_SESSION['current_page'] = $_POST['current_page'];
	}
else {
	$_SESSION['current_page'] = 1;
}
$first = ($_SESSION['current_page']-1)*10;
$last = 10;
$news = $database_handle -> prepare("SELECT * FROM table_news LIMIT :first, :last ");
$news -> bindParam('first', $first, PDO::PARAM_INT);
$news -> bindParam('last', $last, PDO::PARAM_INT);
$news -> execute();
$limit = $news -> rowCount();
$mas_of_news = $news -> fetchAll();
$first=0;
$last = 100000;
$news -> bindParam('first', $first, PDO::PARAM_INT);
$news -> bindParam('last', $last, PDO::PARAM_INT);
$news -> execute();
$all_news = $news -> rowCount();
$limit_page = ceil($all_news / 10);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header >MOBILE</header>
	<?php include 'form.html' ?>
	<div class="block1"> </div>
	<div class="pager">
		<form method = "post">
		  <select name = "current_page">
		    <?php for($i = 1; $i < $limit_page+1; $i++) {?>
		    <option value = "<?php print $i; ?>"><?php print $i; }?></option>
		  </select>
		  <input type = "submit" value="Move "/>
		</form>
	</div>
	<div class = "all_news">
	 <a href="add.php">
	 	<div class="go_add">add news</div>
	 </a>
	<?php
	for($i=0; $i < $limit; $i++):
	$this_news = ($_SESSION['current_page']-1)*10+$i+1;
	?>
		<div class ="news">
				<h1><?php print $mas_of_news[$i]['news_name']; ?></h1>
				<a href="edit.php?news=<?php print $this_news; ?>&site=<?php print $_SERVER['SCRIPT_NAME'] ?>">Edit</a>
				<p> <?php print $mas_of_news[$i]['time']; ?> </p>
				<?php
				if (strlen($mas_of_news[$i]['news_text']) > 155) {
					print substr($mas_of_news[$i]['news_text'], 0, strpos($mas_of_news[$i]['news_text'], ' ', 155)) ;
				}
				else {
					print $mas_of_news[$i]['news_text'];
				}
				?>
				<br >
				<a href="news.php?news=<?php print $this_news; ?>"> READ MORE </a>
		</div>
	<?php endfor; ?>
</div>
</body>
</html>