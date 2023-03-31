<?php include("header.php"); ?>
<?php include("memo_model.php"); ?>

<?php 
$conMemmo = new MemoModel();
$sessIdUser = $_SESSION['USERD']->id;
if (isset($_GET['aksi'])) {
	if ($_GET['aksi']=="search") {
		$memos = $conMemmo->getMemoByLike($_GET['key'],$_GET['id_user']);
	} elseif ($_GET['aksi']=="sort") {
		$memos = $conMemmo->sortAllMemo($_GET['key'],$_GET['idu'],$_GET['col']);
	}
	
} else {
	$memos = $conMemmo->getAllMemo($sessIdUser);
}



$listBg = array();
$listBg[]="lazur-bg"; $listBg[]="red-bg"; $listBg[]="yellow-bg";


function custom_echo($x, $length)
{
  if(strlen($x)<=$length)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    echo $y;
  }
}
 ?>


<body>

<div class="container bootstrap snippets bootdey">
    <div class="row">
    	<!-- <div class="col-md-2">
    	
    	</div> -->
    	<!-- <div class="col-md-12"> -->
    		<ul class="notes">
    			<?php 
    			$count = 1;
    			$countBg = 0;
    			foreach ($memos as $k) { ?>
    				<li>
		                <div class="rotate-<?php echo $count." "; $count++; if($count>2){$count=1;} 
		                 echo $listBg[$countBg]; $countBg++; if($countBg>(sizeof($listBg)-1)){$countBg=0;} ?>
		                ">
		                    <small><?php echo $k->dt_crt; ?></small>
		                    <h4><a href="memo_controller.php?aksi=view&id=<?php echo $k->id; ?>"><?php custom_echo($k->judul,10); ?></a></h4>
		                    <p><?php custom_echo($k->isi,80); ?></p>
		                    <a href="memo_controller.php?aksi=del&id=<?php echo $k->id; ?>" class="text-danger pull-right"><i class="fa fa-trash-o "></i></a>
		                   
		                </div>
		            </li>   
    			<?php } ?>
         
		</ul> 
    	<!-- </div> -->
	</div>
</div>
</body>

<?php include("footer.php"); ?>


