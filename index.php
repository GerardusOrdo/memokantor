<?php 
include("user_model.php");
session_start();

if(!empty($_SESSION['USERD'])){ 
  echo "<script>window.location='dashboard.php';</script>";
}

// var_dump(($_SESSION));

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" >
  <script src="assets/js/bootstrap.min.js"></script> 

  <title></title>
</head>
<body>
  <div class="container">
    <div class="row m-5 no-gutters shadow-lg">
      <div class="col-md-6 d-none d-md-block">
        <img src="https://djpb.kemenkeu.go.id/portal/images/2023/03/gedungjuanda.jpg" class="img-fluid" style="min-height:100%;" />
      </div>
      <div class="col-md-6 bg-white p-5">

        <h3 class="pb-3">Login Aplikasi Memo Kantor</h3>
        <?php if (isset($_GET['get'])) { ?>
          <?php if ($_GET['get']=="gagal"){ ?>
           <div class="alert alert-warning">
            <strong>LOL Gagal Login!</strong> makannya inget2 passwordnya ..
          </div>
          <?php } ?>
          <?php if ($_GET['get']=="logout"){ ?>
           <div class="alert alert-success">
            <strong>See ya !</strong> udah logout nih ..
          </div>
          <?php } ?>
        <?php } ?>



      <div class="form-style">
        <form action="user_controller.php?aksi=login" method="POST">
          <div class="form-group pb-3">
            <input type="text" name="username" placeholder="Masukkan Username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="form-group pb-3">
            <input type="password" name="password" placeholder="Masukkan Password" class="form-control" id="exampleInputPassword1">
          </div>

          <div class="pb-2">
            <button type="submit" class="btn btn-primary w-100 font-weight-bold mt-2">Submit</button>
          </div>
        </form>

        <div class="pt-4 text-center">
          Untuk pendaftaran user baru <a href="https://wa.me/6285743734402">Kontak Kami</a>
         
        </div>
      </div>
    </div>
  </div>
</body>
</html>