<section class="content" id="content">
	<h1>Uživatelé</h1>
	<hr class="unerlineh1">
	<div class="panelnews">
		
		<!-- DELETE BOX -->
		<div id="deletesBOX" class="modal" style="display: none">
    		<div class="modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Opravdu si přejete odebrat uživatele #<span id="dID"></span>?</h2>
					<br>
					<div class="modal-footer">
						<form action="./process.php" method="post"> 
							<input type="hidden" name="id" id="ID" />
							<input type="hidden" name="type" id="type" value="user" />
			  				<button type="submit" name="delete_submit" class="btn yes inner"><i class="fas fa-check-circle"></i> Ano</button>
			  			</form>
        				<button onclick="noDelete()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
					</div>
					<br>
      			</div>
			</div>
		</div>
	</div>
			
		<!-- DELETE BOX -->
		<div id="verifyBOX" class="modal" style="display: none">
    		<div class=" modal-content" style="max-width:600px">
      			<div>
					<div class="modal-header">
					   	<h2>Opravdu si znovu odeslat ověřovací email uživateli #<span id="vtID"></span>?</h2>
						<br>
						<div class="modal-footer">
							<form action="./process.php" method="post"> 
								<input type="hidden" name="id" id="vID" />
			  					<button type="submit" name="verify_submit" class="btn yes inner"><i class="fas fa-check-circle"></i> Ano</button>
			  				</form>
        					<button onclick="noVerify()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
						</div>
						<br>
      				</div>
				</div>
			</div>
		</div>
		<!-- ADD CATEGORY -->
		<div id="eCategoryBOX" class="modal" style="display: none">
    		<div class="modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Přejete si nastavit kategorie pro uživatele #<span id="ctID"></span></h2>
					</div>
					<br>
					<div class="modal-footer">
					<form action="./process.php" method="post">
						<div class="form">
							<input type="hidden" name="eid" id="eID" />
							<input type="hidden" name="type" id="type" value="news" />
							<div class="input-box">
								<p>Kategorie:</p>
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
							<button class="addbutton button" type="submit" name="CategoryESubmit"><i class="fas fa-check-circle"></i> Upravit</button>
						</form>
						
        				<button onclick="noCategory()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
					</div>
					<br>
      			</div>
			</div>
		</div>		
		<!-- Child BOX -->
		<div id="parentBOX" class="modal" style="display: none">
    		<div class="modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Nastavit uživateli dítě #<span id="ptID"></span></h2>
					</div>
					<br>
					<div class="modal-footer">
					<form action="./process.php" method="post">
						<div class="form">
							<input type="hidden" name="eid" id="pID" />
							<div class="input-box">
								<p>Dítě:</p>
								<select name="child">
							  <option value="" disabled selected>Vybrat Dítě</option>
								<?php
								$recordsSelect = SelectAllUsers();

								if($recordsSelect == false){

									echo ' <option value="" disabled>Nenalezen žádný uživatel</option>';
								}else{
									foreach($recordsSelect as $row){

									?>
									<option value="<?=$row['User_ID']?>">#<?=$row['User_ID']?> <?=$row['User_FirstName']?> <?=$row['User_LastName']?></option>
									<?php
									}
								}

								?>

							</select>
							</div>
						</div>
							<button class="addbutton button" type="submit" name="UserChildESubmit"><i class="fas fa-check-circle"></i> Upravit</button>
						</form>
						
        				<button onclick="noParent()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
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
					   	<h2>Úprava Uživatele #<span id="tID"></span></h2>
					</div>
					<br>
					<div class="modal-footer">
					<form action="./process.php" method="post" enctype="multipart/form-data">
						<div class="form">
							<input type="hidden" name="eid" id="epID" />
						<div class="input-box">
							<input type="file" name="File" required />
							<label for="File">Obrázek:</label>
						</div>
						</div>
							<button class="addbutton button" type="submit" name="UsersEPhoto"><i class="fas fa-check-circle"></i> Upravit</button>
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
	</div>
	<div class="data">
		<table id="table">
			<tr>
				<th>#</th>
				<th>Jméno</th>
				<th>Přezdívka</th>
				<th>Email</th>
				<th>Telefon</th>
				<th>Narození</th>
				<th>Kategorie</th>
				<th>Ověření</th>
				<th>Profilovka</th>
				<th></th>
			</tr>
			<?php
			$records = SelectAllUsers();
			
			if($records == false){
				echo '<tr><td>Nebylo nic nalezeno</td></tr>';
			} else{
				foreach($records as $row){
					
					//CONTROL EXIST PICTURE
	
					if(isset($row['User_Photo'])){
						$photo = "<img class='picture' src='../data/uploads/users/". $row['User_Photo'] ."' alt='Picture for user #". $row['New_ID'] ."'>";
					} else{
						$photo = "<i class='far fa-image picture pictureIcon'></i>";
					}
					
					// VERIFY USER
					if(isset($row['User_Verify'])){
						$v = 1;
						$verify = $row['User_Verify'];
					} else{
						$v = 0;
						$verify = 'Neověřen';
					}
					$ucat;
					$scategorie = SelectUserCategory($row['User_ID']);
					if($scategorie != false){
						foreach($scategorie as $cat){
							$ucat = $ucat. '<br>'.$cat['Category_ShortName'];
						}
					}
					?>
					<tr>
						<td><?=$row['User_ID']?></td>
						<td><?=$row['User_FirstName']?> <?=$row['User_LastName']?></td>
						<td><?=$row['User_NickName']?></td>
						<td><?=$row['User_Email']?></td>
						<td><?=$row['User_Phone']?></td>
						<td><?=$row['User_Birthday']?></td>
						<td><?=$ucat?></td>
						<td><?=$verify?></td>
						<td><?=$photo?></td>
						<td class="buttons">
							<button class="btn delete" onClick="deleteBox('<?=$row['User_ID']?>')"><i class="fas fa-trash-alt"></i></button>
							<button class="btn edit" onClick="editeBox('<?=$row['User_ID']?>')"><i class="far fa-image"></i></button>
							<button class="btn addc" onClick="categoryBox('<?=$row['User_ID']?>')"><i class="fas fa-user-plus"></i></button>
							<button class="btn addc" onClick="parentBox('<?=$row['User_ID']?>')"><i class="fas fa-baby"></i></button>
							<?php 
								//RESEND Verify Email
								if($v == 0){
								?>
								<button class="btn resend" onClick="verifyBox('<?=$row['User_ID']?>')"><i class="fas fa-redo-alt"></i></button>		
							<?php
								}
									
							?>
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
		document.getElementById("dID").innerHTML = id;
		document.getElementById("ID").value = id;
	}
	function noDelete(){
		document.getElementById("deletesBOX").style.display = "none";
	}
	function parentBox(id){
		document.getElementById("parentBOX").style.display = "block";
		document.getElementById("ptID").innerHTML = id;
		document.getElementById("pID").value = id;
	}
	function noParent(){
		document.getElementById("parentBOX").style.display = "none";
	}
	function categoryBox(id){
		document.getElementById("eCategoryBOX").style.display = "block";
		document.getElementById("ctID").innerHTML = id;
		document.getElementById("eID").value = id;
	}
	function verifyBox(id){
		document.getElementById("verifyBOX").style.display = "block";
		document.getElementById("vtID").innerHTML = id;
		document.getElementById("vID").value = id;
	}
	function noVerify(){
		document.getElementById("verifyBOX").style.display = "none";
	}
	function noCategory(){
		document.getElementById("eCategoryBOX").style.display = "none";
	}
	
	
	function editeBox(id){
		document.getElementById("editesBOX").style.display = "block";
		document.getElementById("tID").innerHTML = id;
		document.getElementById("epID").value = id;
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