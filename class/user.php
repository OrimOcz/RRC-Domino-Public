<?php

function EditUser($fname, $lname, $nname, $birthday, $phone, $email, $job, $hobby){
		global $conn;
	   	$stmtEditUser = $conn->prepare("
		INSERT INTO UsersEdit
		(UserE_UserID, UserE_FName, UserE_LName,UserE_NName, UserE_Birthday, UserE_Email, UserE_Phone, UserE_Job, UserE_Hobby)
         VALUES 
		 (:id, :fname, :lname, :nname, :bday, :email, :phone, :job, :hobby)
			"); 
		//WHERE User_Verify IS NOT NULL
		$id = $_SESSION['UserID'];
		$stmtEditUser->bindParam(':id', $id, PDO::PARAM_INT);
		$stmtEditUser->bindParam(':fname', $fname);
		$stmtEditUser->bindParam(':lname', $lname);
		$stmtEditUser->bindParam(':nname', $nname);
		$stmtEditUser->bindParam(':bday', $birthday); 
		$stmtEditUser->bindParam(':email', $email);
		$stmtEditUser->bindParam(':phone', $phone);
		$stmtEditUser->bindParam(':job', $job); 
		$stmtEditUser->bindParam(':hobby', $hobby); 
		
	if($stmtEditUser->execute()){
		return true;
	} else{
		return false;
	}
		
}
function SelectAllEdit(){
	    global $conn;
    
        $stmtAllUsers = $conn->prepare("SELECT * FROM UsersEdit"); 
	
		if($stmtAllUsers->execute()){
			return $stmtAllUsers->fetchAll();
		} else{
			return false;
		}
}
function SelectEdit($id){
	    global $conn;
    
		$stmtSelectEdit = $conn->prepare("SELECT * FROM UsersEdit WHERE Usere_ID=:id");
		$stmtSelectEdit->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmtSelectEdit->execute()){
			return $stmtSelectEdit->fetch();
		} else{
			return false;
		}
	
}
function DeleteEdit($id){
	    global $conn;
    
		$stmtDeleteEdit = $conn->prepare("DELETE FROM UsersEdit WHERE Usere_ID=:id");
		$stmtDeleteEdit->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmtDeleteEdit->execute()){
			return true;
		} else{
			return false;
		}
	
}

