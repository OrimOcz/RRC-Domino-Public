<?php
require_once("pages/header.php");
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=$GLOBALS['Server_Name']?> - Registrace</title>
<style>

</style>
</head>
<body>
<div class="bg-image" style="background-image: url('data/photos/dsc_7285.jpg');"></div>
	<div class="bg-text">
		<h1 class="">Registrace</h1>
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
<form id="regForm" method="POST" action="./process/register" class="form">
    <div class="stepper-wrapper">
      <div class="stepper-item">
        <div class="step-counter"><i class="far fa-user"></i></div>
      </div>
      <div class="stepper-item">
        <div class="step-counter"><i class="fas fa-mobile-alt"></i></div>
      </div>
      <div class="stepper-item">
        <div class="step-counter"><i class="fas fa-key"></i></div>
      </div>
      <div class="stepper-item">
        <div class="step-counter"><i class="fas fa-check"></i></div>
      </div>
    </div>
			 <style>
			  input[type="checkbox"]{
    display: none;
  }
  
  label{
    color: yellow;
    position: relative;
  }
  
  input[type="checkbox"] + label::before{
    content: ' ';
    display: block;
    height: 18px;
    width: 45px;
    border: 1px solid #2c2c2c;
    border-radius: 9px;
    position: absolute;
    top: 0px;
    left: -65px;
	background: #ca0018;
  }
  
  input[type="checkbox"] + label::after{
    content: ' ';
    display: block;
    height: 30px;
    width: 30px;
    border: 1px solid #2c2c2c;   
    border-radius: 50%;
    position: absolute;
    top: -6px;
    left: -75px;
    background: #ca0018;
    transition: all 0.3s ease-in;
  }
  
  input[type="checkbox"]:checked + label::after{
    left: -40px;
	  background: green;	
    transition: all 0.3s ease-in;
  }
input[type="checkbox"]:checked + label::before{
		background: green;	 
}
			 .check{
				 text-align: center;
				 margin-top: 20px;
			 }
			 .checklabel{
				 font-family: Second;
				 position: relative;
				 top: -7px;
				 padding-left: 5px;
			 }
			 .checklink{
				 text-decoration: underline;
				 color: red;
			 }
		</style>
  <!-- One "tab" for each step in the form: -->
      <div class="tab"><h2>Osobní Informace:</h2>
		  <p style="color: white">* povinný údaj</p>
        	<p><input type="text" placeholder="Jméno *" oninput="this.className = ''" name="reg_fname"></p>
        	<p><input type="text"  placeholder="Přijmení *" oninput="this.className = ''" name="reg_lname"></p>
        	<p><input type="text"  placeholder="Přezdívka *" oninput="this.className = ''" name="reg_nname"></p>
      </div>
      <div class="tab"><h2>Kontakntní Informace: </h2>
		  <p style="color: white">* povinný údaj</p>
        <p><label for="reg_email" id="msg-mail" style="display: none">Neplatný formát emailové adresa.</label><input placeholder="E-mail *" id="Mail" type="email" oninput="this.className = ''" name="reg_email" value="<?=$_POST['reg_email']?>"></p>
        <p><label for="reg_phone" id="msg-phone" style="display: none">Špatně zadaný formát tel. čísla. Správný formát je +420111222333</label><input placeholder="Telefoní číslo (Formát: +420111222333) *" type="tel" oninput="this.className = ''" name="reg_phone"></p>
      </div>
      <div class="tab"><h2>Nastavení hesla:</h2>
        <p><label for="reg_pword" id="msg-password" style="display: none">K pokračování je potřeba dosahnout alespoň "Dobré heslo".</label><p id="msg"></p><input placeholder="Heslo *" id="password" name="reg_pword" type="password" oninput="strengthChecker()"><i class="fas fa-eye-slash" id="togglePassword" onclick="SeePass()"></i></p>
          <div id="strength-bar"></div>
        <p><label for="reg_spword" id="msg-password2" style="display: none">Hesla se musí shodovat</label><input placeholder="Znovu heslo *" oninput="this.className = ''" id="secpassword" name="reg_spword" type="password"></p>
      </div>
    <div class="tab"><h2>Souhlasy:</h2>
		<p style="color: white">* povinný údaj</p>
		  <div class="check">
			<div class="toggle">
			  <input type="checkbox" id="tempGDPR" />
			  <label for="tempGDPR" class="checklabel">Souhlas se zpracováním <a href="./gdpr" class="checklink" target="_blank">osobních údajů</a> *</label>
			</div>
		</div>
		<!---<div class="check">
			<div class="toggle">
			  <input type="checkbox" name="news" id="temp3" />
			  <label for="temp3" class="checklabel">Chci zasílat informace o novinkách</label>
			</div>
		</div>
		<div class="check">
			<div class="toggle">
			  <input type="checkbox" name="trenings" id="temp2" />
			  <label for="temp2" class="checklabel">Chci zasílat informace o trénikách</label>
			</div>
		</div>-->
      </div>
      <div style="overflow:auto;">
        <div style="float:right;">
          <button type="button" id="prevBtn" onclick="nextPrev(-1)">Zpět</button>
          <button type="button" id="nextBtn" onclick="nextPrev(1)">Dále</button>
        </div>
      </div>
  <!-- Circles which indicates the steps of the form: -->
