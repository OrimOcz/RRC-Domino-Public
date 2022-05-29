<?php
    if (!function_exists('HashFunction')){
        function HashFunction($pass){
                $Bpass = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 12]);
                return $Bpass;
        } 
    }
function translate_date($untranslated_date)
{
	$day;
	switch($untranslated_date){
		case 'Mon':
			$day = 'Pondělí';
			break;
		case 'Tue':
			$day = 'Úterý';
			break;
		case 'Wed':
			$day = 'Středa';
			break;
		case 'Thu':
			$day = 'Čtvrtek';
			break;
		case 'Fri':
			$day = 'Pátek';
			break;
		case 'Sat':
			$day = 'Sobota';
			break;
		case 'Sun':
			$day = 'Neděle';
			break;
			
	}
	
	return $day;
}
    function gencode($length) {
            $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $pieces = [];
			$charactersLength = strlen($keyspace );
			$code = '';
            for ($i = 0; $i < $length; ++$i) 
            {
                $code .= $keyspace[rand(0, $charactersLength - 1)];
            }
            return $code;
    };
function removeFolder($folderName) {
         if (is_dir($folderName))
           $folderHandle = opendir($folderName);
         if (!$folderHandle)
              return false;
 
         while($file = readdir($folderHandle)) {
               if ($file != "." && $file != "..") {
                    if (!is_dir($folderName."/".$file))
                         unlink($folderName."/".$file);
                    else
                         removeFolder($folderName.'/'.$file);
               }
         }
         closedir($folderHandle);
         rmdir($folderName);
         return true;
}
	function ControlPicture($fileName, $fileCheck, $filePath, $fileSize, $File_Temp){
		
		$ControlUpload = 1;
		$target_file = $filePath  .  $fileName;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$errMSG = array();

		
			// Check if image file is a actual image or fake image
		 if($fileCheck == false) {
			$errMSG[] = "Soubor není obrázek.";
			$ControlUpload = 0;
		 }

		// Check if file already exists
		if (file_exists($target_file)) {
			$errMSG[] = "Soubor již existuje.";
		  	$ControlUpload = 0;
		}

		// Check file size
		if ($fileSize > 20971520) {
			$errMSG[] = "Soubor přesahuje maximální velikost. (20 MB)";
			$ControlUpload = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
			$errMSG[] = "Nejedná se o obrázek ve správném formátu (jpg, png, jpeg, gif).";
			$ControlUpload = 0;
		}

		if ($ControlUpload == 0) {
			return $errMSG;
		} else {
		  if (move_uploaded_file($File_Temp, $target_file)) {
			  return true;
		  } else {
			return "Z neznámého důvodu se nepovedlo nahrát obrázek. Zkuste to prosím později, nebo kontaktujte administrátora";
		  }
		}
		
	}
	function ControlFile($fileName, $filePath, $fileSize){
		
		$ControlUpload = 1;
		$target_file = $filePath  .  $fileName;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$errMSG = array();

		
			// Check if image file is a actual image or fake image

		// Check if file already exists
		if (file_exists($target_file)) {
			$errMSG[] = "Soubor již existuje.";
		  	$ControlUpload = 0;
		}

		// Check file size
		if ($fileSize > 20971520) {
			$errMSG[] = "Soubor přesahuje maximální velikost. (20 MB)";
			$ControlUpload = 0;
		}

		// Allow certain file formats
		if($imageFileType != "pdf" && $imageFileType != "txt" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx") {
			$errMSG[] = "Nejedná se o soubor ve správném formátu (pdf, txt, doc, docx, xls, xlsx).";
			$ControlUpload = 0;
		}

		if ($ControlUpload == 0) {
			return $errMSG;
		} else {
		  if (move_uploaded_file($_FILES["File"]["tmp_name"], $target_file)) {
			  return true;
		  } else {
			return "Z neznámého důvodu se nepovedlo nahrát obrázek. Zkuste to prosím později, nebo kontaktujte administrátora";
		  }
		}
		
	}
?>