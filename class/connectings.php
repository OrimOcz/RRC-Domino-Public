<?php

function AddPlanCategory($idCategory, $idPlan){
	
        global $conn;
    
        $stmtAddPlanC= $conn->prepare("
            INSERT INTO PlansCategory(PlanC_PlanID, PlanC_CategoryID)
            VALUES (:p, :c)
        ");
    
		$stmtAddPlanC->bindParam(':p', $idPlan);
        $stmtAddPlanC->bindParam(':c', $idCategory);
        
        if($stmtAddPlanC->execute()){
            return true;
        } else {
           return false;
        }
}


?>