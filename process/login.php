<?php
require_once('../config/main.php');
require_once('../class/init.php');
include("../pages/loader.html");
if(isset($_POST['login_email'])){
  	$mail = strtolower($_POST['login_email']);
	$pass = $_POST['login_pword'];

    if(ControlUser($mail, $pass) == true){
			$_SESSION['email'] = $mail;
            $_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně přihlášn/a.";
    } else{
           $_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Zadal/a jste neplatné přihlašovací údaje, nebo účet není ověřen. V případě, že úćet není ověřen, tak  zkontrolujte Vaší emailovou schránku. (Hláška 11)";
            
        
    }
    echo'<meta http-equiv="refresh" content="2;url='.$GLOBALS['Server_URL'].'/login">';
}

?>