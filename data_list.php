<script type="text/javascript">
$(document).ready(function() {
	$("#kategori").change(function(){
                var kategori = $("#kategori").val();
                //alert(kategori);
                
		$("#content").load("data_list.php","kategori="+kategori);
		   	
          });
          
          $(".detail").click(function(){
		 var element = $(this);
		 var del_id = element.attr("id");
		$(".isi").load("detail_datalog.php",'name_url=' + del_id);
			 
		 });
});
</script>
Select Category : <select name="kategori" id="kategori">
<option value="">select category</option>
<?php
require_once("db.php");
$db = new DB;

$per_page = 2; 

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


$kategori = $_GET['kategori'];

$tampil = $db->display_datalog($per_page,$start,$kategori);


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
<td align="center"><a href="#" class="detail" id="<?php echo $d['url_server']; ?>" ><?php echo $d['total_point']; ?></a></td>	
	 
</tr>
<?php $no++; } ?>
</table>
