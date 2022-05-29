<section class="content" id="content">
	<h1>Doping</h1>
	<hr class="unerlineh1">
	<div class="data">
		<form id="Form" action="./process.php" method="post">
			<div class="form">
			<div class="input-box">
				<textarea style="height: 300px" name="Doping">
						<?php
							$history = SelectDoping();
							
							echo $history["Doping_Text"];
						?>
				</textarea>
			</div>
			<div class="submit">
				<button class="addbutton button" type="submit" name="DopingSubmit"><i class="fas fa-paper-plane"></i> Uložit</button>
			</div>
		</form>
	</div>
</section>
<script>
	document.getElementById("addForm").style.display="block";
</script>