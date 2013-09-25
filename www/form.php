<?php
if (!empty($_POST['unset'])) {
 unset($_SESSION['id']);
}
if (empty($_SESSION['id'])){
	if (empty($_POST['data']) && empty($_POST['password'])) {
		$error = 1;
	}
	else {
	  $data = $_POST['data'];
	  $password = $_POST['password'];
	    if (preg_match('/[\w]+\@{1}[\w]+\.[\w]/',$data)!=0) {
	      $log_or_email = 'email';
	    }
	    else {
	      $log_or_email = 'login';
	    }
	    $statement_handle = $database_handle -> prepare(" SELECT * FROM table_profils WHERE $log_or_email = :data AND password = :password ");
	    $statement_handle -> bindParam('data',$data);
	    $statement_handle -> bindParam('password',$password);
	    $statement_handle -> execute();
	    $mas = $statement_handle -> fetch();
	    if (!empty($mas)) {
	     	$_SESSION['id'] = $mas['id'];
	     	$_SESSION['login'] = $mas['login'];
	     	$site = $_SERVER['REQUEST_URI'];
	     	header("Location:$site");
	    }
	    else {
	      $error = 2;
	    }
	    print($log_or_email);
	}
}?>