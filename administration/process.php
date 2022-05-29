<?php
require_once("../class/init.php");
require_once("../config/main.php");
include("../pages/loader.html");
//RETURN PAGE
	function replace($page){
		echo '<meta http-equiv="refresh" content="1;url='.$GLOBALS['Server_URL'].'administration/?s='. $page .'">';
	}

if(isset($_POST['load_pictures'])){
	  $mydir = '../data/uploads/albums/'. $_POST['id']; 

	  $myfiles = array_diff(scandir($mydir), array('.', '..')); 

	foreach($myfiles as $file){
		CreatePhoto($_POST['id'],$file);
	}
	replace("albums");
}

//GALLERY
if(isset($_POST['AlbumSubmit'])){
	

	if(!empty(basename($_FILES["File"]["name"]))){
			$File_Name = basename($_FILES["File"]["name"]);
			$File_Check = getimagesize($_FILES["File"]["tmp_name"]);
			$File_Size = $_FILES["File"]["size"];
			$File_Temp = $_FILES["File"]["tmp_name"];
			$target_dir = "../data/uploads/albums/";
		$returnPicture = ControlPicture($File_Name, $File_Check, $target_dir, $File_Size, $File_Temp);
	} else {
		$returnPicture = true;
	}

	if($returnPicture == true AND !is_array($returnPicture)){
		$returnCreateNew = CreateAlbum($_POST['name'], $_POST['date'], $File_Name, $_POST['link']);
		if($returnCreateNew == true){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste přidal/a album.";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (100)";
		}
	} else {
		foreach ($returnPicture as $error){
			$_SESSION["errormsg"] = $_SESSION["errormsg"].'<br>'.$error;
		}
	}
	
	replace("albums");
	
}
if(isset($_POST['AlbumESubmit'])){
	$File_Name;

	if(!empty(basename($_FILES["File"]["name"]))){
			$File_Name = basename($_FILES["File"]["name"]);
			$File_Check = getimagesize($_FILES["File"]["tmp_name"]);
			$File_Size = $_FILES["File"]["size"];
			$File_Temp = $_FILES["File"]["tmp_name"];
			$target_dir = "../data/uploads/albums/";
		$returnPicture = ControlPicture($File_Name, $File_Check, $target_dir, $File_Size, $File_Temp);
	} else {
		$returnPicture = true;
	}

	if($returnPicture == true AND !is_array($returnPicture)){
		if(isset($File_Name)){
			$select = SelectAlbumID($_POST['id']);
			unlink("../data/uploads/albums/".$select["GalleryA_Photo"]);
		} else{
			$select = SelectAlbumID($_POST['id']);
			$File_Name = $select["GalleryA_Photo"];
		}
		$returnCreateNew = EditAlbum($_POST['id'], $_POST['name'], $_POST['date'], $File_Name, $_POST['link']);
		if($returnCreateNew == true){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a album.";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (100)";
		}
	} else {
		foreach ($returnPicture as $error){
			$_SESSION["errormsg"] = $_SESSION["errormsg"].'<br>'.$error;
		}
	}
	
	replace("albums");
	
}
if(isset($_POST['PhotoSubmit'])){
	$File_Name;
	
	$album = $_POST['id'];
	$files = $_FILES['files'];
	$file_count = count($files['name']);
	$path = '../data/uploads/albums/'.$_POST['id'];
	$target_dir = '../data/uploads/albums/'.$_POST['id'].'/';
	$errors = [];
	if (!file_exists($path)) {
		mkdir($path , 0777, true);
	}
	
	for ($i = 0; $i < $file_count; $i++) {
		$status = $files['error'][$i];
		$File_Name = basename($files['name'][$i]);
		$File_Check = getimagesize($files['tmp_name'][$i]);
		$File_Temp = $files['tmp_name'][$i];
		$File_Size = $files['size'][$i];
		
		$returnPicture = ControlPicture($File_Name, $File_Check, $target_dir, $File_Size,$File_Temp);

		if($returnPicture == true AND !is_array($returnPicture)){
			$returnCreatePhoto = CreatePhoto($album,$File_Name);
			if($returnCreatePhoto == true){
				$_SESSION["successmsg"] = $_SESSION["successmsg"].'<br> <i class="fas fa-check"></i> Úspěšně jste přidal/a obrázek '.'('.$File_Name.')';
			}
		} else {
			foreach ($returnPicture as $error){
				$_SESSION["errormsg"] = $_SESSION["errormsg"].'<br>'.$error .'('.$File_Name.')';
			}
	 	}

	}

	
	replace("photos");
	
}
//--- NEWS ---
if(isset($_POST['NewsSubmit'])){
	$title = $_POST['TitleNews'];
	$msg = $_POST['MessageNews'];
	$fblink = '';
	

	if(!empty(basename($_FILES["File"]["name"]))){
			$File_Name = basename($_FILES["File"]["name"]);
			$File_Check = getimagesize($_FILES["File"]["tmp_name"]);
			$File_Size = $_FILES["File"]["size"];
			$target_dir = "../data/uploads/news/";
			$File_Temp = $_FILES["File"]["tmp_name"];
		$returnPicture = ControlPicture($File_Name, $File_Check, $target_dir, $File_Size, $File_Temp);
	} else {
		$returnPicture = true;
	}

	if($returnPicture == true AND !is_array($returnPicture)){
		$returnCreateNew = CreateNew($title, $msg, $fblink, $File_Name);
		if($returnCreateNew == true){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste přidal/a novinku.";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (100)";
		}
	} else {
		foreach ($returnPicture as $error){
			$_SESSION["errormsg"] = $_SESSION["errormsg"].'<br>'.$error;
		}
	}
	
	replace("news");
	
}
if(isset($_POST['InfoSubmit'])){
	$title = $_POST['title'];
	$msg = $_POST['msg'];
	$cat;
	///-----------------------------

	if(!empty(basename($_FILES["File"]["name"]))){
			$File_Name = basename($_FILES["File"]["name"]);
			$File_Check = getimagesize($_FILES["File"]["tmp_name"]);
			$File_Size = $_FILES["File"]["size"];
			$File_Temp = $_FILES["File"]["tmp_name"];
			$target_dir = "../data/uploads/informations/";
		$returnFile = ControlFile($File_Name, $File_Check, $target_dir, $File_Size, $File_Temp);
	} else {
		$returnFile = true;
	}

	if($returnFile == true AND !is_array($returnFile)){
		foreach($_POST['category'] as $category){
			$cat= $cat.','.$category;
		}
		$returnCreateInfo = CreateInfo($title, $msg, $File_Name, substr($cat,1));
		if($returnCreateInfo == true){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste přidal/a informaci kategoriím.";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (100)";
		}
	} else {
		foreach ($returnFile as $error){
			$_SESSION["errormsg"] = $_SESSION["errormsg"].'<br>'.$error;
		}
	}
	
	replace("catnews");
	
}
if(isset($_POST['InfoESubmit'])){
	$cat;
		foreach($_POST['category'] as $category){
			$cat= $cat.','.$category;
		}
	$edit = EditInfo($_POST['eid'],$_POST['eTitle'],$_POST['eMsg'],substr($cat,1));
	if($edit){
		$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a informaci.";
	} else {
		$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (101)";
	}
	replace("catnews");
			
}
if(isset($_POST['NewsESubmit'])){
	$File_Name;

	if(!empty(basename($_FILES["File"]["name"]))){
			$File_Name = basename($_FILES["File"]["name"]);
			$File_Check = getimagesize($_FILES["File"]["tmp_name"]);
			$File_Size = $_FILES["File"]["size"];
			$File_Temp = $_FILES["File"]["tmp_name"];
			$target_dir = "../data/uploads/news/";
		$returnPicture = ControlPicture($File_Name, $File_Check, $target_dir, $File_Size, $File_Temp);
	} else {
		$returnPicture = true;
	}

	if($returnPicture == true AND !is_array($returnPicture)){
		
		if(isset($File_Name)){
			$select = SelectNew($_POST['eid']);
			unlink("../data/uploads/news/".$select["New_Photo"]);
		} else{
			$select = SelectNew($_POST['eid']);
			$File_Name = $select["New_Photo"];
		}
		
		$edit = EditNew($_POST['eid'],$_POST['eTitle'],$_POST['eMsg'], $File_Name);
		if($edit){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a novinku.";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (101)";
		}
	} else {
		foreach ($returnFile as $error){
			$_SESSION["errormsg"] = $_SESSION["errormsg"].'<br>'.$error;
		}
	}
	replace("news");
			
}

