<section class="content" id="content">
	<h1>Informace pro kategorie</h1>
	<hr class="unerlineh1">
	<div class="panelnews">
		
		<!-- DELETE BOX -->
		<div id="deletesBOX" class="modal" style="display: none">
    		<div class=" modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Opravdu si přejete odebrat informaci?</h2>
					</div>
					<div class="modal-body">
						<span class="badge badge-pill badge-danger"><a id="nazev"></a></span>
					</div>
					<br>
					<div class="modal-footer">
						<form action="./process.php" method="post"> 
							<input type="hidden" name="id" id="ID" />
							<input type="hidden" name="type" id="type" value="info" />
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
					   	<h2>Úprava informace #<span id="tID"></span></h2>
					</div>
					<br>
					<div class="modal-footer">
					<form action="./process.php" method="post">
						<div class="form">
							<input type="hidden" name="eid" id="eID" />
							<input type="hidden" name="type" id="type" value="news" />
							<div class="input-box">
								<input type="text" name="eTitle" id="eTitle" required />
								<label for="eTitle">Nadpis</label>
							</div>
							<div class="input-box">
								<textarea style="height: 300px" name="eMsg" id="eMsg"></textarea>
							</div>)
							<div class="input-box">
								<p>Kategorie:</p>
								<select name="category[]" id="ecategories" multiple>
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
							<button class="addbutton button" type="submit" name="InfoESubmit"><i class="fas fa-check-circle"></i> Upravit</button>
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
		<h2>Přidat informaci</h2>
		<div class="form">
			<div class="input-box">
				<input type="text" name="title" required />
				<label for="TitleNews">Nadpis</label>
			</div>
			<div class="input-box">
				<textarea style="height: 300px" name="msg"></textarea>
			</div>
			<!--<div class="input-box">
				<input type="file" name="File" />
				<label for="">Soubor:</label>
			</div>-->
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
			<button class="addbutton button" type="submit" name="InfoSubmit">Přidat</button>
		</div>
	</form>
	<div class="data">
		<table id="table">
			<tr>
				<th>#</th>
				<th>Nadpis</th>
				<th>Zpráva</th>
				<th>Pro</th>
				<th>Publikace</th>
				<th></th>
			</tr>
			<?php
			$records = SelectAllInfo();
			if(empty($records)){
				echo '<tr><td>Nebylo nic nalezeno</td></tr>';
			} else{
				foreach($records as $row){
					
					//CONTROL EXIST PICTURE
	
					$categories = explode(",",$row['Info_Categories']);
					$cat = '';
					
					
					foreach($categories as $id){
						$c = SelectCategory($id);
						$cat = $cat . $c['Category_ShortName']. '<br>';
					}
					?>
					<tr>
						<td><?=$row['Info_ID']?></td>
						<td><?=$row['Info_Title']?></td>
						<td><?=$row['Info_Message']?></td>
						<td><?=$cat?></td>
						<td><?=$row['Info_Date']?></td>
						<?php $msg = trim(preg_replace('/\s+/', ' ', $row['Info_Message'])); ?>
						<td class="buttons"><button class="btn delete" onClick="deleteBox('<?=$row['Info_ID']?>')"><i class="fas fa-trash-alt"></i></button><button class="btn edit" onClick="editeBox('<?=$row['Info_ID']?>', '<?=$row['Info_Title']?>','<?=htmlentities($msg)?>')"><i class="fas fa-edit"></i></button></td>
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

	function editeBox(id,title,msg){
		document.getElementById("editesBOX").style.display = "block";
		document.getElementById("tID").innerHTML = id;
		document.getElementById("eID").value = id;
		document.getElementById("eTitle").value = title;
		tinymce.get("eMsg").setContent(msg);
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