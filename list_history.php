<?php
require_once("db.php");
?>

 <script type="text/javascript">
$(document).ready(function() {
	$("#kategori").change(function(){
                var kategori = $("#kategori").val();
                //alert(kategori);
                
		$(".isi").load("list_history.php","kategori="+kategori);
		   	
          });
});
</script>
<div class="isi">

Select Category : <select name="kategori" id="kategori">
<option value="">select category</option>
<?php
$db = new DB;

$kategori = $_GET['kategori'];

$tampil = $db->display_datalog($kategori);


$kategori = $db->display_category();

while($s = mysqli_fetch_array($kategori))
{

?>
<option value="<?php echo $s['pk_reasons'];  ?>"><?php echo $s['description']; ?></option>
<?php
}
?>
</select>
<br /><br />
<table>
<tr>
	<th>Rank</th>
	<th>Domain</th>
	<th>Reasons</th>
	<th>Request</th>
</tr>	
<?php
$no = 1;
while ($d = mysqli_fetch_array($tampil)){
				if ($no%2==0){
					$bgcolor="#E6E6E6";
				}else{
				
					$bgcolor="#F2F2F2";
				}
	
	 ?>
<tr bgcolor="<?php echo $bgcolor; ?>">
<td align="center"><?php echo $no; ?></td>
<td align="center"><?php echo $d['url_server']; ?></td>
<td align="center"><?php echo $d['description']; ?></td>
<td align="center"><?php echo $d['total_point']; ?></td>	
	 
</tr>
<?php $no++; } ?>
</table>
</div>
