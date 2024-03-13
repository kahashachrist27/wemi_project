<?php
   //if(isset($con)){
	$brand_query = "SELECT * FROM brands";
	$run_query = mysqli_query($con,$brand_query);
	echo "
		<div class='nav nav-pills nav-stacked'>";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$bid = $row["brand_id"];
			$brand_name = $row["brand_title"]."   " ;
			echo "<span>	<a href='#' class='selectBrand' bid='$bid'>$brand_name</a>       </span>";
		}
		echo "</div>";
	}
  // }
?>