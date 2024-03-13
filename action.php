
<?php
//include_once 'config/constants.php';
session_start();
$ip_add = getenv("REMOTE_ADDR");
$http_ref = getenv("HTTP_REFERER");
$HTTP_REFERER_TAB = explode("?", $http_ref);
// var_dump($HTTP_REFERER_TAB); die();
$HTTP_REFERER = $HTTP_REFERER_TAB[0];

include "db.php";
// die(var_dump(LIMIT_PAR_PAGE));
if(isset($_POST["category"])){
	$category_query = "SELECT * FROM categories
					INNER JOIN products ON categories.cat_id = products.product_cat
					GROUP BY cat_id
	";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	echo "
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
			$sql ="SELECT * FROM sous_categories
					INNER JOIN products 
					ON sous_categories.sous_cat_id = products.product_sous_cat
					WHERE products.product_cat = $cid
					GROUP BY sous_cat_id
			";
			$pre = $bdd->prepare($sql);
		    $pre->execute();
		    $data = $pre->fetchAll();
		    
			echo "
				<li class='nav-item dropdown'>
	                <a class='nav-link category' href ='#souscat$cid' role='button';
	                 id='dropdown_$cid' data-toggle='collapse' data-parent='#get_category' aria-haspopup='true' aria-expanded='false' cid='$cid'>$cat_name</a>";
	                if(sizeof($data) > 0 ){

	        // echo    "<ul id='souscat$cid' class='collapse' data-parent='#get_category' aria-labelledby='dropdown_$cid'>";
	        echo    "<ul id='souscat$cid' class='collapse' aria-labelledby='dropdown_$cid'>";
	        			foreach ($data as $row) {
	        				$bid = $row["sous_cat_id"];
							$brand_name = $row["sous_cat_title"];
	        // echo          "<li><a class='dropdown-item selectSousCat' href='#' scid='$bid'>$brand_name</a></li>";
	        echo          "<li><a class='dropdown-item' href='search.php?s=$brand_name&isscat=$bid'>$brand_name</a></li>";
	                }
	        echo    "</ul>";
	                }
			
		}
	}
}
if(isset($_POST["brand"])){
	$brand_query = "SELECT * FROM brands";
	$run_query = mysqli_query($con,$brand_query);
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Marques</h4></a></li>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$bid = $row["brand_id"];
			$brand_name = $row["brand_title"];
			echo "
					<li><a href='#' class='selectBrand' bid='$bid'>$brand_name</a></li>
			";
		}
		echo "</div>";
	}
}
//DMK
if(isset($_POST["nav_marque_list"])){
	$brand_query = "SELECT * FROM brands";
	$run_query = mysqli_query($con,$brand_query);
	echo "
		<div >
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$bid = $row["brand_id"];
			$brand_name = $row["brand_title"]." "." "." ";
			echo "
					<span><a href='#get_product' class='nav_marque' mid='$bid'>$brand_name</a></span>
			";
		}
		echo "</div>";
	}
}

if(isset($_POST["page"])){
	$sql = "SELECT * FROM products";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/9);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#' page='$i' id='page'>$i</a></li>
		";
	}
}

