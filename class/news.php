<?php
function SelectHistory(){
	    global $conn;
    
        $stmtAllSponzors = $conn->prepare("SELECT * FROM History"); 

		if($stmtAllSponzors->execute()){
			return $stmtAllSponzors->fetch();
		} else{
			return false;
		}
}
function SelectDoping(){
	    global $conn;
    
        $stmtDoping = $conn->prepare("SELECT * FROM Doping"); 

		if($stmtDoping->execute()){
			return $stmtDoping->fetch();
		} else{
			return false;
		}
}
function SelectHire(){
	    global $conn;
    
        $stmtSHire = $conn->prepare("SELECT * FROM Hire"); 

		if($stmtSHire->execute()){
			return $stmtSHire->fetch();
		} else{
			return false;
		}
}
function EditHistory($text){
	    global $conn;
    
        $stmtEHistory = $conn->prepare("UPDATE History SET History_Text=:text WHERE id='0'"); 
		$stmtEHistory->bindParam(':text', $text);
	
		if($stmtEHistory->execute()){
			return true;
		} else{
			return false;
		}
}
function EditHire($text, $photo){
	    global $conn;
    
        $stmtEHire = $conn->prepare("UPDATE Hire SET Hire_Text=:text, Hire_Photo=:photo WHERE id='1'"); 
		$stmtEHire->bindParam(':text', $text);
		$stmtEHire->bindParam(':photo', $photo);
	
		if($stmtEHire ->execute()){
			return true;
		} else{
			return false;
		}
}
function EditDoping($text){
	    global $conn;
    
        $stmtEDoping = $conn->prepare("UPDATE Doping SET Doping_Text=:text WHERE id='1'"); 
		$stmtEDoping->bindParam(':text', $text);
	
		if($stmtEDoping->execute()){
			return true;
		} else{
			return false;
		}
}
function CreateNew($title, $message, $fblink, $picture){
	
        global $conn;
		$dateTime = date('Y-m-d H:i:s');
    
        $stmtCreateNew = $conn->prepare("
            INSERT INTO News (New_Title, New_Message, New_FBLink, New_Photo, New_Date, New_Author)
            VALUES (:title, :msg, :fb, :photo, :date, :author)
        ");
    
		$stmtCreateNew->bindParam(':title', $title);
        $stmtCreateNew->bindParam(':msg', $message);
        $stmtCreateNew->bindParam(':fb', $link);
        $stmtCreateNew->bindParam(':photo', $picture);
        $stmtCreateNew->bindParam(':date', $dateTime);
        $stmtCreateNew->bindParam(':author', $_SESSION['UserID']);
        
        if($stmtCreateNew->execute()){
            return true;
        } else {
           return false;
        }
}
function SelectAllNews(){
	    global $conn;
    
        $stmtAllNews = $conn->prepare("SELECT * FROM News"); 
	
		if($stmtAllNews->execute()){
			return $stmtAllNews->fetchAll();
		} else{
			return false;
		}
    

}

function SelectNews($fnum,$snum){
		global $conn;
	
		$stmtNews = $conn->prepare("SELECT * FROM News ORDER BY New_Date DESC LIMIT :first,:second");
		$stmtNews->bindParam(':first', $fnum, PDO::PARAM_INT);
    	$stmtNews->bindParam(':second', $snum, PDO::PARAM_INT);	

		if($stmtNews->execute()){
			return $stmtNews->fetchAll();
		} else{
			return false;
		}
		
}
function SelectNew($id){
		global $conn;
	
		$stmtNews = $conn->prepare("SELECT * FROM News WHERE New_ID=:id");
		$stmtNews->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmtNews->execute()){
			return $stmtNews->fetch();
		} else{
			return false;
		}
		
}
function DeleteNew($idNews){
	global $conn;
	
	$stmtDeleteNews = $conn->prepare("DELETE FROM News WHERE New_ID=:id");
	$stmtDeleteNews->bindParam(':id', $idNews, PDO::PARAM_INT);
	
	if($stmtDeleteNews->execute()){
		return true;
	} else{
		return false;
	}
	
}
function EditNew($ID, $Title, $Msg, $IMG){
	global $conn;
	
	$stmtUpdateNew = $conn->prepare('UPDATE News SET New_Title=:title,New_Message=:msg,New_Photo=:photo WHERE NEW_ID=:id');
	$stmtUpdateNew->bindParam(':id', $ID, PDO::PARAM_INT);
	$stmtUpdateNew->bindParam(':title', $Title);
	$stmtUpdateNew->bindParam(':msg', $Msg);
	$stmtUpdateNew->bindParam(':photo', $IMG);
	
	if($stmtUpdateNew->execute()){
		return true;
	} else{
		return false;
	}
	
}

?>