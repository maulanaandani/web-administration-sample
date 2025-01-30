<div class="row">
	<div class="col-md-12">
	
		<?php
		if($_GET['number'] == ""){
		?>
		
		<div class="card">
		<form method="get">
			<input type="hidden" name="p" value="fir_view" />
			<div class="card-header card-primary bg-primary-gradient">
				<div class="card-head-row">
					<div class="card-title">Filter - Final Inspection Report</div>
				</div>
			</div>
			<div class="card-body">
			<div class="form-group">
				<label for="startdate">Startdate</label>
				<input type="text" class="form-control" name="startdate" id="startdate" value="<?php echo $_GET['startdate'] ? $_GET['startdate'] : date('Y-m-01'); ?>" required />
			</div>
			<div class="form-group">
				<label for="enddate">Enddate</label>
				<input type="text" class="form-control" name="enddate" id="enddate" value="<?php echo $_GET['enddate'] ? $_GET['enddate'] : date('Y-m-t'); ?>" required />
			</div>
			<div class="form-group">
				<label for="final">Final Decision</label>
				<select class="form-control" name="final" id="final" required>
					<option value="ALL">ALL</option>
					<option value="PASS">PASS</option>
					<option value="REWORK">REWORK</option>
					<option value="REJECT">REJECT</option>
				</select>
			</div>
			</div>
			<div class="card-footer">
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Filter</button>
					<button type="button" class="btn btn-black btn-sm float-right" onclick="getReport()"><i class="fa fa-download"></i> Export</button>
				</div>
			</div>
		</form>
		</div>
		
		<?php
		if($_GET['startdate'] != "" AND $_GET['enddate'] != "" AND $_GET['final'] != ""){
		?>
		
		<div class="card">
			<div class="card-header card-primary bg-primary-gradient">
				<div class="card-head-row">
					<div class="card-title">View - Final Inspection Report</div>
				</div>
			</div>
			<div class="card-body">
			<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped datatables">
				<thead>	
					<tr>
						<th>No</th>
						<th>Number</th>
						<th>Datecreated</th>
						<th>Customer Name</th>
						<th>Part Name</th>
						<th>Final Decision</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$startdate = $_GET['startdate'];
				$enddate = $_GET['enddate'];
				$final = $_GET['final'];
				if($final != "ALL"){
					$sql_final = "AND final='$final'";
				}
				else{
					$sql_final = "";
				}
				$i = 1;
				$q = mysql_query("SELECT * FROM form_fir WHERE datecreated BETWEEN '$startdate' AND '$enddate' $sql_final ORDER BY number DESC");
				while($r = mysql_fetch_array($q)){
					$status = $r['status'];
					if($status == "-1"){
						$status_label = "<span class='badge badge-danger'>Canceled</span>";
					}
					else if($status == "0"){
						$status_label = "<span class='badge badge-black'>Opened</span>";
					}
					else if($status == "1"){
						$status_label = "<span class='badge badge-warning'>Revised</span>";
					}
					else if($status == "2"){
						$status_label = "<span class='badge badge-success'>Approved</span>";
					}
					else if($status == "3"){
						$status_label = "<span class='badge badge-primary'>Closed</span>";
					}
					else{
						$status_label = "";
					}
					echo "
					<tr>
						<td>$i</td>
						<td>$r[number]</td>
						<td>$r[datecreated]</td>
						<td>$r[customername]</td>
						<td>$r[partname]</td>
						<td>".ucfirst($r['final'])."</td>
						<td>$status_label</td>
						<td>
							<div class='btn-group'>
								<a class='btn btn-primary btn-sm' href='?p=fir_view&number=$r[number]'><i class='fa fa-eye'></i> Detail</a>
								<a class='btn btn-black btn-sm' href='forms/fir/pdf.php?number=$r[number]'><i class='fa fa-print'></i> Print</a>
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
			</div>
		</div>
		
		<?php
		}
		}
		else{
		?>
		
		<div class="card">
		<form method="post">
			<div class="card-header card-primary bg-primary-gradient">
				<div class="card-head-row">
					<div class="card-title">Detail - Final Inspection Report</div>
					<div class="card-tools">
						<?php
						if($_GET['number'] != ""){
						?>
						<a target="_blank" href="forms/fir/pdf.php?number=<?php echo $_GET['number']; ?>" class="btn btn-info btn-border btn-round btn-sm">
							<span class="btn-label">
								<i class="fa fa-print"></i>
							</span>
							Print
						</a>
						<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="card-body">
		
			<?php
			$q = mysql_query("SELECT * FROM form_fir WHERE number='$_GET[number]'");
			$r = mysql_fetch_array($q);
			$number = $r['number'];
			$datecreated = $r['datecreated'];
			$name = $r['name'];
			$department = $r['department'];
			
			$customername = $r['customername'];
			$partnumber = $r['partnumber'];
			$partname = $r['partname'];
			$checkcode = $r['checkcode'];
			$batchnumber = $r['batchnumber'];
			$totallotqty = $r['totallotqty'];
			$standardqc = $r['standardqc'];
			
			$lastissue = $r['lastissue'];
			$issueproduction = $r['issueproduction'];
			$receiptproduction = $r['receiptproduction'];
			$inventorytransfer = $r['inventorytransfer'];
			
			$final = $r['final'];
			$remark = $r['remark'];
			
			$creator = $r['creator'];
			$approval1_id = $r['approval1'];
			$status1 = $r['status1'];
			$date1 = $r['date1'];
			$approval2_id = $r['approval2'];
			$status2 = $r['status2'];
			$date2 = $r['date2'];
			$approval3_id = $r['approval3'];
			$status3 = $r['status3'];
			$date3 = $r['date3'];
			
			$status = $r['status'];
			$date = $r['date'];
			$tag = $r['tag'];
			
			if($status == "1" AND $creator == $_userid){
				$attribute = "required";
				$attribute_item = "";
			}
			else{
				$attribute = "disabled";
				$attribute_item = "disabled";
			}
			
			$query_approval1 = mysql_query("SELECT * FROM user WHERE userid='$approval1_id'");
			$cek_approval1 = mysql_num_rows($query_approval1);
			$data_approval1 = mysql_fetch_array($query_approval1);
			$approval1_name = $data_approval1['name'];
			$query_approval2 = mysql_query("SELECT * FROM user WHERE userid='$approval2_id'");
			$cek_approval2 = mysql_num_rows($query_approval2);
			$data_approval2 = mysql_fetch_array($query_approval2);
			$approval2_name = $data_approval2['name'];
			$query_approval3 = mysql_query("SELECT * FROM user WHERE userid='$approval3_id'");
			$cek_approval3 = mysql_num_rows($query_approval3);
			$data_approval3 = mysql_fetch_array($query_approval3);
			$approval3_name = $data_approval3['name'];
			
			if($status1 == "-1"){
				$status1_label = "<span class='badge badge-danger'>Canceled</span>";
			}
			else if($status1 == "0"){
				$status1_label = "<span class='badge badge-black'>Opened</span>";
			}
			else if($status1 == "1"){
				$status1_label = "<span class='badge badge-warning'>Revised</span>";
			}
			else if($status1 == "2"){
				$status1_label = "<span class='badge badge-success'>Approved</span>";
			}
			else if($status1 == "3"){
				$status1_label = "<span class='badge badge-primary'>Closed</span>";
			}
			else{
				$status1_label = "";
			}
			if($status2 == "-1"){
				$status2_label = "<span class='badge badge-danger'>Canceled</span>";
			}
			else if($status2 == "0"){
				$status2_label = "<span class='badge badge-black'>Opened</span>";
			}
			else if($status2 == "1"){
				$status2_label = "<span class='badge badge-warning'>Revised</span>";
			}
			else if($status2 == "2"){
				$status2_label = "<span class='badge badge-success'>Approved</span>";
			}
			else if($status2 == "3"){
				$status2_label = "span class='badge badge-primary'>Closed</span>";
			}
			else{
				$status2_label = "";
			}
			if($status3 == "-1"){
				$status3_label = "<span class='badge badge-danger'>Canceled</span>";
			}
			else if($status3 == "0"){
				$status3_label = "<span class='badge badge-black'>Opened</span>";
			}
			else if($status3 == "1"){
				$status3_label = "<span class='badge badge-warning'>Revised</span>";
			}
			else if($status3 == "2"){
				$status3_label = "<span class='badge badge-success'>Approved</span>";
			}
			else if($status3 == "3"){
				$status3_label = "span class='badge badge-primary'>Closed</span>";
			}
			else{
				$status3_label = "";
			}
			if($status == "-1"){
				$status_label = "<span class='badge badge-danger'>Canceled</span>";
			}
			else if($status == "0"){
				$status_label = "<span class='badge badge-black'>Opened</span>";
			}
			else if($status == "1"){
				$status_label = "<span class='badge badge-warning'>Revised</span>";
			}
			else if($status == "2"){
				$status_label = "<span class='badge badge-success'>Approved</span>";
			}
			else if($status == "3"){
				$status_label = "<span class='badge badge-primary'>Closed</span>";
			}
			else{
				$status_label = "";
			}
			
			if($status == "0" AND $tag == "1" AND $approval1_id == $_userid){
				$status1_label .= "
					<br/><br/><div class='btn-group-vertical'>
					<a class='btn btn-danger btn-sm' href='?p=fir_view&number=$number&action=canceled&id=1' onclick='return check(this)'><i class='fa fa-times'></i> Canceled</a>
					<a class='btn btn-warning btn-sm' href='?p=fir_view&number=$number&action=revised&id=1' onclick='return check(this)'><i class='fa fa-edit'></i> Revised</a>
					<a class='btn btn-success btn-sm' href='?p=fir_view&number=$number&action=approved&id=1' onclick='return check(this)'><i class='fa fa-check'></i> Approved</a>
					</div>
				";
			}
			if($status == "0" AND $tag == "2" AND $approval2_id == $_userid){
				$status2_label .= "
					<br/><br/><div class='btn-group-vertical'>
					<a class='btn btn-danger btn-sm' href='?p=fir_view&number=$number&action=canceled&id=2' onclick='return check(this)'><i class='fa fa-times'></i> Canceled</a>
					<a class='btn btn-warning btn-sm' href='?p=fir_view&number=$number&action=revised&id=2' onclick='return check(this)'><i class='fa fa-edit'></i> Revised</a>
					<a class='btn btn-success btn-sm' href='?p=fir_view&number=$number&action=approved&id=2' onclick='return check_approval2(this)'><i class='fa fa-check'></i> Approved</a>
					</div>
				";
			}
			if($status == "0" AND $tag == "3" AND $approval3_id == $_userid){
				$status3_label .= "
					<br/><br/><div class='btn-group-vertical'>
					<a class='btn btn-danger btn-sm' href='?p=fir_view&number=$number&action=canceled&id=3' onclick='return check(this)'><i class='fa fa-times'></i> Canceled</a>
					<a class='btn btn-warning btn-sm' href='?p=fir_view&number=$number&action=revised&id=3' onclick='return check(this)'><i class='fa fa-edit'></i> Revised</a>
					<a class='btn btn-success btn-sm' href='?p=fir_view&number=$number&action=approved&id=3' onclick='return check(this)'><i class='fa fa-check'></i> Approved</a>
					</div>
				";
			}
			if($status == "2" AND $creator == $_userid){
				/* $status_label .= "
					<br/><br/><div class='btn-group-vertical'>
					<a class='btn btn-danger btn-sm' href='?p=fir_view&number=$number&action=canceled&id=3' onclick='return check(this)'><i class='fa fa-times'></i> Canceled</a>
					<a class='btn btn-primary btn-sm' href='?p=fir_view&number=$number&action=closed&id=3' onclick='return check(this)'><i class='fa fa-edit'></i> Closed</a>
					</div>
				"; */
			}
			
			?>
			
			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="number">Number</label>
					<input type="text" class="form-control" name="number" id="number" value="<?php echo $number; ?>" readonly />
				</div>
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" readonly />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="datecreated">Datecreated</label>
					<input type="text" class="form-control" name="datecreated" id="datecreated" value="<?php echo $datecreated; ?>" readonly />
				</div>
				<div class="form-group">
					<label for="department">Department</label>
					<input type="text" class="form-control" name="department" id="department" value="<?php echo $department; ?>" readonly />
				</div>
			</div>
			</div>
			<div class="separator-dashed bg-primary"></div>
			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="customername">Customer Name</label>
					<select class="form-control" name="customername" id="customername" <?php echo $attribute; ?> >
						<option value="" data-id="">&nbsp;</option>
						<?php
						$customer_sql = mysql_query("SELECT * FROM customer ORDER BY customername");
						while($customer_row = mysql_fetch_array($customer_sql)){
							echo "<option value='$customer_row[customername]' "; if($customer_row['customername'] == $customername){echo "selected";} echo ">$customer_row[customername]</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="partnumber">Part Number</label>
					<select class="form-control" name="partnumber" id="partnumber" onchange="$('#partname').val($(this).find(':selected').attr('data-id'))" <?php echo $attribute; ?>  >
						<option value="" data-id="">&nbsp;</option>
						<?php
						$part_sql = mysql_query("SELECT * FROM part ORDER BY partnumber");
						while($part_row = mysql_fetch_array($part_sql)){
							echo "<option value='$part_row[partnumber]' data-id='$part_row[partname]' "; if($part_row['partnumber'] == $partnumber){echo "selected";} echo ">$part_row[partnumber] - $part_row[partname]</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="partname">Part Name</label>
					<input type="text" class="form-control" name="partname" id="partname" value="<?php echo $partname; ?>" readonly  />
				</div>
				<div class="form-group">
					<label for="checkcode">Check Code</label>
					<input type="text" class="form-control" name="checkcode" id="checkcode" value="<?php echo $checkcode; ?>" <?php echo $attribute; ?>  />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="batchnumber">Batch Number</label>
					<input type="text" class="form-control" name="batchnumber" id="batchnumber" value="<?php echo $batchnumber; ?>" <?php echo $attribute; ?>  />
				</div>
				<div class="form-group">
					<label for="totallotqty">Total LOT QTY</label>
					<input type="text" class="form-control" name="totallotqty" id="totallotqty" value="<?php echo $totallotqty; ?>" readonly  />
				</div>
				<div class="form-group">
					<label for="standardqc">Standard QC</label>
					<select class="form-control" name="standardqc" id="standardqc" <?php echo $attribute; ?>>
						<option value="100%" <?php if($standardqc == "100%"){echo "selected";} ?>>100%</option>
						<option value="TL3" <?php if($standardqc == "TL3"){echo "selected";} ?>>Tighten Level III</option>
						<option value="TL2" <?php if($standardqc == "TL2"){echo "selected";} ?>>Tighten Level II</option>
						<option value="NL2" <?php if($standardqc == "NL2"){echo "selected";} ?>>Normal Level II</option>
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
								$q_prodqty = mysql_query("SELECT * FROM form_fir_inspection_prodqty WHERE number='$_GET[number]' ORDER BY id");
								while($r_prodqty = mysql_fetch_array($q_prodqty)){
								echo "<th colspan='3'>Prod. Qty: <input type='text' class='prodqty' name='prodqty[]' style='width:100px' value='$r_prodqty[prodqty]' $attribute_item /></th>";
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
						<tbody>
							<?php
							$i = 1;
							$q_inspection = mysql_query("SELECT * FROM form_fir_inspection WHERE number='$_GET[number]' ORDER BY id");
							while($r_inspection = mysql_fetch_array($q_inspection)){
								echo "
								<tr>
									<td>$i</td>
									<td><input type='hidden' class='' style='width:50px' name='item[]' value='$r_inspection[item]' $attribute_item />$r_inspection[item]</td>
									<td><input type='text' class='' style='width:50px' name='ac[]' value='$r_inspection[ac]' readonly /></td>
									<td><input type='text' class='' style='width:50px' name='re[]' value='$r_inspection[re]' readonly /></td>
									<td><input type='text' class='' style='width:50px' name='n[]' value='$r_inspection[n]' readonly /></td>
									<td><input type='text' class='qty_a' style='width:50px' name='a[]' value='$r_inspection[a]' $attribute_item /></td>
									<td><input type='text' class='' style='width:50px' name='r[]' value='$r_inspection[r]' readonly /></td>
									<td><input type='text' class='' style='width:50px' name='n2[]' value='$r_inspection[n2]' readonly /></td>
									<td><input type='text' class='qty_a' style='width:50px' name='a2[]' value='$r_inspection[a2]' $attribute_item /></td>
									<td><input type='text' class='' style='width:50px' name='r2[]' value='$r_inspection[r2]' readonly /></td>
									<td><input type='text' class='' style='width:50px' name='n3[]' value='$r_inspection[n3]' readonly /></td>
									<td><input type='text' class='qty_a' style='width:50px' name='a3[]' value='$r_inspection[a3]' $attribute_item /></td>
									<td><input type='text' class='' style='width:50px' name='r3[]' value='$r_inspection[r3]' readonly /></td>
									<td><input type='text' class='' style='width:50px' name='n4[]' value='$r_inspection[n4]' readonly /></td>
									<td><input type='text' class='qty_a' style='width:50px' name='a4[]' value='$r_inspection[a4]' $attribute_item /></td>
									<td><input type='text' class='' style='width:50px' name='r4[]' value='$r_inspection[r4]' readonly /></td>
									<td><input type='text' class='' style='width:50px' name='n5[]' value='$r_inspection[n5]' readonly /></td>
									<td><input type='text' class='qty_a' style='width:50px' name='a5[]' value='$r_inspection[a5]' $attribute_item /></td>
									<td><input type='text' class='' style='width:50px' name='r5[]' value='$r_inspection[r5]' readonly /></td>
								</tr>
								";
								$i++;
							}
							?>
							<tr>
								<th colspan="4">Judgement</th>
								<?php
								$i = 1;
								$q_prodqty_judgement = mysql_query("SELECT * FROM form_fir_inspection_prodqty WHERE number='$_GET[number]' ORDER BY id");
								while($r_prodqty_judgement = mysql_fetch_array($q_prodqty_judgement)){
								echo "<td colspan='3'><input type='text' id='judgement$i' style='width:180px' name='judgement[]' value='$r_prodqty_judgement[judgement]' readonly /></td>";
								$i++;
								}
								?>
							</tr>
							<tr>
								<th colspan="4">Time</th>
								<?php
								$i = 1;
								$q_prodqty_time = mysql_query("SELECT * FROM form_fir_inspection_prodqty WHERE number='$_GET[number]' ORDER BY id");
								while($r_prodqty_time = mysql_fetch_array($q_prodqty_time)){
								echo "<td colspan='3'><input type='text' id='time$i' style='width:180px' name='time[]' value='$r_prodqty_time[time]' $attribute_item /></td>";
								$i++;
								}
								?>
							</tr>
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
						<tbody>
							<?php
							$i = 1;
							$q_checkpoint = mysql_query("SELECT * FROM form_fir_checkpoint WHERE number='$_GET[number]' ORDER BY id");
							while($r_checkpoint = mysql_fetch_array($q_checkpoint)){
								echo "
								<tr>
									<td>$i<input type='hidden' id='lowerlimit' name='lowerlimit[]' value='$r_checkpoint[lowerlimit]' /><input type='hidden' id='upperlimit' name='upperlimit[]' value='$r_checkpoint[upperlimit]' /></td>
									<td><input type='text' style='width:100px' name='checkpoint[]' value='$r_checkpoint[checkpoint]' readonly /></td>
									<td><input type='text' style='width:170px' name='tolerance[]' value='$r_checkpoint[tolerance]' readonly /></td>
									<td><input type='text' style='width:100px' name='specs[]' value='$r_checkpoint[specs]' readonly /></td>
									<td><input type='text' style='width:50px' class='val' name='val[]' value='$r_checkpoint[val]' $attribute_item /></td>
									<td><input type='text' style='width:50px' class='val' name='val2[]' value='$r_checkpoint[val2]' $attribute_item /></td>
									<td><input type='text' style='width:50px' class='val' name='val3[]' value='$r_checkpoint[val3]' $attribute_item /></td>
									<td><input type='text' style='width:50px' class='val' name='val4[]' value='$r_checkpoint[val4]' $attribute_item /></td>
									<td><input type='text' style='width:50px' class='val' name='val5[]' value='$r_checkpoint[val5]' $attribute_item /></td>
									<td><input type='text' style='width:50px' class='val' name='val6[]' value='$r_checkpoint[val6]' $attribute_item /></td>
									<td><input type='text' style='width:50px' class='val' name='val7[]' value='$r_checkpoint[val7]' $attribute_item /></td>
									<td><input type='text' style='width:50px' class='val' name='val8[]' value='$r_checkpoint[val8]' $attribute_item /></td>
									<td><input type='text' style='width:50px' class='val' name='val9[]' value='$r_checkpoint[val9]' $attribute_item /></td>
									<td><input type='text' style='width:50px' class='val' name='val10[]' value='$r_checkpoint[val10]' $attribute_item /></td>
									<td><input type='text' style='width:50px' class='val' name='val11[]' value='$r_checkpoint[val11]' $attribute_item /></td>
									<td><input type='text' style='width:50px' class='val' name='val12[]' value='$r_checkpoint[val12]' $attribute_item /></td>
									<td><input type='text' style='width:100px' id='judgementcheck' name='judgementcheck[]' value='$r_checkpoint[judgementcheck]' readonly /></td>
								</tr>
								";
								$i++;
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
						<textarea class="form-control" name="lastissue" id="lastissue" rows="10" <?php echo $attribute; ?>><?php echo $lastissue; ?></textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="issueproduction">Issue From Production</label>
						<input type="text" class="form-control" name="issueproduction" id="issueproduction" value="<?php echo $issueproduction; ?>" <?php if($tag == "3" AND $_userid == $approval3_id){echo "required";}else{echo "readonly";} ?> />
					</div>
					<div class="form-group">
						<label for="receiptproduction">Receipt From Production</label>
						<input type="text" class="form-control" name="receiptproduction" id="receiptproduction" value="<?php echo $receiptproduction; ?>" <?php if($tag == "3" AND $_userid == $approval3_id){echo "required";}else{echo "readonly";} ?> />
					</div>
					<div class="form-group">
						<label for="inventorytransfer">Inventory Transfer</label>
						<input type="text" class="form-control" name="inventorytransfer" id="inventorytransfer" value="<?php echo $inventorytransfer; ?>" <?php if($tag == "3" AND $_userid == $approval3_id){echo "required";}else{echo "readonly";} ?> />
					</div>
				</div>
				</div>
				<div class="form-group">
					<label for="final">Final Decision</label>
					<select class="form-control" name="final" id="final" <?php echo $attribute; ?>>
						<option value="PASS" <?php if($final == "PASS"){echo "selected";} ?>>PASS</option>
						<option value="REWORK" <?php if($final == "REWORK"){echo "selected";} ?>>REWORK</option>
						<option value="REJECT" <?php if($final == "REJECT"){echo "selected";} ?>>REJECT</option>
					</select>
				</div>
				<div class="form-group">
					<label for="remark">Remark</label>
					<textarea class="form-control" name="remark" id="remark"><?php echo $remark; ?></textarea>
				</div>
			</div>
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
							<td><input type='hidden' name='creator' value='$creator' />$name</td>
							<td><input type='hidden' name='tag' value='$tag' /><span class='badge badge-black'>Submitted</span></td>
							<td>$datecreated</td>
						</tr>
						";
						if($approval1_name != ""){
						echo "
						<tr>
							<td class='text-primary'>Approval 1</td>
							<td>$approval1_name</td>
							<td><input type='hidden' name='status1' value='$status1' />$status1_label</td>
							<td><input type='hidden' name='date1' value='$date1' />$date1</td>
						</tr>
						";
						}
						if($approval2_name != ""){
						echo "
						<tr>
							<td class='text-primary'>Approval 2</td>
							<td>$approval2_name</td>
							<td><input type='hidden' name='status2' value='$status2' />$status2_label</td>
							<td><input type='hidden' name='date2' value='$date2' />$date2</td>
						</tr>
						";
						}
						if($approval3_name != ""){
						echo "
						<tr>
							<td class='text-primary'>Approval 3</td>
							<td>$approval3_name</td>
							<td><input type='hidden' name='status3' value='$status3' />$status3_label</td>
							<td><input type='hidden' name='date3' value='$date3' />$date3</td>
						</tr>
						";
						}
						echo "
						<tr class='bg-light'>
							<td class='text-primary' colspan='2' align='center'>Status Form</td>
							<td><input type='hidden' name='status' value='$status' />$status_label</td>
							<td><input type='hidden' name='date' value='$date' />$date</td>
						</tr>
						";
						?>
					</tbody>
				</table>
				</div>
			</div>
			<div class="card-footer">
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-save"></i> Update</button>
				</div>
			</div>
		</form>
		</div>
		<?php
		}
		?>
		
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
	
	$status = $_POST['status'];
	$date = $_POST['date'];
	$tag = $_POST['tag'];
	
	$now = date('Y-m-d');
	
	if($status == "1" AND $creator == $_userid){
		//tform_fir
		$q = mysql_query("UPDATE form_fir SET customername='$customername', partnumber='$partnumber', partname='$partname', checkcode='$checkcode', batchnumber='$batchnumber', totallotqty='$totallotqty', standardqc='$standardqc', lastissue='$lastissue', issueproduction='$issueproduction', receiptproduction='$receiptproduction', inventorytransfer='$inventorytransfer', final='$final', remark='$remark', status='0', date='$now', tag='1' WHERE number='$number'");
		//tform_fir_inspection
		mysql_query("DELETE FROM form_fir_inspection WHERE number='$number'");
		foreach($item as $x => $y){
			mysql_query("INSERT INTO form_fir_inspection (number,item,ac,re,n,a,r,n2,a2,r2,n3,a3,r3,n4,a4,r4,n5,a5,r5) VALUES('$number','$item[$x]','$ac[$x]','$re[$x]','$n[$x]','$a[$x]','$r[$x]','$n2[$x]','$a2[$x]','$r2[$x]','$n3[$x]','$a3[$x]','$r3[$x]','$n4[$x]','$a4[$x]','$r4[$x]','$n5[$x]','$a5[$x]','$r5[$x]')");
		}
		//tform_fir_inspection_prodqty
		mysql_query("DELETE FROM form_fir_inspection_prodqty WHERE number='$number'");
		foreach($prodqty as $xx => $yy){
			mysql_query("INSERT INTO form_fir_inspection_prodqty (number,prodqty,judgement,time) VALUES('$number','$prodqty[$xx]','$judgement[$xx]','$time[$xx]')");
		}
		//tform_fir_checkpoint
		mysql_query("DELETE FROM form_fir_checkpoint WHERE number='$number'");
		foreach($checkpoint as $xxx => $yyy){
			mysql_query("INSERT INTO form_fir_checkpoint (number,checkpoint,tolerance,specs,lowerlimit,upperlimit,val,val2,val3,val4,val5,val6,val7,val8,val9,val10,val11,val12,judgementcheck) VALUES('$number','$checkpoint[$xxx]','$tolerance[$xxx]','$specs[$xxx]','$lowerlimit[$xxx]','$upperlimit[$xxx]','$val[$xxx]','$val2[$xxx]','$val3[$xxx]','$val4[$xxx]','$val5[$xxx]','$val6[$xxx]','$val7[$xxx]','$val8[$xxx]','$val9[$xxx]','$val10[$xxx]','$val11[$xxx]','$val12[$xxx]','$judgementcheck[$xxx]')");
		}
	}
	else{
		$q = mysql_query("UPDATE form_fir SET remark='$remark' WHERE number='$number'");
	}
	
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
			window.location = '?p=fir_view&number=$number'
		});
	});
	</script>
	";
	}
}
if($_GET['action'] == "canceled"){
	$number = $_GET['number'];
	$id = $_GET['id'];
	$now = date('Y-m-d');
	$q = mysql_query("UPDATE form_fir SET status1='-1', status2='-1', status='-1', date='$now', tag='-1' WHERE number='$number'");
	
	if($q){
	echo "
	<script>
	jQuery(document).ready(function() {
		swal('Success', 'Canceled successfully', {
			icon : 'success',
			buttons: {        			
				confirm: {
					className : 'btn btn-success'
				}
			},
		}).then(function() {
			window.location = '?p=fir_view&number=$number'
		});
	});
	</script>
	";
	}
}
if($_GET['action'] == "revised"){
	$number = $_GET['number'];
	$id = $_GET['id'];
	$now = date('Y-m-d');
	$q = mysql_query("UPDATE form_fir SET status1='0', status2='0', status='1', date='$now', tag='1' WHERE number='$number'");
	
	if($q){
	echo "
	<script>
	jQuery(document).ready(function() {
		swal('Success', 'Revised successfully', {
			icon : 'success',
			buttons: {        			
				confirm: {
					className : 'btn btn-success'
				}
			},
		}).then(function() {
			window.location = '?p=fir_view&number=$number'
		});
	});
	</script>
	";
	}
}
if($_GET['action'] == "approved"){
	$number = $_GET['number'];
	$id = $_GET['id'];
	$now = date('Y-m-d');
	$tag = ($id+1);
	$q = mysql_query("UPDATE form_fir SET status$id='2', date$id='$now', tag='$tag' WHERE number='$number'");
	
	if($q){
		
	$q = mysql_query("SELECT * FROM form_fir WHERE number='$number'");
	$r = mysql_fetch_array($q);
	$status1 = $r['status1'];
	$status2 = $r['status2'];
	$status3 = $r['status3'];
	if($status1 == "2" AND $status2 == "2" AND $status3 == "2"){
		mysql_query("UPDATE form_fir SET status='2', date='$now', tag='$tag' WHERE number='$number'");
	}
		
	echo "
	<script>
	jQuery(document).ready(function() {
		swal('Success', 'Approved successfully', {
			icon : 'success',
			buttons: {        			
				confirm: {
					className : 'btn btn-success'
				}
			},
		}).then(function() {
			window.location = '?p=fir_view&number=$number'
		});
	});
	</script>
	";
	}
}
if($_GET['action'] == "closed"){
	$number = $_GET['number'];
	$id = $_GET['id'];
	$now = date('Y-m-d');
	$q = mysql_query("UPDATE form_fir SET status$id='3', date$id='$now', status='3', date='$now', tag='4' WHERE number='$number'");
	
	if($q){
	echo "
	<script>
	jQuery(document).ready(function() {
		swal('Success', 'Closed successfully', {
			icon : 'success',
			buttons: {        			
				confirm: {
					className : 'btn btn-success'
				}
			},
		}).then(function() {
			window.location = '?p=fir_view&number=$number'
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
//$('#totallotqty').val('0');
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
		url: "forms/fir/inspection.php?standardqc="+$('#standardqc').val()+"&totallotqty="+tot+"&prodqty1="+arr[0].value+"&prodqty2="+arr[1].value+"&prodqty3="+arr[2].value+"&prodqty4="+arr[3].value+"&prodqty5="+arr[4].value,
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
<?php
if($status == "1"){
?>
$('#standardqc').change();
<?php
}
?>
</script>
<script>
$('.val').on('input', function(){
    var lowerlimit = $(this).parent().parent().find("td:first").find("#lowerlimit").val();
	var upperlimit = $(this).parent().parent().find("td:first").find("#upperlimit").val();
	var judgementcheck = $(this).parent().parent().find("td:last").find("#judgementcheck");
	if($(this).val() != "" && (lowerlimit != "" || upperlimit != "")){
		if(lowerlimit != "" && upperlimit != ""){
			if(parseFloat($(this).val()) >= parseFloat(lowerlimit) && parseFloat($(this).val()) <= parseFloat(upperlimit)){
				$(this).attr("data-id", "OK");
				//$(this).css("color", "var(--success)");
			}
			else{
				$(this).attr("data-id", "NG");
				//$(this).css("color", "var(--danger)");
			}
		}
		else if(lowerlimit != "" && upperlimit == ""){
			if(parseFloat($(this).val()) >= parseFloat(lowerlimit)){
				$(this).attr("data-id", "OK");
				//$(this).css("color", "var(--success)");
			}
			else{
				$(this).attr("data-id", "NG");
				//$(this).css("color", "var(--danger)");
			}
		}
		else if(lowerlimit == "" && upperlimit != ""){
			if(parseFloat($(this).val()) <= parseFloat(upperlimit)){
				$(this).attr("data-id", "OK");
				//$(this).css("color", "var(--success)");
			}
			else{
				$(this).attr("data-id", "NG");
				//$(this).css("color", "var(--danger)");
			}
		}
		var val1 = $(this).closest("tr").find("input[name='val[]']").attr("data-id");
		var val2 = $(this).closest("tr").find("input[name='val2[]']").attr("data-id");
		var val3 = $(this).closest("tr").find("input[name='val3[]']").attr("data-id");
		var val4 = $(this).closest("tr").find("input[name='val4[]']").attr("data-id");
		var val5 = $(this).closest("tr").find("input[name='val5[]']").attr("data-id");
		var val6 = $(this).closest("tr").find("input[name='val6[]']").attr("data-id");
		var val7 = $(this).closest("tr").find("input[name='val7[]']").attr("data-id");
		var val8 = $(this).closest("tr").find("input[name='val8[]']").attr("data-id");
		var val9 = $(this).closest("tr").find("input[name='val9[]']").attr("data-id");
		var val10 = $(this).closest("tr").find("input[name='val10[]']").attr("data-id");
		var val11 = $(this).closest("tr").find("input[name='val11[]']").attr("data-id");
		var val12 = $(this).closest("tr").find("input[name='val12[]']").attr("data-id");
		if(val1 == ""
		&& val2 == ""
		&& val3 == ""
		&& val4 == ""
		&& val5 == ""
		&& val6 == ""
		&& val7 == ""
		&& val8 == ""
		&& val9 == ""
		&& val10 == ""
		&& val11 == ""
		&& val12 == ""){
			judgementcheck.attr("data-id", "");
			judgementcheck.val("");
			//judgementcheck.css("color", "unset");
		}
		else if(val1 == "NG"
		|| val2 == "NG"
		|| val3 == "NG"
		|| val4 == "NG"
		|| val5 == "NG"
		|| val6 == "NG"
		|| val7 == "NG"
		|| val8 == "NG"
		|| val9 == "NG"
		|| val10 == "NG"
		|| val11 == "NG"
		|| val12 == "NG"){
			judgementcheck.attr("data-id", "NG");
			judgementcheck.val("NG");
			//judgementcheck.css("color", "var(--danger)");
		}
		else{
			judgementcheck.attr("data-id", "OK");
			judgementcheck.val("OK");
			//judgementcheck.css("color", "var(--success)");
		}
	}
	else if($(this).val() != "" && lowerlimit == "" && upperlimit == ""){
		if($(this).val() == "0"){
			$(this).attr("data-id", "OK");
			//$(this).css("color", "var(--success)");
		}
		else if($(this).val() == "1"){
			$(this).attr("data-id", "NG");
			//$(this).css("color", "var(--danger)");
		}
		else if($(this).val() == "2"){
			$(this).attr("data-id", "NG");
			//$(this).css("color", "var(--danger)");
		}
		else if($(this).val() >= "3"){
			$(this).attr("data-id", "NG");
			//$(this).css("color", "var(--danger)");
		}
		else{
			$(this).attr("data-id", "");
			//$(this).css("color", "unset");
		}
		var val1 = $(this).closest("tr").find("input[name='val[]']").attr("data-id");
		var val2 = $(this).closest("tr").find("input[name='val2[]']").attr("data-id");
		var val3 = $(this).closest("tr").find("input[name='val3[]']").attr("data-id");
		var val4 = $(this).closest("tr").find("input[name='val4[]']").attr("data-id");
		var val5 = $(this).closest("tr").find("input[name='val5[]']").attr("data-id");
		var val6 = $(this).closest("tr").find("input[name='val6[]']").attr("data-id");
		var val7 = $(this).closest("tr").find("input[name='val7[]']").attr("data-id");
		var val8 = $(this).closest("tr").find("input[name='val8[]']").attr("data-id");
		var val9 = $(this).closest("tr").find("input[name='val9[]']").attr("data-id");
		var val10 = $(this).closest("tr").find("input[name='val10[]']").attr("data-id");
		var val11 = $(this).closest("tr").find("input[name='val11[]']").attr("data-id");
		var val12 = $(this).closest("tr").find("input[name='val12[]']").attr("data-id");
		if(val1 == ""
		&& val2 == ""
		&& val3 == ""
		&& val4 == ""
		&& val5 == ""
		&& val6 == ""
		&& val7 == ""
		&& val8 == ""
		&& val9 == ""
		&& val10 == ""
		&& val11 == ""
		&& val12 == ""){
			judgementcheck.attr("data-id", "");
			judgementcheck.val("");
			//judgementcheck.css("color", "unset");
		}
		else if(val1 == "NG"
		|| val2 == "NG"
		|| val3 == "NG"
		|| val4 == "NG"
		|| val5 == "NG"
		|| val6 == "NG"
		|| val7 == "NG"
		|| val8 == "NG"
		|| val9 == "NG"
		|| val10 == "NG"
		|| val11 == "NG"
		|| val12 == "NG"){
			judgementcheck.attr("data-id", "NG");
			judgementcheck.val("NG");
			//judgementcheck.css("color", "var(--danger)");
		}
		else{
			judgementcheck.attr("data-id", "OK");
			judgementcheck.val("OK");
			//judgementcheck.css("color", "var(--success)");
		}
	}
	else{
		$(this).attr("data-id", "");
		//$(this).css("color", "unset");
		var val1 = $(this).closest("tr").find("input[name='val[]']").attr("data-id");
		var val2 = $(this).closest("tr").find("input[name='val2[]']").attr("data-id");
		var val3 = $(this).closest("tr").find("input[name='val3[]']").attr("data-id");
		var val4 = $(this).closest("tr").find("input[name='val4[]']").attr("data-id");
		var val5 = $(this).closest("tr").find("input[name='val5[]']").attr("data-id");
		var val6 = $(this).closest("tr").find("input[name='val6[]']").attr("data-id");
		var val7 = $(this).closest("tr").find("input[name='val7[]']").attr("data-id");
		var val8 = $(this).closest("tr").find("input[name='val8[]']").attr("data-id");
		var val9 = $(this).closest("tr").find("input[name='val9[]']").attr("data-id");
		var val10 = $(this).closest("tr").find("input[name='val10[]']").attr("data-id");
		var val11 = $(this).closest("tr").find("input[name='val11[]']").attr("data-id");
		var val12 = $(this).closest("tr").find("input[name='val12[]']").attr("data-id");
		if(val1 == ""
		&& val2 == ""
		&& val3 == ""
		&& val4 == ""
		&& val5 == ""
		&& val6 == ""
		&& val7 == ""
		&& val8 == ""
		&& val9 == ""
		&& val10 == ""
		&& val11 == ""
		&& val12 == ""){
			judgementcheck.attr("data-id", "");
			judgementcheck.val("");
			//judgementcheck.css("color", "unset");
		}
		else if(val1 == "NG"
		|| val2 == "NG"
		|| val3 == "NG"
		|| val4 == "NG"
		|| val5 == "NG"
		|| val6 == "NG"
		|| val7 == "NG"
		|| val8 == "NG"
		|| val9 == "NG"
		|| val10 == "NG"
		|| val11 == "NG"
		|| val12 == "NG"){
			judgementcheck.attr("data-id", "NG");
			judgementcheck.val("NG");
			//judgementcheck.css("color", "var(--danger)");
		}
		else{
			judgementcheck.attr("data-id", "OK");
			judgementcheck.val("OK");
			//judgementcheck.css("color", "var(--success)");
		}
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
</script>
<script>
$('#startdate').datetimepicker({
	format: 'YYYY-MM-DD',
});
$('#enddate').datetimepicker({
	format: 'YYYY-MM-DD',
});
function getReport(){
	var s = document.getElementById('startdate').value;
	var e = document.getElementById('enddate').value;
	var f = document.getElementById('final').value;
	swal({
		title: 'Are you sure ?',
		text: 'You will export data from '+s+' until '+e+' with final decision '+f+' ?',
		type: 'warning',
		buttons:{
			confirm: {
				text : 'Yes, export it',
				className : 'btn btn-success'
			},
			cancel: {
				visible: true,
				className: 'btn btn-danger'
			}
		}
	}).then((isConfirm) => {
		if (isConfirm) {
			window.location.href = 'forms/fir/excel.php?startdate='+s+'&enddate='+e+'&final='+f;
		} else {
			swal.close();
		}
	});
}
</script>
<script>
$('#issueproduction').on('input', function(){
	$.ajax({
		async: false,
		url: "forms/fir/update.php?number="+$('#number').val()+"&type=issueproduction&value="+$('#issueproduction').val(),
		success: function(msg){
			//alert(msg);
		},
		dataType: "html"
	});
});
$('#receiptproduction').on('input', function(){
	$.ajax({
		async: false,
		url: "forms/fir/update.php?number="+$('#number').val()+"&type=receiptproduction&value="+$('#receiptproduction').val(),
		success: function(msg){
			//alert(msg);
		},
		dataType: "html"
	});
});
$('#inventorytransfer').on('input', function(){
	$.ajax({
		async: false,
		url: "forms/fir/update.php?number="+$('#number').val()+"&type=inventorytransfer&value="+$('#inventorytransfer').val(),
		success: function(msg){
			//alert(msg);
		},
		dataType: "html"
	});
});
$('#remark').on('input', function(){
	$.ajax({
		async: false,
		url: "forms/fir/update.php?number="+$('#number').val()+"&type=remark&value="+$('#remark').val(),
		success: function(msg){
			//alert(msg);
		},
		dataType: "html"
	});
});
function check_approval2(e){
	if($('#issueproduction').val() != "" && $('#receiptproduction').val() != "" && $('#inventorytransfer').val() != ""){
		check(e);
		return false;
	}
	else{
		swal('Error', 'Please fill this form', {
			icon : 'error',
			buttons: {        			
				confirm: {
					className : 'btn btn-danger'
				}
			},
		}).then(function() {
			if($('#inventorytransfer').val() == ""){$('#inventorytransfer').focus()}
			if($('#receiptproduction').val() == ""){$('#receiptproduction').focus()}
			if($('#issueproduction').val() == ""){$('#issueproduction').focus()}
		});
		return false;
	}
}
</script>