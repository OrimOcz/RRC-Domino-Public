<section class="content" id="content">
	<h1>Alba</h1>
	<hr class="unerlineh1">
	<div class="panelnews">
		
		<!-- DELETE BOX -->
		<div id="deletesBOX" class="modal" style="display: none">
    		<div class=" modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Opravdu si přejete odebrat album #<span id="dtID"></span>?</h2>
					</div>
					<br>
					<div class="modal-footer">
						<form action="./process.php" method="post"> 
							<input type="hidden" name="id" id="dID" />
							<input type="hidden" name="type" id="type" value="album" />
			  				<button type="submit" name="delete_submit" class="btn yes inner"><i class="fas fa-check-circle"></i> Ano</button>
			  			</form>
        				<button onclick="noDelete()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
					</div>
					<br>
      			</div>
			</div>
		</div>
		<div id="loadBOX" class="modal" style="display: none">
    		<div class=" modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Aktualizace fotek #<span id="ltID"></span>?</h2>
					</div>
					<br>
					<div class="modal-footer">
						<form action="./process.php" method="post"> 
							<input type="hidden" name="id" id="lID" />
			  				<button type="submit" name="load_pictures" class="btn yes inner"><i class="fas fa-check-circle"></i> Ano</button>
			  			</form>
        				<button onclick="noDelete()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
					</div>
					<br>
      			</div>
			</div>
		</div>
		<!-- EDIT BOX -->
		<div id="editesBOX" class="modal" style="display: none">
    		<div class="modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Úprava alba #<span id="tID"></span></h2>
					</div>
					<br>
					<div class="modal-footer">
					<form action="./process.php" method="post" enctype="multipart/form-data">
						<div class="form">
							<input type="hidden" name="id" id="eID" />
							<div class="input-box">
								<input type="text" name="name" id="ename" maxlength="100" required />
								<label for="name ">Název *</label>
							</div>
							<div class="input-box">
								<p>Datum *</p>
								<input type="date" name="date" id="edate" required />
							</div>
							<div class="input-box">
								<input type="text" name="link" id="elink" />
								<label for="NameCategory">Odkaz na FB</label>
							</div>
							<div class="input-box">
								<input type="file" name="File" />
								<label for="File">Úvodní fotka</label>
							</div>
						</div>
							<button class="addbutton button" type="submit" name="AlbumESubmit"><i class="fas fa-check-circle"></i> Upravit</button>
						</form>
						
        				<button onclick="noEdit()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
					</div>
					<br>
      			</div>
			</div>
		</div>
	</div>
	<div class="main">
		<input class="search" id="Search" onkeyup="SearchInTable()" placeholder="Vyhledat.." title="Vyhledat..">
		<button class="addbutton button" onclick="ChangeForm()"><i class="fas fa-plus-circle"></i> Přidat </button>
	</div>
	<form id="addForm" action="./process.php" method="post" enctype="multipart/form-data">
		<h2>Přidat Album</h2>
		<div class="form">
			<div class="input-box">
				<input type="text" name="name" maxlength="100" required />
				<label for="name ">Název *</label>
			</div>
			<div class="input-box">
				<p>Datum *</p>
				<input type="date" name="date" required />
			</div>
			<div class="input-box">
				<input type="text" name="link" />
				<label for="NameCategory">Odkaz na FB</label>
			</div>
			<div class="input-box">
				<input type="file" name="File" required />
				<label for="File">Úvodní fotka *</label>
			</div>
		</div>
		<div class="submit">
			<button class="addbutton button" type="submit" name="AlbumSubmit">Přidat</button>
		</div>
	</form>
	<div class="data">
		<table id="table">
			<tr>
				<th>#</th>
				<th>Název</th>
				<th>Datum</th>
				<th>Úvodní fotka</th>
				<th>Odkaz na FB</th>
				<th></th>
			</tr>
			<?php
			$records = SelectAllAlbums();
			
			if($records == false && !is_array($records)){
				echo '<tr><td>Nebylo nic nalezeno</td></tr>';
			} else{
				foreach($records as $row){
					?>
					<tr>
						<td><?=$row['GalleryA_ID']?></td>
						<td><?=$row['GalleryA_Name']?></td>
						<td><?=$row['GalleryA_Date']?></td>
						<td><?=$row['GalleryA_Photo']?></td>
						<td><?=$row['GalleryA_Link']?></td>
						<td class="buttons">
							<button class="btn delete" onClick="deleteBox('<?=$row['GalleryA_ID']?>')"><i class="fas fa-trash-alt"></i></button>
							<button class="btn add" onClick="loadBox('<?=$row['GalleryA_ID']?>')"><i class="fas fa-trash-alt"></i></button>
							<button class="btn edit" onClick="editeBox('<?=$row['GalleryA_ID']?>', 
							'<?=$row['GalleryA_Name']?>','<?=$row['GalleryA_Date']?>','<?=$row['GalleryA_Link']?>')"><i class="fas fa-edit"></i></button></td>
					</tr>
					<?php
				}
			}
			$records
			?>
		</table>
	</div>
</section>
<script>
	document.getElementById("addForm").style.display="none";
	function ChangeForm(){
		var form = document.getElementById("addForm");
		if(form.style.display=='none'){
			form.style.display="block";
		} else {
			form.style.display="none";
		}
	}
	function deleteBox(id){
		document.getElementById("deletesBOX").style.display = "block";
		document.getElementById("dtID").innerHTML = id;
		document.getElementById("dID").value = id;
	}
	function loadBox(id){
		document.getElementById("loadBOX").style.display = "block";
		document.getElementById("ltID").innerHTML = id;
		document.getElementById("lID").value = id;
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