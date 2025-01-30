<div class="row">
	<div class="col-md-12">
		<div class="card">
		<form method="post">
			<div class="card-header card-primary bg-primary-gradient">
				<div class="card-head-row">
					<div class="card-title">Form</div>
					<div class="card-tools">
						<a href="?p=form&action=new" class="btn btn-info btn-border btn-round btn-sm"><i class="fa fa-file"></i> New</a>
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
						<th>Form Code</th>
						<th>Form Number</th>
						<th>Form Name</th>
						<th>Approval 1</th>
						<th>Approval 2</th>
						<th>Approval 3</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i = 1;
				$q = mysql_query("SELECT * FROM form ORDER BY formname ASC");
				while($r = mysql_fetch_array($q)){
					$q_approval1 = mysql_query("SELECT * FROM user WHERE userid='$r[approval1]'");
					$r_approval1 = mysql_fetch_array($q_approval1);
					$approval1 = $r_approval1['name'];
					$q_approval2 = mysql_query("SELECT * FROM user WHERE userid='$r[approval2]'");
					$r_approval2 = mysql_fetch_array($q_approval2);
					$approval2 = $r_approval2['name'];
					$q_approval3 = mysql_query("SELECT * FROM user WHERE userid='$r[approval3]'");
					$r_approval3 = mysql_fetch_array($q_approval3);
					$approval3 = $r_approval3['name'];
					if($r['status'] == "1"){
						$status = "<span class='badge badge-success'>Active</span>";
					}
					else{
						$status = "<span class='badge badge-danger'>Inactive</span>";
					}
					echo "
					<tr>
						<td>$i</td>
						<td>$r[formcode]</td>
						<td>$r[formnumber]</td>
						<td>$r[formname]</td>
						<td>$approval1</td>
						<td>$approval2</td>
						<td>$approval3</td>
						<td>$status</td>
						<td>
							<div class='btn-group'>
								<a class='btn btn-primary btn-sm' href='?p=form&action=view&id=$r[formid]'><i class='fa fa-eye'></i> View</a>
								<a class='btn btn-success btn-sm' href='?p=form&action=edit&id=$r[formid]'><i class='fa fa-edit'></i> Edit</a>
								<a class='btn btn-danger btn-sm' href='?p=form&action=delete&id=$r[formid]' onclick=\"return check_delete('$r[formid]')\"><i class='fa fa-times'></i> Delete</a>
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
					<label for="formid">Form Id</label>
					<input type="text" class="form-control" name="formid" id="formid" value="" />
				</div>
				<div class="form-group">
					<label for="formcode">Form Code</label>
					<select class="form-control" name="formcode" id="formcode" required />
					<?php
					$path = "forms";
					$result = array_diff(scandir($path), array('.', '..'));
					foreach($result as $dir){
						if(is_dir($path.'/'.$dir)) {
							$r = mysql_fetch_array(mysql_query("SELECT * FROM form WHERE formcode='$dir'"));
							if($dir != $r['formcode']){
								echo "<option value='$dir'>$dir</option>";
							}
						}
					}
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="formnumber">Form Number</label>
					<input type="text" class="form-control" name="formnumber" id="formnumber" value="" required />
				</div>
				<div class="form-group">
					<label for="formname">Form Name</label>
					<input type="text" class="form-control" name="formname" id="formname" value="" required />
				</div>
				<div class="form-group">
					<label for="approval1">Approval 1 <br/><span class="badge badge-primary">Default</span></label>
					<select class="form-control" name="approval1" id="approval1">
						<option value=""></option>
						<?php
						$q_user = mysql_query("SELECT * FROM user ORDER BY name ASC");
						while($r_user = mysql_fetch_array($q_user)){
							echo "<option value='$r_user[userid]'>$r_user[name]</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="approval2">Approval 2 <br/><span class="badge badge-primary">Default</span></label>
					<select class="form-control" name="approval2" id="approval2">
						<option value=""></option>
						<?php
						$q_user = mysql_query("SELECT * FROM user ORDER BY name ASC");
						while($r_user = mysql_fetch_array($q_user)){
							echo "<option value='$r_user[userid]'>$r_user[name]</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="approval3">Approval 3 <br/><span class="badge badge-primary">Default</span></label>
					<select class="form-control" name="approval3" id="approval3">
						<option value=""></option>
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
			$q = mysql_query("SELECT * FROM form WHERE formid='$_GET[id]'");
			$r = mysql_fetch_array($q);
			$formid = $r['formid'];
			$formcode = $r['formcode'];
			$formnumber = $r['formnumber'];
			$formname = $r['formname'];
			$approval1 = $r['approval1'];
			$approval2 = $r['approval2'];
			$approval3 = $r['approval3'];
			$status = $r['status'];
			?>
			<div class="row">
			<div class="col-md-12">
				<div class="form-group d-none">
					<label for="formid">Form Id</label>
					<input type="text" class="form-control" name="formid" id="formid" value="<?php echo $formid; ?>" />
				</div>
				<div class="form-group">
					<label for="formcode">Form Code</label>
					<select class="form-control" name="formcode" id="formcode" disabled />
					<?php
					$path = "forms";
					$result = array_diff(scandir($path), array('.', '..'));
					foreach($result as $dir){
						if(is_dir($path.'/'.$dir)) {
							echo "<option value='$dir' "; if($dir == $formcode){echo "selected";} echo ">$dir</option>";
						}
					}
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="formnumber">Form Number</label>
					<input type="text" class="form-control" name="formnumber" id="formnumber" value="<?php echo $formnumber; ?>" disabled />
				</div>
				<div class="form-group">
					<label for="formname">Form Name</label>
					<input type="text" class="form-control" name="formname" id="formname" value="<?php echo $formname; ?>" disabled />
				</div>
				<div class="form-group">
					<label for="approval1">Approval 1 <br/><span class="badge badge-primary">Default</span></label>
					<select class="form-control" name="approval1" id="approval1" disabled>
						<option value=""></option>
						<?php
						$q_user = mysql_query("SELECT * FROM user ORDER BY name ASC");
						while($r_user = mysql_fetch_array($q_user)){
							echo "<option value='$r_user[userid]' "; if($r_user['userid'] == $approval1){echo "selected";} echo ">$r_user[name]</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="approval2">Approval 2 <br/><span class="badge badge-primary">Default</span></label>
					<select class="form-control" name="approval2" id="approval2" disabled>
						<option value=""></option>
						<?php
						$q_user = mysql_query("SELECT * FROM user ORDER BY name ASC");
						while($r_user = mysql_fetch_array($q_user)){
							echo "<option value='$r_user[userid]' "; if($r_user['userid'] == $approval2){echo "selected";} echo ">$r_user[name]</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="approval3">Approval 3 <br/><span class="badge badge-primary">Default</span></label>
					<select class="form-control" name="approval3" id="approval3" disabled>
						<option value=""></option>
						<?php
						$q_user = mysql_query("SELECT * FROM user ORDER BY name ASC");
						while($r_user = mysql_fetch_array($q_user)){
							echo "<option value='$r_user[userid]' "; if($r_user['userid'] == $approval3){echo "selected";} echo ">$r_user[name]</option>";
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
			
			<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Specific Authorization</label>
					<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped datatables">
						<thead>
							<tr>
								<th>No</th>
								<th>Username</th>
								<th>Name</th>
								<th>Department</th>
								<th>New</th>
								<th>View</th>
								<!--<th>Edit</th>-->
								<!--<th>Delete</th>-->
								<th>Approval 1 <br/><span class="badge badge-success">Specific</span></th>
								<th>Approval 2 <br/><span class="badge badge-success">Specific</span></th>
								<th>Approval 3 <br/><span class="badge badge-success">Specific</span></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i = 1;
						$q = mysql_query("SELECT * FROM user ORDER BY name ASC");
						while($r = mysql_fetch_array($q)){
						$q_department = mysql_query("SELECT * FROM department WHERE departmentid='$r[departmentid]'");
						$r_department = mysql_fetch_array($q_department);
						$q_form = mysql_query("SELECT user.username, user.name, form_user.new, form_user.view, form_user.edit, form_user.del, form_user.app1, form_user.app2, form_user.app3 FROM form_user INNER JOIN user ON user.userid=form_user.userid WHERE form_user.formid='$formid' AND form_user.userid='$r[userid]'");
						$r_form = mysql_fetch_array($q_form);
						echo "
							<tr>
								<td>$i</td>
								<td>$r[username]</td>
								<td>$r[name]</td>
								<td>$r_department[departmentname]</td>
								<td>"; if($r_form['new'] == "1"){echo "<input type='checkbox' value='1' onclick=\"setForm(this,'new','$formid','$r[userid]')\" checked disabled />";}else{echo "<input type='checkbox' value='1' onclick=\"setForm(this,'new','$formid','$r[userid]')\" disabled />";} echo "</td>
								<td>"; if($r_form['view'] == "1"){echo "<input type='checkbox' value='1' onclick=\"setForm(this,'view','$formid','$r[userid]')\" checked disabled />";}else{echo "<input type='checkbox' value='1' onclick=\"setForm(this,'view','$formid','$r[userid]')\" disabled />";} echo "</td>
								<!--<td>"; if($r_form['edit'] == "1"){echo "<input type='checkbox' value='1' onclick=\"setForm(this,'edit','$formid','$r[userid]')\" checked disabled />";}else{echo "<input type='checkbox' value='1' onclick=\"setForm(this,'edit','$formid','$r[userid]')\" disabled />";} echo "</td>-->
								<!--<td>"; if($r_form['del'] == "1"){echo "<input type='checkbox' value='1' onclick=\"setForm(this,'del','$formid','$r[userid]')\" checked disabled />";}else{echo "<input type='checkbox' value='1' onclick=\"setForm(this,'del','$formid','$r[userid]')\" disabled />";} echo "</td>-->
								<td>
									<select onchange=\"setFormSelect(this,'app1','$formid','$r[userid]')\" disabled>
										<option value=''></option>";
										$qq = mysql_query("SELECT * FROM user ORDER BY name ASC");
										while($rr = mysql_fetch_array($qq)){
											echo "<option value='$rr[userid]' "; if($r_form['app1'] == "$rr[userid]"){echo "selected";} echo ">$rr[name] ($rr[username])</option>";
										}
										echo "
									</select>
								</td>
								<td>
									<select onchange=\"setFormSelect(this,'app2','$formid','$r[userid]')\" disabled>
										<option value=''></option>";
										$qqq = mysql_query("SELECT * FROM user ORDER BY name ASC");
										while($rrr = mysql_fetch_array($qqq)){
											echo "<option value='$rrr[userid]' "; if($r_form['app2'] == "$rrr[userid]"){echo "selected";} echo ">$rrr[name] ($rrr[username])</option>";
										}
										echo "
									</select>
								</td>
								<td>
									<select onchange=\"setFormSelect(this,'app3','$formid','$r[userid]')\" disabled>
										<option value=''></option>";
										$qqqq = mysql_query("SELECT * FROM user ORDER BY name ASC");
										while($rrrr = mysql_fetch_array($qqqq)){
											echo "<option value='$rrrr[userid]' "; if($r_form['app3'] == "$rrrr[userid]"){echo "selected";} echo ">$rrrr[name] ($rrrr[username])</option>";
										}
										echo "
									</select>
								</td>
							</tr>
						";
						$i++;
						}
						?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
			</div>
			<?php
			}
			else if($_GET['action'] == "edit"){
			?>
			<?php
			$q = mysql_query("SELECT * FROM form WHERE formid='$_GET[id]'");
			$r = mysql_fetch_array($q);
			$formid = $r['formid'];
			$formcode = $r['formcode'];
			$formnumber = $r['formnumber'];
			$formname = $r['formname'];
			$approval1 = $r['approval1'];
			$approval2 = $r['approval2'];
			$approval3 = $r['approval3'];
			$status = $r['status'];
			?>
			<div class="row">
			<div class="col-md-12">
				<div class="form-group d-none">
					<label for="formid">Form Id</label>
					<input type="text" class="form-control" name="formid" id="formid" value="<?php echo $formid; ?>" />
				</div>
				<div class="form-group">
					<label for="formcode">Form Code</label>
					<select class="form-control" name="formcode" id="formcode" onmousedown="return false" readonly required />
					<?php
					$path = "forms";
					$result = array_diff(scandir($path), array('.', '..'));
					foreach($result as $dir){
						if(is_dir($path.'/'.$dir)) {
							echo "<option value='$dir' "; if($dir == $formcode){echo "selected";} echo ">$dir</option>";
						}
					}
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="formnumber">Form Number</label>
					<input type="text" class="form-control" name="formnumber" id="formnumber" value="<?php echo $formnumber; ?>" required />
				</div>
				<div class="form-group">
					<label for="formname">Form Name</label>
					<input type="text" class="form-control" name="formname" id="formname" value="<?php echo $formname; ?>" required />
				</div>
				<div class="form-group">
					<label for="approval1">Approval 1 <br/><span class="badge badge-primary">Default</span></label>
					<select class="form-control" name="approval1" id="approval1">
						<option value=""></option>
						<?php
						$q_user = mysql_query("SELECT * FROM user ORDER BY name ASC");
						while($r_user = mysql_fetch_array($q_user)){
							echo "<option value='$r_user[userid]' "; if($r_user['userid'] == $approval1){echo "selected";} echo ">$r_user[name]</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="approval2">Approval 2 <br/><span class="badge badge-primary">Default</span></label>
					<select class="form-control" name="approval2" id="approval2">
						<option value=""></option>
						<?php
						$q_user = mysql_query("SELECT * FROM user ORDER BY name ASC");
						while($r_user = mysql_fetch_array($q_user)){
							echo "<option value='$r_user[userid]' "; if($r_user['userid'] == $approval2){echo "selected";} echo ">$r_user[name]</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="approval3">Approval 3 <br/><span class="badge badge-primary">Default</span></label>
					<select class="form-control" name="approval3" id="approval3">
						<option value=""></option>
						<?php
						$q_user = mysql_query("SELECT * FROM user ORDER BY name ASC");
						while($r_user = mysql_fetch_array($q_user)){
							echo "<option value='$r_user[userid]' "; if($r_user['userid'] == $approval3){echo "selected";} echo ">$r_user[name]</option>";
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
			
			<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Specific Authorization</label>
					<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped datatables">
						<thead>
							<tr>
								<th>No</th>
								<th>Username</th>
								<th>Name</th>
								<th>Department</th>
								<th>Transaction</th>
								<th>Master</th>
								<th>Approval 1 <br/><span class="badge badge-success">Specific</span></th>
								<th>Approval 2 <br/><span class="badge badge-success">Specific</span></th>
								<th>Approval 3 <br/><span class="badge badge-success">Specific</span></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i = 1;
						$q = mysql_query("SELECT * FROM user ORDER BY name ASC");
						while($r = mysql_fetch_array($q)){
						$q_department = mysql_query("SELECT * FROM department WHERE departmentid='$r[departmentid]'");
						$r_department = mysql_fetch_array($q_department);
						$q_form = mysql_query("SELECT user.username, user.name, form_user.new, form_user.view, form_user.master_new, form_user.master_view, form_user.master_edit, form_user.master_del, form_user.app1, form_user.app2, form_user.app3 FROM form_user INNER JOIN user ON user.userid=form_user.userid WHERE form_user.formid='$formid' AND form_user.userid='$r[userid]'");
						$r_form = mysql_fetch_array($q_form);
						echo "
							<tr>
								<td>$i</td>
								<td>$r[username]</td>
								<td>$r[name]</td>
								<td>$r_department[departmentname]</td>
								<td><label>"; if($r_form['new'] == "1"){echo "<input type='checkbox' value='1' onclick=\"setForm(this,'new','$formid','$r[userid]')\" checked />";}else{echo "<input type='checkbox' value='1' onclick=\"setForm(this,'new','$formid','$r[userid]')\" />";} echo "New</label>
								<label>"; if($r_form['view'] == "1"){echo "<input type='checkbox' value='1' onclick=\"setForm(this,'view','$formid','$r[userid]')\" checked />";}else{echo "<input type='checkbox' value='1' onclick=\"setForm(this,'view','$formid','$r[userid]')\" />";} echo "View</label></td>
								<td><label>"; if($r_form['master_new'] == "1"){echo "<input type='checkbox' value='1' onclick=\"setForm(this,'master_new','$formid','$r[userid]')\" checked />";}else{echo "<input type='checkbox' value='1' onclick=\"setForm(this,'master_new','$formid','$r[userid]')\" />";} echo "New</label>
								<label>"; if($r_form['master_view'] == "1"){echo "<input type='checkbox' value='1' onclick=\"setForm(this,'master_view','$formid','$r[userid]')\" checked />";}else{echo "<input type='checkbox' value='1' onclick=\"setForm(this,'master_view','$formid','$r[userid]')\" />";} echo "View</label>
								<label>"; if($r_form['master_edit'] == "1"){echo "<input type='checkbox' value='1' onclick=\"setForm(this,'master_edit','$formid','$r[userid]')\" checked />";}else{echo "<input type='checkbox' value='1' onclick=\"setForm(this,'master_edit','$formid','$r[userid]')\" />";} echo "Edit</label>
								<label>"; if($r_form['master_del'] == "1"){echo "<input type='checkbox' value='1' onclick=\"setForm(this,'master_del','$formid','$r[userid]')\" checked />";}else{echo "<input type='checkbox' value='1' onclick=\"setForm(this,'master_del','$formid','$r[userid]')\" />";} echo "Del</label></td>
								<td>
									<select onchange=\"setFormSelect(this,'app1','$formid','$r[userid]')\">
										<option value=''></option>";
										$qq = mysql_query("SELECT * FROM user ORDER BY name ASC");
										while($rr = mysql_fetch_array($qq)){
											echo "<option value='$rr[userid]' "; if($r_form['app1'] == "$rr[userid]"){echo "selected";} echo ">$rr[name] ($rr[username])</option>";
										}
										echo "
									</select>
								</td>
								<td>
									<select onchange=\"setFormSelect(this,'app2','$formid','$r[userid]')\">
										<option value=''></option>";
										$qqq = mysql_query("SELECT * FROM user ORDER BY name ASC");
										while($rrr = mysql_fetch_array($qqq)){
											echo "<option value='$rrr[userid]' "; if($r_form['app2'] == "$rrr[userid]"){echo "selected";} echo ">$rrr[name] ($rrr[username])</option>";
										}
										echo "
									</select>
								</td>
								<td>
									<select onchange=\"setFormSelect(this,'app3','$formid','$r[userid]')\">
										<option value=''></option>";
										$qqqq = mysql_query("SELECT * FROM user ORDER BY name ASC");
										while($rrrr = mysql_fetch_array($qqqq)){
											echo "<option value='$rrrr[userid]' "; if($r_form['app3'] == "$rrrr[userid]"){echo "selected";} echo ">$rrrr[name] ($rrrr[username])</option>";
										}
										echo "
									</select>
								</td>
							</tr>
						";
						$i++;
						}
						?>
						</tbody>
					</table>
					</div>
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
					<a href="?p=form" class="btn btn-black btn-sm"><i class="fa fa-undo"></i> Back</a>
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
function setForm(e,str_type,str_formid,str_userid){
	if(e.checked == true){
		$.ajax({
			async: false,
			url: "settings/formuser.php?type="+str_type+"&formid="+str_formid+"&userid="+str_userid+"&value=1",
			success: function(msg){
				if(msg.trim() == "ok"){
				swal('Success', 'Add successfully', {
					icon : 'success',
					buttons: {        			
						confirm: {
							className : 'btn btn-success'
						}
					},
				}).then(function() {
					window.location = window.location.href
				});
				}
			},
			dataType: "html"
		});
	}
	else{
		$.ajax({
			async: false,
			url: "settings/formuser.php?type="+str_type+"&formid="+str_formid+"&userid="+str_userid+"&value=0",
			success: function(msg){
				if(msg.trim() == "ok"){
				swal('Success', 'Remove successfully', {
					icon : 'success',
					buttons: {        			
						confirm: {
							className : 'btn btn-success'
						}
					},
				}).then(function() {
					window.location = window.location.href
				});
				}
			},
			dataType: "html"
		});
	}
}
function setFormSelect(e,str_type,str_formid,str_userid){
	if(e.value != ""){
		$.ajax({
			async: false,
			url: "settings/formuser.php?type="+str_type+"&formid="+str_formid+"&userid="+str_userid+"&value="+e.value,
			success: function(msg){
				if(msg.trim() == "ok"){
				swal('Success', 'Add successfully', {
					icon : 'success',
					buttons: {        			
						confirm: {
							className : 'btn btn-success'
						}
					},
				}).then(function() {
					window.location = window.location.href
				});
				}
			},
			dataType: "html"
		});
	}
	else{
		$.ajax({
			async: false,
			url: "settings/formuser.php?type="+str_type+"&formid="+str_formid+"&userid="+str_userid+"&value=0",
			success: function(msg){
				if(msg.trim() == "ok"){
				swal('Success', 'Remove successfully', {
					icon : 'success',
					buttons: {        			
						confirm: {
							className : 'btn btn-success'
						}
					},
				}).then(function() {
					window.location = window.location.href
				});
				}
			},
			dataType: "html"
		});
	}
}
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
			window.location = '?p=form&action=delete&id='+id
		} else {
			swal.close();
		}
	});
	return false
}
</script>
<?php
if($_GET['action'] == "delete"){
	$formid = $_GET['id'];
	
	$q = mysql_query("DELETE FROM form WHERE formid='$formid'");
	$q_user = mysql_query("DELETE FROM form_user WHERE formid='$formid'");
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
			window.location = '?p=form'
		});
	});
	</script>
	";
	}
}
if(isset($_POST['submit'])){
	$formid = $_POST['formid'];
	$formcode = $_POST['formcode'];
	$formnumber = $_POST['formnumber'];
	$formname = $_POST['formname'];
	$approval1 = $_POST['approval1'];
	$approval2 = $_POST['approval2'];
	$approval3 = $_POST['approval3'];
	$status = $_POST['status'];
	
	$q = mysql_query("INSERT INTO form (formcode,formnumber,formname,approval1,approval2,approval3,status) VALUES('$formcode','$formnumber','$formname','$approval1','$approval2','$approval3','$status')");
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
			window.location = '?p=form'
		});
	});
	</script>
	";
	}
}
if(isset($_POST['update'])){
	$formid = $_POST['formid'];
	$formcode = $_POST['formcode'];
	$formnumber = $_POST['formnumber'];
	$formname = $_POST['formname'];
	$approval1 = $_POST['approval1'];
	$approval2 = $_POST['approval2'];
	$approval3 = $_POST['approval3'];
	$status = $_POST['status'];
	
	$q = mysql_query("UPDATE form SET formcode='$formcode', formnumber='$formnumber', formname='$formname', approval1='$approval1', approval2='$approval2', approval3='$approval3', status='$status' WHERE formid='$formid'");
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