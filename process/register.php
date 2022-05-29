<?php
require_once('../config/main.php');
require_once('../class/init.php');
include("../pages/loader.html");
function returne(){
	echo'<meta http-equiv="refresh" content="1;url='.$GLOBALS['Server_URL'].'register"> ';
}
if(isset($_POST['reg_email'])){
  	$mail = strtolower($_POST['reg_email']);

    if(ExistUser($mail) == false){
        $pass = $_POST['reg_pword'];
        $msg= "";
        $Hpass = HashFunction($pass);
        $create = CreateNewUser($_POST['reg_fname'], $_POST['reg_lname'], $_POST['reg_nname'], $mail, $_POST['reg_phone'], $Hpass, $_POST['news'],$_POST['trenings'],$_POST['action']);
        if($create == true){
            $_SESSION["successmsg"] = "<i class='fas fa-check'></i> Děkujeme Vám za úspěšnou registraci. Nyní Vám dorazí na uvedený email ověřovací kód. Postupujte prosím podle pokynů v emailu.";
			returne();
        } else{
            $_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Omlouváme se, ale něco se pokazilo. Kontaktujte prosím administrátora webu. (Hláška 03)";
			returne();
        }
    } else{
           $_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Tato emailová adresa je již zaregistrovaná. (Hláška 01)";
		returne();
            
        
    }
}
?>