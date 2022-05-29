<section class="content" id="content">
	<h1>Novinky</h1>
	<hr class="unerlineh1">
	<div class="panelnews">
		
		<!-- DELETE BOX -->
		<div id="deletesBOX" class="modal" style="display: none">
    		<div class=" modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Opravdu si přejete odebrat novinku?</h2>
					</div>
					<div class="modal-body">
						<span class="badge badge-pill badge-danger"><a id="nazev"></a></span>
					</div>
					<br>
					<div class="modal-footer">
						<form action="./process.php" method="post"> 
							<input type="hidden" name="id" id="ID" />
							<input type="hidden" name="type" id="type" value="news" />
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
					   	<h2>Úprava novinky #<span id="tID"></span></h2>
					</div>
					<br>
					<div class="modal-footer">
					<form action="./process.php" method="post" enctype="multipart/form-data">
						<div class="form">
							<input type="hidden" name="eid" id="eID" />
							<input type="hidden" name="type" id="type" value="news" />
							<div class="input-box">
								<input type="text" name="eTitle" id="eTitle" required />
								<label for="eTitle">Nadpis</label>
							</div>
							<div class="input-box">
								<textarea style="height: 300px" name="eMsg" id="eMsg"></textarea>
							</div>
							<div class="input-box">
								<input type="file" name="File" />
								<label for="">Obrázek:</label>
							</div>
						</div>
							<button class="addbutton button" type="submit" name="NewsESubmit"><i class="fas fa-check-circle"></i> Upravit</button>
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
				<input type="text" name="TitleNews" required />
				<label for="TitleNews">Nadpis</label>
			</div>
			<div class="input-box">
				<textarea style="height: 300px" name="MessageNews"></textarea>
			</div>
			<div class="input-box">
				<input type="file" name="File" />
				<label for="">Obrázek:</label>
			</div>
		</div>
		<div class="submit">
			<button class="addbutton button" type="submit" name="NewsSubmit">Přidat</button>
		</div>
	</form>
	<div class="data">
		<table id="table">
			<tr>
				<th>#</th>
				<th>Nadpis</th>
				<th>Zpráva</th>
				<th>Obrázek</th>
				<th>Publikace</th>
				<th></th>
			</tr>
			<?php
			$records = SelectAllNews();
			
			if($records == false && !is_array($records)){
				echo '<tr><td>Nebylo nic nalezeno</td></tr>';
			} else{
				foreach($records as $row){
					
					//CONTROL EXIST PICTURE
	
					if(isset($row['New_Photo'])){
						$photo = "<img class='picture' src='../data/uploads/news/". $row['New_Photo'] ."' alt='Picture for new #". $row['New_ID'] ."'>";
					} else{
						$photo = "<i class='far fa-image picture pictureIcon'></i>";
					}
					?>
					<tr>
						<td><?=$row['New_ID']?></td>
						<td><?=$row['New_Title']?></td>
						<td><?=$row['New_Message']?></td>
						<td><?=$photo?></td>
						<td><?=$row['New_Date']?></td>
						<?php $msg = trim(preg_replace('/\s+/', ' ', $row['New_Message'])); ?>
						<td class="buttons"><button class="btn delete" onClick="deleteBox('<?=$row['New_ID']?>')"><i class="fas fa-trash-alt"></i></button><button class="btn edit" onClick="editeBox('<?=$row['New_ID']?>', '<?=$row['New_Title']?>','<?=htmlentities($msg)?>')"><i class="fas fa-edit"></i></button></td>
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