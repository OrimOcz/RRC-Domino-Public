<?php
require_once("pages/header.php");
?> 
<html>
<head>
<meta charset="utf-8"> 
<title><?=$GLOBALS['Server_Name']?> - O nás</title>
	<style>
		.blockhisotry{
			font-family: Second;
		}
		.box{
			width: 100%
		}
	</style>
</head>
<body>
	<style>
		.block-users{
			width: 100%
		}
	 .user{
        background-color: black;
        border-radius: 40px;
        box-shadow: 0 10px rgba(167, 5, 16, 1);
        color:white;
		height: auto;
        margin-bottom: 1em;
		 text-align: center;
        margin-top: 1em;
    }
		.block{
			margin-bottom: 10em;
			text-align: center;
		width: 100%;
		margin-left: 0px;
		margin-right: 0px;
		}
		.foot{
			width: 100%;
		}
	 .user img{
        background-color: black;
        border-radius: 50%;
		 border: 10px solid black;
        color:white;
		 width: 60%;
		 margin-right: auto;
		 margin-left: auto;
		height: auto;
        margin-bottom: 1em;
        margin-top: -5em;
    }
		.info-user{
			color: #ca0018;
			padding: 10px;
			padding-top: 0px;
			font-family: Second;
		}
    .post p{
    	padding: 15px;
    }
		.user-text{
			color: #f2f5f7;
		}
		.block-users{
			margin-top: 5em;
					display: grid;
		grid-column-gap: 5%;
			grid-row-gap: 5em;
		grid-template-columns: 20% 20% 20% 20%;
		justify-content: center;  
		}
		@media screen and (max-width: 1300px){
		.block-users{
			margin-top: 5em;
		display: grid;
		grid-column-gap: 5%;
		grid-row-gap: 5em;
		grid-template-columns: 33% 33% 33%;
		justify-content: center;  
		}			
		}
		@media screen and (max-width: 768px){
		.block-users{
		margin-top: 5em;
		display: grid;
		grid-column-gap: 5%;
		grid-row-gap: 5em;
		grid-template-columns: 50% 50%;
		justify-content: center;  
		}			
		}
		@media screen and (max-width: 500px){
		.block-users{
			margin-top: 5em;
		display: grid;
		grid-column-gap: 5%;
		grid-row-gap: 5em;
		grid-template-columns: 100%;
		justify-content: center;  
		}			
		}
	</style>
<div class="bg-image" style="background-image: url('data/photos/dsc_7464.jpg');"></div>
	<div class="bg-text">
		<h1 class="">O nás</h1>
		<hr>
	</div>
	<div class="button-sections">
		<button class="tablink btn" onclick="openPage('History', this)" id="defaultOpen">Historie Oddílu</button>
		<button class="tablink btn" onclick="openPage('Members', this)">Naši členové</button>
		<button class="tablink btn" onclick="openPage('Coachs', this)">Trenéři</button>
	</div>
	<section class="box">
		<div id="History" class="tabcontent">
			<h2>Historie našeho oddílu</h2>
			<div class="blockhisotry blockInTab">
				<?php
							$history = SelectHistory();
							
							echo $history["History_Text"];
				?>
			</div>
			<div class="foot">
				<?php include('./pages/footer.php'); ?>
			</div>
		</div>
		<div id="Members" class="tabcontent">
			<h2>Naši členové</h2>
			<div class="block-users blockInTab">
				<?php
				
				$allUsers = SelectAllUsers();
				
				foreach($allUsers as $user){
					
					$cat = ControlUserMember($user['User_ID']);
					$byear;
					$hobby;
					$photo;
					
					if($user['User_Birthday'] == '0000-00-00'){
						$byear = "...";
					} else {
						$byear = substr($user['User_Birthday'],0,4);
					}
					if(empty($user['User_Hobby'])){
						$hobby = "...";
					} else {
						$hobby = $user['User_Hobby'];
					}
					if(empty($user['User_Photo'])){
						$photo = "unset.jpg";
					} else {
						$photo = $user['User_Photo'];
					}	
					if($cat != false){
						echo '
						<div>
							<div class="user">
								<img src="data/uploads/users/'.$photo.'" alt="'.$user['User_FirstName'].' '.$user['User_LastName'].'">
								<h3>'.$user['User_NickName'].'</h3>
								<p class="info-user">Kategorie: <br>'.substr($cat,2).'</p>
								<br>
								<p class="info-user">Ročník: <span class="user-text">'.$byear.'</span></p>
								<p class="info-user">Koníčky: <span class="user-text">'.$hobby.'</span></p>
							</div>
						</div>
						';
					}
				}
				
					$byear = $hobby = $photo = '';
				?>
			</div>
			<div class="foot">
				<?php include('./pages/footer.php'); ?>
			</div>
		</div>
		<div id="Coachs" class="tabcontent">
			<h2>Trenéři</h2>
			<div class="block-users blockInTab">
				
				<?php
				
				$allUsers2 = SelectAllUsers();
				
				foreach($allUsers2 as $user){
					
					$coach = ControlUserCoach($user['User_ID']);
					$byear;
					$hobby;
					$photo;
					$job;
					
					if($user['User_Birthday'] == '0000-00-00'){
						$byear = "...";
					} else {
						
						$byear = date("d.m Y", strtotime($user['User_Birthday']));
					}
					if(empty($user['User_Hobby'])){
						$hobby = "...";
					} else {
						$hobby = $user['User_Hobby'];
					}
					if(empty($user['User_Photo'])){
						$photo = "unset.jpg";
					} else {
						$photo = $user['User_Photo'];
					}
					if(empty($user['User_Job'])){
						$job = "...";
					} else {
						$job = $user['User_Job'];
					}	
					if($coach != false){
						echo '
						<div>
							<div class="user">
								<img src="data/uploads/users/'.$photo.'" alt="'.$user['User_FirstName'].' '.$user['User_LastName'].'">
								<h3>'.$user['User_FirstName'].' '.$user['User_LastName'].'</h3>
								<p>"'.$user['User_NickName'].'"</p>
								<br>
								<p class="info-user">Datum narození: <span class="user-text">'.$byear.'</span></p>
								<p class="info-user">Povolání: <span class="user-text">'.$job.'</span></p>
								<p class="info-user">Koníčky: <span class="user-text">'.$hobby.'</span></p>
								<p class="info-user">';
								if($coach['UserB_TypeCoach'] > 0){
									switch($coach['UserB_TypeCoach']){
										case 1:
											echo 'Trenér I.třídy <br>';
											break;
										case 2:
											echo 'Trenér II.třídy <br>';
											break;
										case 3:
											echo 'Trenér III.třídy <br>';
											break;
									}
								}
								if($coach['UserB_Judge'] == 1){
									echo 'Porotce ČSAR <br>';
								}
								if($coach['UserB_DeputyChairman'] == 1){
									echo 'Místopředsedkyně ČSAR <br>';
								}
								if($coach['UserB_SuperVisor'] == 1){
									echo 'Odborný dozor ČSAR <br>';
								}
								if($coach['UserB_AuditCommittee'] == 1){
									echo 'Člen revizní komise ČSAR <br>';
								}
						echo '</p>
							</div>
						</div>
						';
					}
				}
				
					$byear = $hobby = $photo = $job = '';
				?>
		</div>
		<?php
    include('./pages/footer.php');
    ?>
	</div>
	</section>
	
	<script>
function openPage(pageName,elmnt) {
  var i, tabcontent, tablinks, color;
	color = "#808080";
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
</body>
</html>