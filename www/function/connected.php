<?php
	session_start();
 $database_handle=new PDO("mysql:host=localhost;dbname=site_z2",'root','');
$database_handle->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);?>