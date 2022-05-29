<?php
require_once("pages/header.php");
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=$GLOBALS['Server_Name']?> - Přihlášení</title>

</head>
<body>
<div class="bg-image" style="background-image: url('data/photos/dsc_3397.jpg');"></div>
	<div class="bg-text">
		<h1 class="">Přihlášení</h1>
		<hr>
	</div>
<div class="form">
        <p>
          <?php
            if (isset($_SESSION["successmsg"])){
                echo '<div class="successpanel">';
                    echo $_SESSION["successmsg"];
                echo '</div>';
            }
            if (isset($_SESSION["errormsg"])){
                echo '<div class="errorpanel">';
                    echo $_SESSION["errormsg"];
                echo '</div>';
            }
            unset($_SESSION["successmsg"]);
            unset($_SESSION["errormsg"]);?></p>
	<?php
	if(isset($_SESSION['UserID'])){
		echo "<h2 class='loginInfo'> Již jste přihlášen/a. </h2>";
	} else {
	
	?>
<form id="loginForm" method="POST" action="./process/login" class="form">
	<div class="inputs">
		<input class="input-field" type="email" placeholder="E-mail" name="login_email">
		<input class="input-field" type="password" placeholder="Heslo" name="login_pword">
	</div>
	<button type="submit" class="btn">Přihlásit se</button>
	<a href="./forgot-pass">Zapomenuté heslo</a>
</form>
</div>

    <?php
	}
    include('./pages/footer.php');
    ?>
</body>
</html>