//CREATE CATEGORY
if(isset($_POST['CategorySubmit'])){
	 $edit = CreateCategory($_POST['NameCategory'],$_POST['ShortName'],$_POST['DescriptionCategory']);
	
	if($edit){
		$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste přidal/a kategorii";
	} else {
		$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (101)";
	}
	replace("category");
			
}
//Edit CHILD
if(isset($_POST['UserChildESubmit'])){
	 $edit = EditUserChild($_POST['eid'],$_POST['child']);
	
	if($edit){
		$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a dítě uživatelovi";
	} else {
		$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (101)";
	}
	replace("users");
			
}

//EDIT USER PROFILE
if(isset($_POST['delete_edit'])){
	 $delete = DeleteEdit($_POST['id']);
	
	if($delete){
		$user = get_info_user($_POST['userid']);
		SendEmail(5, $user['User_Email'], $user['User_FirstName'].' '.$user['User_LastName'], 0,0 ,0);
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste zamítl/a úpravu profilu.";
	} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Podařilo se nám zamítnout tuto žádost, ale bohžel jsme neodeslali email. Kontaktujte proto prosím vlastníka účtu. (101)";
	}
	replace("approval");
			
}
if(isset($_POST['accept_edit'])){
	 $select = SelectEdit($_POST['id']);
	$update = UpdateUser($_POST['userid'], $select['UserE_FName'], $select['UserE_LName'], $select['UserE_NName'], $select['UserE_Birthday'], $select['UserE_Email'], $select['UserE_Phone'], $select['UserE_Job'], $select['UserE_Hobby']);
	
	if($update){
		DeleteEdit($_POST['id']);
		$user = get_info_user($_POST['userid']);
		SendEmail(6, $user['User_Email'], $user['User_FirstName'].' '.$user['User_LastName'], 0, 0 ,0);
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste schválil/a úpravu profilu.";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (101)";
		}

	replace("approval");
			
}
//EDIT CATEGORY
if(isset($_POST['eCategorySubmit'])){
	 $edit = EditCategory($_POST['eid'], $_POST['eNameCategory'],$_POST['eShortName'],$_POST['eDescriptionCategory']);
	
	if($edit){
		$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a kategorii";
	} else {
		$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (101)";
	}
	replace("category");
			
}

