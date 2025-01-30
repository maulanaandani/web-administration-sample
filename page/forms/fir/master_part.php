<div class="row">
	<div class="col-md-12">
		<div class="card">
		<form method="post">
			<div class="card-header card-primary bg-primary-gradient">
				<div class="card-head-row">
					<div class="card-title">Department</div>
					<div class="card-tools">
						<a href="?p=department&action=new" class="btn btn-info btn-border btn-round btn-sm"><i class="fa fa-file"></i> New</a>
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
						<th>Part Number</th>
						<th>Part Name</th>
						<th>Department Head</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i = 1;
				$q = mysql_query("SELECT * FROM department ORDER BY departmentname ASC");
				while($r = mysql_fetch_array($q)){
					$q_user = mysql_query("SELECT * FROM user WHERE userid='$r[departmenthead]'");
					$r_user = mysql_fetch_array($q_user);
					$departmenthead = $r_user['name'];
					if($r['status'] == "1"){
						$status = "<span class='badge badge-success'>Active</span>";
					}
					else{
						$status = "<span class='badge badge-danger'>Inactive</span>";
					}
					echo "
					<tr>
						<td>$i</td>
						<td>$r[departmentcode]</td>
						<td>$r[departmentname]</td>
						<td>$departmenthead</td>
						<td>$status</td>
						<td>
							<div class='btn-group'>
								<a class='btn btn-primary btn-sm' href='?p=department&action=view&id=$r[departmentid]'><i class='fa fa-eye'></i> View</a>
								<a class='btn btn-success btn-sm' href='?p=department&action=edit&id=$r[departmentid]'><i class='fa fa-edit'></i> Edit</a>
								<a class='btn btn-danger btn-sm' href='?p=department&action=delete&id=$r[departmentid]' onclick=\"return check_delete('$r[departmentid]')\"><i class='fa fa-times'></i> Delete</a>
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
					<label for="departmentid">Department Id</label>
					<input type="text" class="form-control" name="departmentid" id="departmentid" value="" />
				</div>
				<div class="form-group">
					<label for="departmentcode">Part Number</label>
					<input type="text" class="form-control" name="departmentcode" id="departmentcode" value="" required />
				</div>
				<div class="form-group">
					<label for="departmentname">Part Name</label>
					<input type="text" class="form-control" name="departmentname" id="departmentname" value="" required />
				</div>
				<div class="form-group">
					<label for="departmenthead">Department Head</label>
					<select class="form-control" name="departmenthead" id="departmenthead" required>
						<?php
						$q_user = mysql_query("SELECT * FROM user ORDER BY name ASC");
						while($r_user = mysql_fetch_array($q_user)){
							echo "<option value='$r_user[userid]'>$r_user[name]</option>";
						}
						?>
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
			$q = mysql_query("SELECT * FROM department WHERE departmentid='$_GET[id]'");
			$r = mysql_fetch_array($q);
			$departmentid = $r['departmentid'];
			$departmentcode = $r['departmentcode'];
			$departmentname = $r['departmentname'];
			$departmenthead = $r['departmenthead'];
			$status = $r['status'];
			?>
			<div class="row">
			<div class="col-md-12">
				<div class="form-group d-none">
					<label for="departmentid">Department Id</label>
					<input type="text" class="form-control" name="departmentid" id="departmentid" value="<?php echo $departmentid; ?>" />
				</div>
				<div class="form-group">
					<label for="departmentcode">Part Number</label>
					<input type="text" class="form-control" name="departmentcode" id="departmentcode" value="<?php echo $departmentcode; ?>" disabled />
				</div>
				<div class="form-group">
					<label for="departmentname">Part Name</label>
					<input type="text" class="form-control" name="departmentname" id="departmentname" value="<?php echo $departmentname; ?>" disabled />
				</div>
				<div class="form-group">
					<label for="departmenthead">Department Head</label>
					<select class="form-control" name="departmenthead" id="departmenthead" disabled>
						<?php
						$q_user = mysql_query("SELECT * FROM user ORDER BY name ASC");
						while($r_user = mysql_fetch_array($q_user)){
							echo "<option value='$r_user[userid]' "; if($r_user['userid'] == $departmenthead){echo "selected";} echo ">$r_user[name]</option>";
						}
						?>
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
			$q = mysql_query("SELECT * FROM department WHERE departmentid='$_GET[id]'");
			$r = mysql_fetch_array($q);
			$departmentid = $r['departmentid'];
			$departmentcode = $r['departmentcode'];
			$departmentname = $r['departmentname'];
			$departmenthead = $r['departmenthead'];
			$status = $r['status'];
			?>
			<div class="row">
			<div class="col-md-12">
				<div class="form-group d-none">
					<label for="departmentid">Department Id</label>
					<input type="text" class="form-control" name="departmentid" id="departmentid" value="<?php echo $departmentid; ?>" />
				</div>
				<div class="form-group">
					<label for="departmentcode">Part Number</label>
					<input type="text" class="form-control" name="departmentcode" id="departmentcode" value="<?php echo $departmentcode; ?>" required />
				</div>
				<div class="form-group">
					<label for="departmentname">Part Name</label>
					<input type="text" class="form-control" name="departmentname" id="departmentname" value="<?php echo $departmentname; ?>" required />
				</div>
				<div class="form-group">
					<label for="departmenthead">Department Head</label>
					<select class="form-control" name="departmenthead" id="departmenthead" required>
						<?php
						$q_user = mysql_query("SELECT * FROM user ORDER BY name ASC");
						while($r_user = mysql_fetch_array($q_user)){
							echo "<option value='$r_user[userid]' "; if($r_user['userid'] == $departmenthead){echo "selected";} echo ">$r_user[name]</option>";
						}
						?>
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
					<a href="?p=department" class="btn btn-black btn-sm"><i class="fa fa-undo"></i> Back</a>
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
	$departmentid = $_GET['id'];
	
	$q = mysql_query("DELETE FROM department WHERE departmentid='$departmentid'");
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
			window.location = '?p=department'
		});
	});
	</script>
	";
	}
}
if(isset($_POST['submit'])){
	$departmentid = $_POST['departmentid'];
	$departmentcode = $_POST['departmentcode'];
	$departmentname = $_POST['departmentname'];
	$departmenthead = $_POST['departmenthead'];
	$status = $_POST['status'];
	
	$q = mysql_query("INSERT INTO department (departmentcode,departmentname,departmenthead,status) VALUES('$departmentcode','$departmentname','$departmenthead','$status')");
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
			window.location = '?p=department'
		});
	});
	</script>
	";
	}
}
if(isset($_POST['update'])){
	$departmentid = $_POST['departmentid'];
	$departmentcode = $_POST['departmentcode'];
	$departmentname = $_POST['departmentname'];
	$departmenthead = $_POST['departmenthead'];
	$status = $_POST['status'];
	
	$q = mysql_query("UPDATE department SET departmentcode='$departmentcode', departmentname='$departmentname', departmenthead='$departmenthead', status='$status' WHERE departmentid='$departmentid'");
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