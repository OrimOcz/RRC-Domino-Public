
<section class="content" id="content">
	<h1>Pořádané akce</h1>
	<hr class="unerlineh1">
	<div class="panelnews">
		
		<!-- DELETE BOX -->
		<div id="deletesBOX" class="modal" style="display: none">
				<div class=" modal-content" style="max-width:600px">
					<div >
						<div class="modal-header">
							<h2>Opravdu si přejete odebrat plánovanou akci #<span id="dtID"></span></h2>
						</div>
						<div class="modal-body">
							<span class="badge badge-pill badge-danger"><a id="nazev"></a></span>
						</div>
						<br>
						<div class="modal-footer">
							<form action="./process.php" method="post"> 
								<input type="hidden" name="id" id="dID" />
								<input type="hidden" name="type" id="type" value="actions" />
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
					   	<h2>Úprava plánované akce #<span id="etID"></span></h2>
					</div>
					<br>
					<div class="modal-footer">
					<form action="./process.php" method="post" enctype="multipart/form-data">
							<div class="form">
								<input type="hidden" name="id" id="eID" />
								<div class="input-box">
									<input type="text" name="name" id="ename" required />
									<label for="name">Název *</label>
								</div>
								<div class="input-box">
									<p>Datum *</p>
									<input type="date" name="date" id="edate" required />
								</div>
								<div class="input-box">
										<input type="text" name="tickets" id="etickets" />
									<label for="tickets">Vstupenky (odkaz)</label>
								</div>
								<div class="input-box">
										<input type="text" name="photos" id="ephotos" />
									<label for="photos">Fotky (odkaz)</label>
								</div>
							<div class="input-box">
									<input type="file" name="File" />
								<label for="File">Plagát</label>
							</div>
							<div class="inputs-box">
								  <input type="checkbox" id="ecancel" name="cancel">
								  <label for="cancel"> Zrušit Akci</label><br>
							</div>
							</div>
							<button class="addbutton button" type="submit" name="eActionSubmit"><i class="fas fa-check-circle"></i> Upravit</button>
						</form>
						
        				<button onclick="noEdit()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
					</div>
					<br>
      			</div>
			</div>
		</div>
		
		<div id="files" class="modal" style="display: none">
    		<div class=" modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Úprava <span id="ftName"></span> u pořádané akce #<span id="ftID"></span></h2>
					</div>
					<div class="modal-body">
						<span class="badge badge-pill badge-danger"><a id="nazev"></a></span>
					</div>
					<br>
					<div class="modal-footer">
						<form action="./process.php" method="post" enctype="multipart/form-data"> 
							<input type="hidden" name="id" id="fID" />
							<input type="hidden" name="type" id="ftype" />
							<div class="input-box">
									<input type="file" name="File" required />
								<label for="File">Soubor</label>
							</div>
			  				<button type="submit" name="EActionFile" class="btn yes inner"><i class="fas fa-check-circle"></i> Ano</button>
			  			</form>
        				<button onclick="noFile()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
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
		<h2>Přidání Pořádané akce</h2>
		<div class="form">
			<div class="input-box">
				<input type="text" name="name" required />
				<label for="name">Název *</label>
			</div>
			<div class="input-box">
				<p>Datum *</p>
				<input type="date" name="date" required />
			</div>
			<div class="input-box">
					<input type="text" name="tickets" />
				<label for="tickets">Odkaz na vstupenky</label>
			</div>
			<div class="input-box">
					<input type="file" name="File" required />
				<label for="File">Plagát *</label>
			</div>
		</div>
		<div class="submit">
			<button class="addbutton button" type="submit" name="ActionSubmit"><i class="fas fa-paper-plane"></i> Přidat</button>
		</div>
	</form>
	<div class="data">
		<table id="table">
			<tr>
				<th>#</th>
				<th>Název</th>
				<th>Datum</th>
				<th>Plagát</th>
				<th>Propozice</th>
				<th>Harmonogram</th>
				<th>Fotky</th>
				<th>Výsledky</th>
				<th>Vstupenky</th>
				<th>Zrušeno</th>
				<th></th>
			</tr>
			<?php
			$records = SelectAllActions();
			
			if($records == false){
				echo '<tr><td>Nebylo nic nalezeno</td></tr>';
			} else{
				foreach($records as $row){
					$ucat;
					$scategorie = SelectPlanCategory($row['Plan_ID']);
					if($scategorie != false){
						foreach($scategorie as $cat){
							$ucat = $ucat. '<br>'.$cat['Category_ShortName'];
						}
					}
					?>
					<tr>
						<td><?=$row['Competition_ID']?></td>
						<td><?=$row['Competition_Name']?></td>
						<td><?=$row['Competition_Date']?></td>
						<td><?=$row['Competition_Poster']?></td>
						<td><?=$row['Competition_Proposition']?></td>
						<td><?=$row['Competition_Schedule']?></td>
						<td><?=$row['Competition_Photos']?></td>
						<td><?=$row['Competition_Results']?></td>
						<td><?=$row['Competition_Tickets']?></td>
						<td><?php if($row['Competition_Cancel'] == 1){echo 'Ano';}else{echo 'Ne';} ?></td>
						<td class="buttons">
							<button class="btn delete" onClick="deleteBox('<?=$row['Competition_ID']?>')"><i class="fas fa-trash-alt"></i></button>
							<button class="btn edit" onClick="editeBox('<?=$row['Competition_ID']?>','<?=$row['Competition_Name']?>','<?=$row['Competition_Date']?>','<?=$row['Competition_Photos']?>','<?=$row['Competition_Tickets']?>','<?=$row['Competition_Cancel']?>')"><i class="fas fa-edit"></i></button>
							<button class="btn addc" onClick="editPoposition('<?=$row['Competition_ID']?>')"><i class="fas fa-info-circle"></i></button>
							<button class="btn addc" onClick="editSchedule('<?=$row['Competition_ID']?>')"><i class="fas fa-clock"></i></button>
							<button class="btn addc" onClick="editResults('<?=$row['Competition_ID']?>')"><i class="fas fa-trophy"></i></button>
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
	function editPoposition(id){
		document.getElementById("files").style.display = "block";
		document.getElementById("fID").value = id;
		document.getElementById("ftID").innerHTML = id;
		document.getElementById("ftName").innerHTML = "propozice";
		document.getElementById("ftype").value = "p";
	}
	function editSchedule(id){
		document.getElementById("files").style.display = "block";
		document.getElementById("fID").value = id;
		document.getElementById("ftID").innerHTML = id;
		document.getElementById("ftName").innerHTML = "harmonogramu";
		document.getElementById("ftype").value = "s";
	}
	function editResults(id){
		document.getElementById("files").style.display = "block";
		document.getElementById("fID").value = id;
		document.getElementById("ftID").innerHTML = id;
		document.getElementById("ftName").innerHTML = "výsledků";
		document.getElementById("ftype").value = "r";
	}
	function noFile(){
		document.getElementById("files").style.display = "none";
	}
	function deleteBox(id){
		document.getElementById("deletesBOX").style.display = "block";
		document.getElementById("dtID").innerHTML = id;
		document.getElementById("dID").value = id;
	}
	function noDelete(){
		document.getElementById("deletesBOX").style.display = "none";
	}
	function editeBox(id,name, date, photos, tickets, cancel){
		document.getElementById("editesBOX").style.display = "block";
		document.getElementById("eID").value = id;
		document.getElementById("etID").innerHTML = id;
		document.getElementById("ename").value = name;
		document.getElementById("edate").value = date;
		document.getElementById("ephotos").value = photos;
		document.getElementById("etickets").value = tickets;
		if(cancel == 1){
			document.getElementById("ecancel").checked = true;
		}
	}
	function noEdit(){
		document.getElementById("editesBOX").style.display = "none";
	}
	function editeCategory(id){
		document.getElementById("eCategoryBOX").style.display = "block";
		document.getElementById("ctID").innerHTML = id;
		document.getElementById("ecID").value = id;
	}
	function noCatEdit(){
		document.getElementById("eCategoryBOX").style.display = "none";
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