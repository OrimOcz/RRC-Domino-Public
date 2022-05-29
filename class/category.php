<?php

function CreateCategory($name, $short, $description){
	
        global $conn;
		$dateTime = date('Y-m-d H:i:s');
    
        $stmtCreateCategory = $conn->prepare("
            INSERT INTO DanceCategory (Category_Name, Category_ShortName, Category_Description)
            VALUES (:name, :short, :descript)
        ");
    
		$stmtCreateCategory->bindParam(':name', $name);
        $stmtCreateCategory->bindParam(':short', $short);
        $stmtCreateCategory->bindParam(':descript', $description);
        
        if($stmtCreateCategory->execute()){
            return true;
        } else {
           return false;
        }
}
function SelectAllCategory(){
	    global $conn;
    
        $stmtAllCategories = $conn->prepare("SELECT * FROM DanceCategory"); 
	
		if($stmtAllCategories->execute()){
			return $stmtAllCategories->fetchAll();
		} else{
			return false;
		}
    

}

function SelectCategory($id){
	    global $conn;
    
        $stmtCategory = $conn->prepare("
		SELECT * FROM DanceCategory WHERE Category_ID = :id;
		"); 
		$stmtCategory->bindParam(':id', $id, PDO::PARAM_INT);
		if($stmtCategory->execute()){
			return $stmtCategory->fetch();
		} else{
			return false;
		}
    

}
function DeleteCategory($idNews){
	global $conn;
	
	$stmtDeleteCategory = $conn->prepare("DELETE FROM DanceCategory WHERE Category_ID=:id");
	$stmtDeleteCategory->bindParam(':id', $idNews, PDO::PARAM_INT);
	
	if($stmtDeleteCategory->execute()){
		return true;
	} else{
		return false;
	}
	
}
//Plan - CATEGORY
function DeletePlanCategories($id){
	global $conn;
	
	$stmtDeleteCategory = $conn->prepare("DELETE FROM PlansCategory WHERE PlanC_PlanID=:id");
	$stmtDeleteCategory->bindParam(':id', $id, PDO::PARAM_INT);
	
	if($stmtDeleteCategory->execute()){
		return true;
	} else{
		return false;
	}
	
}
function CreteaPlanCategories($id, $categories){
	global $conn;
	$count = 0;
	
	foreach($categories as $category){
		$stmtCreteaPlanCategory = $conn->prepare("INSERT INTO PlansCategory (PlanC_PlanID, PlanC_CategoryID) VALUES (:id, :category)");
		$stmtCreteaPlanCategory->bindParam(':id', $id, PDO::PARAM_INT);
		$stmtCreteaPlanCategory->bindParam(':category', $category);
		if($stmtCreteaPlanCategory->execute()){

		} else {
			$count = $count + 1;
		}
		
	}
	
	if($count <= 0){
		return true;
	} else{
		return false;
	}
	
}
function DeleteUserCategories($id){
	global $conn;
	
	$stmtDeleteCategory = $conn->prepare("DELETE FROM UsersCategory WHERE UserC_UserID=:id");
	$stmtDeleteCategory->bindParam(':id', $id, PDO::PARAM_INT);
	
	if($stmtDeleteCategory->execute()){
		return true;
	} else{
		return false;
	}
	
}
function CreteaUserCategories($id, $categories){
	global $conn;
	$count = 0;
	
	foreach($categories as $category){
		$stmtCreteaUserCategory = $conn->prepare("INSERT INTO UsersCategory (UserC_UserID, UserC_CategoryID) VALUES (:id, :category)");
		$stmtCreteaUserCategory->bindParam(':id', $id, PDO::PARAM_INT);
		$stmtCreteaUserCategory->bindParam(':category', $category);
		if($stmtCreteaUserCategory->execute()){

		} else {
			$count = $count + 1;
		}
		
	}
	
	if($count <= 0){
		return true;
	} else{
		return false;
	}
	
}
function SelectUserCategory($id){
	    global $conn;
    
        $stmtUserCategories = $conn->prepare("
		SELECT DanceCategory.Category_ID, DanceCategory.Category_ShortName
		FROM UsersCategory
		INNER JOIN DanceCategory ON UsersCategory.UserC_CategoryID = DanceCategory.Category_ID
		WHERE UsersCategory.UserC_UserID = :id;
		"); 
		$stmtUserCategories->bindParam(':id', $id, PDO::PARAM_INT);
		if($stmtUserCategories->execute()){
			return $stmtUserCategories->fetchAll();
		} else{
			return false;
		}
    

}
function SelectPlanCategory($id){
	    global $conn;
    
        $stmtUserCategories = $conn->prepare("
		SELECT DanceCategory.Category_ID, DanceCategory.Category_ShortName
		FROM PlansCategory
		INNER JOIN DanceCategory ON PlansCategory.PlanC_CategoryID = DanceCategory.Category_ID
		WHERE PlansCategory.PlanC_PlanID = :id;
		"); 
		$stmtUserCategories->bindParam(':id', $id, PDO::PARAM_INT);
		if($stmtUserCategories->execute()){
			return $stmtUserCategories->fetchAll();
		} else{
			return false;
		}
    

}
function EditCategory($ID, $name, $short, $desc){
	global $conn;
	
	$stmtUpdate = $conn->prepare('UPDATE DanceCategory SET Category_Name=:name, Category_ShortName=:sname, Category_Description=:desc WHERE Category_ID=:id');
	$stmtUpdate->bindParam(':id', $ID, PDO::PARAM_INT);
	$stmtUpdate->bindParam(':name', $name);
	$stmtUpdate->bindParam(':sname', $short);
	$stmtUpdate->bindParam(':desc', $desc);
	
	if($stmtUpdate->execute()){
		return true;
	} else{
		return false;
	}
	
}

?>