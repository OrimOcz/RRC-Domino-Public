<?php
function loadAllContacts(){
    global $conn;

	$stmtLoad = $conn->prepare("SELECT * FROM Contact");
	
	if($stmtLoad->execute()){
		return $stmtLoad->fetchAll();
	} else {
		return false;
	}

}

function CreateContact($typ, $name, $phone1, $phone2, $email, $link){
	
        global $conn;
    
        $stmtCreate = $conn->prepare("
            INSERT INTO Contact(Contact_Type, Contact_Name, Contact_Tel1, Contact_Tel2, Contact_Email, Contact_Link)
            VALUES ( :typ, :name, :tel1, :tel2, :email, :link)
        ");
    
		$stmtCreate->bindParam(':typ', $typ, PDO::PARAM_INT);
        $stmtCreate->bindParam(':name', $name);
        $stmtCreate->bindParam(':tel1', $phone1);
        $stmtCreate->bindParam(':tel2', $phone2);
        $stmtCreate->bindParam(':email', $email);
        $stmtCreate->bindParam(':link', $link);
        
        if($stmtCreate->execute()){
            return true;
        } else {
           return false;
        }
}
function EditContact($id,$typ, $name, $phone1, $phone2, $email, $link){
	
        global $conn;
    
        $stmtEdit = $conn->prepare("
            UPDATE Contact SET Contact_Type=:typ, Contact_Name=:name, Contact_Tel1=:tel1, Contact_Tel2=:tel2, Contact_Email=:email, Contact_Link=:link 
			WHERE Contact_ID=:id
        ");
		$stmtEdit->bindParam(':id', $id, PDO::PARAM_INT);  
		$stmtEdit->bindParam(':typ', $typ, PDO::PARAM_INT);
        $stmtEdit->bindParam(':name', $name);
        $stmtEdit->bindParam(':tel1', $phone1);
        $stmtEdit->bindParam(':tel2', $phone2);
        $stmtEdit->bindParam(':email', $email);
        $stmtEdit->bindParam(':link', $link);
        
        if($stmtEdit->execute()){
            return true;
        } else {
           return false;
        }
}
function DeleteContact($id){
	
        global $conn;
    
        $stmtDelete = $conn->prepare("
			DELETE FROM Contact WHERE Contact_ID=:id
        ");
		$stmtDelete->bindParam(':id', $id, PDO::PARAM_INT);  

        if($stmtDelete->execute()){
            return true;
        } else {
           return false;
        }
}

function loadContacts(){
    global $conn;
    
    $returnData;
    
	$statement = $conn->prepare("SELECT * FROM Contact");
	$statement->execute();
	$rows = $statement->fetchAll();
    
    foreach($rows as $row){
        
        if($row[1] == 0) // 0 = Kontakt na osobu
        {
            $returnData .= "
                <div class='conbox'>
                    <h3>$row[2]</h3>";
            
                    if(!empty($row[3])){$returnData .="<p><i class='fas fa-phone-alt'></i> <a class='data' href='tel:$row[3]'>$row[3]</a></p>";}
                    if(!empty($row[4])){$returnData .="<p><i class='fas fa-phone-alt'></i> <a class='data' href='tel:$row[4]'>$row[4]</a></p>";}
                    if(!empty($row[5])){$returnData .="<p><i class='fas fa-envelope'></i> <a class='data' href='mailto:$row[5]'>$row[5]</a></p>";}
            
            $returnData .="
                </div>
            ";
        }
        else if ($row[1] == 1) // 1 = Kontakt Email
        {
            $returnData .= "
                <div class='conbox'>
                    <h3><i class='fas fa-envelope' style='font-size: 30px;'></i></h3>
                    <p><a class='data' href='mailto:$row[5]'>$row[5]</a></p>
                </div>
            ";
        } else{
            
            $icon;
            switch ($row[1]) {
                    
                case 2: //FB
                    $icon = "fab fa-facebook-square";
                    break;
                case 3:  //IG
                    $icon = "fab fa-instagram";
                    break;
                case 4: //YT
                    $icon = "fab fa-youtube";
                    break;
            }
            
            $returnData .= "
                <div class='conbox'>
                    <h3><i class='$icon' style='font-size: 30px;'></i></h3>
                    <p><a class='data' href='$row[6]'>$row[2]</a></p>
                </div>
            ";
        }
    }

    return $returnData;
}
?>
