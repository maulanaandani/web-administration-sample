<div class="row">
	<div class="col-md-12">
		<div class="card">
		<form method="post">
			<div class="card-header card-primary bg-primary-gradient">
				<div class="card-head-row">
					<div class="card-title">User</div>
					<div class="card-tools">
						<a href="?p=user&action=new" class="btn btn-info btn-border btn-round btn-sm"><i class="fa fa-file"></i> New</a>
					</div>
				</div>
			</div>
			<div class="card-body">
			
			<?php
			if($_GET['action'] == ""){
			?>
			<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover datatables">
				<thead>	
					<tr>
						<th>No</th>
						<th>Username</th>
						<th>Name</th>
						<th>Department</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Level</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i = 1;
				$q = mysql_query("SELECT * FROM user ORDER BY name ASC");
				while($r = mysql_fetch_array($q)){
					$q_department = mysql_query("SELECT * FROM department WHERE departmentid='$r[departmentid]'");
					$r_department = mysql_fetch_array($q_department);
					$departmentname = $r_department['departmentname'];
					if($r['level'] == "1"){
						$level = "<span class='badge badge-primary'>Super User</span>";
					}
					else{
						$level = "<span class='badge badge-black'>User</span>";
					}
					if($r['status'] == "1"){
						$status = "<span class='badge badge-success'>Active</span>";
					}
					else{
						$status = "<span class='badge badge-danger'>Inactive</span>";
					}
					echo "
					<tr>
						<td>$i</td>
						<td>$r[username]</td>
						<td>$r[name]</td>
						<td>$departmentname</td>
						<td>$r[email]</td>
						<td>$r[phone]</td>
						<td>$level</td>
						<td>$status</td>
						<td>
							<div class='btn-group'>
								<a class='btn btn-primary btn-sm' href='?p=user&action=view&id=$r[userid]'><i class='fa fa-eye'></i> View</a>
								<a class='btn btn-success btn-sm' href='?p=user&action=edit&id=$r[userid]'><i class='fa fa-edit'></i> Edit</a>
								<a class='btn btn-danger btn-sm' href='?p=user&action=delete&id=$r[userid]' onclick=\"return check_delete('$r[userid]')\"><i class='fa fa-times'></i> Delete</a>
							</div>
						</td>
					</tr>
					";
					$i++;
				}
				?>
				</tbody>
			</table>
			</div>
			<?php
			}
			else if($_GET['action'] == "new"){
			?>
			<div class="row">
			<div class="col-md-12">
				<div class="form-group d-none">
					<label for="userid">Userid</label>
					<input type="text" class="form-control" name="userid" id="userid" value="" />
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" name="username" id="username" value="" required />
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="password" id="password" value="" required />
				</div>
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name" id="name" value="" required />
				</div>
				<div class="form-group">
					<label for="departmentid">Department</label>
					<select class="form-control" name="departmentid" id="departmentid" required>
						<?php
						$q_department = mysql_query("SELECT * FROM department ORDER BY departmentname ASC");
						while($r_department = mysql_fetch_array($q_department)){
							echo "<option value='$r_department[departmentid]'>$r_department[departmentname]</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control" name="email" id="email" value="" required />
				</div>
				<div class="form-group">
					<label for="phone">Phone</label>
					<input type="text" class="form-control" name="phone" id="phone" value="" required />
				</div>
				<div class="form-group">
					<label for="level">Level</label>
					<select class="form-control" name="level" id="level" required>
						<option value="0">User</option>
						<option value="1">Super User</option>
					</select>
				</div>
				<div class="form-group">
					<label for="status">Status</label>
					<select class="form-control" name="status" id="status" required>
						<option value="1">Active</option>
						<option value="0">Inactive</option>
					</select>
				</div>
			</div>
			</div>
			<?php
			}
			else if($_GET['action'] == "view"){
			?>
			<?php
			$q = mysql_query("SELECT * FROM user WHERE userid='$_GET[id]'");
			$r = mysql_fetch_array($q);
			$userid = $r['userid'];
			$username = $r['username'];
			$password = $r['password'];
			$name = $r['name'];
			$departmentid = $r['departmentid'];
			$email = $r['email'];
			$phone = $r['phone'];
			$level = $r['level'];
			$status = $r['status'];
			?>
			<div class="row">
			<div class="col-md-12">
				<div class="form-group d-none">
					<label for="userid">Userid</label>
					<input type="text" class="form-control" name="userid" id="userid" value="<?php echo $userid; ?>" />
				</div>
				<div class="form-group">
					<label for="username">User Name</label>
					<input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>" disabled />
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="password" id="password" value="<?php echo $password; ?>" disabled />
				</div>
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" disabled />
				</div>
				<div class="form-group">
					<label for="departmentid">Department</label>
					<select class="form-control" name="departmentid" id="departmentid" disabled>
						<?php
						$q_department = mysql_query("SELECT * FROM department ORDER BY departmentname ASC");
						while($r_department = mysql_fetch_array($q_department)){
							echo "<option value='$r_department[departmentid]' "; if($r_department['departmentid'] == $departmentid){echo "selected";} echo ">$r_department[departmentname]</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>" disabled />
				</div>
				<div class="form-group">
					<label for="phone">Phone</label>
					<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>" disabled />
				</div>
				<div class="form-group">
					<label for="level">Level</label>
					<select class="form-control" name="level" id="level" disabled>
						<option value="0" <?php if($level == "0"){echo "selected";} ?>>User</option>
						<option value="1" <?php if($level == "1"){echo "selected";} ?>>Super User</option>
					</select>
				</div>
				<div class="form-group">
					<label for="status">Status</label>
					<select class="form-control" name="status" id="status" disabled>
						<option value="1" <?php if($status == "1"){echo "selected";} ?>>Active</option>
						<option value="0" <?php if($status == "0"){echo "selected";} ?>>Inactive</option>
					</select>
				</div>
			</div>
			</div>
			<?php
			}
			else if($_GET['action'] == "edit"){
			?>
			<?php
			$q = mysql_query("SELECT * FROM user WHERE userid='$_GET[id]'");
			$r = mysql_fetch_array($q);
			$userid = $r['userid'];
			$username = $r['username'];
			$password = $r['password'];
			$name = $r['name'];
			$departmentid = $r['departmentid'];
			$email = $r['email'];
			$phone = $r['phone'];
			$level = $r['level'];
			$status = $r['status'];
			?>
			<div class="row">
			<div class="col-md-12">
				<div class="form-group d-none">
					<label for="userid">Userid</label>
					<input type="text" class="form-control" name="userid" id="userid" value="<?php echo $userid; ?>" />
				</div>
				<div class="form-group">
					<label for="username">User Name</label>
					<input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>" required />
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="password" id="password" value="" />
				</div>
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" required />
				</div>
				<div class="form-group">
					<label for="departmentid">Department</label>
					<select class="form-control" name="departmentid" id="departmentid" required>
						<?php
						$q_department = mysql_query("SELECT * FROM department ORDER BY departmentname ASC");
						while($r_department = mysql_fetch_array($q_department)){
							echo "<option value='$r_department[departmentid]' "; if($r_department['departmentid'] == $departmentid){echo "selected";} echo ">$r_department[departmentname]</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>" required />
				</div>
				<div class="form-group">
					<label for="phone">Phone</label>
					<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>" required />
				</div>
				<div class="form-group">
					<label for="level">Level</label>
					<select class="form-control" name="level" id="level" required>
						<option value="0" <?php if($level == "0"){echo "selected";} ?>>User</option>
						<option value="1" <?php if($level == "1"){echo "selected";} ?>>Super User</option>
					</select>
				</div>
				<div class="form-group">
					<label for="status">Status</label>
					<select class="form-control" name="status" id="status" required>
						<option value="1" <?php if($status == "1"){echo "selected";} ?>>Active</option>
						<option value="0" <?php if($status == "0"){echo "selected";} ?>>Inactive</option>
					</select>
				</div>
			</div>
			</div>
			<?php
			}
			?>
			
			</div>
			<?php
			if($_GET['action'] != ""){
			?>
			<div class="card-footer">
				<div class="form-group">
					<?php
					if($_GET['action'] == "new"){
					?>
					<button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-save"></i> Submit</button>
					<?php
					}
					else if($_GET['action'] == "edit"){
					?>
					<button type="submit" class="btn btn-success btn-sm" name="update" id="update"><i class="fa fa-save"></i> Update</button>
					<?php
					}
					?>
					<a href="?p=user" class="btn btn-black btn-sm"><i class="fa fa-undo"></i> Back</a>
				</div>
			</div>
			<?php
			}
			?>
		</form>
		</div>
	</div>
</div>
<script>
function check_delete(id){
	swal({
		title: 'Are you sure ?',
		text: 'You will not be able to revert this',
		type: 'warning',
		buttons:{
			confirm: {
				text : 'Yes, delete it',
				className : 'btn btn-success'
			},
			cancel: {
				visible: true,
				className: 'btn btn-danger'
			}
		}
	}).then((Delete) => {
		if (Delete) {
			window.location = '?p=department&action=delete&id='+id
		} else {
			swal.close();
		}
	});
	return false
}
</script>
<?php
if($_GET['action'] == "delete"){
	$userid = $_GET['id'];
	
	$q = mysql_query("DELETE FROM user WHERE userid='$userid'");
	if($q){
	echo "
	<script>
	jQuery(document).ready(function() {
		swal('Success', 'Deleted successfully', {
			icon : 'success',
			buttons: {        			
				confirm: {
					className : 'btn btn-success'
				}
			},
		}).then(function() {
			window.location = '?p=user'
		});
	});
	</script>
	";
	}
}
if(isset($_POST['submit'])){
	$userid = $_POST['userid'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$name = $_POST['name'];
	$departmentid = $_POST['departmentid'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$level = $_POST['level'];
	$status = $_POST['status'];
	
	$q = mysql_query("INSERT INTO user (username,password,name,departmentid,email,phone,level,status) VALUES('$username','$password','$name','$departmentid','$email','$phone','$level','$status')");
	if($q){
	echo "
	<script>
	jQuery(document).ready(function() {
		swal('Success', 'Submitted successfully', {
			icon : 'success',
			buttons: {        			
				confirm: {
					className : 'btn btn-success'
				}
			},
		}).then(function() {
			window.location = '?p=user'
		});
	});
	</script>
	";
	}
}
if(isset($_POST['update'])){
	$userid = $_POST['userid'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$name = $_POST['name'];
	$departmentid = $_POST['departmentid'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$level = $_POST['level'];
	$status = $_POST['status'];
	
	if($_POST['password'] != ""){
		$sql_password = "password='$password',";
	}
	else{
		$sql_password = "";
	}
	
	$q = mysql_query("UPDATE user SET username='$username', $sql_password name='$name', departmentid='$departmentid', email='$email', phone='$phone', level='$level', status='$status' WHERE userid='$userid'");
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
			window.location = window.location.href
		});
	});
	</script>
	";
	}
}
?>