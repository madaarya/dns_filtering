<?php
require_once("db.php");
require_once("myclass.php");
$m = new mada;
$db = new DB;

$per_page = 100; 

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

$name = $_GET['name'];

$data = $db->display_detail_datalog($per_page,$start,$name);
?>

<style>

table
{
width:80%; border:1px solid #ffcccc; margin-bottom:20px;
}

table th
{
background:#E6E6E6; padding:5px 15px 5px 15px; color:#573c1e; font-weight:bold; text-align:center; border-bottom:1px solid #ffcccc; font-size: 16px;
}

table td
{
border-bottom:1px solid #ffcccc; padding:5px 15px 5px 15px; border-right:1px solid #ffcccc;
}

</style>


<table>
<tr>
	<th>No</th>
	<th>IP</th>
	<th>Computer Name</th>
	<th>Browser</th>
	<th>Time</th>
</tr>	
<?php
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

