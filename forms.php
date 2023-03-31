<?php include("header.php"); ?>
<?php include("memo_model.php"); ?>


<?php 
$sessIdUser = $_SESSION['USERD']->id;
$dat = new Memo();
$model = new MemoModel();
$isSet = 0;
$aksi = $_GET['aksi'];
if (isset($_GET['id'])) {
	$dat = $model->getMemoById($_GET['id']); 
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
		<form action="memo_controller.php?aksi=<?php echo $aksi."&id=".$dat->id;?>" method="POST">
			<div class="mb-3">
				<input type="text" name="judul" maxlength="20" class="form-control" id="judulMemo" aria-describedby="judulDesc" placeholder="Masukkan judul memo" value="<?php if($isSet){echo ($dat->judul);}?>">
				<small id="judulDesc" class="form-text text-muted">Masukkan maksimal 20 huruf</small>
			</div>
			<div class="mb-3">
				<textarea id="isiMemo" name="isi" class="form-control" aria-describedby="isiDesc" placeholder="Masukkan isi memo" >
					<?php if($isSet){echo $dat->isi;} ?>
				</textarea>
				<small id="isiDesc" class="form-text text-muted">&nbsp;</small>
				<input type="hidden" name="id" value="<?php if($isSet){echo $dat->id;} ?>">
				<input type="hidden" name="id_user" value="<?php echo $sessIdUser; ?>">
			</div>
			<button type="submit" class="btn btn-primary" name="submitbtn"><?php echo $aksi;?></button>
		</form>
	</div>
</body>

<?php include("footer.php"); ?>