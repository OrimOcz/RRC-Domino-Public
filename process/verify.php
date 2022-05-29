<?php
require_once('../config/main.php');
require_once("../class/init.php");
include("../pages/loader.html");

$user = $_GET['u'];
$code = $_GET['c'];

$result = Verify($user, $code);
if($result = true){
	$_SESSION["successmsg"] = "Úspěšně jste ověřil/a svůj účet. Nyní se stačí pouze přihlásit.";
} else {
	$_SESSION["errormsg"] = "Jejda něco se úplně nepovedlo. Nejspíš jste zadali špatný ověřovací odkaz. Pokud nemůžete najít platný ověřovací odkaz, tak kontaktujte Administrátora. (Hláška 21)";
}
 echo'<meta http-equiv="refresh" content="1;url='.$GLOBALS['Server_URL'].'login"> ';
?>