//CREATE PLAN
if(isset($_POST['PlanSubmit'])){
	
	 $createP = CreatePlan($_POST['name'],$_POST['description'],$_POST['from'],$_POST['to'],$_POST['place']);

		foreach($_POST['category'] as $cat){
			AddPlanCategory($cat, $createP);
		}
	
	if($createP >= 0){
		$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste přidal/a Plánovanou Akci";
	} else {
		$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (101)";
	}
	replace("action");
			
}
//CREATE ACTION
if(isset($_POST['ActionSubmit'])){
	$File_Name;

	if(!empty(basename($_FILES["File"]["name"]))){
			$File_Name = basename($_FILES["File"]["name"]);
			$File_Check = getimagesize($_FILES["File"]["tmp_name"]);
			$File_Size = $_FILES["File"]["size"];
			$File_Temp = $_FILES["File"]["tmp_name"];
			$target_dir = "../data/uploads/competitions/";
		$returnPicture = ControlPicture($File_Name, $File_Check, $target_dir, $File_Size, $File_Temp);
	} else {
		$returnPicture = true;
	}

	if($returnPicture == true AND !is_array($returnPicture)){
		$returnCreateAction = CreateAction($_POST['name'], $_POST['date'], $File_Name, $_POST['tickets']);
		if($returnCreateAction == true){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste přidal/a pořádanou akci.";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (100)";
		}
	} else {
		foreach ($returnPicture as $error){
			$_SESSION["errormsg"] = $_SESSION["errormsg"].'<br>'.$error;
		}
	}
	
	replace("actions");
	
}
//EDIT CATEGORY
if(isset($_POST['eActionSubmit'])){
	$File_Name;

	if(!empty(basename($_FILES["File"]["name"]))){
			$File_Name = basename($_FILES["File"]["name"]);
			$File_Check = getimagesize($_FILES["File"]["tmp_name"]);
			$File_Size = $_FILES["File"]["size"];
			$File_Temp = $_FILES["File"]["tmp_name"];
			$target_dir = "../data/uploads/competitions/";
		$returnPicture = ControlPicture($File_Name, $File_Check, $target_dir, $File_Size, $File_Temp);
	} else {
		$returnPicture = true;
	}

	if($returnPicture == true AND !is_array($returnPicture)){
		if(!empty(basename($_FILES["File"]["name"]))){
			$select = SelectAction($_POST['id']);
			unlink("../data/uploads/competitions/".$select["Competition_Poster"]);
		} else {
			$select = SelectAction($_POST['id']);
			$File_Name = $select["Competition_Poster"];
		}
		$edit = EditAction($_POST['id'], $_POST['name'],$_POST['date'],$_POST['tickets'],$_POST['photos'],$_POST['cancel'], $File_Name);
		if($edit == true){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a pořádanou akci.";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (100)";
		}
	} else {
		foreach ($returnPicture as $error){
			$_SESSION["errormsg"] = $_SESSION["errormsg"].'<br>'.$error;
		}
	}
	
	replace("actions");
	
}
if(isset($_POST['EActionFile'])){

	$File_Name = basename($_FILES["File"]["name"]);
	$File_Size = $_FILES["File"]["size"];
	$target_dir = "../data/uploads/competitions/";
	$returnFile = ControlFile($File_Name, $target_dir, $File_Size);


	if($returnFile == true AND !is_array($returnFile)){
			$select = SelectAction($_POST['id']);
			switch($_POST['type']){
				case p:
					if(!empty($select["Competition_Proposition"])){
						unlink("../data/uploads/competitions/".$select["Competition_Proposition"]);	
					}
				break;
				case s:
					if(!empty($select["Competition_Schedule"])){
						unlink("../data/uploads/competitions/".$select["Competition_Schedule"]);
					}
				break;
				case r:
					if(!empty($select["Competition_Results"])){
						unlink("../data/uploads/competitions/".$select["Competition_Results"]);
					}
				break;
			}
		$edit = EditFilesAction($_POST['id'],$_POST['type'],$File_Name);
		if($edit == true){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a pořádanou akci.";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (100)";
		}
	} else {
		foreach ($returnFile as $error){
			$_SESSION["errormsg"] = $_SESSION["errormsg"].'<br>'.$error;
		}
	}
	
	replace("actions");
	
}

