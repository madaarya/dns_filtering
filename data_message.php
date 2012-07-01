<script type="text/javascript">
$(document).ready(function() {
	
$(".hapus").click(function(){
		 var element = $(this);
		 var del_id = element.attr("id");
		 var info = 'id_message=' + del_id;
		 if(confirm("Anda yakin akan menghapus?"))
		 {
			 $.ajax({
			 type: "POST",
			 url : "cud.php",
			 data: info,
			 success: function(){
			 	$(".isi").load("manage_message.php");
			 }
			 });
 			}
		 return false;
		 });
		 
		 
  $(".detail").click(function(){
		 var element = $(this);
		 var del_id = element.attr("id");
		$(".isi").load("detail_message.php",'id_message=' + del_id);
			 
		 });
		 	 
});
</script>
<p>Mesaage from user</p>
<table>
<tr>
	<th>No</th>
	<th>Name</th>
	<th>Email</th>
	<th>Message</th>
	<th>Date</th>
</tr>	
<?php
require_once("db.php");
require_once("myclass.php");
$db = new DB;

$m = new mada;

$per_page = 2; 


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


$data = $db->display_message($per_page,$start);
while ($d = mysqli_fetch_array($data)){
				if ($no%2==0){
					$bgcolor="#E6E6E6";
				}else{
				
					$bgcolor="#F2F2F2";
				}
	
	 ?>
<tr bgcolor="<?php echo $bgcolor; ?>">
<td align="center"><?php echo $no; ?></td>
<td align="center"><?php echo $d['name']; ?></td>
<td align="center"><?php echo $d['email']; ?></td>
<td align="center"><a href="#" class="detail" id="<?php echo $d['pk_contact']; ?>"><?php echo $d['pesan']; ?></a></td>
<td align="center"><?php echo $m->set_waktu($d['added_date']); ?></td>
<td align="center"><a href="#" class="hapus" id="<?php echo $d['pk_contact']; ?>" >Hapus</a></td>	 
</tr>
<?php $no++; } ?>
</table>
