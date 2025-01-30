<?php
//error_reporting(0);
session_start();
if(empty($_SESSION['userid'])){
	header('location: ../');
}
else{
	include "configs/config.php";
	$query_user = mysql_query("SELECT * FROM user WHERE userid='$_SESSION[userid]'");
	$cek_user = mysql_num_rows($query_user);
	$data_user = mysql_fetch_array($query_user);
	$query_department = mysql_query("SELECT * FROM department WHERE departmentid='$data_user[departmentid]'");
	$cek_department = mysql_num_rows($query_department);
	$data_department = mysql_fetch_array($query_department);
	$_userid = $data_user['userid'];
	$_username = $data_user['username'];
	$_password = $data_user['password'];
	$_name = $data_user['name'];
	$_departmentid = $data_user['departmentid'];
	$_departmentcode = $data_department['departmentcode'];
	$_departmentname = $data_department['departmentname'];
	$_email = $data_user['email'];
	$_phone = $data_user['phone'];
	$_level = $data_user['level'];
	$_status = $data_user['status'];
	//APPROVAL
	$_p = explode("_",$_GET['p']);
	$query_form = mysql_query("SELECT * FROM form WHERE formcode='$_p[0]'");
	$cek_form = mysql_num_rows($query_form);
	$data_form = mysql_fetch_array($query_form);
	
	$query_formuser = mysql_query("SELECT * FROM form_user WHERE formid='$data_form[formid]' AND userid='$_userid'");
	$cek_formuser = mysql_num_rows($query_formuser);
	$data_formuser = mysql_fetch_array($query_formuser);
	//$_approval1_id = $data_form['approval1'];
	//$_approval2_id = $data_form['approval2'];
	//$_approval3_id = $data_form['approval3'];
	if($data_formuser['app1'] != "0"){
		$_approval1_id = $data_formuser['app1'];
	}
	else{
		$_approval1_id = $data_form['approval1'];
	}
	if($data_formuser['app2'] != "0"){
		$_approval2_id = $data_formuser['app2'];
	}
	else{
		$_approval2_id = $data_form['approval2'];
	}
	if($data_formuser['app3'] != "0"){
		$_approval3_id = $data_formuser['app3'];
	}
	else{
		$_approval3_id = $data_form['approval3'];
	}
	$query_approval1 = mysql_query("SELECT * FROM user WHERE userid='$_approval1_id'");
	$cek_approval1 = mysql_num_rows($query_approval1);
	$data_approval1 = mysql_fetch_array($query_approval1);
	$_approval1_name = $data_approval1['name'];
	$query_approval2 = mysql_query("SELECT * FROM user WHERE userid='$_approval2_id'");
	$cek_approval2 = mysql_num_rows($query_approval2);
	$data_approval2 = mysql_fetch_array($query_approval2);
	$_approval2_name = $data_approval2['name'];
	$query_approval3 = mysql_query("SELECT * FROM user WHERE userid='$_approval3_id'");
	$cek_approval3 = mysql_num_rows($query_approval3);
	$data_approval3 = mysql_fetch_array($query_approval3);
	$_approval3_name = $data_approval3['name'];
	//FUNCTION
	function convertToRoman($integer){
		$integer = intval($integer);
		$result = '';
		$lookup = array('M' => 1000,
			'CM' => 900,
			'D' => 500,
			'CD' => 400,
			'C' => 100,
			'XC' => 90,
			'L' => 50,
			'XL' => 40,
			'X' => 10,
			'IX' => 9,
			'V' => 5,
			'IV' => 4,
			'I' => 1);
		foreach ($lookup as $roman => $value) {
			$matches = intval($integer / $value);
			$result .= str_repeat($roman, $matches);
			$integer = $integer % $value;
		}
		return $result;
	}
?>
<!DOCTYPE html>
<?php
date_default_timezone_set("Asia/Jakarta");
?>
<html lang="en">
<head>
	<meta name="theme-color" content="#1572E8" />
	<META http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>PT. Sentral Bahana Ekatama</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/logo.png" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.css">
	<!--<link rel="stylesheet" href="../assets/css/atlantis.edit.css">-->

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="./" class="logo">
					<img src="../assets/img/logo.png" alt="navbar brand" class="navbar-brand" style="filter: invert(100%) sepia(100%) saturate(38%) hue-rotate(254deg) brightness(110%) contrast(110%);">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control" id="autocomplete">
							</div>
						</form>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="../assets/img/profile.png" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="../assets/img/profile.png" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?php echo $_name; ?></h4>
												<p class="text-muted"><?php echo $_departmentname; ?></p><button type="button" class="btn btn-primary btn-sm" onclick="return password()">Change Password</button>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="?p=logout" onclick="return logout()">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">
						<li class="nav-item <?php if(basename($_SERVER['REQUEST_URI'])."/" == "page/"){echo "active";} ?>">
							<a href="./" class="collapsed">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<?php
						if($_level == "1"){
						?>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Settings</h4>
						</li>
						<li class="nav-item <?php if($_GET['p'] == "department"){echo "active";} ?>">
							<a href="?p=department">
								<i class="fas fa-sitemap"></i>
								<p>Department</p>
							</a>
						</li>
						<li class="nav-item <?php if($_GET['p'] == "user"){echo "active";} ?>">
							<a href="?p=user">
								<i class="fas fa-users"></i>
								<p>User</p>
							</a>
						</li>
						<li class="nav-item  <?php if($_GET['p'] == "form"){echo "active";} ?>">
							<a href="?p=form">
								<i class="fas fa-layer-group"></i>
								<p>Form Settings</p>
							</a>
						</li>
						<?php
						}
						?>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Forms</h4>
						</li>
						<?php
						$q = mysql_query("SELECT user.username, user.name, form.formcode, form.formname, form_user.new, form_user.view, form_user.master_new, form_user.master_view, form_user.master_edit, form_user.master_del 
						FROM form_user 
						INNER JOIN user ON user.userid=form_user.userid 
						INNER JOIN form ON form.formid=form_user.formid 
						WHERE form_user.userid='$_userid'
						ORDER BY form.formname ASC");
						while($r = mysql_fetch_array($q)){
						if(($r['new'] == "1") OR ($r['view'] == "1") OR ($r['master_new'] == "1") OR ($r['master_view'] == "1") OR ($r['master_edit'] == "1") OR ($r['master_del'] == "1")){
						echo "
						<li class='nav-item "; if($_GET['p'] == $r['formcode']."_new" OR $_GET['p'] == $r['formcode']."_view"){echo "active";} echo " submenu'>
							<a data-toggle='collapse' href='#$r[formcode]'>
								<i class='fas fa-clone'></i>
								<p>$r[formname]</p>
								<span class='caret'></span>
							</a>
							<div id='$r[formcode]' class='collapse "; if($_GET['p'] == $r['formcode']."_new" OR $_GET['p'] == $r['formcode']."_view"){echo "show";} echo "'>
								<ul class='nav nav-collapse subnav'>";
									
									//GENERAL
									if($r['master_new'] == "1" OR $r['master_view'] == "1" OR $r['master_edit'] == "1" OR $r['master_del'] == "1"){
									echo "
									<li class='"; if($_GET['p'] == $r['formcode']."_master_customer"){echo "active";} echo"'>
										<a href='?p=$r[formcode]_master_customer'>
											<i class='fas fa-file'></i>
											<p>Master Customer</p>
										</a>
									</li>
									<li class='"; if($_GET['p'] == $r['formcode']."_master_part"){echo "active";} echo"'>
										<a href='?p=$r[formcode]_master_part'>
											<i class='fas fa-file'></i>
											<p>Master Part</p>
										</a>
									</li>
									<li class='"; if($_GET['p'] == $r['formcode']."_master_inspection"){echo "active";} echo"'>
										<a href='?p=$r[formcode]_master_inspection'>
											<i class='fas fa-file'></i>
											<p>Master Inspection</p>
										</a>
									</li>
									<li class='"; if($_GET['p'] == $r['formcode']."_master_checkpoint"){echo "active";} echo"'>
										<a href='?p=$r[formcode]_master_checkpoint'>
											<i class='fas fa-file'></i>
											<p>Master Checkpoint</p>
										</a>
									</li>
									";
									}
									if($r['new'] == "1"){
									echo "
									<li class='"; if($_GET['p'] == $r['formcode']."_new"){echo "active";} echo"'>
										<a href='?p=$r[formcode]_new'>
											<i class='fas fa-file'></i>
											<p>New</p>
										</a>
									</li>
									";
									}
									if($r['view'] == "1"){
									echo "
									<li class='"; if($_GET['p'] == $r['formcode']."_view"){echo "active";} echo"'>
										<a href='?p=$r[formcode]_view'>
											<i class='fas fa-file'></i>
											<p>View</p>
										</a>
									</li>
									";
									}
									
									//SPECIFIC
									//FIR
									/* if($r['formcode'] == "fir" AND ($r['edit'] == "1" OR $r['del'] == "1")){
									echo "
									<li class='"; if($_GET['p'] == $r['formcode']."_master"){echo "active";} echo"'>
										<a href='?p=$r[formcode]_master'>
											<i class='fas fa-file'></i>
											<p>Master</p>
										</a>
									</li>
									";
									} */
									echo "
								</ul>
							</div>
						</li>";
						}
						}
						?>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
		
	<!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<!--<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>-->
	<link rel="stylesheet" href="../assets/js/plugin/jquery-ui-1.13.1/jquery-ui.css">
	<script src="../assets/js/plugin/jquery-ui-1.13.1/jquery-ui.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	
	<!-- Moment JS -->
	<script src="../assets/js/plugin/moment/moment.min.js"></script>
	<!-- Bootstrap Notify -->
	<script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
	<!-- Bootstrap Toggle -->
	<script src="../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- DateTimePicker -->
	<script src="../assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>
	<!-- Select2 -->
	<script src="../assets/js/plugin/select2/select2.full.min.js"></script>
	<!-- Bootstrap Tagsinput -->
	<script src="../assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<!-- Chart JS -->
	<script src="../assets/js/plugin/chart.js/chart.min.js"></script>
	<!-- jQuery Sparkline -->
	<script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
	<!-- Chart Circle -->
	<script src="../assets/js/plugin/chart-circle/circles.min.js"></script>
	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
	<script>
	$(document).ready(function() {
		$('.datatables').DataTable({});
	});
	</script>

	<!-- Bootstrap Notify -->
	<script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Sweet Alert -->
	<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo.js"></script>
	<!--<script src="../assets/js/demo.js"></script>-->
	
		<div class="main-panel">
			<div class="container">
				<div class="page-inner">
					<?php
					include "configs/controller.php";
					?>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left d-none">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="#">
									Facebook
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Twitter
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Instagran
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						<?php echo date('Y'); ?> | PT. Sentral Bahana Ekatama
					</div>				
				</div>
			</footer>
		</div>
		
		<!-- Custom template | don't include it in your project! -->
		<div class="custom-template d-none">
			<div class="title">Settings</div>
			<div class="custom-content">
				<div class="switcher">
					<div class="switch-block">
						<h4>Logo Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
							<button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Navbar Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeTopBarColor" data-color="dark"></button>
							<button type="button" class="changeTopBarColor" data-color="blue"></button>
							<button type="button" class="changeTopBarColor" data-color="purple"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue"></button>
							<button type="button" class="changeTopBarColor" data-color="green"></button>
							<button type="button" class="changeTopBarColor" data-color="orange"></button>
							<button type="button" class="changeTopBarColor" data-color="red"></button>
							<button type="button" class="changeTopBarColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeTopBarColor" data-color="dark2"></button>
							<button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="purple2"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="green2"></button>
							<button type="button" class="changeTopBarColor" data-color="orange2"></button>
							<button type="button" class="changeTopBarColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Sidebar</h4>
						<div class="btnSwitch">
							<button type="button" class="selected changeSideBarColor" data-color="white"></button>
							<button type="button" class="changeSideBarColor" data-color="dark"></button>
							<button type="button" class="changeSideBarColor" data-color="dark2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Background</h4>
						<div class="btnSwitch">
							<button type="button" class="changeBackgroundColor" data-color="bg2"></button>
							<button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
							<button type="button" class="changeBackgroundColor" data-color="bg3"></button>
							<button type="button" class="changeBackgroundColor" data-color="dark"></button>
						</div>
					</div>
				</div>
			</div>
			<div class="custom-toggle">
				<i class="flaticon-settings"></i>
			</div>
		</div>
		<!-- End Custom template -->
		<!-- Atlantis DEMO methods, don't include it in your project! -->
		<script src="../assets/js/setting-demo.js"></script>
		<script src="../assets/js/demo.js"></script>
		
	</div>
	
	<script>
	function check(e){
		swal({
			title: 'Are you sure ?',
			text: 'This will be update the status of the form',
			type: 'warning',
			buttons:{
				confirm: {
					text : 'Yes, continue',
					className : 'btn btn-success'
				},
				cancel: {
					visible: true,
					className: 'btn btn-danger'
				}
			}
		}).then((isConfirm) => {
			if (isConfirm) {
				window.location = e.href
			} else {
				swal.close();
			}
		});
		return false
	}
	function password(){
		swal({
			title: 'Change Password',
			html: '<br><input class="form-control" placeholder="Input new password" id="input-field">',
			content: {
				element: "input",
				attributes: {
					placeholder: "Input new password",
					type: "password",
					id: "input-field",
					className: "form-control"
				},
			},
			buttons: {
				cancel: {
					visible: true,
					className: 'btn btn-danger'
				},        			
				confirm: {
					className : 'btn btn-success'
				}
			},
		}).then((isConfirm) => {
			if (isConfirm) {
				var password = $('#input-field').val();
				swal({
					title: 'Are you sure ?',
					text: 'Your password will be updated to ' + $('#input-field').val() + '',
					type: 'warning',
					buttons:{
						confirm: {
							text : 'Yes, updated',
							className : 'btn btn-success'
						},
						cancel: {
							visible: true,
							className: 'btn btn-danger'
						}
					}
				}).then((isConfirm) => {
					if (isConfirm) {
						window.location = '?p=password&password=' + password
					} else {
						swal.close();
					}
				});
			} else {
				swal.close();
			}
		});
	}
	function logout(){
		swal({
			title: 'Are you sure ?',
			text: 'You will be logout from system',
			type: 'warning',
			buttons:{
				confirm: {
					text : 'Yes, logout',
					className : 'btn btn-success'
				},
				cancel: {
					visible: true,
					className: 'btn btn-danger'
				}
			}
		}).then((isConfirm) => {
			if (isConfirm) {
				window.location = '?p=logout'
			} else {
				swal.close();
			}
		});
		return false
	}
	</script>
	<?php
	if($_GET['p'] == "password"){
		$password = md5($_GET['password']);
		
		$q = mysql_query("UPDATE user SET password='$password' WHERE userid='$_userid'");
		if($q){
		echo "
		<script>
		jQuery(document).ready(function() {
			swal('Success', 'Updated successfully', {
				icon : 'success',
				buttons: {        			
					confirm: {
						className : 'btn btn-success'
					}
				},
			}).then(function() {
				window.location = './'
			});
		});
		</script>
		";
		}
	}
	if($_GET['p'] == "logout"){
		session_destroy();
		echo "
		<script>
		jQuery(document).ready(function() {
			swal('Success', 'Logout successfully', {
				icon : 'success',
				buttons: {        			
					confirm: {
						className : 'btn btn-success'
					}
				},
			}).then(function() {
				window.location = '../'
			});
		});
		</script>
		";
	}
	?>

<script>
<?php
$sql_search = "SELECT user.username, user.name, form.formid, form.formcode, form.formnumber, form.formname, form_user.id, form_user.new, form_user.view, form_user.master_new, form_user.master_view, form_user.master_edit, form_user.master_del 
FROM form_user 
INNER JOIN user ON user.userid=form_user.userid 
INNER JOIN form ON form.formid=form_user.formid 
WHERE form_user.userid='$_userid'";
$query_search = mysql_query($sql_search);
echo "var data = [";
while($row_search = mysql_fetch_array($query_search)){
	if(basename(dirname(dirname($_getfileurl))) == "forms"){
		$folder = "forms/$row_search[formcode]";
	}
	else{
		$folder = "forms/$row_search[formcode]";
	}
	if($handle = opendir($folder)){
		while(false !== ($entry = readdir($handle))){
			if($entry != "." && $entry != ".." && substr($entry,-3) == "php"){
				$sql_searchname = "SELECT formname FROM form WHERE formid='$row_search[formid]'";
				$query_searchname = mysql_query($sql_searchname);
				$row_searchname = mysql_fetch_array($query_searchname);
				$capitalize_folder = $row_searchname['formname'];
				if (
					((strpos($entry, 'master') !== false) AND ($row_search['master_new'] == "1" OR $row_search['master_view'] == "1" OR $row_search['master_edit'] == "1" OR $row_search['master_del'] == "1")) OR 
					($entry == "new.php" AND $row_search['new'] == "1") OR 
					($entry == "view.php" AND $row_search['view'] == "1")
				){
					if (strpos($entry, 'master') !== false) {
						$entrylabel = $capitalize_folder." - ".ucwords(str_replace("_"," ",rtrim($entry,".php")));
					}
					else {
						$entrylabel = $capitalize_folder." - ".ucwords(rtrim($entry,".php"));
					}
					$entry = rtrim($entry,".php");
					echo "{ id: '$row_search[id]', value: '$row_search[formcode]', category: '$entry', label: '$entrylabel' },";
				}
				else{
					$entrylabel = "";
				}
			}
		}
		closedir($handle);
	}
}
echo "];";
?>
$('#autocomplete' ).autocomplete({
	//minLength: 0,
	source: data,
	select: function (event, ui) {
		var id = ui.item.id;
		var value = ui.item.value;
		var category = ui.item.category;
		var label = ui.item.label;
		//alert(id+" | "+value+" | "+category+" | "+label);
		event.preventDefault();
		$(this).val(ui.item.label);
		window.location.href = '?p='+value+'_'+category;
		//alert('../forms/'+value+'/'+category);
	}
}).focus(function () {
    $(this).autocomplete("search");
});
</script>
<style>
.ui-menu{
	z-index: 9999;
	font-size: 10pt;
	top: 0;
	border-radius: 5px;
}
.ui-menu-item{
	top: 0;
}
.ui-menu-item-wrapper:hover {
    border-radius: 5px;
	background-color: var(--primary);
}
</style>
<style>
.table-responsive>.table-bordered {
	border: 1px solid #ebedf2;
}
.tablex td, .tablex th {
	padding: 5px 5px !important;
}
input, select {
	border: 1px solid #ced4da; /* #ebedf2 */
	border-radius: .25rem;
	height: 30px;
	padding: 5px;
	/* color: #495057; */
}
input[type="checkbox"] {
	vertical-align: middle;
	margin: 0px 5px;
}
</style>

</body>
</html>
<?php
}
?>