//CONTACT
if(isset($_POST['ContactSubmit'])){
	 $edit = CreateContact($_POST['type'], $_POST['name'],$_POST['phone1'],$_POST['phone2'],$_POST['email'],$_POST['link']);
	
	if($edit){
		$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste přidal/a kontakt";
	} else {
		$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (101)";
	}
	replace("contact");
			
}
if(isset($_POST['ContactESubmit'])){
	 $edit = EditContact($_POST['id'], $_POST['type'], $_POST['name'],$_POST['phone1'],$_POST['phone2'],$_POST['email'],$_POST['link']);
	
	if($edit){
		$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a kontakt";
	} else {
		$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (101)";
	}
	replace("contact");
			
}
//EDIT CATEGORY
if(isset($_POST['eCategorySubmit'])){
	 $edit = EditCategory($_POST['eid'], $_POST['eNameCategory'],$_POST['eShortName'],$_POST['eDescriptionCategory']);
	
	if($edit){
		$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a kategorii";
	} else {
		$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (101)";
	}
	replace("category");
			
}
//Edit Category for user
if(isset($_POST['CategoryESubmit'])){
	$delete = DeleteUserCategories($_POST['eid']);
	$insert = CreteaUserCategories($_POST['eid'], $_POST['category']);
	
	if($delete){
		if($insert){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a kategorii/e u uživatele";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Byly smazány staré kategorie, ale nové nebyly vytvořeny.";
		}
	} else {
		$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (101)";
	}
	replace("users");
			
}
//resend user verify
if(isset($_POST['verify_submit'])){
	$id= $_POST['id'];
	$profile = get_info_user($id);
	
	$send = SendEmail(1, $profile['User_Email'], $profile['User_FirstName'].' '.$profile['User_LastName'], 0,0 ,$profile['User_VerifyCode']);
	
	if($send){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste odeslal/a znovu ověřovací email";
	} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Byly smazány staré kategorie, ale nové nebyly vytvořeny.";
	}
	replace("users");
			
}
//Edit user photo
if(isset($_POST['UsersEPhoto'])){
	$id = $_POST['eid'];
	$target_dir = "../data/uploads/users/";
	
	$oldimage = get_info_user($id);
	echo $oldimage['User_Photo'];
	if($oldimage['User_Photo'] != NULL){
		unlink($target_dir . '' .$oldimage['User_Photo']);
	}


	if(!empty(basename($_FILES["File"]["name"]))){
			$File_Name = basename($_FILES["File"]["name"]);
			$File_Check = getimagesize($_FILES["File"]["tmp_name"]);
			$File_Size = $_FILES["File"]["size"];
			$File_Temp = $_FILES["File"]["tmp_name"];
		$returnPicture = ControlPicture($File_Name, $File_Check, $target_dir, $File_Size, $File_Temp);
	} else {
		$returnPicture = true;
	}

	if($returnPicture == true AND !is_array($returnPicture)){
		$returnCreatePhoto = userSetProfilePhoto($id, $File_Name);
		if($returnCreatePhoto){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste nahrál/a profilový obrázek uživateli.";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (100)";
		}
	} else {
		foreach ($returnPicture as $error){
			$_SESSION["errormsg"] = $_SESSION["errormsg"].'<br>'.$error;
		}
	}
	
	replace("users");
	
}
//Edit Plan
if(isset($_POST['ePlanSubmit'])){
	$editPlan = EditPlan($_POST['eid'], $_POST['name'], $_POST['description'], $_POST['place'], $_POST['from'], $_POST['to']);
		if($editPlan){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a plánovanou akci";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Byly smazány staré kategorie, ale nové nebyly vytvořeny.";
		}
	replace("plans");
			
}
if(isset($_POST['CategoryEPlanSubmit'])){
	$delete = DeletePlanCategories($_POST['eid']);
	$insert = CreteaPlanCategories($_POST['eid'], $_POST['category']);
	
	if($delete){
		if($insert){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a kategorii/e u plánované akce";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Byly smazány staré kategorie, ale nové nebyly vytvořeny.";
		}
	} else {
		$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (101)";
	}
	replace("plans");
			
}
if(isset($_POST['HistorySubmit'])){
	$history = EditHistory($_POST['History']);
	
	if($history){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a historii oddílu";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte Administrätora.";
		}

	replace("history");
			
}
if(isset($_POST['HireSubmit'])){
	$File_Name;

	if(!empty(basename($_FILES["File"]["name"]))){
			$File_Name = basename($_FILES["File"]["name"]);
			$File_Check = getimagesize($_FILES["File"]["tmp_name"]);
			$File_Size = $_FILES["File"]["size"];
			$target_dir = "../data/other/";
			$File_Temp = $_FILES["File"]["tmp_name"];
		$returnPicture = ControlPicture($File_Name, $File_Check, $target_dir, $File_Size, $File_Temp);
	} else {
		$returnPicture = true;
	}

	if($returnPicture == true AND !is_array($returnPicture)){
		$select = SelectHire();
		$photo;
		if(!empty(basename($_FILES["File"]["name"]))){
			if(!empty($select['Hire_Photo'])){
				unlink("../data/other/".$select['Hire_Photo']);	
			}
			$photo = $File_Name;
		} else {
			$photo = $select['Hire_Photo'];
		}
		$history = EditHire($_POST['Hire'], $photo);
		if($history == true){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a nábory oddílu";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (100)";
		}
	} else {
		foreach ($returnPicture as $error){
			$_SESSION["errormsg"] = $_SESSION["errormsg"].'<br>'.$error;
		}
	}
	
	replace("hire");
			
}
if(isset($_POST['DopingSubmit'])){
	$history = EditDoping($_POST['Doping']);
	
	if($history){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a informace o dopingu";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte Administrätora.";
		}

	replace("doping");
			
}
if(isset($_POST['TraningSubmit'])){
	$days = TraningsDays($_POST['fromdate'],$_POST['todate'],$_POST['day']);
	$cat;
	foreach($_POST['category'] as $category){
		$cat= $cat.','.$category;
	}
	foreach($days as $day){
		CreateTraning($_POST['place'],substr($cat,1),$day,$_POST['fromtime'],$_POST['totime']);
	}
	$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste přidal/a tréninky";


	replace("tranings");
}
// --- SPONZORS ---
//create sponzor
if(isset($_POST['SponzorSubmit'])){
	$name = $_POST['name'];
	$link = $_POST['link'];
	

	if(!empty(basename($_FILES["File"]["name"]))){
			$File_Name = basename($_FILES["File"]["name"]);
			$File_Check = getimagesize($_FILES["File"]["tmp_name"]);
			$File_Size = $_FILES["File"]["size"];
			$target_dir = "../data/uploads/sponzors/";
			$File_Temp = $_FILES["File"]["tmp_name"];
		$returnPicture = ControlPicture($File_Name, $File_Check, $target_dir, $File_Size, $File_Temp);
	} else {
		$returnPicture = true;
	}

	if($returnPicture == true AND !is_array($returnPicture)){
		$returnCreateNew = CreateSponzor($name, $File_Name, $link);
		if($returnCreateNew == true){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste přidal/a sponzora.";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (100)";
		}
	} else {
		foreach ($returnPicture as $error){
			$_SESSION["errormsg"] = $_SESSION["errormsg"].'<br>'.$error;
		}
	}
	
	replace("sponzors");
	
}
if(isset($_POST['eSponzorSubmit'])){
	$id = $_POST['eid'];
	$name = $_POST['name'];
	$link = $_POST['link'];
	$File_Name;
	

	if(!empty(basename($_FILES["File"]["name"]))){
			$File_Name = basename($_FILES["File"]["name"]);
			$File_Check = getimagesize($_FILES["File"]["tmp_name"]);
			$File_Size = $_FILES["File"]["size"];
			$target_dir = "../data/uploads/sponzors/";
			$File_Temp = $_FILES["File"]["tmp_name"];
		$returnPicture = ControlPicture($File_Name, $File_Check, $target_dir, $File_Size, $File_Temp);
	} else {
		$returnPicture = true;
	}

	if($returnPicture == true || !is_array($returnPicture)){
		$selectsponzor = SelectSponzor($id);
		if(empty($File_Name) && $selectsponzor){
			$File_Name = $selectsponzor["Sponzor_Photo"];
		} else {
			unlink("../data/uploads/sponzors/".$selectsponzor["Sponzor_Photo"]);
		}
		
		$returnEditSponzor = EditSponzor($id, $name, $File_Name, $link);
		if($returnEditSponzor){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a sponzora.";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (100)";
		}
	} else {
		foreach ($returnPicture as $error){
			$_SESSION["errormsg"] = $_SESSION["errormsg"].'<br>'.$error;
		}
	}
	
	replace("sponzors");
}
// --- TRANINGS PLACE ---
if(isset($_POST['PlaceSubmit'])){
	$createPlace = CreateTreningPlace($_POST['name'], $_POST['adress'], $_POST['link']);
		if($createPlace){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste přidal/a tréninkové místo";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Byly smazány staré kategorie, ale nové nebyly vytvořeny.";
		}
	replace("tplace");
			
}
if(isset($_POST['EPlaceSubmit'])){
	$editPlace = EditTreningPlace($_POST['id'],$_POST['name'], $_POST['adress'], $_POST['link']);
		if($editPlace){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a tréninkové místo";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Byly smazány staré kategorie, ale nové nebyly vytvořeny.";
		}
	replace("tplace");
			
}
if(isset($_POST['StaffSubmit'])){
	$admin = (isset($_POST['admin'])) ? '1' : '0';
	$coach = $_POST['coach'];
	$judge = (isset($_POST['judge'])) ? '1' : '0';
	$leader = (isset($_POST['leader'])) ? '1' : '0';
	$Deputy = (isset($_POST['Deputy'])) ? '1' : '0';
	$Visor = (isset($_POST['Visor'])) ? '1' : '0';
	$Audit = (isset($_POST['Audit'])) ? '1' : '0';
		
	$createStaff = CreateBehavior($_POST['user'], $admin, $leader, $coach, $judge, $Deputy, $Visor, $Audit);
		if($createStaff){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste přidal/a nového trenéra";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Byly smazány staré kategorie, ale nové nebyly vytvořeny.";
		}
	replace("staff");
			
}
if(isset($_POST['EStaffSubmit'])){
	$admin = (isset($_POST['eadmin'])) ? '1' : '0';
	$coach = $_POST['coach'];
	$judge = (isset($_POST['ejudge'])) ? '1' : '0';
	$leader = (isset($_POST['eleader'])) ? '1' : '0';
	$Deputy = (isset($_POST['eDeputy'])) ? '1' : '0';
	$Visor = (isset($_POST['eVisor'])) ? '1' : '0';
	$Audit = (isset($_POST['eAudit'])) ? '1' : '0';
		
	$createStaff = EditBehavior($_POST['id'], $admin, $leader, $coach, $judge, $Deputy, $Visor, $Audit);
		if($createStaff){
			$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste upravil/a trenéra";
		} else {
			$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Byly smazány staré kategorie, ale nové nebyly vytvořeny.";
		}
	replace("staff");
			
}
//Delete GLOBAL
if(isset($_POST['delete_submit'])){
	
	switch($_POST['type']){
		case 'news':
			$deletenews = DeleteNew($_POST['id']);
			if($deletenews){
				$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste smazal/a novinku.";
			} else {
				$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (102)";
			}
			replace("news");
		break;
		case 'category':
			$deletenews = DeleteCategory($_POST['id']);
			if($deletenews){
				$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste smazal/a kategorii.";
			} else {
				$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (102)";
			}
			replace("category");
		break;		
		case 'user':
			$deleteuser = DeleteUser($_POST['id']);
			if($deleteuser){
				$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste smazal/a uživatele.";
			} else {
				$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (102)";
			}
			replace("users");
		break;	
		case 'plans':
			$deleteplan = DeletePlan($_POST['id']);
			if($deleteplan){
				$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste smazal/a plánovanou akci.";
			} else {
				$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (102)";
			}
			replace("plans");
		break;
		case 'sponzors':
			$selectsponzor = SelectSponzor($_POST['id']);
			unlink("../data/uploads/sponzors/".$selectsponzor["Sponzor_Photo"]);
			$deletesponzor = DeleteSponzor($_POST['id']);
			if($deletesponzor){
				$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste smazal/a sponzora.";
			} else {
				$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (102)";
			}
			replace("sponzors");
		break;
		case 'place':
			$deleteplace = DeleteTreningPlace($_POST['id']);
			if($deleteplace){
				$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste smazal/a tréninkové místo.";
			} else {
				$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (102)";
			}
			replace("tplace");
		break;
		case 'staff':
			$deleteplace =  DeleteStaff($_POST['id']);
			if($deleteplace){
				$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste smazal/a trenéra.";
			} else {
				$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (102)";
			}
			replace("staff");
		break;
		case 'traning':
			$deleteplace =  DeleteTraning($_POST['id']);
			if($deleteplace){
				$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste smazal/a trénink.";
			} else {
				$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (102)";
			}
			replace("tranings");
		break;
		case 'info':
			$deletenews = DeleteInfo($_POST['id']);
			$selectinfo = SelectInfo($_POST['id']);
			unlink("../data/uploads/informations/".$selectinfo["Info_File"]);
			if($deletenews){
				$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste smazal/a informaci.";
			} else {
				$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (102)";
			}
			replace("catnews");
		break;
		case 'actions':
			$delete = DeleteAction($_POST['id']);
			$select = SelectAction($_POST['id']);
			unlink("../data/uploads/competitions/".$select ["Competition_Poster"]);
			unlink("../data/uploads/competitions/".$select ["Competition_Proposition"]);
			unlink("../data/uploads/competitions/".$select ["Competition_Schedule"]);
			unlink("../data/uploads/competitions/".$select ["Competition_Results"]);
			
			if($delete){
				$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste smazal/a pořádanou akci.";
			} else {
				$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (102)";
			}
			replace("actions");
		break;
		case 'album':
			$info = SelectAlbumID($_POST['id']);
			$delete = DeleteAlbum($_POST['id']);
			unlink("../data/uploads/albums/".$info["GalleryA_Photo"]);
			$photos = SelectPhotosByAlbum($_POST['id']);
			if(!empty($photos)){
				foreach($photos as $photo){
					DeletePhoto($photo['GalleryP_ID']);
				}
				removeFolder("../data/uploads/albums/".$_POST['id']);
			}
			if($delete){
				$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste smazal/a album.";
			} else {
				$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (102)";
			}
			replace("albums");
		break;
		case 'photo':
			$album = $_POST['album'];
			$name = $_POST['name'];
			$id = $_POST['id']; 
			$delete = DeletePhoto($id);
			unlink("../data/uploads/albums/".$album.'/'.$name);
			if($delete){
				$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste smazal/a obrázek z alba.";
			} else {
				$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (102)";
			}
			replace("photos");
		break;
		case 'contact':
			$delete = DeleteContact($_POST['id']);
			if($delete){
				$_SESSION["successmsg"] = "<i class='fas fa-check'></i> Úspěšně jste smazal/a kontakt.";
			} else {
				$_SESSION["errormsg"] = "<i class='fas fa-exclamation-triangle'></i> Jejda, něco se pokazilo. Kontaktujte prosím administrátora webu. (102)";
			}
			replace("contact");
		break;
	}
}

?>