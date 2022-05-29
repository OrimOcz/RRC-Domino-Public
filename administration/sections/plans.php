
<section class="content" id="content">
	<h1>Plánované Akce</h1>
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
							<input type="hidden" name="type" id="type" value="plans" />
			  				<button type="submit" name="delete_submit" class="btn yes inner"><i class="fas fa-check-circle"></i> Ano</button>
			  			</form>
        				<button onclick="noDelete()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
					</div>
					<br>
      			</div>
			</div>
		</div>
		<!-- ADD CATEGORY -->
		<div id="eCategoryBOX" class="modal" style="display: none">
    		<div class="modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Přejete si nastavit kategorie pro plánovanou akci #<span id="ctID"></span></h2>
					</div>
					<br>
					<div class="modal-footer">
					<form action="./process.php" method="post">
						<div class="form">
							<input type="hidden" name="eid" id="ecID" />
							<div class="input-box">
								<p>Kategorie:</p>
								<select name="category[]" multiple>
							  <option value="" disabled selected>Vybrat Kategorie (CTRL a klikat)</option>
								<?php
								$recordsSelect = SelectAllCategory();

								if($recordsSelect == false){

									echo ' <option value="" disabled>Není vytvořená žádná kategorie</option>';
								}else{
									foreach($recordsSelect as $row){

									?>
									<option value="<?=$row['Category_ID']?>"><?=$row['Category_ShortName']?> - <?=$row['Category_Name']?></option>
									<?php
									}
								}

								?>

							</select>
							</div>
						</div>
							<button class="addbutton button" type="submit" name="CategoryEPlanSubmit"><i class="fas fa-check-circle"></i> Upravit</button>
						</form>
						
        				<button onclick="noCatEdit()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
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
					<form action="./process.php" method="post">
						<div class="form">
							<input type="hidden" name="eid" id="eID" />
							<div class="input-box">
								<input type="text" name="name" id="ename" required />
								<label for="name">Název</label>
							</div>
							<div class="input-box">
								<input type="text" name="description" id="edescription" required />
								<label for="description">Poznámka</label>
							</div>
							<div class="input-box">
								<input type="text" name="place" id="eplace" required />
								<label for="place">Místo</label>
							</div>
							<div class="input-box">
								<p>Od:</p>
								<input type="date" name="from" id="efrom" required />
							</div>
							<div class="input-box">
								<p>Do:</p>
								<input type="date" name="to" id="eto" required />
							</div>
						</div>
							<button class="addbutton button" type="submit" name="ePlanSubmit"><i class="fas fa-check-circle"></i> Upravit</button>
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
	<form id="addForm" action="./process.php" method="post">
		<h2>Přidání Akce</h2>
		<div class="form">
			<div class="input-box">
				<input type="text" name="name" required />
				<label for="name">Název</label>
			</div>
			<div class="input-box">
				<input type="text" name="description" required />
				<label for="description">Poznámka</label>
			</div>
			<div class="input-box">
				<input type="text" name="place" required />
				<label for="place">Místo</label>
			</div>
			<div class="input-box">
				<p>Od:</p>
				<input type="date" name="from" required />
			</div>
			<div class="input-box">
				<p>Do:</p>
				<input type="date" name="to" required />
			</div>
			<div class="input-box">
				<p>Pro:</p>
				<select name="category[]" multiple>
				  <option value="" disabled selected>Vybrat Kategorie</option>
					<?php
					$recordsSelect = SelectAllCategory();
			
					if($recordsSelect == false){
						
						echo ' <option value="" disabled>Není vytvořená žádná kategorie</option>';
					}else{
						foreach($recordsSelect as $row){
					
						?>
						<option value="<?=$row['Category_ID']?>"><?=$row['Category_ShortName']?> - <?=$row['Category_Name']?></option>
						<?php
						}
					}
					
					?>

				</select>
			</div>
		</div>
		<div class="submit">
			<button class="addbutton button" type="submit" name="PlanSubmit"><i class="fas fa-paper-plane"></i> Přidat</button>
		</div>
	</form>
	<div class="data">
		<table id="table">
			<tr>
				<th>#</th>
				<th>Název</th>
				<th>Pro</th>
				<th>Od / Do</th>
				<th>Místo</th>
				<th>Poznámka</th>
				<th></th>
			</tr>
			<?php
			$records = SelectAllPlans();
			
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
						<td><?=$row['Plan_ID']?></td>
						<td><?=$row['Plan_Name']?></td>
						<td><?=$ucat?></td>
						<td><?=$row['Plan_From']?> / <?=$row['Plan_To']?></td>
						<td><?=$row['Plan_Place']?></td>
						<td><?=$row['Plan_Descript']?></td>
						<td class="buttons">
							<button class="btn delete" onClick="deleteBox('<?=$row['Plan_ID']?>')"><i class="fas fa-trash-alt"></i></button>
							<button class="btn edit" onClick="editeBox('<?=$row['Plan_ID']?>', '<?=$row['Plan_Name']?>', '<?=$row['Plan_Descript']?>','<?=$row['Plan_Place']?>','<?=$row['Plan_From']?>','<?=$row['Plan_To']?>')"><i class="fas fa-edit"></i></button>
							<button class="btn addc" onClick="editeCategory('<?=$row['Plan_ID']?>')"><i class="fas fa-user-plus"></i></button>
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
	function editeBox(id,name, desc, place, from, to){
		document.getElementById("editesBOX").style.display = "block";
		document.getElementById("eID").value = id;
		document.getElementById("etID").innerHTML = id;
		document.getElementById("ename").value = name;
		document.getElementById("edescription").value = desc;
		document.getElementById("eplace").value = place;
		document.getElementById("efrom").value = from;
		document.getElementById("eto").value = to;
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