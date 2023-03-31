<?php include_once("header.php"); ?>
<?php include_once("user_model.php"); ?>

<?php 
	
	$dat = new User();
	$model = new UserModel();
	$isSet = 0;
	$aksi = $_GET['aksi'];
	if (isset($_GET['id'])) {
		$dat = $model->getUserById($_GET['id']); 
		$isSet = 1;
	}

?>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-1">&nbsp;</div>
			<div class="col-md-10">

			</div>
		</div>
		<?php if (isset($_GET['idexist'])) { ?>
           <div class="alert alert-warning">
            <strong>Udah ada nih orangnya woy !</strong> <a href="<?php echo "admin_forms.php?id=".$_GET['idexist']."&aksi=edit" ?>">ini nih datanya ...</a>
          </div>  
        <?php } ?>


		<form action="user_controller.php?aksi=<?php echo $aksi."&id=".$dat->id;?>" method="POST">
			<div class="mb-3">
				<input type="text" name="nama" maxlength="25" class="form-control"  aria-describedby="desc" placeholder="Masukkan Nama" value="<?php if($isSet){echo ($dat->nama);}?>">
				<small id="desc" class="form-text text-muted">Masukkan Nama maksimal 25 huruf</small>
			</div>
			<div class="mb-3">
				<input type="text" name="username" maxlength="18" class="form-control"  aria-describedby="desc" placeholder="Masukkan NIP" value="<?php if($isSet){echo ($dat->username);}?>">
				<small id="desc" class="form-text text-muted">Masukkan NIP Kemenkeu maksimal 18 huruf</small>
			</div>
			<div class="mb-3">
				<input type="password" name="password"  class="form-control"  aria-describedby="desc" placeholder="Masukkan password" value="">
				<small id="desc" class="form-text text-muted">Masukkan password yg aman</small>
			</div>
			<div class="form-check form-switch mb-3">
			  <input class="form-check-input" name="is_admin" type="checkbox" role="switch" id="flexSwitchCheckChecked" 
			  <?php if ($dat->is_admin==1) {echo "checked";} ?> 
			  value="<?php echo $dat->is_admin; ?>">
			  <label class="form-check-label" for="flexSwitchCheckChecked">Naikkan kasta ke Admin ?</label>
			</div>
			<input type="hidden" name="id" value="<?php echo $dat->id; ?>">
			<button type="submit" class="btn btn-primary" name="submitbtn"><?php echo $aksi;?></button>
		</form>
	</div>
</body>

<?php include("footer.php"); ?>