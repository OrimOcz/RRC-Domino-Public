<?php
require_once('../config/main.php');
require_once("../class/init.php");
include("../pages/loader.html");

if(isset($_POST['ForgotEmail'])){
	ForgotPass($_POST['forgot_email']);
	$email = $_POST['forgot_email'];
	$_SESSION["successmsg"] = "Pokud je tento email zaregistrovaný a ověřený, tak na byl na tento email zaslán kód pro změnu hesla.";
	 echo'<meta http-equiv="refresh" content="1;url='.$GLOBALS['Server_URL'].'forgot-pass?u='. md5($email) .'&p=2"> ';
}
if(isset($_POST['ForgotEmail2'])){
	$code = $_POST['i1'] . $_POST['i2'] . $_POST['i3'] . $_POST['i4'] . $_POST['i5'] . $_POST['i6'];
	$result = VerifyCode($_POST['CodeEmail'], $code);
	$email = $_POST['CodeEmail'];
	if($result){
		$_SESSION["successmsg"] = "Úspěšně potvrzená emailová adresa.";
	 	echo'<meta http-equiv="refresh" content="1;url='.$GLOBALS['Server_URL'].'forgot-pass?u='. $email.'&c='.$code.'&p=3"> ';
	} else{
		$_SESSION["errormsg"] = "Jejda. Zadali jste špatný kód. (Hláška 27)";
	 	echo'<meta http-equiv="refresh" content="1;url='.$GLOBALS['Server_URL'].'forgot-pass?u='. $email .'&p=2"> ';
	}
}
if(isset($_POST['ForgotEmail3'])){
	$emial = $_POST['PassEmail'];
	$pass1=$_POST['change_spword'];
	$pass2=$_POST['change_pword'];
	$code = $_POST['PassCode'];
	
	if(($pass1 == $pass2)){
		$pass = HashFunction($pass1);
		$result = ChangePass($pass, $emial, $code);
		if($result){
			$_SESSION["successmsg"] = "Úspěšně jsme změnili Vaše heslo. Nyní se stačí přihlásit";
	 		echo'<meta http-equiv="refresh" content="1;url='.$GLOBALS['Server_URL'].'login"> ';
		} else{
			$_SESSION["errormsg"] = "Jejda. Něco se nepovedlo. Zkuste to prosím znovu (Hláška 29)";
	 		echo'<meta http-equiv="refresh" content="1;url='.$GLOBALS['Server_URL'].'forgot-pass"> ';
		}
	} else{
		$_SESSION["errormsg"] = "Jejda. Hesla se neshodují. (Hláška 30)";
		echo'<meta http-equiv="refresh" content="1;url='.$GLOBALS['Server_URL'].'forgot-pass?u='. $emial .'&c='.$_POST['PassCode'].'&p=3"> ';
	}
}


?>
