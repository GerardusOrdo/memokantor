<?php 
require_once('user_model.php');

$m = new UserModel();

//login data
if (!empty($_GET['aksi']=='login')) {
	$user = strip_tags($_POST['username']);
	$pass = strip_tags($_POST['password']);

	$result = $m->loginUser($user,$pass);
	if(is_null($result->id))
	{
		echo "<script>window.location='index.php?get=gagal';</script>";
	}else{

		session_start();
		$_SESSION['USERD'] = $result;
		echo "<script>window.location='dashboard.php';</script>";
	}

	//var_dump($result);
}

//logout data
if (!empty($_GET['aksi']=='logout')) { 
	session_start();
	session_destroy();
	header("location:index.php?get=logout"); 
	
}

//view data
if (!empty($_GET['aksi']=='view')) {
		$d = new User();
	     $d->id = $_GET['id'];
       
        # proses view
        if($d->id!=0){
        	echo "<script>window.location='admin_forms.php?id=".$d->id."&aksi=edit';</script>";
        	//echo "a";
        } else
        {
        	echo "<script>window.location='admin_forms.php?aksi=add';</script>";
        	//echo "b";
        }
}

//tambah data
if (!empty($_GET['aksi']=='add')) {
		$d = new User();
		$d->nama = strip_tags($_POST['nama']);
		$d->username = strip_tags($_POST['username']);
        $d->password = md5(strip_tags($_POST['username']));
        $d->is_admin = 0;
        if (isset($_POST['is_admin'])) {
        	$d->is_admin = 1;
        }
        
        $d2 = new User();
        $d2 = $m->getUserByUsername($d->username);



        if (is_null($d2->username)) // cek apakah ada user atau tidak
        {
        	 # proses insert
	        if($m->addUser($d)){
	        	echo '<script>alert("Tambah Data Berhasil");window.location="admin_dashboard.php"</script>';
	        }
        } else
        {
        	//var_dump(is_null($d2->username));
        	echo "<script>window.location='admin_forms.php?aksi=add&idexist=".$d2->id."';</script>";
        }
       
}

//edit data
if (!empty($_GET['aksi']=='edit')) {
		$d = new User();
		$d->id=strip_tags($_POST['id']);
		$d->nama = strip_tags($_POST['nama']);
		$d->username = strip_tags($_POST['username']);
		if ($_POST['password']!="") {
			$d->password = md5(strip_tags($_POST['password']));
		}
        $d->is_admin = 0;
        if (isset($_POST['is_admin'])) {
        	$d->is_admin = 1;
        }
        
        # proses edit
        if($m->editUser($d)){
        	echo "<script>alert('Edit Data Berhasil');window.location='admin_forms.php?id=".$d->id."&aksi=edit';</script>";
        }
}


//del data
if (!empty($_GET['aksi']=='del')) {
		$d = new User();
		$d->id = $_GET['id'];
        
        # proses del
        if($m->deleteUser($d)){
        	echo '<script>alert("Hapus Data Berhasil");window.location="admin_dashboard.php"</script>';
        }
}




?>