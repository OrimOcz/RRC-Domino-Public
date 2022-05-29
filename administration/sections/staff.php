<section class="content" id="content">
	<h1>Trenéři</h1>
	<hr class="unerlineh1">
	<div class="panelnews">
		
		<!-- DELETE BOX -->
		<div id="deletesBOX" class="modal" style="display: none">
    		<div class=" modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Opravdu si přejete odebrat trenéra #<span id="dtID"></span>?</h2>
					</div>
					<br>
					<div class="modal-footer">
						<form action="./process.php" method="post"> 
							<input type="hidden" name="id" id="dID" />
							<input type="hidden" name="type" id="type" value="staff" />
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
					   	<h2>Úprava trenéra #<span id="tID"></span></h2>
					</div>
					<br>
					<div class="modal-footer">
					<form action="./process.php" method="post">
						<div class="form">
							<input type="hidden" name="id" id="eID" />
							<div class="input-box">
								<p>Trenér:</p>
								<select name="coach" id="ecoach" required>
									<option value="" id="class" disabled selected>Vybrat třídu</option>
									<option value="1">1.</option>
									<option value="2">2.</option>
									<option value="3">3.</option>
									<option value="0">Není</option>
								</select>
							</div>
							<div class="inputs-box">
								  <input type="checkbox" id="eadmin" name="eadmin">
								  <label for="eadmin"> Administrátor</label><br>
								  <input type="checkbox" id="eleader" name="eleader">
								  <label for="eleader"> Vedoucí klubu</label><br>
								  <input type="checkbox" id="ejudge" name="ejudge">
								  <label for="judge"> Porotce</label><br>
								  <input type="checkbox" id="eDeputy" name="eDeputy">
								  <label for="eDeputy"> Místopředseda/kině</label><br>
								  <input type="checkbox" id="eVisor" name="eVisor">
								  <label for="eVisor"> Odborný dozor</label><br>
								  <input type="checkbox" id="eAudit" name="eAudit">
								  <label for="eAudit"> Revizní komise</label><br>
							</div>
						</div>
							<button class="addbutton button" type="submit" name="EStaffSubmit"><i class="fas fa-check-circle"></i> Upravit</button>
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
		<h2>Přidat trenéra</h2>
		<div class="form">
			<div class="input-box">
				<p>Uživatel:</p>
				<select name="user">
					<option value="" disabled selected>Vybrat Uživatele</option>
								<?php
								$recordsSelect = SelectAllUsers();

								if($recordsSelect == false){

									echo ' <option value="" disabled>Není vytvořen žádný uživatel</option>';
								}else{
									foreach($recordsSelect as $row){

									?>
									<option value="<?=$row['User_ID']?>"><?=$row['User_ID']?> - <?=$row['User_FirstName']?> <?=$row['User_LastName']?></option>
									<?php
									}
								}

								?>
				</select>
			</div>
			<div class="input-box">
				<p>Trenér:</p>
				<select name="coach" required>
					<option value="" disabled selected>Vybrat třídu</option>
					<option value="1">1.</option>
					<option value="2">2.</option>
					<option value="3">3.</option>
					<option value="0">Není</option>
				</select>
			</div>
			<div class="inputs-box">
				  <input type="checkbox" id="admin" name="admin" value="1">
				  <label for="admin"> Administrátor</label><br>
					<input type="checkbox" id="leader" name="leader" value="1">
					<label for="leader"> Vedoucí klubu</label><br>
				  <input type="checkbox" id="judge" name="judge" value="1">
				  <label for="judge"> Porotce</label><br>
				  <input type="checkbox" id="Deputy" name="Deputy" value="1">
				  <label for="Deputy"> Místopředseda/kině</label><br>
				  <input type="checkbox" id="Visor" name="Visor" value="1">
				  <label for="Visor"> Odborný dozor</label><br>
				  <input type="checkbox" id="Audit" name="Audit" value="1">
				  <label for="Audit"> Revizní komise</label><br>
			</div>
		</div>
		<div class="submit">
			<button class="addbutton button" type="submit" name="StaffSubmit">Přidat</button>
		</div>
	</form>
	<div class="data">
		<table id="table">
			<tr>
				<th>#</th>
				<th>Jméno trenéra</th>
				<th>Admin přístup</th>
				<th>Vedoucí klubu</th>
				<th>Trenén třídy</th>
				<th>Porotce</th>
				<th>Místopředseda</th>
				<th>Odborný dozor</th>
				<th>Revizní komise</th>
				<th></th>
			</tr>
			<?php
			$records = SelectAllStaff();
			
			if($records == false && !is_array($records)){
				echo '<tr><td>Nebylo nic nalezeno</td></tr>';
			} else{
				foreach($records as $row){
					?>
					<tr>
						<td><?=$row['UserB_ID']?></td>
						<td><?=$row['User_FirstName']?> <?=$row['User_LastName']?></td>
						<td><?php if($row['UserB_Administrator'] == 1){echo 'Ano';}else{echo'Ne';} ?></td>
						<td><?php if($row['UserB_Leader'] == 1){echo 'Ano';}else{echo'Ne';} ?></td>
						<td><?php if($row['UserB_TypeCoach'] == 0){echo '/';}else{echo $row['UserB_TypeCoach'];} ?></td>
						<td><?php if($row['UserB_Judge'] == 1){echo 'Ano';}else{echo'Ne';} ?></td>
						<td><?php if($row['UserB_DeputyChairman'] == 1){echo 'Ano';}else{echo'Ne';} ?></td>
						<td><?php if($row['UserB_SuperVisor'] == 1){echo 'Ano';}else{echo'Ne';} ?></td>
						<td><?php if($row['UserB_AuditCommittee'] == 1){echo 'Ano';}else{echo'Ne';} ?></td>
						<?php $msg = trim(preg_replace('/\s+/', ' ', $row['New_Message'])); ?>
						<td class="buttons"><button class="btn delete" onClick="deleteBox('<?=$row['UserB_ID']?>')"><i class="fas fa-trash-alt"></i></button><button class="btn edit" onClick="editeBox('<?=$row['UserB_ID']?>', 
							'<?=$row['UserB_Administrator']?>','<?=$row['UserB_Leader']?>','<?=$row['UserB_TypeCoach']?>','<?=$row['UserB_Judge']?>','<?=$row['UserB_DeputyChairman']?>','<?=$row['UserB_SuperVisor']?>','<?=$row['UserB_AuditCommittee']?>')"><i class="fas fa-edit"></i></button></td>
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
	function noDelete(){
		document.getElementById("deletesBOX").style.display = "none";
	}
	function editeBox(id, admin,l,c,j,d,s,a){
		document.getElementById("eadmin").checked = false;
		document.getElementById("ejudge").checked = false;
		document.getElementById("eDeputy").checked = false;
		document.getElementById("eVisor").checked = false;
		document.getElementById("eAudit").checked = false;
		
		document.getElementById("editesBOX").style.display = "block";
		document.getElementById("tID").innerHTML = id;
		document.getElementById("eID").value = id;
		document.getElementById('ecoach').getElementsByTagName('option')[c].selected = 'selected'
		if(admin == 1){
			document.getElementById("eadmin").checked = true;
		}
		if(l == 1){
			document.getElementById("eleader").checked = true;
		}
		if(j == 1){
			document.getElementById("ejudge").checked = true;
		}
		if(d == 1){
			document.getElementById("eDeputy").checked = true;
		}
		if(s == 1){
			document.getElementById("eVisor").checked = true;
		}
		if(a == 1){
			document.getElementById("eAudit").checked = true;
		}
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