<?php

function CreateAlbum($name, $date, $photo, $link){
	
        global $conn;
    
        $stmtCAlbum= $conn->prepare("
            INSERT INTO GalleryAlbum(GalleryA_Name, GalleryA_Date, GalleryA_Photo, GalleryA_Link)
            VALUES (:name, :date, :photo, :link)
        ");
    
		$stmtCAlbum->bindParam(':name', $name);
        $stmtCAlbum->bindParam(':date', $date);
		$stmtCAlbum->bindParam(':photo', $photo);
		$stmtCAlbum->bindParam(':link', $link);
        
        if($stmtCAlbum->execute()){
            return true;
        } else {
           return false;
        }
}
function SelectAllAlbums(){
	    global $conn;
    
        $stmtAllAlbums = $conn->prepare("SELECT * FROM GalleryAlbum ORDER BY GalleryA_Date DESC"); 

		if($stmtAllAlbums->execute()){
			return $stmtAllAlbums->fetchAll();
		} else{
			return false;
		}
    

}
function SelectAlbumID($id){
	    global $conn;
    
        $stmtSelect = $conn->prepare("SELECT * FROM GalleryAlbum WHERE GalleryA_ID=:id"); 
		$stmtSelect->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmtSelect->execute()){
			return $stmtSelect->fetch();
		} else{
			return false;
		}
}
function SelectAllAlbumsNoLink(){
	    global $conn;
    
        $stmtPlan = $conn->prepare("SELECT * FROM GalleryAlbum WHERE GalleryA_Link = ''"); 
		$stmtPlan->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmtPlan->execute()){
			return $stmtPlan->fetchAll();
		} else{
			return false;
		}
}
function DeleteAlbum($id){
	global $conn;
	
	$stmtDelete = $conn->prepare("DELETE FROM GalleryAlbum WHERE GalleryA_ID=:id");
	$stmtDelete->bindParam(':id', $id, PDO::PARAM_INT);
	
	if(($stmtDelete->execute())){
		return true;
	} else{
		return false;
	}
	
}
function EditAlbum($id,$name, $date, $photo, $link){
	global $conn;
	
	$stmtUpdate = $conn->prepare('UPDATE GalleryAlbum SET GalleryA_Name=:name, GalleryA_Date=:date, GalleryA_Link=:link, GalleryA_Photo=:photo WHERE GalleryA_ID=:id');
	$stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
	$stmtUpdate->bindParam(':name', $name);
    $stmtUpdate->bindParam(':date', $date);
	$stmtUpdate->bindParam(':photo', $photo);
	$stmtUpdate->bindParam(':link', $link);
	
	if($stmtUpdate->execute()){
		return true;
	} else{
		return false;
	}
	
}
function SelectPhotosByAlbum($id){
	    global $conn;
    
        $stmtPhoto = $conn->prepare("SELECT * FROM GalleryPhotos WHERE GalleryP_Album = :id"); 
		$stmtPhoto->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmtPhoto->execute()){
			return $stmtPhoto->fetchAll();
		} else{
			return false;
		}
}
function CreatePhoto($album,$file){
	
        global $conn;
    
        $stmtCPhoto= $conn->prepare("
            INSERT INTO GalleryPhotos (GalleryP_Album, GalleryP_Photo)
            VALUES (:album, :photo)
        ");
    
		$stmtCPhoto->bindParam(':album', $album);
        $stmtCPhoto->bindParam(':photo', $file);
        
        if($stmtCPhoto->execute()){
            return true;
        } else {
           return false;
        }
}
function DeletePhoto($id){
	global $conn;
	
	$stmtDelete = $conn->prepare("DELETE FROM GalleryPhotos WHERE GalleryP_ID=:id");
	$stmtDelete->bindParam(':id', $id, PDO::PARAM_INT);
	
	if(($stmtDelete->execute())){
		return true;
	} else{
		return false;
	}
	
}
?>