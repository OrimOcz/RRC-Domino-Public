<section class="content" id="content">
	<h1>Nábor nových členů</h1>
	<hr class="unerlineh1">
	<div class="data">
		<form id="Form" action="./process.php" method="post" enctype="multipart/form-data">
			<div class="form">
			<div class="input-box">
			<div class="input-box">
				<input type="file" name="File" />
				<label for="">Leták:</label>
			</div>
				<textarea style="height: 300px" name="Hire">
						<?php
							$history = SelectHire();
							
							echo $history["Hire_Text"];
						?>
				</textarea>
			</div>
			<div class="submit">
				<button class="addbutton button" type="submit" name="HireSubmit"><i class="fas fa-paper-plane"></i> Uložit</button>
			</div>
		</form>
	</div>
</section>
<script>
	document.getElementById("addForm").style.display="block";
</script>