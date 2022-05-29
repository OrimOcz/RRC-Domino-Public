<?php
require_once('../config/main.php');
require_once('../class/init.php');
include("../pages/loader.html");
function returne(){
	echo'<meta http-equiv="refresh" content="1;url='.$GLOBALS['Server_URL'].'members?p=tranings"> ';
}
if(isset($_POST['submit'])){
	$Attendance;
	if($_POST['type'] == 0){
		$Attendance = DeleteAttendance($_POST['id'], $_SESSION['UserID']);
	} else {
		$Attendance = CreateAttendance($_POST['id'], $_SESSION['UserID'], $_POST['type'], $_POST['reason']);
	}

	if($Attendance){
		
            $_SESSION["successmsg"] = "<i class='fas fa-check'></i> Děkujeme Vám za nastavení účasti na tréninku.";
			returne();
		} else{
					$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Omlouváme se, ale něco se pokazilo. Zkuste to prosím znovu později.";
					returne();
			 }
}

?>