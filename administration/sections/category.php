
<section class="content" id="content">
	<h1>Kategorie</h1>
	<hr class="unerlineh1">
	<div class="panelnews">
		
		<!-- DELETE BOX -->
		<div id="deletesBOX" class="modal" style="display: none">
    		<div class=" modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Opravdu si přejete odebrat taneční kategorii?</h2>
					</div>
					<div class="modal-body">
						<span class="badge badge-pill badge-danger"><a id="nazev"></a></span>
					</div>
					<br>
					<div class="modal-footer">
						<form action="./process.php" method="post"> 
							<input type="hidden" name="id" id="ID" />
							<input type="hidden" name="type" id="type" value="category" />
			  				<button type="submit" name="delete_submit" class="btn yes inner"><i class="fas fa-check-circle"></i> Ano</button>
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
					   	<h2>Úprava kategorie #<span id="tID"></span></h2>
					</div>
					<br>
					<div class="modal-footer">
					<form action="./process.php" method="post">
						<div class="form">
							<input type="hidden" name="eid" id="eID" />
						<div class="input-box">
							<input type="text" name="eNameCategory" id="eNameCategory" required />
							<label for="eNameCategory">Celý název</label>
						</div>
						<div class="input-box">
							<input type="text" name="eShortName" id="eShortName" required />
							<label for="eShortName">Zkratka (Max. 5 znaků)</label>
						</div>
						<div class="input-box">
							<input type="text" name="eDescriptionCategory" id="eDescriptionCategory" required />
							<label for="eescriptionCategory">Popis</label>
						</div>
						</div>
							<button class="addbutton button" type="submit" name="eCategorySubmit"><i class="fas fa-check-circle"></i> Upravit</button>
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
		<button class="addbutton button" onclick="ChangeForm()"><i class="fas fa-plus-circle"></i> Přidat</button>
	</div>
	<form id="addForm" action="./process.php" method="post" enctype="multipart/form-data">
		<h2>Přidání kategorie</h2>
		<div class="form">
			<div class="input-box">
				<input type="text" name="NameCategory" required />
				<label for="NameCategory">Celý název</label>
			</div>
			<div class="input-box">
				<input type="text" name="ShortName" required />
				<label for="ShortName">Zkratka (Max. 5 znaků)</label>
			</div>
			<div class="input-box">
				<input type="text" name="DescriptionCategory" required />
				<label for="DescriptionCategory">Popis</label>
			</div>
		</div>
		<div class="submit">
			<button class="addbutton button" type="submit" name="CategorySubmit">Přidat</button>
		</div>
	</form>
	<div class="data">
		<table id="table">
			<tr>
				<th>#</th>
				<th>Název</th>
				<th>Zkratka</th>
				<th>Popis</th>
				<th></th>
			</tr>
			<?php
			$records = SelectAllCategory();
			
			if($records == false){
				echo '<tr><td>Nebylo nic nalezeno</td><td></td><td></td><td></td><td></td></tr>';
			} else{
				foreach($records as $row){
					
					?>
					<tr>
						<td><?=$row['Category_ID']?></td>
						<td><?=$row['Category_Name']?></td>
						<td><?=$row['Category_ShortName']?></td>
						<td><?=$row['Category_Description']?></td>
						<td class="buttons"><button class="btn delete" onClick="deleteBox('<?=$row['Category_ID']?>')"><i class="fas fa-trash-alt"></i></button><button class="btn edit" onClick="editeBox('<?=$row['Category_ID']?>', '<?=$row['Category_Name']?>', '<?=$row['Category_ShortName']?>','<?=$row['Category_Description']?>')"><i class="fas fa-edit"></i></button></td>
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
		document.getElementById("ID").value = id;
	}
	function noDelete(){
		document.getElementById("deletesBOX").style.display = "none";
	}
	function editeBox(id,name, short, desc){
		document.getElementById("editesBOX").style.display = "block";
		document.getElementById("tID").innerHTML = id;
		document.getElementById("eID").value = id;
		document.getElementById("eNameCategory").value = name;
		document.getElementById("eShortName").value = short;
		document.getElementById("eDescriptionCategory").value = desc;
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