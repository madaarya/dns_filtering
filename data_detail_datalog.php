<?php
require_once("db.php");
require_once("myclass.php");
$m = new mada;
$db = new DB;

$name = $_GET['name']; // get parameter name
$per_page = 100; // tampilkan jumlah baris yg di tampilkan


$sql = $db->display_detail_datalog_all($name);
$count = mysqli_num_rows($sql); // hitung jumlah data
$pages = ceil($count/$per_page); // jumlah data di bagi halaman yg di tentukan


if($_GET['page'])
{
	switch($_GET['page']) // kondisi
	{
		case $_GET['page'] == 'first':
		$page = 1;
		break;
		
		case $_GET['page'] == 'last':
		$page = $pages;
		break;
		 
		case $_GET['page'] == 'next':
		$page = $_GET['nilai'] + 1;
		break; 
		 
		case $_GET['page'] == 'prev':
		$page = $_GET['nilai'] - 1;
		break;
		
		case empty($_GET['page']) :
		$page = 0;
		break;
		  
		 
		default:
		$page = $_GET['page'];
	}
	
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

$data = $db->display_detail_datalog($per_page,$start,$name); // ambil data detail pribadi
?>

<div style="display:none" id="paging" class="<?php echo $page; ?>"></div>
<input type="hidden" id="paging2" value="<? echo $page; ?>" />
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


<p>Total data : <?php echo $count; ?></p>
<table>
<tr>
	<th>No</th>
	<th>IP</th>
	<th>Computer Name</th>
	<th>Browser</th>
	<th>Time</th>
</tr>	
<?php
while ($d = mysqli_fetch_array($data)){ // looping data hasil dari database
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