function EditUserChild($userID, $ChildID){
	    global $conn;
    
        $stmtUUser = $conn->prepare("UPDATE Users SET User_Child=:child WHERE User_ID=:user"); 
	
		$stmtUUser->bindParam(':user', $userID, PDO::PARAM_INT);
		$stmtUUser->bindParam(':child', $ChildID, PDO::PARAM_INT);
	
		if($stmtUUser->execute()){
			return true;
		} else{
			return false;
		}	
}
function UpdateUser($id, $fname, $lname, $nname, $bday, $email, $phone, $job, $hobby){
	    global $conn;
    
        $stmtUUser = $conn->prepare("UPDATE Users SET User_FirstName = :fname, User_LastName = :lname, User_NickName = :nname, User_Email=:mail,User_Birthday=:bday,User_Job=:job,User_Hobby=:hobby,User_Phone=:phone WHERE User_ID= :user"); 
	
		$stmtUUser->bindParam(':fname', $fname);
		$stmtUUser->bindParam(':lname', $lname);
		$stmtUUser->bindParam(':nname', $nname);
		$stmtUUser->bindParam(':bday', $bday); 
		$stmtUUser->bindParam(':mail', $email);
		$stmtUUser->bindParam(':phone', $phone);
		$stmtUUser->bindParam(':job', $job); 
		$stmtUUser->bindParam(':hobby', $hobby); 
		$stmtUUser->bindParam(':user', $id);
	
		if($stmtUUser->execute()){
			return true;
		} else{
			return false;
		}	
}
function SelectAllUsers(){
	    global $conn;
    
        $stmtAllUsers = $conn->prepare("SELECT * FROM Users"); 
	
		if($stmtAllUsers->execute()){
			return $stmtAllUsers->fetchAll();
		} else{
			return false;
		}
    

}
function ControlUserMember($userID){
	    global $conn;
    
        $stmtControlUserMember = $conn->prepare("
		SELECT 
		DanceCategory.Category_ShortName, UsersCategory.UserC_UserID
		FROM DanceCategory
		INNER JOIN UsersCategory ON DanceCategory.Category_ID = UsersCategory.UserC_CategoryID			
		WHERE UsersCategory.UserC_UserID = :id;
		");
		$stmtControlUserMember->bindParam(':id', $userID);
		$stmtControlUserMember->execute();
		$categories = $stmtControlUserMember->fetchAll();
	
		if($stmtControlUserMember->rowCount() > 0){
			$usercat;
			foreach ($categories as $cat){
				$usercat = $usercat.', '.$cat[0];
			}
			return $usercat;
		} else{
			return false;
		}	
}
function ControlUserCoach($userID){
		global $conn;
	   	$stmtBehavior = $conn->prepare("
		SELECT * FROM UsersBehavior WHERE UserB_UserID=:id"); 
		//WHERE User_Verify IS NOT NULL
	
		$stmtBehavior->bindParam(':id', $userID, PDO::PARAM_INT); 
		$stmtBehavior->execute();

		$resultBehavior = $stmtBehavior->rowCount();
	if($resultBehavior == 1){
		return $stmtBehavior->fetch();
	} else{
		return false;
	}
		
}
function CreateVerificateCode(){
        global $conn;
    
		do{
			$code = gencode(50);
            $stmtSCode = $conn->prepare("SELECT COUNT(*) FROM Users WHERE User_VerifyCode=:code");
    
            $stmtSCode->bindParam(':code', $code);
            $resultSCode = $stmtSCode->fetch();
            
			if ($resultSCode[0] >= 1){
				$loop = true;
			} else {
				$loop = false;
			}
			
		} while ($loop);
        
        return $code;
}

function ExistUser($email){
        global $conn;
    
        $stmtSUser = $conn->prepare("SELECT COUNT(*) FROM Users WHERE User_Email=:mail");
		$stmtSUser->bindParam(':mail', $email); 
		$stmtSUser->execute();
		$resultSUser = $stmtSUser->fetch();
    
        if($resultSUser[0] >= 1){
            return true;
        } else{
            return false;
        }
}
function ControlUser($email, $psw){
        global $conn;
    
        $stmtPass = $conn->prepare("SELECT User_Password, User_ID FROM Users WHERE User_Email=:mail AND NOT User_Verify=''"); 
	
		$stmtPass->bindParam(':mail', $email); 
		$stmtPass->execute();
		$resultPass = $stmtPass->fetch();
    
        if(password_verify($psw, $resultPass[0])){
			$info = get_info_user($resultPass[1]);
			$_SESSION['UserID'] = $info[0];
			$_SESSION['FName'] = $info[1];
			$_SESSION['LName'] = $info[2];
			$_SESSION['NName'] = $info[3];
			$_SESSION['Mail'] = $info[4];
			$_SESSION['Phone'] = $info[6];
			$_SESSION['ChildID'] = $info['User_Child'];
            return true;
        } else{
            return false;
        }
}
function get_info_user($id){
		global $conn;
	
        $stmtUser = $conn->prepare("SELECT * FROM Users WHERE User_ID=:id"); 
		//WHERE User_Verify IS NOT NULL
	
		$stmtUser->bindParam(':id', $id, PDO::PARAM_INT); 
		$stmtUser->execute();
		$resultUser = $stmtUser->fetch();
		
		return $resultUser;
}
function CreateNewUser($fname, $lname, $nick, $email, $phone, $pass, $news, $trenigs, $events){
        global $conn;
    
        $code = CreateVerificateCode();
		$name = $fname ." ". $lname;
    
        $stmtIUser = $conn->prepare("
            INSERT INTO Users (User_FirstName, User_LastName, User_NickName, User_Email, User_Phone, User_Password, User_VerifyCode)
            VALUES (:fname, :lname, :nick, :mail, :phone, :pass, :code)
        ");
    
		$stmtIUser->bindParam(':fname', $fname);
        $stmtIUser->bindParam(':lname', $lname);
        $stmtIUser->bindParam(':nick', $nick);
        $stmtIUser->bindParam(':mail', $email);
        $stmtIUser->bindParam(':phone', $phone);
        $stmtIUser->bindParam(':pass', $pass);
        $stmtIUser->bindParam(':code', $code);
        
        if($stmtIUser->execute()){
			
			$userID = $conn->lastInsertId();;
			
			if($news == true){
				CreateSubscribe(1,$userID);
			}
			if($trenigs == true){
				CreateSubscribe(2,$userID);
			}
			if($events == true){
				CreateSubscribe(3,$userID);
			}
			
			SendEmail(1, $email, $name, 0,0 ,$code);
            return true;
        } else {
           return false;
        }

}
function userAdmin($id){
		global $conn;
	   	$stmtBehavior = $conn->prepare("SELECT UserB_UserID FROM UsersBehavior WHERE UserB_UserID=:id AND UserB_Administrator=1"); 
		//WHERE User_Verify IS NOT NULL
	
		$stmtBehavior->bindParam(':id', $id, PDO::PARAM_INT); 
		$stmtBehavior->execute();
		
		$resultBehavior = $stmtBehavior->rowCount();
	if($resultBehavior == '1'){
		return true;
	} else{
		return false;
	}
		
}


// Behavior
function CreateBehavior($id, $admin, $leader, $coach, $jud, $dep, $visor, $audit){
		global $conn;
	   	$stmtBehavior = $conn->prepare("
		INSERT INTO UsersBehavior 
		(UserB_UserID, UserB_Administrator, UserB_Leader,UserB_TypeCoach,UserB_Judge, UserB_DeputyChairman, UserB_SuperVisor, UserB_AuditCommittee)
         VALUES 
		 (:id, :admin, :leader, :coach, :jud, :dep, :vis, :audit)
			"); 
		//WHERE User_Verify IS NOT NULL
		$stmtBehavior->bindParam(':id', $id, PDO::PARAM_INT);
		$stmtBehavior->bindParam(':admin', $admin, PDO::PARAM_INT);
		$stmtBehavior->bindParam(':leader', $leader, PDO::PARAM_INT);
		$stmtBehavior->bindParam(':coach', $coach, PDO::PARAM_INT);
		$stmtBehavior->bindParam(':jud', $jud, PDO::PARAM_INT);
		$stmtBehavior->bindParam(':dep', $dep, PDO::PARAM_INT); 
		$stmtBehavior->bindParam(':vis', $visor, PDO::PARAM_INT);
		$stmtBehavior->bindParam(':audit', $audit, PDO::PARAM_INT); 
		
	if($stmtBehavior->execute()){
		return true;
	} else{
		return false;
	}
		
}
function EditBehavior($id, $admin, $leader, $coach, $jud, $dep, $visor, $audit){
		global $conn;
	   	$stmtBehavior2 = $conn->prepare("
		UPDATE UsersBehavior SET
		UserB_Administrator=:admin,UserB_Leader=:leader,UserB_TypeCoach=:coach,UserB_Judge=:jud, UserB_DeputyChairman=:dep, UserB_SuperVisor=:vis, UserB_AuditCommittee=:audit
		WHERE UserB_ID=:id
			;"); 
		//WHERE User_Verify IS NOT NULL
		$stmtBehavior2->bindParam(':id', $id, PDO::PARAM_INT);
		$stmtBehavior2->bindParam(':admin', $admin, PDO::PARAM_INT);
		$stmtBehavior2->bindParam(':leader', $leader, PDO::PARAM_INT);
		$stmtBehavior2->bindParam(':coach', $coach, PDO::PARAM_INT);
		$stmtBehavior2->bindParam(':jud', $jud, PDO::PARAM_INT);
		$stmtBehavior2->bindParam(':dep', $dep, PDO::PARAM_INT); 
		$stmtBehavior2->bindParam(':vis', $visor, PDO::PARAM_INT);
		$stmtBehavior2->bindParam(':audit', $audit, PDO::PARAM_INT); 
		
	if($stmtBehavior2->execute()){
		return true;
	} else{
		return false;
	}
		
}
function SelectAllStaff(){
		global $conn;
	   	$stmtStaff = $conn->prepare("
		SELECT Users.User_FirstName, Users.User_LastName, 
		UsersBehavior.UserB_Administrator,UsersBehavior.UserB_TypeCoach,UsersBehavior.UserB_Judge,UsersBehavior.UserB_DeputyChairman	,UsersBehavior.UserB_SuperVisor,UsersBehavior.UserB_AuditCommittee, UsersBehavior.UserB_ID, UsersBehavior.UserB_Leader
		FROM UsersBehavior
		INNER JOIN Users ON UsersBehavior.UserB_UserID = Users.User_ID;
		"); 
		//WHERE User_Verify IS NOT NULL
		
	if($stmtStaff->execute()){
		return $stmtStaff->fetchAll();
	} else{
		return false;
	}
		
}
function DeleteStaff($id){
	global $conn;
	
	$stmtDeleteUser = $conn->prepare("DELETE FROM UsersBehavior WHERE UserB_ID=:id");
	$stmtDeleteUser->bindParam(':id', $id, PDO::PARAM_INT);
	
	if($stmtDeleteUser->execute()){
		return true;
	} else{
		return false;
	}
	
}

function userMember($id){
		global $conn;
	   	$stmtBehavior = $conn->prepare("SELECT UserB_UserID FROM UsersBehavior WHERE UserB_UserID=:id AND UserB_Administrator=1"); 
		//WHERE User_Verify IS NOT NULL
	
		$stmtBehavior->bindParam(':id', $id, PDO::PARAM_INT); 
		$stmtBehavior->execute();
		
		$resultBehavior = $stmtBehavior->rowCount();
	if($resultBehavior == '1'){
		return true;
	} else{
		return false;
	}
		
}
function userSetProfilePhoto($id, $photo){
		global $conn;
	   	$stmtProfilePhoto = $conn->prepare("UPDATE Users SET User_Photo=:photo WHERE User_ID=:id"); 
		//WHERE User_Verify IS NOT NULL
		$stmtProfilePhoto->bindParam(':id', $id, PDO::PARAM_INT); 
		$stmtProfilePhoto->bindParam(':photo', $photo); 
		
	if($stmtProfilePhoto->execute()){
		return true;
	} else{
		return false;
	}
		
}
function Verify($user, $code){
		global $conn;
	   	$stmtGetEmail = $conn->prepare("SELECT User_Email, User_FirstName, User_LastName FROM Users WHERE User_VerifyCode=:code"); 
		//WHERE User_Verify IS NOT NULL
	
		$stmtGetEmail->bindParam(':code', $code); 
		$stmtGetEmail->execute();
		$resultEmail = $stmtGetEmail->fetch();
		$name = $resultEmail[1] .' '. $resultEmail[2];
		$date = date('Y-m-d H:i:s');
				
		if(md5($resultEmail[0]) == $user){
				$stmtVerifyUser = $conn->prepare("UPDATE Users SET User_VerifyCode='', User_Verify=:date WHERE User_VerifyCode=:code AND User_Email=:email"); 
				$stmtVerifyUser->bindParam(':date', $date); 
				$stmtVerifyUser->bindParam(':code', $code); 
				$stmtVerifyUser->bindParam(':email', $resultEmail[0]); 
				
				if($stmtVerifyUser->execute()){
					SendEmail(2, $resultEmail[0], $name, 0,0 ,$code);
					return true;
				} else{
					return false;
				}
		} else{
			return false;
		}
}
function CreateSubscribe($t, $id){
	    $stmtSub = $conn->prepare("
            INSERT INTO Subscribe (Sub_Type, Sub_User)
            VALUES (:type, :userID)
        ");
    
		$stmtSub->bindParam(':type', $t);
        $stmtSub->bindParam(':userID', $id, PDO::PARAM_INT);
		$stmtSub->execute();
}
function DeleteUser($id){
	global $conn;
	
	$stmtDeleteUser = $conn->prepare("DELETE FROM Users WHERE User_ID=:id");
	$stmtDeleteUser->bindParam(':id', $id, PDO::PARAM_INT);
	
	if($stmtDeleteUser->execute()){
		return true;
	} else{
		return false;
	}
	
}
function log_out(){
	unset($_SESSION['UserID']);
	unset($_SESSION['FName']);
	unset($_SESSION['LName']);
	unset($_SESSION['NName']);
	unset($_SESSION['Mail']);
	unset($_SESSION['Phone']);
}

//FORGOT PASSWORD
function ForgotPass($email){
		global $conn;
		$date = date('Y-m-d H:i:s');
	
	   	$stmtGetEmail2 = $conn->prepare("SELECT User_FirstName, User_LastName FROM Users WHERE User_Email=:email AND NOT User_Verify=''"); 
		//WHERE User_Verify IS NOT NULL
	
		$stmtGetEmail2->bindParam(':email', $email); 
		$stmtGetEmail2->execute();
	
		if($stmtGetEmail2->rowCount() == 1){
			$resultEmail = $stmtGetEmail2->fetchAll();
			$code = gencode(6);
			$stmtChanceCode = $conn->prepare("
            	UPDATE Users SET User_ChangeCode=:code, User_ChangeTime=:datetime WHERE User_Email=:email
        	");
    
			$stmtChanceCode->bindParam(':code', $code);
			$stmtChanceCode->bindParam(':datetime', $date);
			$stmtChanceCode->bindParam(':email', $email);
			$stmtChanceCode->execute();
			SendEmail(3, $email, $resultEmail[0].' '.$resultEmail[1], 0, 0,$code);
			return true;
			
		} else{
			return false;
		}
}
function VerifyCode($email, $code){
		global $conn;
		$datetime = date('Y-m-d H:i:s');
	
	   	$stmtGetInformationCode = $conn->prepare("SELECT User_Email, User_ChangeTime FROM Users WHERE User_ChangeCode=:code"); 
		//WHERE User_Verify IS NOT NULL
		
		$stmtGetInformationCode->bindParam(':code', $code);
		$stmtGetInformationCode->execute();
		$dataSelect = $stmtGetInformationCode->fetch();

	$time = strtotime('+30 minutes',strtotime($dataSelect[1]));
		if((md5($dataSelect['User_Email']) == $email) && ($time  >= strtotime($datetime))){
			return true;
		} else {
			return false;
		}

}
function ChangePass($pass, $email, $code){
	
		global $conn;
		$datetime = date('Y-m-d H:i:s');
	
	   	$stmtGetInformationPass = $conn->prepare("SELECT User_Email, User_ChangeTime, User_FirstName, User_LastName FROM Users WHERE User_ChangeCode=:code");
		
		$stmtGetInformationPass->bindParam(':code', $code);
		$stmtGetInformationPass->execute();
	
		$dataSelectChange = $stmtGetInformationPass->fetch();
	

		$time = strtotime('+30 minutes',strtotime($dataSelectChange[1]));
		$sqlemial=$dataSelectChange['User_Email'];

		echo strtotime($dataSelectChange[1]).' - '.strtotime($datetime). '<br>';
	
		if((md5($sqlemial) == $email) && ($time  >= strtotime($datetime))){
			$stmtChangePass= $conn->prepare("
            	UPDATE Users SET User_ChangeCode=:code, User_ChangeTime=:datetime, User_Password=:pass WHERE User_ChangeCode=:code2
        	");
			$nonvalue = '';
			$stmtChangePass->bindParam(':code', $nonvalue);
			$stmtChangePass->bindParam(':datetime', $nonvalue);
			$stmtChangePass->bindParam(':pass', $pass);
			$stmtChangePass->bindParam(':code2', $code);
			$send = $stmtChangePass->execute();
			
			if($send){
				SendEmail(4, $sqlemial, $dataSelectChange[2].' '.$dataSelectChange[3], 0, 0,0);
				return true;
			}
		} else {
			return false;
		}
	
}
?>
