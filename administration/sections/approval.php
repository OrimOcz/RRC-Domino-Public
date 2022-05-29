<section class="content" id="content">
	<h1>Úpravy profilů</h1>
	<hr class="unerlineh1">
	<div class="main">
		<input class="search" id="Search" onkeyup="SearchInTable()" placeholder="Vyhledat.." title="Vyhledat..">
	</div>
	<div class="data">
		<table id="table">
			<tr>
				<th>Uživatelské ID</th>
				<th>Jméno</th>
				<th>Přijmení</th>
				<th>Přezdívka</th>
				<th>Narozen/a</th>
				<th>E-mail</th>
				<th>Telefon</th>
				<th>Zaměstnání</th>
				<th>Koníčky</th>
				<th></th>
			</tr>
			<?php
			$records = SelectAllEdit();
			
			if($records == false && !is_array($records)){
				echo '<tr><td>Nebylo nic nalezeno</td></tr>';
			} else{
				foreach($records as $row){
					
					?>
					<tr>
						<td><?=$row['UserE_UserID']?></td>
						<td><?=$row['UserE_FName']?></td>
						<td><?=$row['UserE_LName']?></td>
						<td><?=$row['UserE_NName']?></td>
						<td><?=$row['UserE_Birthday']?></td>
						<td><?=$row['UserE_Email']?></td>
						<td><?=$row['UserE_Phone']?></td>
						<td><?=$row['UserE_Job']?></td>
						<td><?=$row['UserE_Hobby']?></td>
						<td class="buttons">
							<form method="post" action="./process">
								<input name="id" value="<?=$row['Usere_ID']?>" hidden>
								<input name="userid" value="<?=$row['UserE_UserID']?>" hidden="">
								<button class="btn delete" name="delete_edit" type="submit"><i class="fas fa-times"></i></button>
							</form>
							<form method="post" action="./process">
								<input name="id" value="<?=$row['Usere_ID']?>" hidden>
								<input name="userid" value="<?=$row['UserE_UserID']?>" hidden="">
								<button class="btn addbutton" name="accept_edit" type="submit"><i class="fas fa-check"></i></button>
							</form>
						</td>
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