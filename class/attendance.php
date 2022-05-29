<?php

function CreateAttendance($tid, $uid, $type, $reason){
	
        global $conn;
    
        $stmtCAttendance= $conn->prepare("
            INSERT INTO Attendance (Attendance_Traning, Attendance_User, Attendance_Type, Attendance_Reason)
            VALUES (:traning, :user, :type, :reason)
        ");
    
		$stmtCAttendance->bindParam(':traning', $tid);
        $stmtCAttendance->bindParam(':user', $uid);
		$stmtCAttendance->bindParam(':type', $type);
		$stmtCAttendance->bindParam(':reason', $reason);
        
        if($stmtCAttendance->execute()){
            return true;
        } else {
           return false;
        }
}
function SelectAttendance($tid, $uid){
	
        global $conn;
    
        $stmtSAttendance= $conn->prepare("
			SELECT Attendance_Type FROM Attendance WHERE Attendance_Traning =:tid AND Attendance_User=:uid;
        ");
    
		$stmtSAttendance->bindParam(':tid', $tid);
        $stmtSAttendance->bindParam(':uid', $uid);

        
        if($stmtSAttendance->execute()){
            return $stmtSAttendance->fetch();
        } else {
           return false;
        }
}
function SelectAttendanceTrening($tid, $type){
	
        global $conn;
    
        $stmtSUAttendance= $conn->prepare("
			SELECT Users.User_FirstName, Users.User_LastName, Attendance.Attendance_Reason
			FROM Attendance
			INNER JOIN Users
			ON Attendance.Attendance_User = Users.User_ID
			WHERE Attendance.Attendance_Traning=:tid AND Attendance.Attendance_Type=:type;
        ");
    
		$stmtSUAttendance->bindParam(':tid', $tid);
       $stmtSUAttendance->bindParam(':type', $type);

        
        if($stmtSUAttendance->execute()){
            return $stmtSUAttendance->fetchAll();
        } else {
           return false;
        }
}
function DeleteAttendance($tid, $uid){
	
        global $conn;
    
        $stmtDAttendance = $conn->prepare("
            DELETE FROM Attendance WHERE Attendance_Traning =:tid AND Attendance_User=:uid;
        ");
    
		$stmtDAttendance->bindParam(':tid', $tid);
        $stmtDAttendance->bindParam(':uid', $uid);
        
        if($stmtDAttendance->execute()){
            return true;
        } else {
           return false;
        }
}
?>