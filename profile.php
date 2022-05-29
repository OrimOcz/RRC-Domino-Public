<?php
require_once("pages/header.php");
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php

if(!isset($_SESSION['UserID'])){
	echo'<meta http-equiv="refresh" content="1;url='.$GLOBALS['Server_URL'].'"> ';
}

?>
<title><?=$GLOBALS['Server_Name']?> - Úprava profilu</title>
<style>
	form{
		margin-bottom: 10em;
	}
	/* Set a style for the submit button */
.btn {
  background-color: green;
	float: right;
  color: #ffffff;
  border: none;
	border-radius: 2em;
  padding: 10px 20px;
  font-size: 17px;
  cursor: pointer;
}
	inputs{
		display: block;
	}
.btn:hover {
  opacity: 1;
}
	.input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}

.icon {
  padding: 10px;
 
  color: red;
  min-width: 50px;
  text-align: center;
}

.input-field {
  width: 100%;
	margin-top: 0;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid dodgerblue;
}

/* Set a style for the submit button */
.btn {
  background-color: dodgerblue;
  color: white;
  padding: 15px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}
</style>
</head>
<body>
<div class="bg-image" style="background-image: url('./data/photos/dsc_2669.jpg');"></div>
	<div class="bg-text">
		<h1 class="">Nastavení profilu</h1>
		<hr>
	</div>
<div class="form">
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
				<?php
		$profileINFO = get_info_user($_SESSION['UserID']);
		$photo;
		if(!empty($profileINFO['User_Photo'])){
			$photo = $profileINFO['User_Photo'];
		} else {
			$photo = "unset.jpg";
		}
		?>
	<div class="profile">
		<div>
			<div class="user-info">
				<img src="./data/uploads/users/<?=$photo?>" alt="Profile photo <?=$profileINFO['User_FirstName']?> <?=$profileINFO['User_LastName']?>" />
				<h2><?=$profileINFO['User_FirstName']?> <?=$profileINFO['User_LastName']?></h2>
				<p><?=$profileINFO['User_NickName']?></p>
			</div>
		</div>
		<div>
			<form method="post" action="./process/edit">
				<div class="form-section">
					<p>* - povinný údaj</p>
				 	<h2>Osobní informace</h2>
					<div class="input-box2">
						<input type="text" name="fname" maxlength="20" value="<?=$profileINFO['User_FirstName']?>" required />
						<label for="fname">Jméno *</label>
					</div>	
					<div class="input-box2">
						<input type="text" name="lname" maxlength="30" value="<?=$profileINFO['User_LastName']?>" required />
						<label for="lname">Přijmení *</label>
					</div>
					<div class="input-box2">
						<input type="text" name="nname" maxlength="10" value="<?=$profileINFO['User_NickName']?>" required />
						<label for="nname">Přezdívka *</label>
					</div>	
					<div class="input-box2">
						<p>Datum narození *</p>
						<input type="date" name="birthday" value="<?=$profileINFO['User_Birthday']?>" required />
					</div>
				</div>
				<div class="form-section">
				 	<h2>Kontaktní informace</h2>
					<div class="input-box2">
						<input type="text" name="mail" maxlength="50" value="<?=$profileINFO['User_Email']?>" required />
						<label for="mail">E-Mail *</label>
					</div>	
					<div class="input-box2">
						<input type="text" name="phone" maxlength="13" value="<?=$profileINFO['User_Phone']?>" required />
						<label for="phone">Tel. číslo *</label>
					</div>
				</div>			
				<div class="form-section">
				 	<h2>Doplňkové informace</h2>
					<div class="input-box2">
						<input type="text" name="job" maxlength="50" value="<?=$profileINFO['User_Job']?>" />
						<label for="job">Zaměstnání</label>
					</div>	
					<div class="input-box2">
						<input type="text" name="hobby" maxlength="50" value="<?=$profileINFO['User_Hobby']?>" />
						<label for="hobby">Koníčky</label>
					</div>
				</div>				
				<div class="form-section">
				 	<h2>Souhlasy</h2>
					  <div class="check">
						<div class="toggle">
						  <input type="checkbox" id="tempGDPR" checked disabled required/>
						  <label for="tempGDPR" class="checklabel">Souhlas se zpracováním <a href="./gdpr" class="checklink" target="_blank">osobních údajů</a> *</label>
						</div>
					</div>
					<!--<div class="check">
						<div class="toggle">
						  <input type="checkbox" name="news" id="temp3" />
						  <label for="temp3" class="checklabel">Chci zasílat informace o novinkách</label>
						</div>
					</div>
					<div class="check">
						<div class="toggle">
						  <input type="checkbox" name="trenings" id="temp2" />
						  <label for="temp2" class="checklabel">Chci zasílat informace o trénikách</label>
						</div>
					</div>-->
				</div>
				<button type="submit" name="send" class="btn">Aktualizovat údaje</button>
			</form>
		
		
		</div>
		
	</div>

</div>

    <?php
    include('./pages/footer.php');
    ?>
</body>
</html>