<?php
function CreateInfo($title, $message, $file, $cat){
	
        global $conn;
		$dateTime = date('Y-m-d H:i:s');
    
        $stmtCreateInfo = $conn->prepare("
            INSERT INTO Information (Info_Title, Info_Message, Info_File, Info_Date, Info_Categories)
            VALUES (:title, :msg, :file, :date, :cat)
        ");
    
		$stmtCreateInfo->bindParam(':title', $title);
        $stmtCreateInfo->bindParam(':msg', $message);
        $stmtCreateInfo->bindParam(':file', $file);
        $stmtCreateInfo->bindParam(':cat', $cat);
        $stmtCreateInfo->bindParam(':date', $dateTime);
        
        if($stmtCreateInfo->execute()){
            return true;
        } else {
           return false;
        }
}
function SelectAllInfo(){
	    global $conn;
    
        $stmtAllInfo = $conn->prepare("SELECT * FROM Information"); 
	
		if($stmtAllInfo->execute()){
			return $stmtAllInfo->fetchAll();
		} else{
			return false;
		}
    

}

function SelectInfo($id){
		global $conn;
	
		$stmtNews = $conn->prepare("SELECT * FROM Information WHERE Info_ID=:id");
		$stmtNews->bindParam(':id', $id, PDO::PARAM_INT);
		$stmtNews->execute();
		if($stmtNews->execute()){
			return $stmtNews->fetch();
		} else{
			return false;
		}
		
}

function DeleteInfo($id){
	global $conn;
	
	$stmtDeleteInfo = $conn->prepare("DELETE FROM Information WHERE Info_ID=:id");
	$stmtDeleteInfo->bindParam(':id', $id, PDO::PARAM_INT);
	
	if($stmtDeleteInfo->execute()){
		return true;
	} else{
		return false;
	}
	
}
function EditInfo($ID, $Title, $Msg, $cat){
	global $conn;
	
	$stmtUpdateInfo = $conn->prepare('UPDATE Information SET Info_Title=:title,Info_Message=:msg,Info_Categories=:cat WHERE Info_ID=:id');
	$stmtUpdateInfo->bindParam(':id', $ID, PDO::PARAM_INT);
	$stmtUpdateInfo->bindParam(':title', $Title);
	$stmtUpdateInfo->bindParam(':msg', $Msg);
	$stmtUpdateInfo->bindParam(':cat', $cat);
	
	if($stmtUpdateInfo->execute()){
		return true;
	} else{
		return false;
	}
	
}
function SelectInfoCategory($id){
	
        global $conn;
    
        $stmtSelect = $conn->prepare("
			SELECT Info_ID FROM Information
			WHERE Info_Categories REGEXP :id ORDER BY Info_Date;
        ;");
	$stmtSelect->bindParam(':id', $id);
        
        if($stmtSelect->execute()){
            return $stmtSelect->fetchAll();
        } else {
           return false;
        }
}
?>