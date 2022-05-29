<?php
function CreateAction($name, $date, $poster, $ticket){
	
        global $conn;
    
        $stmtCAction= $conn->prepare("
            INSERT INTO Competition (Competition_Name, Competition_Date, Competition_Poster, Competition_Tickets)
            VALUES (:name, :date, :poster, :tickets)
        ");
    
		$stmtCAction->bindParam(':name', $name);
        $stmtCAction->bindParam(':date', $date);
		$stmtCAction->bindParam(':poster', $poster);
			$stmtCAction->bindParam(':tickets', $ticket);
        
        if($stmtCAction->execute()){
            return true;
        } else {
           return false;
        }
}

function EditAction($id, $name, $date, $tickets, $photos, $cancel, $poster){
	global $conn;
	
	$stmtUpdate = $conn->prepare('UPDATE Competition SET Competition_Name=:name, Competition_Date=:date, Competition_Photos=:phot, Competition_Tickets=:tic, 	Competition_Cancel=:can, Competition_Poster=:post WHERE Competition_ID=:id');
	$stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
	$stmtUpdate->bindParam(':name', $name);
	$stmtUpdate->bindParam(':date', $date);
	$stmtUpdate->bindParam(':phot', $photos);
	$stmtUpdate->bindParam(':tic', $tickets);
	$stmtUpdate->bindParam(':can', $cancel);
	$stmtUpdate->bindParam(':post', $poster);
	
	if($stmtUpdate->execute()){
		return true;
	} else{
		return false;
	}
	
}
function EditFilesAction($id,$type,$file){
	global $conn;
	$stmtUpdate;

	switch($type){
		case p:
			$stmtUpdate = $conn->prepare('UPDATE Competition SET Competition_Proposition=:file WHERE Competition_ID=:id');
		break;
		case s:
			$stmtUpdate = $conn->prepare('UPDATE Competition SET Competition_Schedule=:file WHERE Competition_ID=:id');
		break;
		case r:
			$stmtUpdate = $conn->prepare('UPDATE Competition SET Competition_Results=:file WHERE Competition_ID=:id');
		break;
	}
	
	$stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
	$stmtUpdate->bindParam(':file', $file);

	
	if($stmtUpdate->execute()){
		return true;
	} else{
		return false;
	}
	
}
function SelectAllActions(){
	    global $conn;
    
        $stmtAllAction = $conn->prepare("SELECT * FROM Competition ORDER BY Competition_Date DESC"); 
	
		if($stmtAllAction->execute()){
			return $stmtAllAction->fetchAll();
		} else{
			return false;
		}
}
function SelectAction($id){
	    global $conn;
    
        $stmtAction = $conn->prepare("SELECT * FROM Competition WHERE Competition_ID=:id");
		$stmtAction->bindParam(':id', $id, PDO::PARAM_INT);
	
		if($stmtAction->execute()){
			return $stmtAction->fetch();
		} else{
			return false;
		}
}
function DeleteAction($id){
	global $conn;
	
	$stmtDeleteAction = $conn->prepare("DELETE FROM Competition WHERE Competition_ID=:id");
	$stmtDeleteAction->bindParam(':id', $id, PDO::PARAM_INT);
	
	
	if($stmtDeleteAction->execute()){
		return true;
	} else{
		return false;
	}
	
}
?>