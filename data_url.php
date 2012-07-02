<script type="text/javascript">
$(document).ready(function() {
	
$(".hapus").click(function(){
		 var element = $(this);
		 var del_id = element.attr("id");
		 var info = 'id_url=' + del_id;
		 if(confirm("Anda yakin akan menghapus?"))
		 {
			 $.ajax({
			 type: "POST",
			 url : "cud.php",
			 data: info,
			 success: function(){
			 	$(".isi").load("manage_url.php");
			 }
			 });
 			}
		 return false;
		 });
		 
	$("#kategori").change(function(){
                var kategori = $("#kategori").val();
                //alert(page);
                
                $.ajax({
			 type: "POST",
			 url : "manage_url.php",
			 data: "kategori="+kategori,
			 success: function(){
			 	$(".isi").load("data_url.php","kategori="+kategori);
			 }
			 });
                	
          });	
          
          $("#tambah").click(function(){
	$("#form_tambah").fadeIn();
	});
	
	$("#cancel").click(function(){
	$("#form_tambah").fadeOut();
	});
	
	$("#send").click(function(){
	var desc = $("#desc").val();
		
			$.ajax({
					type:"POST",
					url: "cud.php",
					data: $('#ContactForm').serialize(),
					beforeSend:function(){
						$("#loading-box").show();
					},
					success:function(pesan){
						if (pesan==1)
						{
						alert("New category was succesfully added.");
						$("#form_tambah").fadeOut();				
						$(".isi").load("manage_url.php");
						}
						else
						{
						alert("data don't empty !");
						}
						$("#loading-box").hide();
					}											
			});
	
	});	 
});
</script>

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


<p>Menu manage Url blocked</p>

Select Category : <select name="kategori" id="kategori">
<option value="">select category</option>
<?php
require_once("db.php");
$db = new DB;

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

<a href="#" id="tambah">Tambah data</a>
<br />
<div id="form_tambah" style="display:none">
	<form name="category" id="ContactForm">
		<p>Url name <span style="padding-left:55px">:<input type="input" name="url" id="desc" /></span></p>
		<p>Select Category : <select name="category" id="kategori">
<option value="">select category</option>
<?php
$kategori = $db->display_category();

while($s = mysqli_fetch_array($kategori))
{

?>
<option value="<?php echo $s['pk_reasons'];  ?>"><?php echo $s['description']; ?></option>
<?php
}
?>
</select>
</p>
		<p><input type="button" value="Submit" id="send" /> <input type="button" value="Cancel" id="cancel" /></p>
	</form>
	<div id="loading-box" style="display:none;">Loading...</div>
</div>

<br />
<table>
<tr>
	<th>No</th>
	<th>Url Name</th>
	<th>Reason</th>
	<th>Action</th>
</tr>	
<?php

$per_page = 15; 

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
while ($d = mysqli_fetch_array($data)){
				if ($no%2==0){
					$bgcolor="#E6E6E6";
				}else{
				
					$bgcolor="#F2F2F2";
				}
	
	 ?>
<tr bgcolor="<?php echo $bgcolor; ?>">
<td align="center"><?php echo $no; ?></td>
<td align="center"><?php echo $d['url_name']; ?></td>
<td align="center"><?php echo $d['description']; ?></td>
<td align="center"><a href="#" class="hapus" id="<?php echo $d['pk_url']; ?>" >Hapus</a></td>	 
</tr>
<?php $no++; } ?>
</table>
