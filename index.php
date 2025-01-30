<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>PT. Sentral Bahana Ekatama</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="assets/img/logo.png" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/atlantis.css">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn bg-primary-gradient">
			<h3 class="text-center"><img src="assets/img/logo.png" alt="navbar brand" class="navbar-brand" style="filter: invert(100%) sepia(100%) saturate(38%) hue-rotate(254deg) brightness(110%) contrast(110%);"></h3>
			<form method="post" action="?p=login">
			<div class="login-form">
				<div class="form-group">
					<label for="username" class="placeholder text-white"><b>Username</b></label>
					<input id="username" name="username" type="text" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password" class="placeholder text-white"><b>Password</b></label>
					<div class="position-relative">
						<input id="password" name="password" type="password" class="form-control" required>
						<div class="show-password">
							<i class="icon-eye"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-action-d-flex mb-3">
					<div class="custom-control"></div>
					<button type="submit" name="submit" class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Login</a>
				</div>
			</div>
			</form>
		</div>
	</div>
	<script src="assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="assets/js/core/popper.min.js"></script>
	<script src="assets/js/core/bootstrap.min.js"></script>
	<script src="assets/js/atlantis.min.js"></script>
	<script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>
	<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
	<?php
	if(isset($_GET['p']) AND $_GET['p'] == "login"){
		include "page/configs/config.php";

		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$query_user = mysql_query("SELECT * FROM user WHERE username='$username' AND password='$password' AND status='1'");
		$cek_user = mysql_num_rows($query_user);
		$data_user = mysql_fetch_array($query_user);

		if($cek_user > 0){
			$_SESSION['userid'] = $data_user['userid'];
			echo "
			<script>
			swal('Success', 'Login successfully', {
				icon : 'success',
				buttons: {        			
					confirm: {
						className : 'btn btn-success'
					}
				},
			}).then(function() {
				window.location = 'page/'
			});
			/* $.notify({
				icon: 'fa fa-check',
				title: 'Success',
				message: 'Login successfully',
			},{
				type: 'success',
				placement: {
					from: 'top',
					align: 'center'
				},
				delay: 1000,
				timer: 1500,
				onClosed: function() {
					window.location = 'page/'
				}
			}); */
			</script>
			";
		}
		else{
			echo "
			<script>
			swal('Failed', 'Login failed', {
				icon : 'error',
				buttons: {        			
					confirm: {
						className : 'btn btn-danger'
					}
				},
			}).then(function() {
				window.location = './'
			});
			/* $.notify({
				icon: 'fa fa-times',
				title: 'Failed',
				message: 'Login failed',
			},{
				type: 'danger',
				placement: {
					from: 'top',
					align: 'center'
				},
				delay: 1000,
				timer: 1500,
				onClosed: function() {
					window.location = './'
				}
			}); */
			</script>
			";
		}
	}
	?>
	
</body>
</html>