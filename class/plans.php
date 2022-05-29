<?php

function CreatePlan($name, $description, $from, $to, $place){
	
        global $conn;
    
        $stmtCPlan= $conn->prepare("
            INSERT INTO Plans(Plan_Name, Plan_From, Plan_To, Plan_Place, Plan_Descript)
            VALUES (:name, :from, :to, :place, :descript)
        ");
    
		$stmtCPlan->bindParam(':name', $name);
        $stmtCPlan->bindParam(':from', $from);
		$stmtCPlan->bindParam(':to', $to);
		$stmtCPlan->bindParam(':place', $place);
        $stmtCPlan->bindParam(':descript', $description);
        
        if($stmtCPlan->execute()){
            return $conn->lastInsertId();
        } else {
           return false;
        }
}
function SelectAllPlans(){
	    global $conn;
    
        $stmtAllPlans = $conn->prepare("SELECT * FROM Plans"); 
	/*		SELECT Plans.Plan_ID,Plans.Plan_Name, Plans.Plan_, DanceCategory.Category_Name
		FROM ((PlansCategory
		INNER JOIN Plans ON PlansCategory.PlanC_PlanID = Plans.Plan_ID)
		INNER JOIN DanceCategory ON PlansCategory.PlanC_CategoryID = DanceCategory.Category_ID);*/
	
		if($stmtAllPlans->execute()){
			return $stmtAllPlans->fetchAll();
		} else{
			return false;
		}
    

}
function SelectPlansByUserCategory($id){
	    global $conn;
    
        $stmtPlan = $conn->prepare("SELECT PlanC_PlanID FROM PlansCategory WHERE PlanC_CategoryID = :id"); 
		$stmtPlan->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmtPlan->execute()){
			return $stmtPlan->fetchAll();
		} else{
			return false;
		}
}
function SelectPlanByID($id){
	    global $conn;
    
        $stmtPlan = $conn->prepare("SELECT * FROM Plans WHERE Plan_ID = :id"); 
		$stmtPlan->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmtPlan->execute()){
			return $stmtPlan->fetch();
		} else{
			return false;
		}
}
function DeletePlan($id){
	global $conn;
	
	$stmtDeletePlan = $conn->prepare("DELETE FROM Plans WHERE Plan_ID=:id");
	$stmtDeletePlan->bindParam(':id', $id, PDO::PARAM_INT);
	
	$stmtDeletecatPlan = $conn->prepare("DELETE FROM PlansCategory WHERE PlanC_PlanID=:id");
	$stmtDeletecatPlan->bindParam(':id', $id, PDO::PARAM_INT);
	
	if(($stmtDeletePlan->execute()) && ($stmtDeletecatPlan->execute())){
		return true;
	} else{
		return false;
	}
	
}
function EditPlan($ID, $name, $desc, $place, $from, $to){
	global $conn;
	
	$stmtUpdate = $conn->prepare('UPDATE Plans SET Plan_Name=:name, Plan_From=:from, Plan_To=:to, Plan_Place=:place, Plan_Descript=:desc WHERE Plan_ID=:id');
	$stmtUpdate->bindParam(':id', $ID, PDO::PARAM_INT);
	$stmtUpdate->bindParam(':name', $name);
	$stmtUpdate->bindParam(':place', $place);
	$stmtUpdate->bindParam(':from', $from);
	$stmtUpdate->bindParam(':to', $to);
	$stmtUpdate->bindParam(':desc', $desc);
	
	if($stmtUpdate->execute()){
		return true;
	} else{
		return false;
	}
	
}

?>