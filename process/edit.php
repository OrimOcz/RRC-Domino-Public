<?php
require_once('../config/main.php');
require_once('../class/init.php');
include("../pages/loader.html");
function returne(){
	echo'<meta http-equiv="refresh" content="2;url='.$GLOBALS['Server_URL'].'profile"> ';
}
if(isset($_POST['send'])){
	$edit = EditUser($_POST['fname'], $_POST['lname'], $_POST['nname'], $_POST['birthday'], $_POST['phone'], $_POST['mail'], $_POST['job'],$_POST['hobby']);

            $_SESSION["successmsg"] = "<i class='fas fa-check'></i> Děkujeme Vám za žádost o změnu údajů. Nyní musíte vyčkat na schválení administrátorem. O dalších krocích budete informováni pomocí emailu.";
			returne();
} else{
            $_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Omlouváme se, ale něco se pokazilo. Zkuste to prosím znovu později. (Hláška 03)";
			returne();
     }

?>