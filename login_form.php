<?php
#this is Login form page , if user is already logged in then we will not allow user to access this page by executing isset($_SESSION["uid"])
#if below statment return true then we will send user to their profile.php page
if (isset($_SESSION["uid"])) {
	header("location:profile.php");
}
//in action.php page if user click on "ready to checkout" button that time we will pass data in a form from action.php page
if (isset($_POST["login_user_with_product"])) {
	//this is product list array
	$product_list = $_POST["product_id"];
	//here we are converting array into json format because array cannot be store in cookie
	$json_e = json_encode($product_list);
	//here we are creating cookie and name of cookie is product_list
	setcookie("product_list",$json_e,strtotime("+1 day"),"/","","",TRUE);

}
?>
<?php include_once 'header.php'; ?>	

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="signup_msg">
				<!--Alert from signup form-->
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="card card-primary mb-4">
					<div class="card-header">Connexion du client</div>
					<div class="card-body">
						<!--User Login Form-->
						<form onsubmit="return false" id="login">
							<label for="email">Mail</label>
							<input type="email" class="form-control" name="email" id="email" required/>
							<label for="email">Mot de passe</label>
							<input type="password" class="form-control" name="password" id="password" required/>
							<p><br/></p>
							<a href="#" style="color:#333; list-style:none;">Récuperer votre Mot de passe</a><input type="submit" class="btn btn-success" style="float:right;" Value="Connexion">
							<div><a href="customer_registration.php?register=1">Créer un nouveau compte?</a></div>						
						</form>
				</div>
				<div class="card-footer"><div id="e_msg"></div></div>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
        </div>
        </div>
<?php include_once 'footer.php'; ?>






















