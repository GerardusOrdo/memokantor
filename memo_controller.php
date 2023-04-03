<?php 

require('memo_model.php');

$m = new MemoModel();

//view data
if (!empty($_GET['aksi']=='view')) {
		$d = new Memo();
	     $d->id = $_GET['id'];
       
        # proses view
        if($d->id!=0){
        	echo "<script>window.location='forms.php?id=".$d->id."&aksi=edit';</script>";
        	//echo "a";
        } else
        {
        	echo "<script>window.location='forms.php?aksi=add';</script>";
        	//echo "b";
        }
}

//tambah data
if (!empty($_GET['aksi']=='add')) {
		$d = new Memo();
		$d->judul = strip_tags($_POST['judul']);
        $d->isi = strip_tags($_POST['isi']);
        $d->id_user = strip_tags($_POST['id_user']);
        
        # proses insert
        if($m->addMemo($d)){
        	echo '<script>alert("Tambah Data Berhasil");window.location="dashboard.php"</script>';
        }
}

//edit data
if (!empty($_GET['aksi']=='edit')) {
		$d = new Memo();
		$d->id = $_GET['id'];
		$d->judul = strip_tags($_POST['judul']);
        $d->isi = strip_tags($_POST['isi']);
        $d->id_user = strip_tags($_POST['id_user']);
        
        # proses edit
        if($m->editMemo($d)){
        	echo "<script>alert('Ubah Data Berhasil');window.location='forms.php?id=".$d->id."&aksi=edit';</script>";
        }
}

//del data
if (!empty($_GET['aksi']=='del')) {
		$d = new Memo();
		$d->id = $_GET['id'];
        
        # proses del
        if($m->deleteMemo($d)){
        	echo '<script>alert("Hapus Data Berhasil");window.location="dashboard.php"</script>';
        }
}

//search data
if (!empty($_GET['aksi']=='search')) {
		$key = strip_tags($_POST['key']);
		$id_user = strip_tags($_POST['id_user']);
		echo "<script>window.location='dashboard.php?aksi=search&id_user=".$id_user."&key=".$key."';</script>";
}

//sort data by id
if (!empty($_GET['aksi']=='sort')) {
		$key = $_GET['key'];
		$id_user = $_GET['idu'];
		echo "<script>window.location='dashboard.php?aksi=sort&idu=".$id_user."&key=".$key."&col=ID';</script>";
}
 ?>