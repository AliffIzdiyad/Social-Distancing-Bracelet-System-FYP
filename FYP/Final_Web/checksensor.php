<?php
//connection to database
$to_connect = mysqli_connect("localhost", "root", "", "project_10_length");

//read value from table
$sql = mysqli_query($to_connect, "select * from signal_value ORDER BY time_updated DESC LIMIT 30");
$sql2 = mysqli_query($to_connect, "select * from signal_value ORDER BY time_updated DESC LIMIT 1");
$rows = mysqli_fetch_assoc($sql2);
if (($rows["status"]) != 'Far') {
?>
	<div class="alert alert-danger alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Please move apart !
	</div>
<?php } ?>
<h3>Live Data</h3>
<div class="card-body">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>Signal Value</th>
					<th>Status</th>
					<th>Time</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while ($rows = mysqli_fetch_assoc($sql)) {
				?>
					<tr style="<?php if ($rows['status'] == 'Near') {
									echo 'background:#ef7575;';
								} elseif ($rows['status'] == 'Too Near') {
									echo 'background:#d93939;';
								} ?>">
						<td><?php echo $rows['signal_val']; ?></td>
						<td><?php echo $rows['status']; ?></td>
						<td><?php echo $rows['time_updated']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>