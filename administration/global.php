<?php
require_once("../class/init.php");
require_once("../config/main.php");

//CREATE NEW
if(isset($_POST['NewsSubmit'])){
	$title = $_POST['TitleNews'];
	$msg = $_POST['MessageNews'];
	$fblink = '';
	$$picture = '';
	
	CreateNew($title, $msg, $fblink, $picture);
	
}

?>