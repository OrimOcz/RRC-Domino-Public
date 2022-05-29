<?php
require_once("./class/init.php");
require_once("./config/main.php");
?> 

	<link rel="apple-touch-icon" sizes="180x180" href="./data/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="./data/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="./data/favicons/favicon-16x16.png">
	<link rel="manifest" href="./data/favicons/site.webmanifest">
	<link rel="mask-icon" href="./data/favicons/safari-pinned-tab.svg" color="#ca0018">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">

    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale = 1.0" />
    <script src="https://kit.fontawesome.com/f307a5f3a4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="./css/main.css">
	<link rel="stylesheet" type="text/css" href="./css/cookies.css">
	<?php

	if((!isset($_SESSION['cookie'] ) || (empty($_SESSION['cookie'])))){
		echo '
	<div id="CookieModal" class="modal">
	  <!-- Modal content -->
	  <div class="modal-content">
		  <div id="GlobalCookies">
			  <div class="globalCookies">
				  <img src="./data/other/CookieMAN_02.png"/>
				  <div>
					  <h4>Soubory Cookies</h4>
						<p>Tento web využívá soubory technických cookie. Tyto cookies jsou nezbytné kvůli správnému fungování, bezpečnosti, řádnému zobrazování na počítači nebo na mobilu, fungujícímu vyplňování i odesílání formulářů a podobně.. Technické cookies není možné vypnout, bez nich by naše stránky nefungovaly správně..</p>
					  <div class="buttons">
						  	<button name="GlobalAgree" onclick="TurnOfCookie()" class="cookieAcceptAll button">Rozumím</button>
					  </div>
				  </div>
			  </div>
		  </div>
		  <!--<div id="SetCookies" class="setCookies">
				<h4>Vaše nastavení souborů cookies</h4>
			  	<form method="post" action="/">
				  <div>
					  <table>
					  	<tr>
							<td width="60%">
								<h5>Cookies nezbytné pro fungování webu</h5>
								 <p>Tyto cookies jsou nezbytné pro fungování našeho webu a nelze je deaktivovat. Tyto soubory navíc přispívají k bezpečnému a řádnému využívání našich služeb.</p>
							</td>
							<td  width="40%">
								<div class="check" style="justify-content: center;">
									<div class="toggle">
									  <input type="checkbox" id="temp0" name="BasicAgree" checked disabled />
										<label for="temp0" class="checklabel">(Nelze zakázat)</label>
									</div>
								</div>
							</td>
						</tr>
					  	<tr>
							<td width="60%">
								<h5>Analytické cookies</h5>
								 <p>Tyto soubory se používají k měření a analýze návštěvnosti našich webových stránek (množství návštěvníků, zobrazené stránky, průměrná doba prohlížení atd.), což nám pomáhá vylepšovat jejich fungování a vyvíjet pro vás nové služby. Souhlasem nám pomáháte získat cenná data o tom, jak naše stránky užíváte. Díky tomu náš web funguje lépe.</p>
							</td>
							<td width="40%">
								<div class="check" style="justify-content: center;">
									<div class="toggle">
									  <input type="checkbox" name="AnalyticsAgree" id="temp1" value="Analytics" />
										<label for="temp1" class="checklabel"></label>
									</div>
								</div>
							</td>
						</tr> 
					  
					  </table>
					 
				  </div>
				  <div class="buttons">
					  <button class="cookieMore" onClick="CancelsettingCookies()">Zrušit</button>
					<button type="submit" name="DetailsCookies" class="cookieAcceptAll button">Souhlasím</button>
				  </div>
				</form>
		  </div>-->
	  </div>
	</div>	
		';
	}
	?>
    <section id="menu">
    <nav>
        <div class="logo">
            <a href="/" ><img src="./data/logos/rrcdomino.png" alt="Logo RRC Domino"></a>
        </div>
        <div class="hamburger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <ul class="nav-links">
            <li><a href="gallery">GALERIE</a></li>
            <li><a href="events">AKCE</a></li>
            <li><a href="about_us">O nás</a></li>
			<li><a href="index#contacts">Kontakt</a></li>
            <li>
				<?php
				if(isset($_SESSION['UserID'])){
				?>
							<button class="user-button" onclick="window.location.href='/profile'"><?=$_SESSION['FName']?> <?=$_SESSION['LName']?></button>
							<?php
							if(userAdmin($_SESSION['UserID']) == true){?>
								<button class="user-button" onclick="window.location.href='/administration/'">Administrace</button>
							<?php }
							
							?>
							<button class="join-button" onclick="window.location.href='/log_out'">Odhlásit se</button>
				<?php
				} else {
					?>
					<button class="login-button" onclick="window.location.href='/login'">Přihlásit se</button><button class="join-button" onclick="window.location.href='/register'">Registrovat se</button>
				<?php
				}
				?></li>
        </ul>
    </nav>
    </section>
<?php
/*if($_SESSION['Cookies'] = 'no'){
	echo '<script>document.getElementById("myModal").style.display = "none";</script>';
}

if(isset($_POST['GlobalAgree'])){
	echo "
	<script>
		consentGranted();
	</script>
	";
	echo '<script>document.getElementById("myModal").style.display = "none";</script>';
	unset($_POST['GlobalAgree']);
}
*/

/*if(isset($_POST['DetailsCookies'])){
	unset($_POST['DetailsCookies']);
	$_SESSION['Cookies'] = 'on';
	if(isset($_POST['AnalyticsAgree'])){
		echo "
	<script>
		consentGranted();
	</script>
	";
	}
	echo '<script>document.getElementById("myModal").style.display = "none";</script>';
}
*/
?>
<script>
	document.body.classList.add('js-loading');

window.addEventListener("load", showPage, false);

function showPage() {
  document.body.classList.remove('js-loading');
}
	function settingCookies(){
		document.getElementById("GlobalCookies").style.display = "none";
		document.getElementById("SetCookies").style.display = "block";
	}
	function CancelsettingCookies(){
		document.getElementById("SetCookies").style.display = "none";
		document.getElementById("GlobalCookies").style.display = "block";
	}
		function CloseCookies(){
			document.getElementById("CookieModal").style.display = "none";
		}
</script>
<script>
	function TurnOfCookie(){
		document.getElementById("CookieModal").style.display = "none";
		const Http = new XMLHttpRequest();
		const url='./process/cookies.php?c=on';
		Http.open("GET", url);
		Http.send();
	}
</script>
<script src="js/main.js"></script>