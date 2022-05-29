
<section class="content" id="content">
	<h1>Obrázky</h1>
	<hr class="unerlineh1">
	<div class="main-picture">
					<form method="post">
						<div class="form">
							<div class="input-box">
								<p>Album:</p>
								<select name="album" data-live-search="true" required>
								<?php
								$recordsSelect = SelectAllAlbumsNoLink();

								if($recordsSelect == false){

									echo ' <option value="" selected disabled>Není vytvořené žádné album</option>';
								}else{
									echo ' <option value="" selected disabled>Vyberte Album</option>';
									foreach($recordsSelect as $row){
									if($_POST['album'] == $row['GalleryA_ID']){
										echo '<option value="'. $row['GalleryA_ID'] .'" selected>'. $row['GalleryA_Name'] .',  '. $row['GalleryA_Date'] .'; </option>';
									} else {
										echo '<option value="'. $row['GalleryA_ID'] .'">'. $row['GalleryA_Name'] .',  '. $row['GalleryA_Date'] .'; </option>';
									}
									?>
									<?php
									}
								}

								?>

							</select>
							</div>

						</div>
							<button class="addbutton button" type="submit" name="SubmitAlbum02"><i class="fas fa-search"></i>Vyhledat</button>
						</form>
	</div>
	<div class="data">
		
<?php 

if(isset($_POST['album'])){
	$album = $_POST['album'];
	$select =  SelectPhotosByAlbum($album);
	?>
		<form id="addForm" action="./process.php" method="post" enctype="multipart/form-data">
			<h2>Přidat Obrázky</h2>
			<div class="form">
				<input type="hidden" name="id" value="<?=$_POST['album']?>"/>
				<div class="input-box">
					<input type="file" name="files[]" required multiple/>
					<label for="File">Vybrat Obrázky</label>
				</div>
			</div>
			 <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
			<div class="submit">
				<button class="addbutton button" name="PhotoSubmit">Přidat</button>
			</div>
		</form>
	<?php
	echo'
		<table id="table">
			<tr>
				<th>#</th>
				<th>Název</th>
				<th></th>
			</tr>
	';
	if(empty($select)){
		echo'
			<table id="table">
				<tr>
					<td>Nebyl</td>
					<td>nalezen žádný</td>
					<td>obrázek</td>
				</tr>
		';
	}else{
	foreach($select as $row){
?>
					<tr>
						<td><?=$row['GalleryP_ID']?></td>
						<td><img class="photos" src="../data/uploads/albums/<?=$_POST['album']?>/<?=$row['GalleryP_Photo']?>" alt="<?=$row['GalleryP_Photo']?>"></td>
						<td class="buttons">
							<form method="post" action="./process">
								<input name="id" value="<?=$row['GalleryP_ID']?>" hidden>
								<input name="type" value="photo" hidden>
								<input name="album" value="<?=$_POST['album']?>" hidden>
								<input name="name" value="<?=$row['GalleryP_Photo']?>" hidden>
								<button class="btn delete" name="delete_submit" type="submit"><i  class="fas fa-trash-alt"></i></button></form>
							</td>
					</tr>	
<?php
	}
	}
	
}

?>		
		</table>
	</div>
</section>
<script>

	document.getElementById("addForm").style.display="block";
	
	function deleteBox(id){
		document.getElementById("deletesBOX").style.display = "block";
		document.getElementById("dtID").innerHTML = id;
		document.getElementById("dID").value = id;
	}
	function noDelete(){
		document.getElementById("deletesBOX").style.display = "none";
	}
	function editeBox(id,name,date,link){
		document.getElementById("ename").value = name;
		document.getElementById("edate").value = date;
		document.getElementById("elink").value = link;

		document.getElementById("editesBOX").style.display = "block";
		document.getElementById("tID").innerHTML = id;
		document.getElementById("eID").value = id;
	}
	function noEdit(){
		document.getElementById("editesBOX").style.display = "none";
	}
function SearchInTable() {
    var input, filter, found, table, tr, td, i, j,k;
    input = document.getElementById("Search");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                found = true;
            }
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            if (i>0) { //this skips the headers
            tr[i].style.display = "none";
            }
        }
    }
}

</script>