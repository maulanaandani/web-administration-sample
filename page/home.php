<div class="row">
<div class="col-md-12">
	<div class="card card-dark bg-primary-gradient">
		<div class="card-body skew-shadow">
			<div class="row">
				<div class="col-8 pr-0">
					<h3 class="fw-bold mb-1">Welcome</h3>
					<div class="text-small text-uppercase fw-bold op-8"><?php echo $_name; ?></div>
				</div>
				<div class="col-4 pl-0 text-right">
					<h3 class="fw-bold mb-1"><?php echo $_username; ?></h3>
					<div class="text-small text-uppercase fw-bold op-8"><?php echo $_departmentname; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php
$q = mysql_query("
SELECT * FROM form_fir 
WHERE 
(status='1' AND tag='1' AND creator='$_userid')
OR
(status='0' AND tag='1' AND approval1='$_userid')
OR
(status='0' AND tag='2' AND approval2='$_userid')
OR
(status='0' AND tag='3' AND approval3='$_userid')
OR
(status='0' AND creator='$_userid')
 ORDER BY number DESC
");
$n = mysql_num_rows($q);
if($n > 0){
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-primary bg-primary-gradient">
				<div class="card-head-row">
					<div class="card-title">Final Inspection Report</div>
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
					$i = 1;
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
							<td><a class='btn btn-primary btn-sm' href='?p=fir_view&number=$r[number]'><i class='fa fa-eye'></i> Detail</a></td>
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
</div>
<?php
}
?>