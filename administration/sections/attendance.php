<section class="content" id="content">
	<h1>Docházka</h1>
	<hr class="unerlineh1">
	<div class="main">
		<input class="search" id="Search" onkeyup="SearchInTable()" placeholder="Vyhledat.." title="Vyhledat..">
	</div>
	<div class="data">
		<table id="table">
			<tr>
				<th>Datum tréninku</th>
				<th>Od /Do</th>
				<th>Místo</th>
				<th>Potvrzená účast</th>
			</tr>
			<?php
			$records = SelectAllTranings();
			
			if($records == false  || empty($records)){
				echo '<tr><td>Nebylo nic nalezeno</td></tr>';
			} else{
				foreach($records as $row){
					
					$users =  SelectAttendanceTrening($row['Traning_ID'], 1);
					

					
					?>
					<tr>
						<td><?=$row['Traning_Day']?> (<?=translate_date(date("D", strtotime($user['Traning_Day'])))?>)</td>
						<td><?=$row['Traning_From']?> / <?=$row['Traning_To']?></td>
						<td><?=$row['Traning_Name']?></td>
						<td><?php
							foreach($users as $user)
							{
								echo $user['User_FirstName'] .' '.$user['User_LastName'].'<br>';

							}
							?></td>
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