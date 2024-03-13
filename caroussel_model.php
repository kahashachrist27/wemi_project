<?php
	//if(isset($_POST["get_caroussel"])){
	include_once "db.php";
	$sql = "SELECT t.*
			FROM caroussels as t
			WHERE t.etat = 1;
			ORDER BY RAND DESC 
			";
		$pre = $bdd->prepare($sql);
	    $pre->execute();
	    $data = $pre->fetchAll();

//Modifie  par DMK
	if(sizeof($data) > 0 ){
		$caroussel_images = array();
		$caroussel_title = array();
		$brand_id = array();
		foreach ($data as $row) {
			$caroussel_images[]    = "caroussel_images/".$row['caroussel_image'];
			$caroussel_title[]   = $row['caroussel_title'];
			$brand_id[]   = $row['brand_id'];
		}
         for($i=0;$i<sizeof($caroussel_images);$i++){
			 $caroussel_image[$i]=isset($caroussel_images[$i])? $caroussel_images[$i] : null;
			 $caroussel_title[$i]=isset($caroussel_title[$i])? $caroussel_title[$i] : "";
			 $brand_id[$i]=isset($brand_id[$i])? $brand_id[$i] : 0;
			 
		 }
		echo caroousel($caroussel_image,$caroussel_title,$brand_id,true);
	}
//}
?>