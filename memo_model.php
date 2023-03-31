<?php 
include_once('koneksi.php');

/**
 * kelas object memo
 */
class Memo
{
	public $id;
	public $judul;
	public $isi;
	public $id_user;
	public $dt_crt;
	public $dt_upd;

	function __construct()
	{
		
	}

	public function set($id,$judul,$isi,$id_user,$dt_crt,$dt_upd)
	{
		$this->id = $id;
		$this->judul = $judul;
		$this->isi = $isi;
		$this->id_user = $id_user;
		$this->dt_crt = $dt_crt;
		$this->dt_upd = $dt_upd;
	}
}



/**
 * Kelas untuk melakukan olah data Memo
 */

class MemoModel 
{
	protected $db; 
	function __construct()
	{
		$koneksi = new Koneksi();
		$this->db = $koneksi->DBConnect();
	}


	function getAllMemo($iduser){
		$row = $this->db->prepare("SELECT * FROM MEMO WHERE ID_USER = ".$iduser. " ORDER BY ID DESC");
		$row->execute();
		$hasil = $row->fetchAll(PDO::FETCH_ASSOC);
		$dats = array();

		foreach ($hasil as $r) {
			$memo = new Memo();
			$memo->set($r['ID'],$r['JUDUL'],$r['ISI'],$r['ID_USER'],$r['DT_CRT'],$r['DT_UPD']);
			$dats[] = $memo;
		}
		return $dats;
	}


	function sortAllMemo($by,$iduser,$col){
		$sql= "SELECT * FROM MEMO WHERE ID_USER = ".$iduser." ORDER BY ".$col." ".$by;

		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll(PDO::FETCH_ASSOC);
		$dats = array();

		foreach ($hasil as $r) {
			$memo = new Memo();
			$memo->set($r['ID'],$r['JUDUL'],$r['ISI'],$r['ID_USER'],$r['DT_CRT'],$r['DT_UPD']);
			$dats[] = $memo;
		}
		return $dats;
	}

	function getMemoById($id){
		$row = $this->db->prepare("SELECT * FROM MEMO WHERE ID = $id ORDER BY ID DESC");
		$row->execute();
		$r = $row->fetch(PDO::FETCH_ASSOC);
		$memo = new Memo();
		$memo->set($r['ID'],$r['JUDUL'],$r['ISI'],$r['ID_USER'],$r['DT_CRT'],$r['DT_UPD']);
		return $memo;
	}

	function getMemoByLike($str,$id_user){
		$sql = "SELECT * FROM MEMO WHERE ((JUDUL LIKE '%$str%' OR ISI LIKE '%$str%') AND ID_USER = $id_user) ORDER BY ID DESC";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll(PDO::FETCH_ASSOC);
		$dats = array();

		foreach ($hasil as $r) {
			$memo = new Memo();
			$memo->set($r['ID'],$r['JUDUL'],$r['ISI'],$r['ID_USER'],$r['DT_CRT'],$r['DT_UPD']);
			$dats[] = $memo;
		}
		return $dats;
	}

	function editMemo($d){
		$row = $this->db->prepare("
			UPDATE MEMO 
				SET JUDUL = '$d->judul', ISI = '$d->isi', ID_USER = '$d->id_user' WHERE ID = $d->id
			");
		return $row->execute();
		
	}

	function addMemo($d){
		$row = $this->db->prepare("
			INSERT INTO MEMO (JUDUL, ISI, ID_USER, DT_CRT, DT_UPD) 
				VALUES ('$d->judul','$d->isi','$d->id_user',current_timestamp(),current_timestamp())

			");
		return $row->execute();
	}

	function deleteMemo($d){
		$row = $this->db->prepare("
			DELETE FROM MEMO WHERE ID = $d->id

			");
		return $row->execute();
	}


}



 ?>