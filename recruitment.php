<?php
require_once("pages/header.php");
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=$GLOBALS['Server_Name']?> - Nábory</title>
	<style>
		.block{
			font-family: Second;
			display: block;
			margin-bottom: 8em;
		}
	
	</style>
</head>
<body>
<div class="bg-image" style="background-image: url('./data/photos/nabor-letak.jpg');"></div>
	<div class="bg-text">
		<h1 class="">Nábory</h1>
		<hr>
	</div>
<div class="block">
					<?php
							$history = SelectHire();
							
							if(!empty($history["Hire_Photo"])){
							?>
							<img src="data/other/<?=$history["Hire_Photo"]?>" style="width: auto; max-width: 100%" alt="Náborový leták">
							
							<?php
							}
							echo $history["Hire_Text"];
				?>
</div>

    <?php
    include('./pages/footer.php');
    ?>
</body>
</html>