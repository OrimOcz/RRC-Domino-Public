<?php

function CreateSponzor($name, $pic, $url){
	
        global $conn;
    
        $stmtNSponzor= $conn->prepare("
            INSERT INTO Sponzors(Sponzor_Name, Sponzor_Photo, Sponzor_Link)
            VALUES (:name, :photo, :link)
        ");
    
		$stmtNSponzor->bindParam(':name', $name);
        $stmtNSponzor->bindParam(':photo', $pic);
		$stmtNSponzor->bindParam(':link', $url);
        
        if($stmtNSponzor->execute()){
            return $conn->lastInsertId();
        } else {
           return false;
        }
}
function SelectAllSponzors(){
	    global $conn;
    
        $stmtAllSponzors = $conn->prepare("SELECT * FROM Sponzors"); 

		if($stmtAllSponzors->execute()){
			return $stmtAllSponzors->fetchAll();
		} else{
			return false;
		}
    

}
function SelectSponzor($id){
	    global $conn;
    
        $stmtSponzor = $conn->prepare("SELECT * FROM Sponzors WHERE Sponzor_ID=:id");
		$stmtSponzor->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmtSponzor->execute()){
			return $stmtSponzor->fetch();
		} else{
			return false;
		}
    

}

function DeleteSponzor($id){
	global $conn;
	
	$stmtDeleteSponzor = $conn->prepare("DELETE FROM Sponzors WHERE Sponzor_ID=:id");
	$stmtDeleteSponzor->bindParam(':id', $id, PDO::PARAM_INT);
	
	if($stmtDeleteSponzor->execute()){
		return true;
	} else{
		return false;
	}
	
}
function EditSponzor($ID, $name, $file, $link){
	global $conn;
	
	$stmtUpdate = $conn->prepare('UPDATE Sponzors SET Sponzor_Name=:name, Sponzor_Photo=:pic, Sponzor_Link=:url WHERE Sponzor_ID=:id');
	$stmtUpdate->bindParam(':id', $ID, PDO::PARAM_INT);
	$stmtUpdate->bindParam(':name', $name);
	$stmtUpdate->bindParam(':pic', $file);
	$stmtUpdate->bindParam(':url', $link);
	
	if($stmtUpdate->execute()){
		return true;
	} else{
		return false;
	}
	
}

?>