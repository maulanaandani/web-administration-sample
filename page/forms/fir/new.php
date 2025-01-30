<div class="row">
	<div class="col-md-12">
		<div class="card">
		<form method="post">
			<div class="card-header card-primary bg-primary-gradient">
				<div class="card-head-row">
					<div class="card-title">New - Final Inspection Report</div>
				</div>
			</div>
			<div class="card-body">
			
			<?php
			$r = mysql_fetch_array(mysql_query("SELECT * FROM form_fir ORDER BY number DESC LIMIT 1"));
			$n = "FIR".date('y')."0000000";
			$nu = $r['number'] ? $r['number'] : $n;
			$num = substr($nu,5,7);
			$number = "FIR".date('y').sprintf("%07d",$num+1); 
			?>
			
			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="number">Number</label>
					<input type="text" class="form-control" name="number" id="number" value="<?php echo $number; ?>" readonly />
				</div>
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name" id="name" value="<?php echo $_name; ?>" readonly />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="datecreated">Datecreated</label>
					<input type="text" class="form-control" name="datecreated" id="datecreated" value="<?php echo date('Y-m-d'); ?>" readonly />
				</div>
				<div class="form-group">
					<label for="department">Department</label>
					<input type="text" class="form-control" name="department" id="department" value="<?php echo $_departmentname; ?>" readonly />
				</div>
			</div>
			</div>
			<div class="separator-dashed bg-primary"></div>
			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="customername">Customer Name</label>
					<select class="form-control" name="customername" id="customername" required>
						<option value="" data-id="">&nbsp;</option>
						<?php
						$customer_sql = mysql_query("SELECT * FROM customer ORDER BY customername");
						while($customer_row = mysql_fetch_array($customer_sql)){
							echo "<option value='$customer_row[customername]'>$customer_row[customername]</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="partnumber">Part Number</label>
					<select class="form-control" name="partnumber" id="partnumber" onchange="$('#partname').val($(this).find(':selected').attr('data-id'))" required>
						<option value="" data-id="">&nbsp;</option>
						<?php
						$part_sql = mysql_query("SELECT * FROM part ORDER BY partnumber");
						while($part_row = mysql_fetch_array($part_sql)){
							echo "<option value='$part_row[partnumber]' data-id='$part_row[partname]'>$part_row[partnumber] - $part_row[partname]</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="partname">Part Name</label>
					<input type="text" class="form-control" name="partname" id="partname" required readonly />
				</div>
				<div class="form-group">
					<label for="checkcode">Check Code</label>
					<input type="text" class="form-control" name="checkcode" id="checkcode" value="<?php echo date('ymd'); ?>" required />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="batchnumber">Batch Number</label>
					<input type="text" class="form-control" name="batchnumber" id="batchnumber" value="<?php echo date('ymd'); ?>" required />
				</div>
				<div class="form-group">
					<label for="totallotqty">Total LOT QTY</label>
					<input type="text" class="form-control" name="totallotqty" id="totallotqty" required readonly />
				</div>
				<div class="form-group">
					<label for="standardqc">Standard QC</label>
					<select class="form-control" name="standardqc" id="standardqc" required>
						<option value="100%">100%</option>
						<option value="TL3">Tighten Level III</option>
						<option value="TL2">Tighten Level II</option>
						<option value="NL2">Normal Level II</option>
					</select>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<img id="result_drawing" width="100%" />
				</div>
				<div class="form-group">
					<div class="table-responsive">
					<table class="table table-bordered table-hover tablex">
						<thead>
							<tr>
								<th rowspan="3">No</th>
								<th rowspan="3">Inspection Items</th>
								<th rowspan="2" colspan="2">AQL (Accept Quality Limit)</th>
								<?php
								for($i=1;$i<=5;$i++){
								echo "<th colspan='3'>".convertToRoman($i)."</th>";
								}
								?>
							</tr>
							<tr>
								<?php
								for($i=1;$i<=5;$i++){
								echo "<th colspan='3'>Prod. Qty: <input type='text' class='prodqty' name='prodqty[]' id='prodqty$i' style='width:100px' /></th>";
								}
								?>
							</tr>
							<tr>
								<th>Ac</th>
								<th>Re</th>
								<?php
								for($i=1;$i<=5;$i++){
								echo "
								<th>n</th>
								<th>a</th>
								<th>r</th>
								";
								}
								?>
							</tr>
						</thead>
						<tbody id="result_inspection">
							<?php
							echo "
							<tr>
								<td>1</td>
								<td>Identity<input type='hidden' class='' style='width:50px' name='item[]' value='Identity' /></td>
								<td><input type='text' class='' style='width:50px' name='ac[]' value='$r_identity_ac' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='re[]' value='$r_identity_re' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n[]' value='$r_identity_n' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n2[]' value='$r_identity_n2' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a2[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r2[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n3[]' value='$r_identity_n3' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a3[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r3[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n4[]' value='$r_identity_n4' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a4[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r4[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n5[]' value='$r_identity_n5' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a5[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r5[]' readonly /></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Packaging<input type='hidden' class='' style='width:50px' name='item[]' value='Packaging' /></td>
								<td><input type='text' class='' style='width:50px' name='ac[]' value='$r_packaging_ac' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='re[]' value='$r_packaging_re' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n[]' value='$r_packaging_n' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n2[]' value='$r_packaging_n2' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a2[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r2[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n3[]' value='$r_packaging_n3' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a3[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r3[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n4[]' value='$r_packaging_n4' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a4[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r4[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n5[]' value='$r_packaging_n5' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a5[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r5[]' readonly /></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Quantity<input type='hidden' class='' style='width:50px' name='item[]' value='Quantity' /></td>
								<td><input type='text' class='' style='width:50px' name='ac[]' value='$r_quantity_ac' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='re[]' value='$r_quantity_re' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n[]' value='$r_quantity_n' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n2[]' value='$r_quantity_n2' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a2[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r2[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n3[]' value='$r_quantity_n3' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a3[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r3[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n4[]' value='$r_quantity_n4' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a4[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r4[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n5[]' value='$r_quantity_n5' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a5[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r5[]' readonly /></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Appearance<input type='hidden' class='' style='width:50px' name='item[]' value='Appearance' /></td>
								<td><input type='text' class='' style='width:50px' name='ac[]' value='$r_appearance_ac' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='re[]' value='$r_appearance_re' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n[]' value='$r_appearance_n' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n2[]' value='$r_appearance_n2' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a2[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r2[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n3[]' value='$r_appearance_n3' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a3[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r3[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n4[]' value='$r_appearance_n4' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a4[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r4[]' readonly /></td>
								<td><input type='text' class='' style='width:50px' name='n5[]' value='$r_appearance_n5' readonly /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a5[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r5[]' readonly /></td>
							</tr>
							<tr>
								<td>5</td>
								<td>Application<input type='hidden' class='' style='width:50px' name='item[]' value='Application' /></td>
								<td><input type='text' class='' style='width:50px' name='ac[]' value='$r_application_ac' /></td>
								<td><input type='text' class='' style='width:50px' name='re[]' value='$r_application_re' /></td>
								<td><input type='text' class='' style='width:50px' name='n[]' value='$r_application_n' /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r[]' /></td>
								<td><input type='text' class='' style='width:50px' name='n2[]' value='$r_application_n2' /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a2[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r2[]' /></td>
								<td><input type='text' class='' style='width:50px' name='n3[]' value='$r_application_n3' /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a3[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r3[]' /></td>
								<td><input type='text' class='' style='width:50px' name='n4[]' value='$r_application_n4' /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a4[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r4[]' /></td>
								<td><input type='text' class='' style='width:50px' name='n5[]' value='$r_application_n5' /></td>
								<td><input type='text' class='qty_a' style='width:50px' name='a5[]' /></td>
								<td><input type='text' class='' style='width:50px' name='r5[]' /></td>
							</tr>
							<tr>
								<th colspan='4'>Judgement</th>
								<td colspan='3'><input type='text' id='judgement1' style='width:180px' name='judgement[]' readonly /></td>
								<td colspan='3'><input type='text' id='judgement2' style='width:180px' name='judgement[]' readonly /></td>
								<td colspan='3'><input type='text' id='judgement3' style='width:180px' name='judgement[]' readonly /></td>
								<td colspan='3'><input type='text' id='judgement4' style='width:180px' name='judgement[]' readonly /></td>
								<td colspan='3'><input type='text' id='judgement5' style='width:180px' name='judgement[]' readonly /></td>
							</tr>
							<tr>
								<th colspan='4'>Time</th>
								<td colspan='3'><input type='text' id='time1' style='width:180px' name='time[]' /></td>
								<td colspan='3'><input type='text' id='time2' style='width:180px' name='time[]' /></td>
								<td colspan='3'><input type='text' id='time3' style='width:180px' name='time[]' /></td>
								<td colspan='3'><input type='text' id='time4' style='width:180px' name='time[]' /></td>
								<td colspan='3'><input type='text' id='time5' style='width:180px' name='time[]' /></td>
							</tr>
							";
							?>
						</tbody>
					</table>
					</div>
				</div>
				<div class="form-group">
					<div class="table-responsive">
					<table class="table table-bordered table-hover tablex">
						<thead>
							<tr>
								<th rowspan="2" width="3%">No</th>
								<th rowspan="2" width="10%">Check Point</th>
								<th rowspan="2" width="17%">Tolerance</th>
								<th rowspan="2" width="10%">Specs</th>
								<th colspan="12">Hasil Pengukuran</th>
								<th rowspan="2">Judgement</th>
							</tr>
							<tr>
								<?php
								for($i=1;$i<=12;$i++){
								echo "<th>$i</th>";
								}
								?>
							</tr>
						</thead>
						<tbody id="result_checkpoint">
							<?php
							for($i=1;$i<=10;$i++){
								echo "
								<tr>
									<td>$i<input type='hidden' id='lowerlimit' name='lowerlimit[]' value='' /><input type='hidden' id='upperlimit' name='upperlimit[]' value='' /></td>
									<td><input type='text' style='width:100px' name='checkpoint[]' readonly /></td>
									<td><input type='text' style='width:170px' name='tolerance[]' readonly /></td>
									<td><input type='text' style='width:100px' name='specs[]' readonly /></td>
									<td><input type='text' style='width:50px' class='val' name='val[]' data-id='' /></td>
									<td><input type='text' style='width:50px' class='val' name='val2[]' data-id='' /></td>
									<td><input type='text' style='width:50px' class='val' name='val3[]' data-id='' /></td>
									<td><input type='text' style='width:50px' class='val' name='val4[]' data-id='' /></td>
									<td><input type='text' style='width:50px' class='val' name='val5[]' data-id='' /></td>
									<td><input type='text' style='width:50px' class='val' name='val6[]' data-id='' /></td>
									<td><input type='text' style='width:50px' class='val' name='val7[]' data-id='' /></td>
									<td><input type='text' style='width:50px' class='val' name='val8[]' data-id='' /></td>
									<td><input type='text' style='width:50px' class='val' name='val9[]' data-id='' /></td>
									<td><input type='text' style='width:50px' class='val' name='val10[]' data-id='' /></td>
									<td><input type='text' style='width:50px' class='val' name='val11[]' data-id='' /></td>
									<td><input type='text' style='width:50px' class='val' name='val12[]' data-id='' /></td>
									<td><input type='text' style='width:100px' id='judgementcheck' name='judgementcheck[]' readonly /></td>
								</tr>
								";
							}
							?>
						</tbody>
					</table>
					</div>
				</div>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="lastissue">Last Known Issue</label>
						<textarea class="form-control" name="lastissue" id="lastissue" rows="10" required ></textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="issueproduction">Issue From Production</label>
						<input type="text" class="form-control" name="issueproduction" id="issueproduction" required readonly />
					</div>
					<div class="form-group">
						<label for="receiptproduction">Receipt From Production</label>
						<input type="text" class="form-control" name="receiptproduction" id="receiptproduction" required readonly />
					</div>
					<div class="form-group">
						<label for="inventorytransfer">Inventory Transfer</label>
						<input type="text" class="form-control" name="inventorytransfer" id="inventorytransfer" required readonly />
					</div>
				</div>
				</div>
				<div class="form-group">
					<label for="final">Final Decision</label>
					<select class="form-control" name="final" id="final" required>
						<option value="PASS">PASS</option>
						<option value="REWORK">REWORK</option>
						<option value="REJECT">REJECT</option>
					</select>
				</div>
			</div>
			</div>
			<div class="form-group">
				<label for="remark">Remark</label>
				<textarea class="form-control" name="remark" id="remark"></textarea>
			</div>
			<div class="separator-dashed bg-primary"></div>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr class="bg-primary-gradient text-white">
							<th></th>
							<th>Name</th>
							<th>Status</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php
						echo "
						<tr>
							<td class='text-primary'>Creator</td>
							<td><input type='hidden' name='creator' value='$_userid' />$_name</td>
							<td><span class='badge badge-black'>Submitted</span></td>
							<td>".date('Y-m-d')."</td>
						</tr>
						";
						if($_approval1_name != ""){
						echo "
						<tr>
							<td class='text-primary'>Approval 1</td>
							<td><input type='hidden' name='approval1' value='$_approval1_id' />$_approval1_name</td>
							<td><input type='hidden' name='status1' value='0' /><span class='badge badge-black'>Opened</span></td>
							<td><input type='hidden' name='date1' value='".date('Y-m-d')."' />".date('Y-m-d')."</td>
						</tr>
						";
						}
						if($_approval2_name != ""){
						echo "
						<tr>
							<td class='text-primary'>Approval 2</td>
							<td><input type='hidden' name='approval2' value='$_approval2_id' />$_approval2_name</td>
							<td><input type='hidden' name='status2' value='0' /><span class='badge badge-black'>Opened</span></td>
							<td><input type='hidden' name='date2' value='".date('Y-m-d')."' />".date('Y-m-d')."</td>
						</tr>
						";
						}
						if($_approval3_name != ""){
						echo "
						<tr>
							<td class='text-primary'>Approval 3</td>
							<td><input type='hidden' name='approval3' value='$_approval3_id' />$_approval3_name</td>
							<td><input type='hidden' name='status3' value='0' /><span class='badge badge-black'>Opened</span></td>
							<td><input type='hidden' name='date3' value='".date('Y-m-d')."' />".date('Y-m-d')."</td>
						</tr>
						";
						}
						echo "
						<tr class='bg-light'>
							<td class='text-primary' colspan='2' align='center'>Status Form</td>
							<td><span class='badge badge-black'>Opened</span></td>
							<td>".date('Y-m-d')."</td>
						</tr>
						";
						?>
					</tbody>
				</table>
			</div>
			
			</div>
			<div class="card-footer">
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-save"></i> Submit</button>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>
<?php
if(isset($_POST['submit'])){
	
	$number = $_POST['number'];
	$datecreated = $_POST['datecreated'];
	$name = $_POST['name'];
	$department = $_POST['department'];
	
	$customername = $_POST['customername'];
	$partnumber = $_POST['partnumber'];
	$partname = $_POST['partname'];
	$checkcode = $_POST['checkcode'];
	$batchnumber = $_POST['batchnumber'];
	$totallotqty = $_POST['totallotqty'];
	$standardqc = $_POST['standardqc'];
	
	$item = $_POST['item'];
	$ac = $_POST['ac'];
	$re = $_POST['re'];
	$n = $_POST['n'];
	$a = $_POST['a'];
	$r = $_POST['r'];
	$n2 = $_POST['n2'];
	$a2 = $_POST['a2'];
	$r2 = $_POST['r2'];
	$n3 = $_POST['n3'];
	$a3 = $_POST['a3'];
	$r3 = $_POST['r3'];
	$n4 = $_POST['n4'];
	$a4 = $_POST['a4'];
	$r4 = $_POST['r4'];
	$n5 = $_POST['n5'];
	$a5 = $_POST['a5'];
	$r5 = $_POST['r5'];
	$prodqty = $_POST['prodqty'];
	$judgement = $_POST['judgement'];
	$time = $_POST['time'];
	
	$checkpoint = $_POST['checkpoint'];
	$tolerance = $_POST['tolerance'];
	$specs = $_POST['specs'];
	$lowerlimit = $_POST['lowerlimit'];
	$upperlimit = $_POST['upperlimit'];
	$val = $_POST['val'];
	$val2 = $_POST['val2'];
	$val3 = $_POST['val3'];
	$val4 = $_POST['val4'];
	$val5 = $_POST['val5'];
	$val6 = $_POST['val6'];
	$val7 = $_POST['val7'];
	$val8 = $_POST['val8'];
	$val9 = $_POST['val9'];
	$val10 = $_POST['val10'];
	$val11 = $_POST['val11'];
	$val12 = $_POST['val12'];
	$judgementcheck = $_POST['judgementcheck'];
	
	$lastissue = $_POST['lastissue'];
	$issueproduction = $_POST['issueproduction'];
	$receiptproduction = $_POST['receiptproduction'];
	$inventorytransfer = $_POST['inventorytransfer'];
	
	$final = $_POST['final'];
	$remark = $_POST['remark'];
	
	$creator = $_POST['creator'];
	$approval1 = $_POST['approval1'];
	$status1 = $_POST['status1'];
	$date1 = $_POST['date1'];
	$approval2 = $_POST['approval2'];
	$status2 = $_POST['status2'];
	$date2 = $_POST['date2'];
	$approval3 = $_POST['approval3'];
	$status3 = $_POST['status3'];
	$date3 = $_POST['date3'];
	
	$status = "0";
	$date = $datecreated;
	$tag = "1";
	
	//tform_fir
	$q = mysql_query("INSERT INTO form_fir (number,datecreated,name,department,customername,partnumber,partname,checkcode,batchnumber,totallotqty,standardqc,lastissue,issueproduction,receiptproduction,inventorytransfer,final,remark,creator,approval1,status1,date1,approval2,status2,date2,approval3,status3,date3,status,date,tag) VALUES('$number','$datecreated','$name','$department','$customername','$partnumber','$partname','$checkcode','$batchnumber','$totallotqty','$standardqc','$lastissue','$issueproduction','$receiptproduction','$inventorytransfer','$final','$remark','$creator','$approval1','$status1','$date1','$approval2','$status2','$date2','$approval3','$status3','$date3','$status','$date','$tag')");
	//tform_fir_inspection
	foreach($item as $x => $y){
		mysql_query("INSERT INTO form_fir_inspection (number,item,ac,re,n,a,r,n2,a2,r2,n3,a3,r3,n4,a4,r4,n5,a5,r5) VALUES('$number','$item[$x]','$ac[$x]','$re[$x]','$n[$x]','$a[$x]','$r[$x]','$n2[$x]','$a2[$x]','$r2[$x]','$n3[$x]','$a3[$x]','$r3[$x]','$n4[$x]','$a4[$x]','$r4[$x]','$n5[$x]','$a5[$x]','$r5[$x]')");
	}
	//tform_fir_inspection_prodqty
	foreach($prodqty as $xx => $yy){
		mysql_query("INSERT INTO form_fir_inspection_prodqty (number,prodqty,judgement,time) VALUES('$number','$prodqty[$xx]','$judgement[$xx]','$time[$xx]')");
	}
	//tform_fir_checkpoint
	foreach($checkpoint as $xxx => $yyy){
		mysql_query("INSERT INTO form_fir_checkpoint (number,checkpoint,tolerance,specs,lowerlimit,upperlimit,val,val2,val3,val4,val5,val6,val7,val8,val9,val10,val11,val12,judgementcheck) VALUES('$number','$checkpoint[$xxx]','$tolerance[$xxx]','$specs[$xxx]','$lowerlimit[$xxx]','$upperlimit[$xxx]','$val[$xxx]','$val2[$xxx]','$val3[$xxx]','$val4[$xxx]','$val5[$xxx]','$val6[$xxx]','$val7[$xxx]','$val8[$xxx]','$val9[$xxx]','$val10[$xxx]','$val11[$xxx]','$val12[$xxx]','$judgementcheck[$xxx]')");
	}
	
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
			window.location = './'
		});
	});
	</script>
	";
	}
}
?>
<script>
$('input[name="time[]"]').datetimepicker({
	format: 'HH:mm', 
});
$('#customername').select2({
	theme: "bootstrap",
	width: "auto"
});
$('#partnumber').select2({
	theme: "bootstrap",
	width: "auto"
});
$('#standardqc').select2({
	theme: "bootstrap",
	width: "auto"
});
$('#totallotqty').val('0');
$('.prodqty').on('input', function(){
    var arr = document.getElementsByName('prodqty[]'); //var arr = document.getElementsByClassName('prodqty');
    var tot = 0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    document.getElementById('totallotqty').value = tot;
	var $this = $(this);
	$.ajax({
		async: false,
		url: "forms/fir/inspection.php?id="+$this.attr('id')+"&standardqc="+$('#standardqc').val()+"&totallotqty="+tot+"&prodqty1="+arr[0].value+"&prodqty2="+arr[1].value+"&prodqty3="+arr[2].value+"&prodqty4="+arr[3].value+"&prodqty5="+arr[4].value,
		success: function(msg){
			//$('#result_inspection').html(msg);
			var item = msg.split('#');
			var identity = item[1].split('|'); //Identity
			var packaging = item[2].split('|'); //Packaging
			var quantity = item[3].split('|'); //Quantity
			var appearance = item[4].split('|'); //Appearance
			var application = item[5].split('|'); //Application
			//Identity
			var identity_ac = identity[1];
			var identity_re = identity[2];
			var identity_n = identity[3];
			var identity_n2 = identity[4];
			var identity_n3 = identity[5];
			var identity_n4 = identity[6];
			var identity_n5 = identity[7];
			//Packaging
			var packaging_ac = packaging[1];
			var packaging_re = packaging[2];
			var packaging_n = packaging[3];
			var packaging_n2 = packaging[4];
			var packaging_n3 = packaging[5];
			var packaging_n4 = packaging[6];
			var packaging_n5 = packaging[7];
			//Quantity
			var quantity_ac = quantity[1];
			var quantity_re = quantity[2];
			var quantity_n = quantity[3];
			var quantity_n2 = quantity[4];
			var quantity_n3 = quantity[5];
			var quantity_n4 = quantity[6];
			var quantity_n5 = quantity[7];
			//Appearance
			var appearance_ac = appearance[1];
			var appearance_re = appearance[2];
			var appearance_n = appearance[3];
			var appearance_n2 = appearance[4];
			var appearance_n3 = appearance[5];
			var appearance_n4 = appearance[6];
			var appearance_n5 = appearance[7];
			//Application
			var application_ac = application[1];
			var application_re = application[2];
			var application_n = application[3];
			var application_n2 = application[4];
			var application_n3 = application[5];
			var application_n4 = application[6];
			var application_n5 = application[7];
			
			var qty_identity_ac = $this.closest("tr").parent().next().find("tr:nth-child(1)").find("input[name='ac[]']").val(identity_ac);
			var qty_identity_re = $this.closest("tr").parent().next().find("tr:nth-child(1)").find("input[name='re[]']").val(identity_re)
			var qty_packaging_ac = $this.closest("tr").parent().next().find("tr:nth-child(2)").find("input[name='ac[]']").val(packaging_ac);
			var qty_packaging_re = $this.closest("tr").parent().next().find("tr:nth-child(2)").find("input[name='re[]']").val(packaging_re)
			var qty_quantity_ac = $this.closest("tr").parent().next().find("tr:nth-child(3)").find("input[name='ac[]']").val(quantity_ac);
			var qty_quantity_re = $this.closest("tr").parent().next().find("tr:nth-child(3)").find("input[name='re[]']").val(quantity_re)
			var qty_appearance_ac = $this.closest("tr").parent().next().find("tr:nth-child(4)").find("input[name='ac[]']").val(appearance_ac);
			var qty_appearance_re = $this.closest("tr").parent().next().find("tr:nth-child(4)").find("input[name='re[]']").val(appearance_re)
			var qty_application_ac = $this.closest("tr").parent().next().find("tr:nth-child(5)").find("input[name='ac[]']").val(application_ac);
			var qty_application_re = $this.closest("tr").parent().next().find("tr:nth-child(5)").find("input[name='re[]']").val(application_re)
			
			if($this.closest("th").is(':nth-child(1)')){
				var qty_n = $this.closest("tr").parent().next().find("tr:nth-child(1)").find("input[name='n[]']").val(identity_n);
				var qty_nn = $this.closest("tr").parent().next().find("tr:nth-child(2)").find("input[name='n[]']").val(packaging_n);
				var qty_nnn = $this.closest("tr").parent().next().find("tr:nth-child(3)").find("input[name='n[]']").val(quantity_n);
				var qty_nnnn = $this.closest("tr").parent().next().find("tr:nth-child(4)").find("input[name='n[]']").val(appearance_n);
				var qty_nnnnn = $this.closest("tr").parent().next().find("tr:nth-child(5)").find("input[name='n[]']").val(application_n);
				var judgement = $this.parent().parent().parent().next().find("tr:nth-child(6)").find("#judgement1");
			}
			else if($this.closest("th").is(':nth-child(2)')){
				var qty_n = $this.closest("tr").parent().next().find("tr:nth-child(1)").find("input[name='n2[]']").val(identity_n2);
				var qty_nn = $this.closest("tr").parent().next().find("tr:nth-child(2)").find("input[name='n2[]']").val(packaging_n2);
				var qty_nnn = $this.closest("tr").parent().next().find("tr:nth-child(3)").find("input[name='n2[]']").val(quantity_n2);
				var qty_nnnn = $this.closest("tr").parent().next().find("tr:nth-child(4)").find("input[name='n2[]']").val(appearance_n2);
				var qty_nnnnn = $this.closest("tr").parent().next().find("tr:nth-child(5)").find("input[name='n2[]']").val(application_n2);
				var judgement = $this.parent().parent().parent().next().find("tr:nth-child(6)").find("#judgement2");
			}
			else if($this.closest("th").is(':nth-child(3)')){
				var qty_n = $this.closest("tr").parent().next().find("tr:nth-child(1)").find("input[name='n3[]']").val(identity_n3);
				var qty_nn = $this.closest("tr").parent().next().find("tr:nth-child(2)").find("input[name='n3[]']").val(packaging_n3);
				var qty_nnn = $this.closest("tr").parent().next().find("tr:nth-child(3)").find("input[name='n3[]']").val(quantity_n3);
				var qty_nnnn = $this.closest("tr").parent().next().find("tr:nth-child(4)").find("input[name='n3[]']").val(appearance_n3);
				var qty_nnnnn = $this.closest("tr").parent().next().find("tr:nth-child(5)").find("input[name='n3[]']").val(application_n3);
				var judgement = $this.parent().parent().parent().next().find("tr:nth-child(6)").find("#judgement3");
			}
			else if($this.closest("th").is(':nth-child(4)')){
				var qty_n = $this.closest("tr").parent().next().find("tr:nth-child(1)").find("input[name='n4[]']").val(identity_n4);
				var qty_nn = $this.closest("tr").parent().next().find("tr:nth-child(2)").find("input[name='n4[]']").val(packaging_n4);
				var qty_nnn = $this.closest("tr").parent().next().find("tr:nth-child(3)").find("input[name='n4[]']").val(quantity_n4);
				var qty_nnnn = $this.closest("tr").parent().next().find("tr:nth-child(4)").find("input[name='n4[]']").val(appearance_n4);
				var qty_nnnnn = $this.closest("tr").parent().next().find("tr:nth-child(5)").find("input[name='n4[]']").val(application_n4);
				var judgement = $this.parent().parent().parent().next().find("tr:nth-child(6)").find("#judgement4");
			}
			else if($this.closest("th").is(':nth-child(5)')){
				var qty_n = $this.closest("tr").parent().next().find("tr:nth-child(1)").find("input[name='n5[]']").val(identity_n5);
				var qty_nn = $this.closest("tr").parent().next().find("tr:nth-child(2)").find("input[name='n5[]']").val(packaging_n5);
				var qty_nnn = $this.closest("tr").parent().next().find("tr:nth-child(3)").find("input[name='n5[]']").val(quantity_n5);
				var qty_nnnn = $this.closest("tr").parent().next().find("tr:nth-child(4)").find("input[name='n5[]']").val(appearance_n5);
				var qty_nnnnn = $this.closest("tr").parent().next().find("tr:nth-child(5)").find("input[name='n5[]']").val(application_n5);
				var judgement = $this.parent().parent().parent().next().find("tr:nth-child(6)").find("#judgement5");
			}
			$('.qty_a').trigger('input');
		},
		dataType: "html"
	});
});
$('.qty_a').on('input', function(){
	var n = $(this).parent().prev().children();
	var r = $(this).parent().next().children();
	var h = Math.round(parseFloat(n.val())-parseFloat($(this).val()));
	
	if(isNaN(h)){
		r.val("");
	}
	else{
		r.val(h);
	}
	
	if($(this).closest("td").is(':nth-child(6)')){
		var qty_r = $(this).closest("tr").parent().find("tr:nth-child(1)").find("input[name='r[]']").val();
		var qty_rr = $(this).closest("tr").parent().find("tr:nth-child(2)").find("input[name='r[]']").val();
		var qty_rrr = $(this).closest("tr").parent().find("tr:nth-child(3)").find("input[name='r[]']").val();
		var qty_rrrr = $(this).closest("tr").parent().find("tr:nth-child(4)").find("input[name='r[]']").val();
		var qty_rrrrr = $(this).closest("tr").parent().find("tr:nth-child(5)").find("input[name='r[]']").val();
		var judgement = $(this).parent().parent().parent().find("tr:nth-child(6)").find("#judgement1");
	}
	else if($(this).closest("td").is(':nth-child(9)')){
		var qty_r = $(this).closest("tr").parent().find("tr:nth-child(1)").find("input[name='r2[]']").val();
		var qty_rr = $(this).closest("tr").parent().find("tr:nth-child(2)").find("input[name='r2[]']").val();
		var qty_rrr = $(this).closest("tr").parent().find("tr:nth-child(3)").find("input[name='r2[]']").val();
		var qty_rrrr = $(this).closest("tr").parent().find("tr:nth-child(4)").find("input[name='r2[]']").val();
		var qty_rrrrr = $(this).closest("tr").parent().find("tr:nth-child(5)").find("input[name='r2[]']").val();
		var judgement = $(this).parent().parent().parent().find("tr:nth-child(6)").find("#judgement2");
	}
	else if($(this).closest("td").is(':nth-child(12)')){
		var qty_r = $(this).closest("tr").parent().find("tr:nth-child(1)").find("input[name='r3[]']").val();
		var qty_rr = $(this).closest("tr").parent().find("tr:nth-child(2)").find("input[name='r3[]']").val();
		var qty_rrr = $(this).closest("tr").parent().find("tr:nth-child(3)").find("input[name='r3[]']").val();
		var qty_rrrr = $(this).closest("tr").parent().find("tr:nth-child(4)").find("input[name='r3[]']").val();
		var qty_rrrrr = $(this).closest("tr").parent().find("tr:nth-child(5)").find("input[name='r3[]']").val();
		var judgement = $(this).parent().parent().parent().find("tr:nth-child(6)").find("#judgement3");
	}
	else if($(this).closest("td").is(':nth-child(15)')){
		var qty_r = $(this).closest("tr").parent().find("tr:nth-child(1)").find("input[name='r4[]']").val();
		var qty_rr = $(this).closest("tr").parent().find("tr:nth-child(2)").find("input[name='r4[]']").val();
		var qty_rrr = $(this).closest("tr").parent().find("tr:nth-child(3)").find("input[name='r4[]']").val();
		var qty_rrrr = $(this).closest("tr").parent().find("tr:nth-child(4)").find("input[name='r4[]']").val();
		var qty_rrrrr = $(this).closest("tr").parent().find("tr:nth-child(5)").find("input[name='r4[]']").val();
		var judgement = $(this).parent().parent().parent().find("tr:nth-child(6)").find("#judgement4");
	}
	else if($(this).closest("td").is(':nth-child(18)')){
		var qty_r = $(this).closest("tr").parent().find("tr:nth-child(1)").find("input[name='r5[]']").val();
		var qty_rr = $(this).closest("tr").parent().find("tr:nth-child(2)").find("input[name='r5[]']").val();
		var qty_rrr = $(this).closest("tr").parent().find("tr:nth-child(3)").find("input[name='r5[]']").val();
		var qty_rrrr = $(this).closest("tr").parent().find("tr:nth-child(4)").find("input[name='r5[]']").val();
		var qty_rrrrr = $(this).closest("tr").parent().find("tr:nth-child(5)").find("input[name='r5[]']").val();
		var judgement = $(this).parent().parent().parent().find("tr:nth-child(6)").find("#judgement5");
	}
	
	var qty_re = $(this).closest("tr").parent().find("tr:nth-child(1)").find("input[name='re[]']").val();
	var qty_rre = $(this).closest("tr").parent().find("tr:nth-child(2)").find("input[name='re[]']").val();
	var qty_rrre = $(this).closest("tr").parent().find("tr:nth-child(3)").find("input[name='re[]']").val();
	var qty_rrrre = $(this).closest("tr").parent().find("tr:nth-child(4)").find("input[name='re[]']").val();
	var qty_rrrrre = $(this).closest("tr").parent().find("tr:nth-child(5)").find("input[name='re[]']").val();
	
	if(qty_r == ""
	&& qty_rr == ""
	&& qty_rrr == ""
	&& qty_rrrr == ""
	&& qty_rrrrr == ""){
		judgement.val("");
		//judgement.css("color", "unset");
	}
	else if(
	(qty_r != "" && qty_r >= qty_re)
	|| (qty_rr != "" && qty_rr >= qty_rre)
	|| (qty_rrr != "" && qty_rrr >= qty_rrre)
	|| (qty_rrrr != "" && qty_rrrr >= qty_rrrre)
	|| (qty_rrrrr != "" && qty_rrrrr >= qty_rrrrre)
	){
		judgement.val("NG");
		//judgement.css("color", "var(--danger)");
	}
	else{
		judgement.val("OK");
		//judgement.css("color", "var(--success)");
	}
	
	var values_NG = [];
	var values_OK = [];
	var values_EMPTY = [];
	var fieldsc = document.getElementsByName("judgementcheck[]");
	for(var i = 0; i < fieldsc.length; i++) {
		if(fieldsc[i].value == "NG"){
			values_NG.push(fieldsc[i].value);
		}
		else if(fieldsc[i].value == "OK"){
			values_OK.push(fieldsc[i].value);
		}
		else{
			values_EMPTY.push(fieldsc[i].value);
		}
	}
	
	var fields = document.getElementsByName("judgement[]");
	for(var i = 0; i < fields.length; i++) {
		if(fields[i].value == "NG"){
			values_NG.push(fields[i].value);
		}
		else if(fields[i].value == "OK"){
			values_OK.push(fields[i].value);
		}
		else{
			values_EMPTY.push(fields[i].value);
		}
	}
	
	if(values_NG.length > values_OK.length){
		$("#final").val("REJECT");
	}
	else if((values_NG.length == values_OK.length) && (values_NG.length > 0 && values_OK.length > 0)){
		$("#final").val("REWORK");
	}
	else{
		$("#final").val("PASS");
	}
});
$('#partnumber').on('change', function(){
    $.ajax({
		async: false,
		url: "forms/fir/drawing.php?partnumber="+$('#partnumber').val(),
		success: function(msg){
			if(msg != ""){
				$('#result_drawing').attr("src",msg);
			}
			else{
				$('#result_drawing').removeAttr("src");
			}
		},
		dataType: "html"
	});
	$.ajax({
		async: false,
		url: "forms/fir/checkpoint.php?partnumber="+$('#partnumber').val(),
		success: function(msg){
			$('#result_checkpoint').html(msg);
		},
		dataType: "html"
	});
});
$('#partnumber').change();
$('#standardqc').on('change', function(){
    $('.prodqty').trigger('input');
});
$('#standardqc').change();
</script>