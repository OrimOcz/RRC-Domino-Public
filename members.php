<?php
require_once("pages/header.php");
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="./css/members.css">
<title><?=$GLOBALS['Server_Name']?> - Pro členy</title>
</head>
<body>
<div class="bg-image" style="background-image: url('data/photos/dsc_7458.jpg');"></div>
	<div class="bg-text">
		<h1 class="">Pro členy</h1>
		<hr>
	</div>
        <p>
          <?php
            if (isset($_SESSION["successmsg"])){
                echo '<div class="successpanel">';
                    echo $_SESSION["successmsg"];
                echo '</div>';
            }
            if (isset($_SESSION["errormsg"])){
                echo '<div class="errorpanel">';
                    echo $_SESSION["errormsg"];
                echo '</div>';
            }
            unset($_SESSION["successmsg"]);
            unset($_SESSION["errormsg"]);?></p>
		<!-- Accept BOX -->
		<div id="acceptBOX" class="membermodal" style="display: none">
    		<div class="modal-content" style="max-width:600px">
      			<div>
					<div class="modal-header">
					   	<h2>Potvrdit účast na tréninku</h2>
						<p>Datum tréninku: <span id="aDate"></span></p>
						<br>
						<div class="modal-footer">
							<form action="./process/members.php" method="post"> 
								<input type="hidden" name="id" id="aID" />
								<input type="hidden" name="type" id="type" value="1" />
								<input type="hidden" name="reason" value="" />
								<div class="reaction">
									<button onclick="noaccept()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
									<button type="submit" name="submit" class="btn yes inner"><i class="fas fa-check-circle"></i> Ano</button>
								</div>
							</form>
							<br>
						</div>
						<br>
					</div>
				</div>
			</div>
		</div>
		<div id="declimeBOX" class="modal" style="display: none">
    		<div class="modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Zamítnout účast na tréninku</h2>
						<p>Datum tréninku: <span id="dDate"></span></p>
					<br>
					<div class="modal-footer">
						<form action="./process/members.php" method="post"> 
							<input type="hidden" name="id" id="dID" />
							<input type="hidden" name="type" id="type" value="2" />
							<div class="input-box2">
								<input type="text" name="reason" maxlength="200" required />
								<label for="reason">Důvod (max. 200 znaků)</label>
							</div>
							<div class="reaction">
								<button onclick="nodeclime()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
								<button type="submit" name="submit" class="btn yes inner"><i class="fas fa-check-circle"></i> Ano</button>
							</div>
			  			</form>
						<br>
					</div>
					<br>
      			</div>
			</div>
		</div>
	</div>
		<div id="backBOX" class="modal" style="display: none">
    		<div class="modal-content" style="max-width:600px">
      			<div >
					<div class="modal-header">
					   	<h2>Vrátit účast na "Nevím"</h2>
						<p>Datum tréninku: <span id="bDate"></span></p>
					<br>
					<div class="modal-footer">
						<form action="./process/members.php" method="post"> 
							<input type="hidden" name="id" id="bID" />
							<input type="hidden" name="type" id="type" value="0" />
								<input type="hidden" name="reason" />
							<div class="reaction">
								<button onclick="noback()" type="button" class="btn no inner"><i class="fas fa-times-circle"></i> Ne</button>
								<button type="submit" name="submit" class="btn yes inner"><i class="fas fa-check-circle"></i> Ano</button>
							</div>
			  			</form>
						<br>
					</div>
					<br>
      			</div>
			</div>
		</div>
	</div>
	<section id="members">
	<?php
		$user;
		if(!empty($_SESSION['ChildID'])){
			$user = $_SESSION['ChildID'];
		} else {
			$user = $_SESSION['UserID'];
		}
	$UserCat = SelectUserCategory($user);
	if(empty($_SESSION['UserID'])){
		echo "<h2 class='loginInfo'> Nejste přihlášen ke svému účtu. <br><a href='./login'>Přihlásit se</a></h2>";
	} else if(($UserCat == false) && (userAdmin($_SESSION['UserID']) == false) && (empty($_SESSION['ChildID']))){
		echo "<h2 class='loginInfo'> Nejste členem oddílu.</h2>";
	} else {
	?>
	<div class="content">
		<div>
		<div class="sidebar">
			<?php

			if($_GET['p'] == 'info' || !isset($_GET['p'])){
				echo '<a href="?p=info" class="active"><i class="fas fa-info"></i>  Informace</a>';
			} else {
				echo '<a href="?p=info"><i class="fas fa-info"></i>  Informace</a>';
			}
			if($_GET['p'] == 'actions'){
				echo '<a href="?p=actions" class="active"><i class="far fa-calendar-alt"></i>  Plánované Akce</a>';
			} else {
				echo '<a href="?p=actions"><i class="far fa-calendar-alt"></i>  Plánované Akce</a>';
			}
			if($_GET['p'] == 'doping'){
				echo '<a href="?p=doping" class="active"><i class="fas fa-prescription-bottle-alt"></i>  Doping</a>';
			} else {
				echo '<a href="?p=doping"><i class="fas fa-prescription-bottle-alt"></i>  Doping</a>';
			}
			if($_GET['p'] == 'tranings'){
				echo '<a href="?p=tranings" class="active"><i class="fas fa-book"></i>  Tréniky</a>';
			} else {
				echo '<a href="?p=tranings"><i class="fas fa-book"></i>  Tréniky</a>';
			}
			?>

		</div>
		</div>
			<div>
				<?php
					if($_GET['p'] == 'actions'){
						$actions = array();
						
						if(userAdmin($_SESSION['UserID']) == true){
							$result = SelectAllPlans();
							foreach($result as $action){
								array_push($actions, $action[0]);
							}
						} else {
							foreach($UserCat as $id){
								$result = SelectPlansByUserCategory($id[0]);
								foreach($result as $action){
									array_push($actions, $action[0]);

								}
							}
						}
						
						$unique = array_unique($actions);
						if($unique[0] != false){
							echo '
						<table>
							<tr class="head">
								<th>Od</th>
								<th>Do</th>
								<th>Název akce</th>
								<th>Místo</th>
								<th>Poznámka</th>
							</tr>
	
							';
							foreach($unique as $action){
								$info = SelectPlanByID($action);
								?>
							<tr>
								<td><?=date("d.m.Y", strtotime($info['Plan_From']))?></td>
								<td><?=date("d.m.Y", strtotime($info['Plan_To']))?></td>
								<td><?=$info['Plan_Name']?></td>
								<td><?=$info['Plan_Place']?></td>
								<td><?=$info['Plan_Descript']?></td>
							</tr>
								<?php
							}
							echo'</table>';
						} else {
							echo "<h2 class='loginInfo'> Nenalezeny žádné akce.</h2>";
						}
					} 
					if($_GET['p'] == 'tranings'){
						$actions = array();
						if(userAdmin($_SESSION['UserID']) == true){
							$result = SelectAllTraningsMembers();
							foreach($result as $action){
								
								array_push($actions, $action['Traning_ID']);
							}
						} else {
							foreach($UserCat as $id){
								$result = SelectTraningCategory($id[0]);
								foreach($result as $action){
									array_push($actions, $action[0]);

								}
							}
						}
						
						$unique = array_unique($actions);
						if($unique[0] != false){
							echo '
						<table>
							<tr class="head">
								<th>Datum (den)</th>
								<th>Místo</th>
								<th>Od</th>
								<th>Do</th>
								<th></th>
							</tr>
	
							';
							foreach($unique as $action){
								$info = InfoTrening($action);
								$Attendance = SelectAttendance($action, $user);
								?>
							<tr <?php 
								$day = date("D", strtotime($info['Traning_Day']));
								switch($Attendance[0]){
									case 1:
										echo 'class="acepted"';
									break;
									case 2:
										echo 'class="declimed"';
									break;
								}
								
								
								?>>
								<td><?=date("d.m.Y", strtotime($info['Traning_Day']))?> (<?=translate_date($day)?>)</td>
								<td><?=$info['Traning_Name']?></td>
								<td><?=date("H:i", strtotime($info['Traning_From']))?></td>
								<td><?=date("H:i", strtotime($info['Traning_To']))?></td>
								<td>
									<?php
									if($Attendance[0] > 0){
										?>
											<button class="btn" style="background: orange;" onClick="back('<?=$action?>','<?=date("d.m.Y", strtotime($info['Traning_Day']))?>')"><i class="fas fa-undo"></i> Vrátit</button>
										<?php
									} else{
										?>
										<button class="btn" onClick="declime('<?=$action?>','<?=date("d.m.Y", strtotime($info['Traning_Day']))?>')"><i class="fas fa-times-circle"></i> Nejdu</button>
										<button class="btn" style="background: green;" onClick="accept('<?=$action?>','<?=date("d.m.Y", strtotime($info['Traning_Day']))?>')"><i class="fas fa-check-circle"></i> Jdu</button>
										<?php	
									}
									?>
								</td>
							</tr>
								<?php
							}
							echo'</table>';
						} else {
							echo "<h2 class='loginInfo'> Nenalezeny žádné tréninky.</h2>";
						}
					} 
					if($_GET['p'] == 'doping'){
							$doping = SelectDoping();
							
							echo $doping["Doping_Text"];
					}
					if($_GET['p'] == 'info' || !isset($_GET['p'])){
						$actions = array();
						
						
						if(userAdmin($_SESSION['UserID']) == true){
							$result = SelectAllInfo();
							foreach($result as $action){
								array_push($actions, $action[0]);
							}
						} else {
							foreach($UserCat as $id){
								$result = SelectInfoCategory($id['Category_ID']);
								foreach($result as $action){
									array_push($actions, $action[0]);

								}
							}
						}

						$unique = array_unique($actions);
						if($unique[0] != false){
							foreach($unique as $action){
								$info = SelectInfo($action);
								?>
						<div class="post" id="post-<?=$info['Info_ID']?>">
                			<p class="time"><?=date("d.m.Y H:i", strtotime($info['Info_Date']))?></p>
                			<h3 class="title"><?=$info['Info_Title']?></h3>
                			<div class="redhr"></div>
                			<div class="text"><?=$info['Info_Message']?></div>
							<?php
							if(isset($new[4])){
								echo '<p><img class="newpicture" src="data/uploads/news/'. $new[4] .'"></p>';
							}
							if(isset($new[3])){
								echo '<p class="center"><a class="fb" href="'. $new[3] .'"><i class="fab fa-facebook"></i> Pokračovat na FB</a></p>';
							}
							?>
            			</div>
							
							<?php
							}
						} else {
							echo "<h2 class='loginInfo'> Nenalezeny žádné informace.</h2>";
						}
					} 
				?>
				
			</div>	
	</div>
	</section>
    <?php
	}
    include('./pages/footer.php');
    ?>
<script>
	function accept(id, date){
		document.getElementById("acceptBOX").style.display = "block";
		document.getElementById("aDate").innerHTML = date;
		document.getElementById("aID").value = id;
	}
	function noaccept(){
		document.getElementById("acceptBOX").style.display = "none";
	}
	function declime(id, date){
		document.getElementById("declimeBOX").style.display = "block";
		document.getElementById("dDate").innerHTML = date;
		document.getElementById("dID").value = id;
	}
	function nodeclime(){
		document.getElementById("declimeBOX").style.display = "none";
	}
	function back(id, date){
		document.getElementById("backBOX").style.display = "block";
		document.getElementById("bDate").innerHTML = date;
		document.getElementById("bID").value = id;
	}
	function noback(){
		document.getElementById("backBOX").style.display = "none";
	}
	</script>
</body>
</html>