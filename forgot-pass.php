<?php
require_once("pages/header.php");
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=$GLOBALS['Server_Name']?> - Zapomenuté heslo</title>

</head>
<body>
<div class="bg-image" style="background-image: url('data/photos/dsc_2638.jpg');"></div>
	<div class="bg-text">
		<h1 class="">Zapomenuté heslo</h1>
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
	<style>
		.emailcode{
			display: flex;
			max-width: 80%;
			
		}
		.emailcode > input{
			height: 50px;
			width: 50px;
			border-radius: 10px;
			border: 0 none;
			text-align:center;
			margin: 10px;
			padding: 5px;
			font-size: 1.25rem;
				}
		.form{
			margin-bottom: 9em;
			width: 50%;
			margin-right: auto;
			margin-left: auto;
		}
  @media (max-width: 768px) {
		.emailcode > input{
			height: 30px;
			width: 30px;
			border-radius: 10px;
			border: 0 none;
			text-align:center;
			margin: 8px;
			padding: 2.5px;
				}
  }
	</style>
	<?php
	if(isset($_SESSION['UserID'])){
		echo "<h2 class='loginInfo'> Již jste přihlášen/a. </h2>";
	} else {
		
	switch ($_GET['p']){
		
		case 2:
			echo '
			<h2>Zadejte prosím kód který Vám byl odeslán na email.</h2>
			<form id="ForgotForm2" method="POST" action="./process/forgot_pass" class="form">
			<input type="hidden" name="CodeEmail" value="'. $_GET['u'] .'" />
					<div class="inputs emailcode">
						<input id="input-1" name="i1" maxlength="1" class="block input">
						<input id="input-2" name="i2" maxlength="1" class="block input">
						<input id="input-3" name="i3" maxlength="1" class="block input">
						<input id="input-4" name="i4" maxlength="1" class="block input">
						<input id="input-5" name="i5" maxlength="1" class="block input">
						<input id="input-6" name="i6" maxlength="1" class="block input">
					</div>
					<button type="submit" name="ForgotEmail2" style="float:right">Ověřit kód</button>
				</form>
				';
			break;
		case 3:
			echo '
			<h2>Zadejte prosím nové heslo.</h2>
			<form id="ForgotForm3" method="POST" action="./process/forgot_pass" class="form">
			<input type="hidden" name="PassEmail" value="'. $_GET['u'] .'" />
			<input type="hidden" name="PassCode" value="'. $_GET['c'] .'" />';?>
        <p><label for="change_pword" id="msg-password" style="display: none">K pokračování je potřeba dosahnout alespoň "Dobré heslo".</label><p id="msg"></p><input placeholder="Heslo" id="password" name="change_pword" type="password" oninput="strengthChecker()"><i class="fas fa-eye-slash" id="togglePassword" onclick="SeePass()"></i></p>
          <div id="strength-bar"></div>
   			<p><label for="change_spword" id="msg-password2" style="display: none">Hesla se musí shodovat</label><input placeholder="Znovu heslo" id="secpassword" name="change_spword" type="password"></p>
					<button type="submit" name="ForgotEmail3" style="float:right">Změnit heslo</button>
				</form>
			<?php
			break;
		default:
			echo '
			<h2>Níže zadejte emailovou adresu pro kterou jste zapoměli heslo.</h2>
			<form id="ForgotPass" method="POST" action="./process/forgot_pass">
					<div class="inputs">
						<input class="input-field" type="email" placeholder="Email" name="forgot_email">
					</div>
					<button type="submit" name="ForgotEmail" class="btn">Odeslat kód</button>
				</form>
				';
			break;
					
	};
	
	if($_GET['p'] == 2){
		
	}
	?>
	<script>
var container = document.getElementsByClassName("emailcode")[0];
container.onkeyup = function(e) {
    var target = e.srcElement;
    var maxLength = parseInt(target.attributes["maxlength"].value, 10);
    var myLength = target.value.length;
    if (myLength >= maxLength) {
        var next = target;
        while (next = next.nextElementSibling) {
            if (next == null)
                break;
            if (next.tagName.toLowerCase() == "input") {
                next.focus();
                break;
            }
        }
    }
};
	</script>
	<script>
	
		let parameters = {
    count : false,
    letters : false,
    numbers : false,
    special : false
}
let strengthBar = document.getElementById("strength-bar");
let msg = document.getElementById("msg");
    
function strengthChecker(){
	msg.textContent = "Test";
    let password = document.getElementById("password").value;

    parameters.letters = (/[A-Za-z]+/.test(password))?true:false;
    parameters.numbers = (/[0-9]+/.test(password))?true:false;
    parameters.special = (/[!\"$%&/()=?@~`\\.\';:+=^*_-]+/.test(password))?true:false;
    parameters.count = (password.length > 7)?true:false;

    let barLength = Object.values(parameters).filter(value=>value);

    console.log(Object.values(parameters), barLength);

    strengthBar.innerHTML = "";
    for( let i in barLength){
        let span = document.createElement("span");
        span.classList.add("strength");
        strengthBar.appendChild(span);
    }

    let spanRef = document.getElementsByClassName("strength");
    for( let i = 0; i < spanRef.length; i++){
        switch(spanRef.length - 1){
            case 0 :
                spanRef[i].style.background = "#ff3e36";
                msg.textContent = "Velmi slabé heslo";
                msg.style.color = "#ff3e36";
                break;
            case 1:
                spanRef[i].style.background = "#ff691f";
                msg.textContent = "Slabé heslo";
                msg.style.color = "#ff691f";
                break;
            case 2:
                spanRef[i].style.background = "#ffda36";
                msg.textContent = "Dobré heslo";
                msg.style.color = "#ffda36";
                break;
            case 3:
                spanRef[i].style.background = "#0be881";
                msg.textContent = "Velmi dobré heslo";
                msg.style.color = "#0be881";
                break;
        }
    }
}
		function SeePass() {
  var x = document.getElementById("password");
	var i = document.getElementById("togglePassword");
  if (x.type === "password") {
    x.type = "text";
	  i.classList.toggle("fa-eye");
  } else {
    x.type = "password";
	   i.classList.toggle("fa-eye-slash");
  }
}
	</script>
</div>

    <?php
	}
    include('./pages/footer.php');
    ?>
</body>
</html>