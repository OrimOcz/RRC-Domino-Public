<?php
require_once('../config/main.php');
require_once('../class/init.php');
if(isset($_GET['c'])){
	$_SESSION['cookie'] = 'on';
	echo 'test';
}
?>