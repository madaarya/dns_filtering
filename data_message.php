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

<style>

table
{
width:90%; border:1px solid #ffcccc; margin-bottom:20px;
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

<p>Message from user</p>
<table>
<tr>
	<th align="center">No</th>
	<th align="center">Name</th>
	<th align="center">Email</th>
	<th align="center">Message</th>
	<th align="center">Date</th>
	<th align="center">Action</th>
</tr>	
<?php
require_once("db.php");
require_once("myclass.php");
$db = new DB;

$m = new mada;

$per_page = 15; 


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

			if($d['status'] == 0)
			{
				$bgcolor="#ffcccc";
			}
			else
			{
				if ($no%2==0){
					$bgcolor="#E6E6E6";
				}else{
				
					$bgcolor="#F2F2F2";
				}
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
