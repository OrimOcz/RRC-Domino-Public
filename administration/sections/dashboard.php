<section class="content" id="dashboard">
	<style>
		.block{
			display: grid;
			width: 80%;
			margin-left: auto;
			margin-right: auto;
			grid-column-gap: 5%;
			grid-template-columns: 20% 20% 20% 20%;
		}
		.block2{
			display: grid;
			width: 80%;
			margin-left: auto;
			margin-right: auto;
			grid-column-gap: 5%;
			grid-template-columns: 33% 33% 33%;
			padding: 10px;
			background-color: #444;
		}
		.card {
		  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		  padding: 16px;
		  text-align: center;
		  background-color: #444;
		  color: white;
		}
		.block2 h3{
			color: white;
		}
		.block2 p{
			color: #ca0018;
			font-size: 2em;
			font-family: Basic;
		}
		#dashboard h3{
			font-size: 3em;
			font-family: Basic;
		}
		.card p{
		font-size: 1.5em;
			padding: 0;
			font-family: Basic;

		}
		.red{
			background: red;
		}
		.green{
			background:#21820A;
		}
		.yellow{
			background:#8E8007;
		}
		.blue{
			background:#1816A7;
		}
	</style>
<div class="block">
  <div>
    <div class="card red">
      <h3><?= count(SelectAllUsers())?></h3>
      <p>Uživatelů</p>
    </div>
  </div>

  <div>
    <div class="card yellow">
      <h3><?=count(SelectAllCategory())?></h3>
      <p>Kategorií</p>
    </div>
  </div>
  
  <div>
    <div class="card green">
      <h3><?=count(SelectAllActions())?></h3>
      <p>Pořádaných závodů</p>
    </div>
  </div>
  
  <div>
    <div class="card blue">
      <h3><?=count(SelectAllStaff())?></h3>
      <p>Trenérů</p>
    </div>
  </div>
</div>
	<br>
	<hr>
	<br>
<div class="block2">
		<div>
			<h3>Omluvenky na dnešek</h3>
			<?php
			$date = date("Y-m-d");
			$info = InfoTreningDate($date);
			if(empty($info)){
				echo '<p>Dnes není trénink</p>';
			} else {
				$users = SelectAttendanceTrening($info['Traning_ID'], 2);
				echo'
				
				<table>
					<tr>
						<th>Uživatel</th>
						<th>Důvod neúčasti</th>
					</tr>
				
				';
				foreach($users as $user){
					echo '
					<tr>
						<td>'. $user['User_FirstName'].' '.$user['User_LastName']. '</td>
						<td>'.$user['Attendance_Reason'] .'</td>
					</tr>
					
					';
				}
				echo '
				</table>
				';
			}
	
			?>
		</div>
	</div>
</section>