if(isset($_POST["getProduct"])){
	$tab = explode("?", $_POST["url"]);
	$tab_url_get = $tab;
	// var_dump($tab); die();
	$search = '';
	foreach ($tab_url_get as $v) {
		$value = explode("=", $v);
		if ($value[0] == "pageno") {
			$_GET['pageno'] = $value[1];
		}
	}
	$str_search = "?".$search;
	if (isset($_GET['pageno'])) {
		$pageno = $_GET['pageno'];
	} else {
		$pageno = 1;
	}
                            // Formula for pagination
	$no_of_records_per_page = LIMIT_PAR_PAGE;
	$offset = ($pageno - 1) * $no_of_records_per_page;
                            // Getting total number of pages
	$total_pages_sql = "SELECT COUNT(*) FROM products";
	$pre = $bdd->prepare($total_pages_sql);
    $pre->execute(array("search"=>"%".$search."%"));
	$result = $pre->fetchAll();
	
	$total_rows = current($result)[0];
	$total_pages = ceil($total_rows / $no_of_records_per_page);

	$sql = "SELECT t.*, t1.brand_title, t2.cat_title 
			FROM products as t
			INNER JOIN brands as t1 ON t1.brand_id =  t.product_brand
			INNER JOIN categories as t2 ON t2.cat_id =  t.product_cat
			 ORDER BY product_id DESC LIMIT $offset, $no_of_records_per_page
			";
		$pre = $bdd->prepare($sql);
	    $pre->execute();
	    $data = $pre->fetchAll();


	if(sizeof($data) > 0 ){
		foreach ($data as $row) {
			$pro_id    = $row['product_id'];
			$pro_shop  = $row['product_shop'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			$product_cat = $row['cat_title'];
	    	$product_brand = $row['brand_title'];
			
			echo "
				<a href='".BASE_URL."wemi_project/boutique-detail.php?product_shop=$pro_shop' >
				<div class='d-block d-md-flex podcast-entry bg-white mb-5' data-aos='fade-up'>
					<div class='image' style='background-image: url(\"product_images/$pro_image\");'>
					
					</div>
					<div class='text'>

						<h3 class='font-weight-light'>$pro_title</h3>
						<div class='text-white mb-3'>

							<span class='text-black-opacity-05'><small>$product_cat <span class='sep'>/</span> $product_brand <span class='sep'></span></small></span>
						</div>
						<div class='player'>
						<h4>".CURRENCY." $pro_price.00</h4>
						</div>

						</div>
						<div class='player'>
							<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs' ><i class='bi bi-shop'></i> Ajouter au panier</button>
							</div>

						</div>
					</div>
				</a>";
		}
	?>
	</div>
	<?php
		pagination($total_pages, $pageno, $str_search, $HTTP_REFERER);
	}
}
//Condition pour afficher un seul produit
if(isset($_POST["getProduct_one"])){
	$limit = 9;
	$tab = explode("=", $_POST["url"]);
	if (isset($tab[1])) {
		
		$id = intval($tab[1]);
		// var_dump($id);
		$url = $_SERVER['HTTP_REFERER'];
		

		$sql = "SELECT t.*, t1.brand_title, t2.cat_title, t3.shop_title 
			FROM products as t
			INNER JOIN brands as t1 ON t1.brand_id =  t.product_brand
			INNER JOIN categories as t2 ON t2.cat_id =  t.product_cat
			INNER JOIN shops as t3 ON t3.shop_id =  t.product_shop
			 WHERE t.product_id='$id'
			";
		$pre = $bdd->prepare($sql);
	    $pre->execute();
	    $data = $pre->fetchAll();

	    if(sizeof($data) > 0 ){
	    	foreach ($data as $row) {
	    		$pro_id    = $row['product_id'];
				$pro_shop  = $row['product_shop'];
				$pro_cat   = $row['product_cat'];
				$pro_brand = $row['product_brand'];
				$pro_title = $row['product_title'];
				$pro_price = $row['product_price'];
				$pro_image = $row['product_image'];
				$product_cat = $row['cat_title'];
		    	$product_brand = $row['brand_title'];
		    	$pro_qty = $row['product_qty'];

	    		echo "

				<a href='".BASE_URL."wemi_project/boutique-detail.php?product_shop=$pro_shop' >
                    <div class='d-block d-md-flex podcast-entry bg-white mb-5' data-aos='fade-up'>
                        <div class='image' style='background-image: url(\"product_images/$pro_image\");'>
                    
                        </div>
                        <div class='text'>
                        	
                            <h3 class='font-weight-light'>$pro_title</h3>
                                <div class='text-white mb-3'>

                                    <span class='text-black-opacity-05'><small>$product_cat <span class='sep'>/</span>$product_brand<span class='sep'></span></small></span>
                                </div>
                                <div class='player'>
                                    <h4>".CURRENCY." $pro_price.00</h4>
                                </div>
                                <div class='text-black-opacity-05 mb-3'>
                                    <h6>Quantite restante en stock : $pro_qty</h6>
                                </div>
                                <div class='player'>
                                    <button pid='$pro_id style='float:right;' id='product' class='btn btn-danger btn-xs' ><span class='fa fa-user'></span> Ajouter au panier</button>
                                    <button pid=$pro_id style='float:right;' id='like' class='btn btn-success btn-xs'> <span class='fa fa-ok'> Like</span></button>
                                </div>
                        </div>
                    </div>

				</a>
	    		";
	    	}
	    }else{
	    	echo flashInfo("<h1>Erreur:</p> Produit non trouvé</h1>", "dark");
	    }
	}else{
		echo flashInfo("<h1>Erreur 404</p> Erreur de l'url</h1>", "danger");
	}
}

if(isset($_POST["get_product_search"]) || isset($_GET["get_product"])){
	$tab = explode("?", $_POST["url"]);
	$tab_url_get = isset($tab[1])? explode("&", $tab[1]) : array();
	$search = '';
	$isscat = false;
	$id_cat_s = 0;
	// var_dump($tab_url_get);
	foreach ($tab_url_get as $v) {
		$value = explode("=", $v);
		if ($value[0] == "s") {
			$search = isset($value[1])?$value[1]:'';
		}
		if ($value[0] == "isscat") {
			$isscat = true;
			$id_cat_s = floatval(isset($value[1])?$value[1]:0);
		}

		if ($value[0] == "pageno") {
			$_GET['pageno'] = isset($value[1])?$value[1]:'';
		}
	}
	$str_search = "?s=".$search."&";
	if (isset($_GET['pageno'])) {
		$pageno = $_GET['pageno'];
	} else {
		$pageno = 1;
	}
                            // Formula for pagination
	$no_of_records_per_page = LIMIT_PAR_PAGE;
	$offset = ($pageno - 1) * $no_of_records_per_page;
                            // Getting total number of pages
	$min_sql = "";
	if ($isscat) {
		$min_sql = "AND t3.sous_cat_id='$id_cat_s'";
	}
	$total_pages_sql = "SELECT COUNT(*) FROM products as t
			INNER JOIN brands as t1 ON t1.brand_id =  t.product_brand
			INNER JOIN categories as t2 ON t2.cat_id =  t.product_cat
			INNER JOIN sous_categories as t3 ON t3.sous_cat_id =  t.product_sous_cat
			WHERE (product_title LIKE :search OR product_price LIKE :search OR product_desc LIKE :search OR product_keywords LIKE :search  OR brand_title LIKE :search OR cat_title LIKE :search AND 1=1 $min_sql)";
	$pre = $bdd->prepare($total_pages_sql);
    $pre->execute(array("search"=>"%".$search."%"));
	$result = $pre->fetchAll();
	
	$total_rows = current($result)[0];
	$total_pages = ceil($total_rows / $no_of_records_per_page);

	$sql = "SELECT t.*, t1.brand_title, t2.cat_title 
			FROM products as t
			INNER JOIN brands as t1 ON t1.brand_id =  t.product_brand
			INNER JOIN categories as t2 ON t2.cat_id =  t.product_cat
			INNER JOIN sous_categories as t3 ON t3.sous_cat_id =  t.product_sous_cat
			WHERE (product_title LIKE :search OR product_price LIKE :search OR product_desc LIKE :search OR product_keywords LIKE :search  OR brand_title LIKE :search OR cat_title LIKE :search ) AND 1=1 $min_sql  ORDER BY RAND()  LIMIT $offset, $no_of_records_per_page 
			";
			/*SELECT * FROM sous_categories
					INNER JOIN products 
					ON sous_categories.sous_cat_id = products.product_sous_cat
					WHERE products.product_cat = $cid
					GROUP BY sous_cat_id*/

	$pre = $bdd->prepare($sql);
    $pre->execute(array("search"=>"%".$search."%"));
	$data = $pre->fetchAll();
	if(sizeof($data) > 0 ){
		foreach ($data as $row) {
			$pro_id    = $row['product_id'];
			$pro_shop  = $row['product_shop'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			$product_cat = $row['cat_title'];
	    	$product_brand = $row['brand_title'];
			echo "
				<a href='".BASE_URL."wemi_project/boutique-detail.php?product_shop=$pro_shop'>
				<div class='d-block d-md-flex podcast-entry bg-white mb-5' data-aos='fade-up'>
					<div class='image' style='background-image: url(\"product_images/$pro_image\");'>
					
					</div>
					<div class='text'>

						<h3 class='font-weight-light'>$pro_title</h3>
						<div class='text-white mb-3'>

							<span class='text-black-opacity-05'><small>$product_cat <span class='sep'>/</span> $product_brand <span class='sep'></span></small></span>
						</div>
						<div class='player'>
						<h4>".CURRENCY." $pro_price.00</h4>
						</div>

						</div>
						<div class='player'>
						<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Ajouter au panier</button>
							
							</div>

						</div>
					</div>
				</a>";
		
		}
	?>
	</div>
	
	<?php
	pagination($total_pages, $pageno, $str_search, $HTTP_REFERER);
	}else{
		echo "<div class='d-block d-md-flex podcast-entry bg-white mb-5' data-aos='fade-up'>
					<div class='image' style='background-image: url(\"images/icons/warning.png\"); min-height:300px'>
					
					</div>
					<div class='text text-center'>
					 	<h1>Thème de recherche introuvable</h1>
					 	<p><a href='index.php' class='btn btn-primary text-white'>Continuer la navigation</a></p>
					</div>
			</div>
		";
	}
}

if(isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"])|| isset($_POST["nav_marque"]) || isset($_POST["selectSousCat"])|| isset($_POST["search"])){

	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM products as t 
		INNER JOIN brands as t1 ON t1.brand_id =  t.product_brand
			INNER JOIN categories as t2 ON t2.cat_id =  t.product_cat
		WHERE product_cat = '$id'";
	}else if(isset($_POST["selectBrand"])){
		$id = $_POST["brand_id"];
		$sql = "SELECT * FROM products as t 
		INNER JOIN brands as t1 ON t1.brand_id =  t.product_brand
			INNER JOIN categories as t2 ON t2.cat_id =  t.product_cat
		WHERE product_brand = '$id'";
	}else if(isset($_POST["nav_marque"])){//DMK
		
		$id = $_POST["marque_id"];
		$sql = "SELECT * FROM products as t 
		INNER JOIN brands as t1 ON t1.brand_id =  t.product_brand
			INNER JOIN categories as t2 ON t2.cat_id =  t.product_cat
		WHERE product_brand = '$id'";
	}else if(isset($_POST["selectSousCat"])){//DMK
		$id = $_POST["sous_cat_id"];
		$sql = "SELECT * FROM products as t 
		INNER JOIN sous_categories as t1 ON t1.sous_cat_id =  t.product_sous_cat
			INNER JOIN categories as t2 ON t2.cat_id =  t.product_cat INNER JOIN brands ON brands.brand_id =t.product_brand
		WHERE product_sous_cat = '$id'";
	}else {
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM products as t 
		INNER JOIN brands as t1 ON t1.brand_id =  t.product_brand
			INNER JOIN categories as t2 ON t2.cat_id =  t.product_cat
		WHERE product_keywords LIKE '%$keyword%'";
	}
	
	$run_query = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			$product_cat = $row['cat_title'];
	    	$product_brand = $row['brand_title'];
			
			echo "
				<a href='".BASE_URL."product.php?id=$pro_id'>
				<div class='d-block d-md-flex podcast-entry bg-white mb-5' data-aos='fade-up'>
					<div class='image' style='background-image: url(\"product_images/$pro_image\");'>
					
					</div>
					<div class='text'>

						<h3 class='font-weight-light'>$pro_title</h3>
						<div class='text-white mb-3'>

							<span class='text-black-opacity-05'><small>$product_cat <span class='sep'>/</span> $product_brand <span class='sep'></span></small></span>
						</div>
						<div class='player'>
						<h4>".CURRENCY." $pro_price.00</h4>
						</div>

						</div>
						<div class='player'>
							<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs' >Ajouter au panier</button>
							</div>

						</div>
					</div>
				</a>";
			/*echo "
			<a href='".BASE_URL."product.php?id=$pro_id'>
				<div class='col-6 col-sm-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<img src='product_images/$pro_image' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$.$pro_price.00
									<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Ajouter au panier</button>
								</div>
							</div>
						</div>	
				</a>	
			";*/
		}
	}
	


	if(isset($_POST["addToCart"])){
		$p_id = $_POST["proId"];

		if(isset($_SESSION["uid"])){

		$user_id = $_SESSION["uid"];

		$sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
		$run_query = mysqli_query($con,$sql);
		$count = mysqli_num_rows($run_query);
		if($count > 0){
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Le produit est bien ajouté dans votre pannier, continuer votre shopping...!</b>
				</div>
			";//not in video
		} else {
			$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`) 
			VALUES ('$p_id','$ip_add','$user_id','1')";
			if(mysqli_query($con,$sql)){
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Le produit est bien ajouté..!</b>
					</div>
				";
			}
		}
		}else{
			$sql = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
			$query = mysqli_query($con,$sql);
			if (mysqli_num_rows($query) > 0) {
				echo "
					<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Le produit est bien ajouté dans votre pannier, continuer votre shopping...!</b>
					</div>";
					exit();
			}
			$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`) 
			VALUES ('$p_id','$ip_add','-1','1')";
			if (mysqli_query($con,$sql)) {
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Votre produit est ajouté avec succès..!</b>
					</div>
				";
				exit();
			}
			
		}
	}

