<?php
require_once("db.php");
require_once("myclass.php");
$m = new mada;
$db = new DB;

$name = $_GET['name_url'];

$data = $db->display_detail_datalog($name);
?>

<table>
<tr>
	<th>No</th>
	<th>IP</th>
	<th>Computer Name</th>
	<th>Browser</th>
	<th>Time</th>
</tr>	
<?php
/*
$per_page = 5; 

$kat = $_GET['kategori'];
if(isset($kat))
{
$page = 1;
}


if($_GET['page'])
{
$page=$_GET['page'];
$mada = TRUE;
}

$start = ($page-1)*$per_page;

if($mada)
{
	$no = 1 + $start; 
}
else
{
	$no = 1;
}


$data = $db->display_url($per_page,$start,$kat);
*/
	$no = 1;
while ($d = mysqli_fetch_array($data)){
				if ($no%2==0){
					$bgcolor="#E6E6E6";
				}else{
				
					$bgcolor="#F2F2F2";
				}
	
	 ?>
<tr bgcolor="<?php echo $bgcolor; ?>">
<td align="center"><?php echo $no; ?></td>
<td align="center"><?php echo $d['ip']; ?></td>
<td align="center"><?php echo $d['nama_komputer']; ?></td>
<td align="center"><?php echo $d['browser']; ?></td>	 
<td align="center"><?php echo $m->set_waktu($d['waktu']); ?></td>
</tr>
<?php $no++; } ?>
</table>

