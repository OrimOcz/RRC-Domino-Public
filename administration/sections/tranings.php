<section class="content" id="content">
	<h1>Tréninky</h1>
	<hr class="unerlineh1">
	<div class="panelnews">
		
		<!-- DELETE BOX -->
		<div id="deletesBOX" class="modal" style="display: none">
    		<div class=" modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Opravdu si přejete odebrat trénink? #<span id="dtID"></span>?</h2>
					<br>
					<div class="modal-footer">
						<form action="./process.php" method="post"> 
							<input type="hidden" name="id" id="dID" />
							<input type="hidden" name="type" id="type" value="traning" />
			  				<button type="submit" name="delete_submit" class="btn yes inner"><i class="fas fa-check-circle"></i> Ano</button>
			  			</form>
        				<button onclick="noDelete()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
					</div>
					<br>
      			</div>
			</div>
		</div>
		</div>
	</div>
	<div class="main">
		<input class="search" id="Search" onkeyup="SearchInTable()" placeholder="Vyhledat.." title="Vyhledat..">
		<button class="addbutton button" onclick="ChangeForm()"><i class="fas fa-plus-circle"></i> Přidat</button>
	</div>
	<form id="addForm" action="./process.php" method="post">
		<h2>Přidat tréninky</h2>
		<div class="form">
			<div class="input-box">
				<p>Od (datum)</p>
				<input type="date" name="fromdate" required />
			</div>
			<div class="input-box">
				<p>Do (datum)</p>
				<input type="date" name="todate" required />
			</div>
			<div class="input-box">
				<p>Od (data)</p>
				<input type="time" name="fromtime" required />
			</div>
			<div class="input-box">
				<p>Do (datum)</p>
				<input type="time" name="totime" required />
			</div>
				<div class="input-box">
					<p>Den:</p>
					<select name="day" required>
						<option value="" id="class" disabled selected>Vybrat den</option>
						<option value="Mon">Pondělí</option>
						<option value="Tue">Úterý</option>
						<option value="Wed">Středa</option>
						<option value="Thu">Čtvrtek</option>
						<option value="Fri">Pátek</option>
						<option value="Sat">Sobota</option>
						<option value="Sun">Neděle</option>
					</select>
				</div>
			<div class="input-box">
								<p>Místo:</p>
								<select name="place" required>
							  <option value="" disabled selected>Vybrat místo</option>
								<?php
								$recordsSelect = SelectAllTPlace();

								if($recordsSelect == false){

									echo ' <option value="" disabled>Není vytvořená žádné místo</option>';
								}else{
									foreach($recordsSelect as $row){

									?>
									<option value="<?=$row['TraningP_ID']?>"><?=$row['Traning_Name']?> - <?=$row['Traning_Adress']?></option>
									<?php
									}
								}

								?>

							</select>
							</div>
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
		<div class="submit">
			<button class="addbutton button" type="submit" name="TraningSubmit">Přidat</button>
		</div>
	</form>
	<div class="data">
		<table id="table">
			<tr>
				<th>Datum tréninku</th>
				<th>Od / Do</th>
				<th>Pro</th>
				<th>Místo</th>
				<th></th>
			</tr>
			<?php
			$records = SelectAllTranings();
			
			if($records == false){
				echo '<tr><td>Nebylo nic nalezeno</td></tr>';
			} else{
				foreach($records as $row){
					?>
					<tr>
						<td><?=$row['Traning_Day']?></td>
						<td><?=$row['Traning_From']?> / <?=$row['Traning_To']?></td>
						<td><?php
						$cat = explode(",",$row['Traning_Category']);

							foreach($cat as $data){
								$category = SelectCategory($data);
								echo $category['Category_ShortName']. '<br>';

							}
						
						
						
						?></td>
						<td><?=$row['Traning_Name']?></td>
						<td class="buttons">
							<button class="btn delete" onClick="deleteBox('<?=$row['Traning_ID']?>')"><i class="fas fa-trash-alt"></i></button>
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