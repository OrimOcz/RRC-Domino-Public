<?php
require_once("pages/header.php");
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=$GLOBALS['Server_Name']?> - Pořádané Akce</title>
	<style>
		.block{
			font-family: Second;
		}
	
	</style>
</head>
<body>
	<style>
	 .action{
        background-color: black;
        border-radius: 40px;
        box-shadow: 0 10px rgba(167, 5, 16, 1);
        color:white;
		height: auto;
        margin-bottom: 1em;
		 text-align: center;
        margin-top: 1em;
    }
	 .action img{
        background-color: black;
		 border: 10px solid black;
        color:white;
		 width: 60%;
		 margin-right: auto;
		 margin-left: auto;
		height: auto;
        margin-bottom: 1em;
        margin-top: 0.5em;
    }
		.action h3{
			font-size: 30px;
			padding-top: 1em;
			color: #f2f5f7;
		}
		.date{
			color: #ca0018;
			font-family: Second;
		}
		.info-action{
			color: #ca0018;
			padding: 10px;
			padding-top: 0px;
			margin-right: 20px;
			font-family: Second;
			display: block;
			position: relative;
		}
    .post p{
    	padding: 15px;
    }		

		.box h2{
			font-size: 30px;
			background: black;
			width: 80%;
			margin-right: auto;
			margin-left: auto;
		}
		.blur{
			filter: blur(5px) grayscale(1);
			-webkit-filter: blur(5px) grayscale(1);
			-moz-filter: blur(5px) grayscale(1);
			-o-filter: blur(5px) grayscale(1);
			-ms-filter: blur(5px) grayscale(1);
		}

		.actions{
		width: 80%;
			margin-bottom: 2em;
		margin-left: auto;
		margin-right: auto;
		display: grid;
		grid-column-gap: 5%;
		grid-row-gap: 2em;
		grid-template-columns: 33% 33% 33%;
		justify-content: center;  
		}
		@media screen and (max-width: 1300px){
		.actions{
		width: 80%;
		margin-left: auto;
		margin-right: auto;
		display: grid;
		grid-column-gap: 5%;
		grid-row-gap: 2em;
		grid-template-columns: 50% 50%;
		justify-content: center;  
		}			
		}
		@media screen and (max-width: 768px){
		.actions{
		width: 80%;
		margin-left: auto;
		margin-right: auto;
		display: grid;
		grid-column-gap: 5%;
		grid-row-gap: 2em;
		grid-template-columns: 100%;
		justify-content: center;  
		}			
		}
.image-modal {
   display: none;
   position: fixed;
   z-index: 50;
   padding-top: 100px;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
   background-color: rgb(0, 0, 0);
   background-color: rgba(0, 0, 0, 0.9);
}
.image2 {
   margin: auto;
   display: block;
	cursor: pointer;
   width: 70%;
   max-width: 700px;
}	
		.close2 {
   position: absolute;
   top: 15px;
   right: 35px;
   color: #f1f1f1;
   font-size: 40px;
   font-weight: bold;
   transition: 0.3s;
}
.close:hover,
.close:focus {
   color: rgb(255, 0, 0);
   cursor: pointer;
}
@media only screen and (max-width: 500px) {
   .image2 {
      width: 100%;
	    max-width: 500px;
   }
}
	</style>

<div class="bg-image" style="background-image: url('data/photos/zavody.jpg');"></div>
	<div class="bg-text">
		<h1 class="">Pořádané akce</h1>
		<hr>
	</div>
			<div class="image-modal">
			<span class="close2">×</span>
			<img class="image2" id="img01" />
		</div>
	<section class="box">
			<?php
			$actions = SelectAllActions();
			$LastYear = date('Y',strtotime($actions[0]['Competition_Date']));
			$FirstYear = date('Y',strtotime(end($actions)['Competition_Date']));
			for($x = $LastYear; $x >= $FirstYear; $x--){
				
				?>
				<h2><?=$x?></h2>
				<div class="actions">
				<?php
				foreach($actions as $action){
					
					if(date('Y', strtotime($action['Competition_Date'])) == $x){
						?>
							<div class="action">
								<h3><?=$action['Competition_Name'] ?></h3>
								<?php
								if($action['Competition_Cancel'] == 1){
									echo '<p class="date">ZRUŠENO</p>';
								} else{
							
								?>
								<p class="date"><?=date('d.m.Y', strtotime($action['Competition_Date']))?>
								<?php
									if(date("Y") == $x){
										echo '(za ';
										$cout = strtotime($action['Competition_Date']) - strtotime(date("Y-m-d"));
										echo date("d", $cout);
										echo ' dní)';
									}
							
								 ?></p>
								<?php
								}
								?>
								<br>
								<img <?php if($action['Competition_Cancel'] == 1){echo 'class="grayscale blur ModalIMG"';} else {echo 'class="ModalIMG"';}?> src="./data/uploads/competitions/<?=$action['Competition_Poster']?>" alt="Plakát pro <?=$action['Competition_Name'] ?>">
								<p class="info-action">Propozice: 
									<?php
									 	if(isset($action['Competition_Proposition']) && $action['Competition_Cancel'] == 0){
											echo '<a class="text" href="/data/uploads/competitions/'.$action['Competition_Proposition'].'" target="_blank">otevřít</a>';
										} else{
											echo '<span class=""> <i class="fas fa-times"></i> </span>';
										}
									?>
								</p>
								<p class="info-action">Harmonogram:
									<?php
									 	if(isset($action['Competition_Schedule']) && $action['Competition_Cancel'] == 0){
											echo '<a class="text" href="/data/uploads/competitions/'.$action['Competition_Schedule'].'" target="_blank">otevřít</a>';
										} else{
											echo '<span class=""> <i class="fas fa-times"></i> </span>';
										}
									?>
								</p>
								<p class="info-action">Fotky:
									<?php
									 	if(!empty($action['Competition_Photos']) && $action['Competition_Cancel'] == 0){
											echo '<a class="text" href="'.$action['Competition_Photos'].'" target="_blank">otevřít</a>';
										} else{
											echo '<span class=""> <i class="fas fa-times"></i> </span>';
										}
									?>
								</p>
								<p class="info-action">Výsledky:
									<?php
									 	if(isset($action['Competition_Results']) && $action['Competition_Cancel'] == 0){
											echo '<a class="text" href="/data/uploads/competitions/'.$action['Competition_Results'].'" target="_blank">otevřít</a>';
										} else{
											echo '<span class=""> <i class="fas fa-times"></i> </span>';
										}
									?>
								</p>
								<p class="info-action">Vstupenky:
									<?php
									 	if(($action['Competition_Tickets'] != '') && $action['Competition_Cancel'] == 0){
											echo '<a class="text" href="'.$action['Competition_Tickets'].'" target="_blank">otevřít</a>';
										} else{
											echo '<span class=""> <i class="fas fa-times"></i> </span>';
										}
									?>
								</p>
							</div>
					
						<?php
					}
					
				}
				echo '</div>';
				
			};
	
			?>
		</div>

	</section>
	
    <?php
    include('./pages/footer.php');
    ?>
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
<script>
var modalEle = document.querySelector(".image-modal");
var modalImage = document.querySelector(".image2");
Array.from(document.querySelectorAll(".ModalIMG")).forEach(item => {
   item.addEventListener("click", event => {
      modalEle.style.display = "block";
      modalImage.src = event.target.src;
   });
});
document.querySelector(".image2").addEventListener("click", () => {
   modalEle.style.display = "none";
});
document.querySelector(".close2").addEventListener("click", () => {
   modalEle.style.display = "none";
});
</script>
</body>
</html>