//Count User cart item
if (isset($_POST["count_item"])) {
	//When user is logged in then we will count number of item in cart by using user session id
	if (isset($_SESSION["uid"])) {
		$uid = $_SESSION["uid"];
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $uid";
	}else{
		//When user is not logged in then we will count number of item in cart by using users unique ip address
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = '$ip_add' AND user_id < 0";
	}
	
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_item"];
	exit();
}
//Count User cart item

//Get Cart Item From Database to Dropdown menu
if (isset($_POST["Common"])) {

	if (isset($_SESSION["uid"])) {
		//When user is logged in this query will execute
		$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
	}else{
		//When user is not logged in this query will execute
		$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
	}
	$query = mysqli_query($con,$sql);
	if (isset($_POST["getCartItem"])) {
		//display cart item in dropdown menu
		if (mysqli_num_rows($query) > 0) {
			$n=0;
			while ($row=mysqli_fetch_array($query)) {
				$n++;
				$product_id = $row["product_id"];
				$product_title = $row["product_title"];
				$product_price = $row["product_price"];
				$product_image = $row["product_image"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				echo '
					<tr>
						<td>'.$n.'</td>
						<td><img class="img-responsive" src="product_images/'.$product_image.'" style="max-width:100px"/></div>
						<td>'.$product_title.'</td>
						<td>'.CURRENCY.''.$product_price.'</td>
					</tr>';
				
			}
			?><tr>
				<td colspan="3"></td>
				<td><a style="float:right;" href="cart.php" class="btn btn-warning">Modifier&nbsp;&nbsp;<span class="fa fa-edit"></span></a>
				</td></tr>
			<?php
			exit();
		}
	}
	if (isset($_POST["checkOutDetails"])) {
		if (mysqli_num_rows($query) > 0) {
			//display user cart item with "Ready to checkout" button if user is not login
			echo "<form method='post' action='login_form.php' class='mb-2'>";
				$n=0;
				while ($row=mysqli_fetch_array($query)) {
					$n++;
					$product_id = $row["product_id"];
					$product_title = $row["product_title"];
					$product_price = $row["product_price"];
					$product_image = $row["product_image"];
					$cart_item_id = $row["id"];
					$qty = $row["qty"];
					echo'

						<tr>
							<input type="hidden" name="product_id[]" value="'.$product_id.'"/>
					      <td>
					      	<div class="btn-group">
								<a href="#" remove_id="'.$product_id.'" class="btn btn-danger remove"><span class="fa fa-trash"></span></a> 
								<a href="#" update_id="'.$product_id.'" class="btn btn-secondary update"><span class="fa fa-check"></span></a>
							</div>
					      </td>
					      <td><img class="img-responsive" src="product_images/'.$product_image.'" style="max-width:100px;"></td>
					      <td>'.$product_title.'</td>
					      <td><input type="number" min="0" class="form-control qty" value="'.$qty.'" ></td>
					      <td><input type="text" class="form-control price" style="min-width:100px" value="'.$product_price.'" readonly="readonly"></td>
					      <input type="hidden" class="form-control total" value="'.($tot = $product_price * $qty).'" readonly="readonly">
					      <td>'.$tot.'</td>
					    </tr>
					';		

					/*echo 
						'<div class="row mb-2">
								<div class="col-md-2">
									<div class="btn-group">
										<a href="#" remove_id="'.$product_id.'" class="btn btn-danger remove"><span class="fa fa-trash"></span></a> 
										<a href="#" update_id="'.$product_id.'" class="btn btn-secondary update"><span class="fa fa-check"></span></a>
									</div>
								</div>
								
								<input type="hidden" name="" value="'.$cart_item_id.'"/>
								<div class="col-md-2"><img class="img-responsive" src="product_images/'.$product_image.'" style="max-width:100px;"></div>
								<div class="col-md-2">'.$product_title.'</div>
								<div class="col-md-2"><input type="text" class="form-control qty" value="'.$qty.'" ></div>
								<div class="col-md-2"><input type="text" class="form-control price" value="'.$product_price.'" readonly="readonly"></div>
								<div class="col-md-2"><input type="text" class="form-control total" value="'.$product_price.'" readonly="readonly"></div>
							</div>';*/
				}
				
				echo '<tr class="row">
							
							<td colspan="7">
								<b class="net_total" style="font-size:20px;"> </b>
							</td>
					</tr>';
				if (!isset($_SESSION["uid"])) {
					echo '<input type="submit" style="float:right;" name="login_user_with_product" class="btn btn-info btn-lg" value="Prêt à payer" >
							</form>';
					
				}else if(isset($_SESSION["uid"])){
					//Paypal checkout form
					/*echo '
						</form>
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="business" value="shoppingcart@shop_mwisa.com">
							<input type="hidden" name="upload" value="1">';
							  
							$x=0;
							$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
							$query = mysqli_query($con,$sql);
							while($row=mysqli_fetch_array($query)){
								$x++;
								echo  	
									'<input type="hidden" name="item_name_'.$x.'" value="'.$row["product_title"].'">
								  	 <input type="hidden" name="item_number_'.$x.'" value="'.$x.'">
								     <input type="hidden" name="amount_'.$x.'" value="'.$row["product_price"].'">
								     <input type="hidden" name="quantity_'.$x.'" value="'.$row["qty"].'">';
								}
							  
							echo   
								'<input type="hidden" name="return" value="http://localhost/shop_mwisa/payment_success.php"/>
					                <input type="hidden" name="notify_url" value="http://localhost/shop_mwisa/payment_success.php">
									<input type="hidden" name="cancel_return" value="http://localhost/shop_mwisa/cancel.php"/>
									<input type="hidden" name="currency_code" value="USD"/>
									<input type="hidden" name="custom" value="'.$_SESSION["uid"].'"/>
									<input style="float:right;margin-right:80px;" type="image" name="submit"
										src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-rect-paypalcheckout-60px.png" alt="PayPal Checkout"
										alt="PayPal - The safer, easier way to pay online">
								</form>';*/
				}
			}
	}
	
	
}

//Remove Item From cart
if (isset($_POST["removeItemFromCart"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["uid"])) {
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Produit supprimé du panier</b>
				</div>";
		exit();
	}
}


//Update Item From cart
if (isset($_POST["updateCartItem"])) {
	$update_id = $_POST["update_id"];
	$qty = $_POST["qty"];
	if (isset($_SESSION["uid"])) {
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-info'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Produit modifier</b>
				</div>";
		exit();
	}
}

if(isset($_POST["get_caroussel"])){
	
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
		 caroousel($caroussel_image,$caroussel_title,$brand_id,true);
		/*caroousel(
		array(
			isset($caroussel_images[0])? $caroussel_images[0] : null,
			isset($caroussel_images[1])? $caroussel_images[1] : null,
			isset($caroussel_images[2])? $caroussel_images[2] : null
		),
		array(
			isset($caroussel_title[0])? $caroussel_title[0] : "", 
			isset($caroussel_title[1])? $caroussel_title[1] : "", 
			isset($caroussel_title[2])? $caroussel_title[2] : ""
		),
		true

		);*/
	}
}

