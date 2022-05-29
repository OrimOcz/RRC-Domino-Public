<?php
require_once("pages/header.php");
?> 
<!doctype html>

<html><head>
<meta charset="utf-8">
	<title>RRC Domino</title>
<script src="js/main.js"></script>
	<style>
.slide {
  animation-duration: 10s;
  animation-name: slidein;
}
		@keyframes slidein {
		   0%  { top: -325px; opacity: 0; } /* Original Position */
		   10% { top: -325px; opacity: 1; }/* Starts moving after 16% to this position */
		   20% { top: 0px; opacity: 1; }
		   41% { top: -325px; opacity: 1; z-index: -1; }   /* Return to Original Position */
		   93% { top: -325px; opacity: 1; z-index: -1; }   /* Return to Original Position */
			99%{ top: -325px; opacity: 0; z-index: -1; }
		   100%{ top: -325px; opacity: 0; z-index: -1; }
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
</head>

<body>
		<div class="image-modal">
			<span class="close2">×</span>
			<img class="image2" id="img01" />
		</div>
	<section id="pictures">
		<div class="slide SlideBlock" style='background-image: url("data/photos/dsc_2625.jpg")'>
			<p>ZAŽIJ TU PRAVOU ZÁBAVU</p>
		</div>
		<div class="slide SlideBlock" style='background-image: url("data/photos/dsc_7458.jpg")'>
			<p>RÁDI TĚ UVÍTÁME V NAŠEM KOLEKTIVU</p>
		</div>
		<div class="slide SlideBlock" style='background-image: url("data/photos/dsc_7318.jpg")'>
			<p>JSME SKVĚLÁ PARTA</p>
		</div>
		<div class="slide SlideBlock" style='background-image: url("data/photos/dsc_7285.jpg")'>
			<p>Začít můžeš v každém věku</p>
		</div>
	</section>
	<section id="mainmenu">
		<a href="events">
			<div class="mainlink" style='background-image: url("data/photos/zavody.jpg")'>
				<p>POŘÁDANÉ ZÁVODY</p>
			</div>
		</a>
		<a href="recruitment">
			<div class="mainlink" style='background-image: url("data/photos/nabor-letak.jpg")'>
				<p>NÁBORY</p>
			</div>
		</a>
		<a href="about_us">
			<div class="mainlink" style='background-image: url("data/photos/spolecna.jpg")'>
				<p>O NÁS</p>
			</div>
		</a>
		<a href="members">
			<div class="mainlink" style='background-image: url("data/photos/holky_odpočinek.jpg")'>
				<p>PRO ČLENY</p>
			</div>
		</a>
	</section>
	<section id="news">
        <h1>NOVINKY</h1>
        <hr>
        <div class="news">
			<?php
			
			$news = SelectNews(0,3);
			$totalnews = SelectAllNews();
			
			?>
			
			<?php
			if(is_array($news)){
				foreach($news as $new){
					$ID = $new[0];
					$Title = $new[1];
					$Message = $new[2];
					$Date = date('H:i:s d.m.Y', strtotime($new[5]));
					?>
					<div>
						<div class="post" id="post-<?=$ID?>">
                			<p class="time"><?=$Date?></p>
                			<h3><?=$Title?></h3>
                			<div class="redhr"></div>
                			<div class="text"><?=$Message?></div>
							<?php
							if(isset($new[4])){
								echo '<p><img class="newpicture ModalIMG" src="data/uploads/news/'. $new[4] .'"></p>';
							}
							if(isset($new[3])){
								echo '<p class="center"><a class="fb" href="'. $new[3] .'"><i class="fab fa-facebook"></i> Pokračovat na FB</a></p>';
							}
							?>
            			</div>
					</div>

			<?php
				}
				
			} else{
				echo '<p>Nebyly nalezeny žádné novinky</p>';
			}
			
			?>

        </div>
	</section>
	<section id="trenings">
        <h1>Tréninky</h1>
        <hr>
		<style>
			#trenings{
				/*display: grid;
				padding-right: 5%;
				padding-left: 5%;
				grid-row-gap: 20px;
				grid-template-columns: 45%;*/
				width: 50%;
				margin-right: auto;
				margin-left: auto;
			}
			.box{
				display: grid;
				grid-row-gap: 10px;
				grid-template-columns: 35% 65%;
				background-color: black;
				border-radius: 40px;
				box-shadow: 0 10px rgba(167, 5, 16, 1);
				color:white;
				margin-bottom: 10em;
			}
			.h3title{
            font-size: 3em;
            text-align: center;
            padding-bottom: 0em;
            margin-bottom: 0.2em;
            padding-top: 1em;
			}
			.box p {
				margin: 5px;
				padding: 5px;
			}
			.map{
				border:0;
				border-radius:40px 0px 0px 40px;
				border-right: 10px solid rgb(167, 5, 16);
				width: 100%;
				height: 100%;
			}
			@media screen and (max-width: 950px) {
				#trenings{
					/*display: grid;
					padding-right: 5%;
					padding-left: 5%;
					grid-row-gap: 20px;
					grid-template-columns: 45%;*/
					width: 95%;
					margin-right: auto;
					margin-left: auto;
				}
				.box{
					display: grid;
					grid-row-gap: 20px;
					grid-template-columns: 100%;
					background-color: black;
					border-radius: 40px;
					box-shadow: 0 10px rgba(167, 5, 16, 1);
					color:white;
					margin-bottom: 10em;
				}
				.map{
					border-radius:40px 40px 0px 0px;
					border-right: 0px;
					border-bottom: 10px solid rgb(167, 5, 16);
					width: 100%;
					height: 100%;
				}
			}
		</style>
		<?php
			$places = SelectAllTPlace();
		
			foreach($places as $place){
				?>
				<div class="box">
					<div>
						<iframe src="<?= $place['Traning_LinkMap']?>" allowfullscreen="" loading="lazy" class="map"></iframe>
					</div>
					<div class="information">
						<h3 class="h3title"><?= $place['Traning_Name']?></h3>
						<p class="adress"><?= $place['Traning_Adress']?></p>
						<div class="datetranings">
							<p>Každé pondělí od 18:00 do 19:30.</p>
							<p>Každý čtvrtek od 17:30 do 19:30.</p>
						</div>
					</div>
				</div>
				<?php
			}
		?>
	</section>
	<section id="contacts">
        <h1>KONTAKT</h1>
        <hr>
        <div class="contactblocks">
             <?php echo loadContacts() ?>
        </div>
	</section>
<?php
    include('./pages/footer.php');
    ?>

<script>

    
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("SlideBlock");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    

  slides[slideIndex-1].style.display = "block";  
  setTimeout(showSlides, 10000); // Change image every 2 seconds
}
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