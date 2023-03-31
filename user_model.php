<?php 
include_once('koneksi.php');

/**
 * kelas object user
 */
class User
{
	public $id;
	public $nama;
	public $username;
	public $password;
	public $is_admin;
	public $dt_crt;
	public $dt_upd;

	function __construct()
	{
		
	}

	public function set($id,$nama,$username,$password,$is_admin,$dt_crt,$dt_upd)
	{
		$this->id = $id;
		$this->nama = $nama;
		$this->username = $username;
		$this->password = $password;
		$this->is_admin = $is_admin;
		$this->dt_crt = $dt_crt;
		$this->dt_upd = $dt_upd;
	}

	
}


/**
 * Kelas untuk melakukan olah data user
 */

class UserModel 
{
	protected $db; 
	function __construct()
	{
		$koneksi = new Koneksi();
		$this->db = $koneksi->DBConnect();
	}


	function loginUser($userstr,$pass){
		 // untuk password kita enkrip dengan md5
		$user = new User();
		$row = $this->db->prepare('SELECT * FROM USER WHERE username=? AND password=md5(?)');
		$row->execute(array($userstr,$pass));
		$count = $row->rowCount();
		if($count > 0)
		{
			$r = $row->fetch(PDO::FETCH_ASSOC);
			$user->set($r['ID'],$r['NAMA'],$r['USERNAME'],$r['PASSWORD'],$r['IS_ADMIN'],$r['DT_CRT'],$r['DT_UPD'] );
	
		}
		return $user;
	}

	function getAllUser(){
		$row = $this->db->prepare("SELECT * FROM USER");
		$row->execute();
		$hasil = $row->fetchAll(PDO::FETCH_ASSOC);
		$users = array();

		foreach ($hasil as $r) {
			$user = new User();
			$user->set($r['ID'],$r['NAMA'],$r['USERNAME'],$r['PASSWORD'],$r['IS_ADMIN'],$r['DT_CRT'],$r['DT_UPD']);
			$users[] = $user;
		}
		return $users;
	}

	function getUserById($id){
		$row = $this->db->prepare("SELECT * FROM USER WHERE ID = $id");
		$row->execute();
		$r = $row->fetch(PDO::FETCH_ASSOC);
		$user = new User();
		$user->set($r['ID'],$r['NAMA'],$r['USERNAME'],$r['PASSWORD'],$r['IS_ADMIN'],$r['DT_CRT'],$r['DT_UPD'] );
		return $user;
	}

	function getUserByUsername($str){
		$sql = "SELECT * FROM USER WHERE USERNAME = '$str'";
		
		$row = $this->db->prepare($sql);
		$row->execute();
		$r = $row->fetch(PDO::FETCH_ASSOC);
		$user = new User();
		if (!(empty($r))) {
			$user->set($r['ID'],$r['NAMA'],$r['USERNAME'],$r['PASSWORD'],$r['IS_ADMIN'],$r['DT_CRT'],$r['DT_UPD'] );
		}
		
		return $user;
	}

	function editUser($d){
		$sql ="";
		if(is_null($d->password)){
			$sql ="
			UPDATE USER 
			SET 
			NAMA = '$d->nama',
			USERNAME = '$d->username', 
			IS_ADMIN = '$d->is_admin' 
			WHERE ID = $d->id";
		} else{
			$sql ="
			UPDATE USER 
			SET 
			NAMA = '$d->nama',
			USERNAME = '$d->username', 
			PASSWORD = '$d->password', 
			IS_ADMIN = '$d->is_admin' 
			WHERE ID = $d->id";
		}
		
		$row = $this->db->prepare($sql);
		return $row->execute();
		
	}

	function addUser($d){
		$sql = "
			INSERT INTO USER (NAMA, USERNAME, PASSWORD, IS_ADMIN, DT_CRT, DT_UPD)
			VALUES ('$d->nama','$d->username','$d->password','$d->is_admin',current_timestamp(),current_timestamp())

			";
		//var_dump($sql);
		$row = $this->db->prepare($sql);
		return $row->execute();
	}

	function deleteUser($d){
		$row = $this->db->prepare("
			DELETE FROM USER WHERE ID = $d->id

			");
		return $row->execute();
	}


}





?>