function flashInfo($msg,$type){
	?>
	<div class="col-md alert alert-<?= $type?> text-center" id='alert' style=''>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h6><?= $msg?></h6>
	</div>
	<?php
}
 
function pagination($total_pages, $pageno, $str_search, $HTTP_REFERER){ 
?>
<div class="container" data-aos="fade-up">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="site-block-27">
					<ul class='pagination'>
						<?php 
							$tours = ($total_pages > 4)? 4 : $total_pages;
						 ?>
						<?php if ($pageno > 1) { ?>
						<li class=''>
							<a href='<?php if ($pageno <= 1) {
							echo '#';
							} else {
								echo $HTTP_REFERER.$str_search.'pageno=' . ($pageno - 1);
							} ?>' class="icon-keyboard_arrow_left"></a>
						</li>
						<?php } ?>
						<?php 
							for ($i = 1; $i <= $tours; $i++ ) {
						?>
						<li class="<?= ($pageno == $i)? 'active' : '' ?>"><span><a href='<?= $HTTP_REFERER.$str_search?>pageno=<?= $i ?>'><?= $i ?></a> </span></li>
						<?php		
							}
						 ?>
						
						<?php if ($pageno <= $total_pages) { ?>
						<li class="<?= ($pageno > $tours )? 'active' : '' ?>">
						<a href='<?php if ($pageno >= $total_pages) {
							echo '#';
							} else {
								echo $HTTP_REFERER.$str_search.'pageno=' . ($pageno + 1);
							} ?>' class="icon-keyboard_arrow_right"></a>
						</li>
						<?php		
							}
						 ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
