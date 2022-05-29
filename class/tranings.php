<?php
	function TraningsDays($from,$to,$day){
		$selectday;
		$x = 0;
		$dates = array();
		$date = strtotime(date('Y-m-d', strtotime($from . ' -1 day')));
		$finish = strtotime($to);
		do{
			$date = date("Y-m-d", $date);
			$date = strtotime($date . ' +1 day');
			$selectday = date("D", $date);
			if($selectday == $day){
				$x=1;
				array_push($dates, date("Y-m-d", $date));
			} else {
				$x=0;
			}
		}while($x < 1);
		$y=0;
		do{
			$date = date("Y-m-d", $date);
			$date = strtotime($date . ' +7 days');
			if($date <= $finish){
				array_push($dates, date("Y-m-d", $date));
				$y=0;
			} else {
				$y=1;
			}

		}while($y < 1);
		return $dates;
	}
function CreateTraning($place,$cat,$day,$from,$to){
	
        global $conn;
    
        $stmtCreateTraning = $conn->prepare("
            INSERT INTO Tranings (Traning_Place, Traning_Category, Traning_Day, Traning_From, Traning_To)
            VALUES (:place, :cat, :day, :from, :to)
        ;");
    
		$stmtCreateTraning->bindParam(':place', $place);
        $stmtCreateTraning->bindParam(':cat', $cat);
        $stmtCreateTraning->bindParam(':day', $day);
        $stmtCreateTraning->bindParam(':from', $from);
        $stmtCreateTraning->bindParam(':to', $to);
        
        if($stmtCreateTraning->execute()){
            return true;
        } else {
           return false;
        }
}
function SelectTraningCategory($id){
	
        global $conn;
    
        $stmtSelect = $conn->prepare("
			SELECT Traning_ID FROM Tranings
			WHERE Tranings.Traning_Category REGEXP :id AND Tranings.Traning_Day >= CURDATE() ORDER BY Tranings.Traning_Day;
        ;");
	$stmtSelect->bindParam(':id', $id);
        
        if($stmtSelect->execute()){
            return $stmtSelect->fetchAll();
        } else {
           return false;
        }
}
function SelectAllTraningsMembers(){
	
        global $conn;
    
        $stmtCreateTraning = $conn->prepare("
			SELECT Traning_ID FROM Tranings
			ORDER BY Tranings.Traning_Day
        ;");
    
        
        if($stmtCreateTraning->execute()){
            return $stmtCreateTraning->fetchAll();
        } else {
           return false;
        }
}
function InfoTrening($id){
        global $conn;
    
        $stmtInfo = $conn->prepare("
			SELECT Tranings.Traning_Day, Tranings.Traning_From, Tranings.Traning_To, TraningsPlace.Traning_Name
			FROM Tranings
			INNER JOIN TraningsPlace
			ON Tranings.Traning_Place = TraningsPlace.TraningP_ID 
			WHERE Tranings.Traning_ID=:id;
        ;");
    
        $stmtInfo->bindParam(':id', $id);
        if($stmtInfo->execute()){
            return $stmtInfo->fetch();
        } else {
           return false;
        }
}
function InfoTreningDate($date){
        global $conn;
    
        $stmtInfo = $conn->prepare("
			SELECT Tranings.Traning_ID, Tranings.Traning_From, Tranings.Traning_To, TraningsPlace.Traning_Name
			FROM Tranings
			INNER JOIN TraningsPlace
			ON Tranings.Traning_Place = TraningsPlace.TraningP_ID 
			WHERE Tranings.Traning_Day=:day;
        ;");
    
        $stmtInfo->bindParam(':day', $date);
        if($stmtInfo->execute()){
            return $stmtInfo->fetch();
        } else {
           return false;
        }
}
function SelectAllTranings(){
	
        global $conn;
    
        $stmtCreateTraning = $conn->prepare("
			SELECT Tranings.Traning_Category, Tranings.Traning_Day, Tranings.Traning_From, Tranings.Traning_To, Tranings.Traning_ID, TraningsPlace.Traning_Name
			FROM Tranings
			INNER JOIN TraningsPlace
			ON Tranings.Traning_Place = TraningsPlace.TraningP_ID;
        ;");
    
        
        if($stmtCreateTraning->execute()){
            return $stmtCreateTraning->fetchAll();
        } else {
           return false;
        }
}

	function DeleteTraning($id){
	
        global $conn;
    
        $stmtDeleteTPlace = $conn->prepare("
            DELETE FROM Tranings WHERE Traning_ID=:id
       ; ");
    
		$stmtDeleteTPlace->bindParam(':id', $id);
        
        if($stmtDeleteTPlace->execute()){
            return true;
        } else {
           return false;
        }
}
function CreateTreningPlace($name, $address, $linkmap){
	
        global $conn;
    
        $stmtCreateTPlace = $conn->prepare("
            INSERT INTO TraningsPlace (Traning_Name, Traning_Adress, Traning_LinkMap)
            VALUES (:name, :adress, :link)
        ;");
    
		$stmtCreateTPlace->bindParam(':name', $name);
        $stmtCreateTPlace->bindParam(':adress', $address);
        $stmtCreateTPlace->bindParam(':link', $linkmap);

        
        if($stmtCreateTPlace->execute()){
            return true;
        } else {
           return false;
        }
}
function EditTreningPlace($id, $name, $address, $linkmap){
	
        global $conn;
    
        $stmtEditTPlace = $conn->prepare("
			UPDATE TraningsPlace SET 
				Traning_Name=:name, 
				Traning_Adress=:adress, 
				Traning_LinkMap=:link 
			WHERE TraningP_ID=:id
        ;");
    	$stmtEditTPlace->bindParam(':id', $id);
		$stmtEditTPlace->bindParam(':name', $name);
        $stmtEditTPlace->bindParam(':adress', $address);
        $stmtEditTPlace->bindParam(':link', $linkmap);

        
        if($stmtEditTPlace->execute()){
            return true;
        } else {
           return false;
        }
}
function DeleteTreningPlace($id){
	
        global $conn;
    
        $stmtDeleteTPlace = $conn->prepare("
            DELETE FROM TraningsPlace WHERE TraningP_ID=:id
       ; ");
    
		$stmtDeleteTPlace->bindParam(':id', $id);
        
        if($stmtDeleteTPlace->execute()){
            return true;
        } else {
           return false;
        }
}

function SelectAllTPlace(){
	
        global $conn;
    
        $stmtDeleteTPlace = $conn->prepare("
            SELECT * FROM TraningsPlace;
        ");
    
        
        if($stmtDeleteTPlace->execute()){
            return $stmtDeleteTPlace->fetchAll();
        } else {
           return false;
        }
}
?>