</form>
	<?php
}
	?>;
	</div>
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab
 
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
	

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Zaregistrovat se";
  } else {
    document.getElementById("nextBtn").innerHTML = "Dále";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
    document.getElementsByTagName("label")[0].style.display = "none";
    document.getElementsByTagName("label")[1].style.display = "none";
    document.getElementById("msg-password").style.display = "none";
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
    var err = 0;
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()){return false;}
	if(currentTab == 1 && !validateEmail() && n == 1){
		var y;
        document.getElementsByTagName("label")[0].style.display = "block";
  		y = x[currentTab].getElementsByTagName("input");
		y[0].className += " invalid";
        err = err + 1;
	}
	if(currentTab == 1 && !validatePhone() && n == 1){
		var y;
        document.getElementsByTagName("label")[1].style.display = "block";
  		y = x[currentTab].getElementsByTagName("input");
		y[1].className += " invalid";
		err = err + 1;
	}
	if(currentTab == 2 && document.getElementsByClassName("strength").length < 3  && n == 1){
		var y;
        document.getElementById("msg-password").style.display = "block";
  		y = x[currentTab].getElementByTagName("input");
		y[0].className += " invalid";
        err = err + 1;
	}
	if(currentTab == 2 && document.getElementById("password").value != document.getElementById("secpassword").value && n == 1){
		var y;
        document.getElementById("msg-password2").style.display = "block";
  		y = x[currentTab].getElementByTagName("input");
		y[0].className += " invalid";
        err = err + 1;
	}
	if(currentTab == 3 && document.getElementById("tempGDPR").checked == false && n == 1){
		err = err + 1;
	}
    if(err >= 1){
        return false;
    }
    
    complete();
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
	
  // if you have reached the end of the form...
  if (currentTab == x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}
function validateEmail(){
	let x, y, i;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    let re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    //return re.test(String(email).toLowerCase());
  	// A loop that checks every input field in the current tab:
    if (re.test(y[0].value)) {
             return true
        } else {
            return false
    }
    
  }
function validatePhone(){
	let x, y, i;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    let re = /^[+][0-9]{1,3}[0-9]{9}$/;
    //return re.test(String(email).toLowerCase());
  	// A loop that checks every input field in the current tab:
    if (re.test(y[1].value)) {
             return true
        } else {
            return false
    }
    
  }
function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  return valid; // return the valid status
}
function complete(){
    document.getElementsByClassName("stepper-item")[currentTab].className += " completed";
}
function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("stepper-item");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
let parameters = {
    count : false,
    letters : false,
    numbers : false,
    special : false
}
let strengthBar = document.getElementById("strength-bar");
let msg = document.getElementById("msg");
    
function strengthChecker(){
    document.getElementsByClassName("tab")[1].getElementsByTagName("input").className -= " invalid";
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

</script>

    <?php
    include('./pages/footer.php');
    ?>
</body>
</html>