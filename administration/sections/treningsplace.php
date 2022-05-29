<section class="content" id="content">
	<h1>Tréninková místa</h1>
	<hr class="unerlineh1">
	<div class="panelnews">
		
		<!-- DELETE BOX -->
		<div id="deletesBOX" class="modal" style="display: none">
    		<div class=" modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Opravdu si přejete odebrat tréninkové místo #<span id="dtID"></span>?</h2>
					<br>
					<div class="modal-footer">
						<form action="./process.php" method="post"> 
							<input type="hidden" name="id" id="dID" />
							<input type="hidden" name="type" id="type" value="place" />
			  				<button type="submit" name="delete_submit" class="btn yes inner"><i class="fas fa-check-circle"></i> Ano</button>
			  			</form>
        				<button onclick="noDelete()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
					</div>
					<br>
      			</div>
			</div>
		</div>
		</div>

		
		<!-- EDIT BOX -->
		<div id="editesBOX" class="modal" style="display: none">
    		<div class="modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Úprava tréninkového místa #<span id="etID"></span></h2>
					</div>
					<br>
					<div class="modal-footer">
					<form action="./process.php" method="post">
							<div class="form">
								<input type="hidden" name="id" id="eID" />
								<div class="input-box">
									<input type="text" name="name" id="ename" required />
									<label for="name">Název</label>
								</div>
								<div class="input-box">
									<input type="text" name="adress" id="eadress" required />
									<label for="adress">Adresa</label>
								</div>
								<div class="input-box">
									<input type="text" name="link" id="elink" required />
									<label for="link">Odkaz na mapy</label>
								</div>
							</div>
							<button class="addbutton button" type="submit" name="EPlaceSubmit"><i class="fas fa-check-circle"></i> Upravit</button>
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
		<h2>Přidat novinku</h2>
		<div class="form">
			<div class="input-box">
				<input type="text" name="name" required />
				<label for="name">Název</label>
			</div>
			<div class="input-box">
				<input type="text" name="adress" required />
				<label for="adress">Adresa</label>
			</div>
			<div class="input-box">
				<input type="text" name="link" required />
				<label for="link">Odkaz na mapy</label>
			</div>
		</div>
		<div class="submit">
			<button class="addbutton button" type="submit" name="PlaceSubmit">Přidat</button>
		</div>
	</form>
	<div class="data">
		<table id="table">
			<tr>
				<th>#</th>
				<th>Název</th>
				<th>Adresa</th>
				<th>Odkaz na mapu</th>
				<th></th>
			</tr>
			<?php
			$records = SelectAllTPlace();
			
			if($records == false){
				echo '<tr><td>Nebylo nic nalezeno</td></tr>';
			} else{
				foreach($records as $row){
					?>
					<tr>
						<td><?=$row['TraningP_ID']?></td>
						<td><?=$row['Traning_Name']?></td>
						<td><?=$row['Traning_Adress']?></td>
						<td><?=$row['Traning_LinkMap']?></td>
						<td class="buttons">
							<button class="btn delete" onClick="deleteBox('<?=$row['TraningP_ID']?>')"><i class="fas fa-trash-alt"></i></button>
							<button class="btn edit" onClick="editeBox('<?=$row['TraningP_ID']?>','<?=$row['Traning_Name']?>','<?=$row['Traning_Adress']?>','<?=$row['Traning_LinkMap']?>')"><i class="fas fa-edit"></i></button>
						</td>
					</tr>
					<?php
					$ucat = '';
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
	function noDelete(){
		document.getElementById("deletesBOX").style.display = "none";
	}
	
	function editeBox(id, name, adres, link){
		document.getElementById("editesBOX").style.display = "block";
		document.getElementById("etID").innerHTML = id;
		document.getElementById("eID").value = id;
		document.getElementById("ename").value = name;
		document.getElementById("eadress").value = adres;
		document.getElementById("elink").value = link;
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