<div class="isi">
<?php
require_once("db.php");
?>

<p>Menu manage Url blocked</p>
<script type="text/javascript">
$(document).ready(function() {
	
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
	
	
	$(".hapus").click(function(){
		 var element = $(this);
		 var del_id = element.attr("id");
		 var info = 'id=' + del_id;
		 if(confirm("Anda yakin akan menghapus?"))
		 {
			 $.ajax({
			 type: "POST",
			 url : "cud.php",
			 data: info,
			 success: function(){
			 }
			 });	
		 $(this).parents(".content").animate({ opacity: "hide" }, "slow");
 			}
		 return false;
		 });
	
});
</script>

<a href="#" id="tambah">Tambah data</a>

<div id="form_tambah" style="display:none">
	<form name="category" id="ContactForm">
		<p>Url name :<input type="input" name="url" id="desc" /></p>
		<p>Select Category : <select name="category" id="kategori">
<option value="">select category</option>
<?php
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
</p>
		<p><input type="button" value="Submit" id="send" /> <input type="button" value="Cancel" id="cancel" /></p>
	</form>
	<div id="loading-box" style="display:none;">Loading...</div>
</div>


<table>
<tr>
	<th>No</th>
	<th>Url Name</th>
	<th>Reason</th>
</tr>	
<?php
$db = new DB;
$no = 1;
$data = $db->display_url();
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
</tr>
<?php $no++; } ?>
</table>
</div>