<?php 			
}

//function pour la caroousel--Modifier par DMK
    function caroousel($image=[],$text=[],$brand=[],$navigate){
  ?>
  <div id="myCarousel" class="carousel slide" data-ride="carousel" >
      <ol class="carousel-indicators">
	  <?php
	  for($i=0;$i<sizeof($image);$i++){
		  ?>
		  <li class="<?php echo $i==0?'active':'';?>" style="z-index:102" data-target="#myCarousel" data-slide-to ="<?php echo $i;?>"></li>
		  <?php
	  }
	  ?>
        
        <!--<li class="" style="z-index:102" data-target="#myCarousel" data-slide-to ="1"></li>
        <li class="" style="z-index:102" data-target="#myCarousel" data-slide-to ="2"></li>-->
      </ol>
      <div class="carousel-inner" >
	  <?php
	  for($i=0;$i<sizeof($image);$i++){
		  ?>
        <div class="carousel-item <?php echo $i==0?'active':'';?>">
          <a  <?php echo $brand[$i]>0?" href='#' class='nav_marque' mid='".$brand[$i]."'":'';?>><img class="imgFilter first-slide" alt="First image" src="<?= $image[$i]?>" alt="" width="100%" style="max-height:"/></a>

          <div class="container"><div class="carousel-caption text-left text-black bold"></div></div>
        </div>
		 <?php
	  }
	  ?>
      </div>
      <?php 
          if ($navigate == true) {
      ?>
      <a href="#myCarousel" style="z-index:101" class="carousel-control-prev" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a href="#myCarousel" style="z-index:101" class="carousel-control-next" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <?php 
        }
      ?>
    </div>
  <?php
    
  }
?>






