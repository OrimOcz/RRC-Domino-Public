<?php
require_once("pages/header.php");
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=$GLOBALS['Server_Name']?> - Galerie</title>
</head>
<body>
	<style>
		.albums{
			width: 80%;
			margin-bottom: 2em;
			margin-left: auto;
			margin-right: auto;
			display: grid;
			grid-column-gap: 5%;
			grid-row-gap: 2em;
			grid-template-columns: 20% 20% 20% 20%;
			justify-content: center;  
		}
		.album{
			position: relative;
  			text-align: center;
			border-radius: 10px;
		}
		.album:hover{
			transform: scale(1.2);
			  padding: 10px;
			  box-shadow: 5px 10px 18px black;
		}
		.albums a:hover{
			color: white;
			text-decoration: none;
		}
		.albums a, .albums a:link, .albums a:visited {
			text-decoration: none;
		}
		
		.backgallery a, .backgallery a:link, .backgallery a:visited{
			color: white;
			text-decoration: none;
		}
		.backgallery a:hover{
			color: #ca0018;
		}
		.img-text {
			background-color: black;
			border-radius: 0 0 10px 10px;
			box-shadow: 0 10px rgba(167, 5, 16, 1);
			width: 100%;
		  	text-align: center;
		}

	.gallery {
	 	line-height: 0;
	  	-webkit-column-count: 5;
	  	-webkit-column-gap: 0px;
	  	-moz-column-count: 5;
	  	-moz-column-gap: 0px;
	  	column-count: 5;
	 	column-gap: 0px;  
	}
	.gallery img {
		cursor: pointer;
		padding: 8px;
	  	width: 95% !important;
	  	height: auto !important;
	}
	#content{
		display: block;
		margin-top: 2em;
		margin-bottom: 8em;
	}		

	#content h2{
		font-size: 2em;
	}
		h3, p {
			font-size: 1em;
			color: white;
			text-align: center;
		}
.gallery-modal {
   display: none;
   position: fixed;
   z-index: 50;
   padding-top: 100px;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
   overflow: auto;
   background-color: rgb(0, 0, 0);
   background-color: rgba(0, 0, 0, 0.9);
}
.image {
   margin: auto;
   display: block;
	cursor: pointer;
   width: 70%;
   max-width: 700px;
}	
		.close {
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
@media only screen and (max-width: 700px) {
   .image {
      width: 100%;
   }
}
@media (max-width: 1300px) {
  	.gallery {
  		-moz-column-count: 4;
  		-webkit-column-count: 4;
  		column-count: 4;
  	}
	.albums{
		width: 80%;
		grid-template-columns: 33% 33% 33%;
	}
}
@media (max-width: 1000px) {
  	.gallery {
  		-moz-column-count: 3;
  		-webkit-column-count: 3;
  		column-count: 3;
  	}
}
@media (max-width: 800px) {
  	.gallery {
  		-moz-column-count: 2;
  		-webkit-column-count: 2;
  		column-count: 2;
  	}
   .image {
      	width: 100%;
   	}
	.albums{
		width: 90%;
		grid-template-columns: 50% 50%;
	}
	.album:hover{
		transform: scale(1.1);
		padding: 0;
		box-shadow: 5px 10px 18px black;
	}
}
@media (max-width: 400px) {
  .gallery {
  -moz-column-count:    1;
  -webkit-column-count: 1;
  column-count:         1;
  }
}
    .circle {
  width: 400px;
        display: block;
        filter: invert(25%) sepia(80%) saturate(10878%) hue-rotate(360deg) brightness(100%) contrast(100%);
        align-content: center;
  margin-left: auto;
        margin-bottom: 0px;
        margin-right: auto;
  -webkit-animation: rotateY 4s infinite linear;
  animation: rotateY 3s infinite linear;
}
        object{
            fill: red;
        }
@-webkit-keyframes rotateY {
  to { -webkit-transform: rotateY(360deg); }
}
@keyframes rotateY {
  to { transform: rotateY(360deg); }
}

	</style>
<div class="bg-image" style="background-image: url('data/photos/parta2.jpg');"></div>
	<div class="bg-text">
		<h1 class="">Galerie</h1>
		<hr>
	</div>
		<?php
			if (isset($_GET['gallery'])){
			$Album = SelectAlbumID($_GET['gallery']);
				?>
		
				<h2 class="backgallery"><a href="./gallery"><i class="fas fa-angle-left"></i> <?=$Album['GalleryA_Name']?></a></h2>
				<h3><p><?=date("d.m.Y", strtotime($Album['GalleryA_Date']))?></p></h3>
				<?php
			}
	
			?>
		
		<div id="loader">
			<object class="circle" data="./data/other/dancers.svg"> </object>
			<p>Načítání...</p>
		</div>
	<section id="content">
		<?php
		if (isset($_GET['gallery'])){
			$Album = SelectAlbumID($_GET['gallery']);
		
		?>
		<div class="gallery">
			<?php
			$photos = SelectPhotosByAlbum($_GET['gallery']);
			
			if(empty($photos)){
				echo '<meta http-equiv="refresh" content="0;url='.$GLOBALS['Server_URL'].'gallery">';
			}
			foreach($photos as $photo){
				echo	'
				
                    <img class="GalleryIMG" src="/data/uploads/albums/'. $_GET['gallery'] .'/'.$photo['GalleryP_Photo'].'" alt="Obrázek v galerii">
				
				';
			}
				?>
		</div>
		<div class="gallery-modal">
		<span class="close">×</span>
		<img class="image" id="img01" />
		</div>
		<?php
			
		} else {

		?>
		
		<div class="albums">
			<?php
				$Albums = SelectAllAlbums();
				
				foreach($Albums as $album){
					$url = '';
					$icon = '';
					$countphoto = SelectPhotosByAlbum($album['GalleryA_ID']);
					$open = '';
					if(!empty($album['GalleryA_Link'])){
						$url = $album['GalleryA_Link'];
						$icon = '<i class="fab fa-facebook"></i>';
						$open = "target='_blank'";
					} else{
						$url = '?gallery='. $album['GalleryA_ID'];
						
					}
					?>
						<a href="<?=$url?>" <?=$open?>>
							<div class="album">
								<img src="data/uploads/albums/<?=$album['GalleryA_Photo']?>" alt="<?=$album['GalleryA_Name']?>" style="width:100%;">
								<div class="img-text">
									<h2><?=$icon .' '.$album['GalleryA_Name']?> </h2>
									<p><?=date("d.m.Y", strtotime($album['GalleryA_Date']))?></p>
									<?php if(count($countphoto) != 0){ echo '<p>Fotek: '.count($countphoto).'</p>';} ?>
								</div>
							</div>	
						</a>
			
					<?php
				}
	
	
	
			?>

		</div>
		<?php } ?>
	</section>
	
    <?php
    include('./pages/footer.php');
    ?>
   <script>
        document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector("#content").style.visibility = "hidden";
                document.querySelector("#loader").style.visibility = "visible";
            } else {
                document.querySelector("#loader").style.display = "none";
                document.querySelector("#content").style.visibility = "visible";
            }
        };
    </script>
<script>
var modalEle = document.querySelector(".gallery-modal");
var modalImage = document.querySelector(".image");
Array.from(document.querySelectorAll(".GalleryIMG")).forEach(item => {
   item.addEventListener("click", event => {
      modalEle.style.display = "block";
      modalImage.src = event.target.src;
   });
});
document.querySelector(".image").addEventListener("click", () => {
   modalEle.style.display = "none";
});
document.querySelector(".close").addEventListener("click", () => {
   modalEle.style.display = "none";
});
</script>
</body>
</html>