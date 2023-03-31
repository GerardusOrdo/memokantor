<?php 

include("user_model.php");
session_start();

if(isset($_SESSION['USERD'])){ 
	$sessIdUser = $_SESSION['USERD']->id; 
}else{ 
	echo "<script>window.location='index.php';</script>"; 
}

$d = new User();
$d = $_SESSION['USERD'];
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" >
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/memo.css">
	<link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css" />
	<title></title>
</head>



<div class="container">
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
		<div class="container-fluid">
			<a class="navbar-brand" href="dashboard.php">
			<img src="assets/img/profile.png" width="50" height="50" class="d-inline-block align-top" alt="">
			Selamat Datang, <?php echo $d->nama; ?>
			</a>

			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav me-auto mb-2 mb-md-0">
					<li class="nav-item">
						<a class="nav-link" href="<?php echo ("user_controller.php?aksi=logout") ?>">Logout</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="memo_controller.php?aksi=view&id=0">Tambah Memo</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Urutkan Memo</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="memo_controller.php?aksi=sort&key=desc&idu=<?php echo $sessIdUser ;?>">Terbaru</a></li>
							<li><a class="dropdown-item" href="memo_controller.php?aksi=sort&key=asc&idu=<?php echo $sessIdUser ;?>">Terlama</a></li>
						</ul>
					</li>
					<?php if ($d->is_admin==1) { ?>
					<li class="nav-item">
						<a class="nav-link" href="admin_dashboard.php">List User</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="user_controller.php?aksi=view&id=0">Tambah User</a>
					</li>	
					<?php } ?>
				</ul>
				<form class="d-flex" role="search" action="memo_controller.php?aksi=search" method="POST">
					<input class="form-control me-2" type="search" placeholder="Cari Memo" aria-label="Search" name="key">
					<input type="hidden" name="id_user" value="<?php echo $sessIdUser; ?>">
					<button class="btn btn-outline-light my-2 my-sm-0" type="submit">Cari</button>
				</form>
			</div>
		</div>
	</nav>
</div>