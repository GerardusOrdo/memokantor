<?php include("header.php"); ?>
<?php include("memo_model.php"); ?>


<?php 
$conUser = new UserModel();
$users = $conUser->getAllUser();
 ?>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table id="dtAdmin" class="table table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Status</th>
							<th>Date Registered</th>
							<th>Hapus</th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
							$no = 0;
							foreach ($users as $k) {
								$no++;
						?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $k->nama;?></td>
								<td><a href="user_controller.php?aksi=view&id=<?php echo $k->id; ?>"><?php echo $k->username;?></a></td>
								<td><?php if ($k->is_admin==1) {
									echo "admin";
								} else {echo "rakyat biasa";}?></td>
								<td><?php echo $k->dt_crt;?></td>
								<td>
									<a href="user_controller.php?aksi=del&id=<?php echo $k->id; ?>" class="text-danger "><i class="fa fa-trash-o "></i></a>
								</td>
							</tr>

						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

<?php include("footer.php"); ?>