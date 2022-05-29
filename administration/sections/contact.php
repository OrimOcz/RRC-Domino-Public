<section class="content" id="content">
	<h1>Kontakty</h1>
	<hr class="unerlineh1">
	<div class="panelnews">
		
		<!-- DELETE BOX -->
		<div id="deletesBOX" class="modal" style="display: none">
    		<div class=" modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Opravdu si přejete odebrat kontakt?</h2>
					</div>
					<br>
					<div class="modal-footer">
						<form action="./process.php" method="post"> 
							<input type="hidden" name="id" id="dID" />
							<input type="hidden" name="type" id="type" value="contact" />
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
					   	<h2>Úprava kontaktu #<span id="tID"></span></h2>
					</div>
					<br>
					<div class="modal-footer">
					<form action="./process.php" method="post">
						<div class="form">
							<input type="hidden" name="id" id="eID" />
							<div class="input-box">
								<p>Typ kontaktu *</p>
								<select name="type" id="etype" required>
									<option value="" disabled>Vybrat typ</option>
									<option value="0">Tel. Číslo</option>
									<option value="1">E-Mail</option>
									<option value="2">Facebook</option>
									<option value="3">Instagram</option>
								</select>
							</div>
						<div class="input-box">
							<input type="text" maxlength="60" name="name" id="ename" required />
							<label for="name">Jméno (Přezdívka na soc. síti / jméno a přijmení) *</label>
						</div>
						<div class="input-box">
							<input type="tel" maxlength="13" name="phone1" id="ephone1" />
							<label for="phone1">Tel. číslo 1.</label>
						</div>
						<div class="input-box">
							<input type="tel" maxlength="13" name="phone2" id="ephone2" />
							<label for="phone2">Tel. číslo 2.</label>
						</div>
						<div class="input-box">
							<input type="email" maxlength="50" name="email" id="eemail" />
							<label for="email">Email</label>
						</div>
						<div class="input-box">
							<input type="text" name="link" maxlength="200" id="elink" />
							<label for="link">Odkaz na soc. síť</label>
						</div>
						</div>
							<button class="addbutton button" type="submit" name="ContactESubmit"><i class="fas fa-check-circle"></i> Upravit</button>
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
		<h2>Přidat kontakt</h2>
		<div class="form">
			<div class="input-box">
				<p>Typ kontaktu *</p>
				<select name="type" required>
					<option value="" disabled selected>Vybrat typ</option>
					<option value="0">Tel. Číslo</option>
					<option value="1">E-Mail</option>
					<option value="2">Facebook</option>
					<option value="3">Instagram</option>
				</select>
			</div>
		<div class="input-box">
			<input type="text" maxlength="60" name="name" required />
			<label for="name">Jméno (Přezdívka na soc. síti / jméno a přijmení) *</label>
		</div>
		<div class="input-box">
			<input type="tel" maxlength="13" name="phone1" />
			<label for="phone1">Tel. číslo 1.</label>
		</div>
		<div class="input-box">
			<input type="tel" maxlength="13" name="phone2" />
			<label for="phone2">Tel. číslo 2.</label>
		</div>
		<div class="input-box">
			<input type="email" maxlength="50" name="email" />
			<label for="email">Email</label>
		</div>
		<div class="input-box">
			<input type="text" name="link" maxlength="200" />
			<label for="link">Odkaz na soc. síť</label>
		</div>
		<div class="submit">
			<button class="addbutton button" type="submit" name="ContactSubmit"> Přidat</button>
		</div>
		</div>
	</form>
	<div class="data">
		<table id="table">
			<tr>
				<th>#</th>
				<th>Typ</th>
				<th>Jméno</th>
				<th>Telefon</th>
				<th>E-Mail</th>
				<th>Odkaz</th>
				<th></th>
			</tr>
			<?php
			$records = loadAllContacts();
			
			if($records == false){
				echo '<tr><td>Nebylo nic nalezeno</td></tr>';
			} else{
				foreach($records as $row){
					
					?>
					<tr>
						<td><?=$row['Contact_ID']?></td>
						<td><?php if($row['Contact_Type'] == '1'){echo 'E-Mail';} if($row['Contact_Type']==0){echo 'Telefon';} if($row['Contact_Type']==2){echo 'Facebook';} if($row['Contact_Type']==3){echo 'Instagram';}	 ?></td>
						<td><?=$row['Contact_Name']?></td>
						<td><?=$row['Contact_Tel1']?> / <?=$row['Contact_Tel2']?></td>
						<td><?=$row['Contact_Email']?></td>
						<td><?=$row['Contact_Link']?></td>
						<td class="buttons">
							<button class="btn delete" onClick="deleteBox('<?=$row['Contact_ID']?>')"><i class="fas fa-trash-alt"></i></button>
							<button class="btn edit" onClick="editeBox('<?=$row['Contact_ID']?>', '<?=$row['Contact_Type']?>','<?=$row['Contact_Name']?>','<?=$row['Contact_Tel1']?>','<?=$row['Contact_Tel2']?>','<?=$row['Contact_Email']?>','<?=$row['Contact_Link']?>')"><i class="fas fa-edit"></i></button></td>
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
		document.getElementById("dID").value = id;
	}
	function noDelete(){
		document.getElementById("deletesBOX").style.display = "none";
	}
	function editeBox(id, type, name, tel1, tel2, email, link){
		document.getElementById("editesBOX").style.display = "block";
		document.getElementById("tID").innerHTML = id;
		document.getElementById("eID").value = id;
		document.getElementById('etype').value=type;
		document.getElementById("ename").value = name;
		document.getElementById("ephone1").value = tel1;
		document.getElementById("ephone2").value = tel2;
		document.getElementById("eemail").value = email;
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