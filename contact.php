<?php
require_once("config/main.php");
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php
include("pages/header.php");
?> 
<title><?=$GLOBALS['Server_Name']?> - Napište nám</title>

</head>
<body>

<div class="bg-image" style="background-image: url('data/photos/zavody.jpg');"></div>
	<div class="bg-text">
		<h1 class="">Napište nám</h1>
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

<form id="contactForm" method="POST" action="./process/contact" class="form">
				<div class="form-section">
				<p style="color: white">* - je potřebné tento údaj vyplnit</p>
					<div class="input-box2">
						<input type="text" name="name" required />
						<label for="fname">Jméno a Přijmení *</label>
					</div>	
					<div class="input-box2">
						<input type="email" maxlength="30" name="mail" required />
						<label for="nname">E-mail *</label>
					</div>	
					<div class="input-box2">
						<input type="tel" name="phone" maxlength="16" required />
						<label for="phone">Telefon *</label>
					</div>
					<div class="input-box2">
						<p for="text">Zpráva *</p>
						<textarea style="resize: vertical;" maxlength="200" name="text"></textarea>
					</div>
				</div>
	<button type="submit" class="btn">Odeslat</button>
</form>
</div>

    <?php
	
    include('./pages/footer.php');
    ?>
</body>
</html>