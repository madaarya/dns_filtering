<div class="isi">
<p>Menu manage category</p>

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
						$(".isi").load("manage_category.php");
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
		 var info = 'id_category=' + del_id;
		 if(confirm("Anda yakin akan menghapus?"))
		 {
			 $.ajax({
			 type: "POST",
			 url : "cud.php",
			 data: info,
			 success: function(){
			 	$(".isi").load("manage_category.php");
			 }
			 });
 			}
		 return false;
		 });
	
});
</script>

<a href="#" id="tambah">Tambah data</a>

<div id="form_tambah" style="display:none">
	<form name="category" id="ContactForm">
		<p>Deskripsi :<input type="input" name="desc" id="desc" /></p>
		<p><input type="button" value="Submit" id="send" /> <input type="button" value="Cancel" id="cancel" /></p>
	</form>
	<div id="loading-box" style="display:none;">Loading...</div>
</div>


<table>
<tr>
	<th>No</th>
	<th>Description</th>
	<th>Action</th>
</tr>	
<?php
require_once("db.php");

$db = new DB;

$no = 1;
$data = $db->display_category();
while ($d = mysqli_fetch_array($data)){
				if ($no%2==0){
					$bgcolor="#E6E6E6";
				}else{
				
					$bgcolor="#F2F2F2";
				}
	
	 ?>
<tr bgcolor="<?php echo $bgcolor; ?>" class="content">
<td align="center"><?php echo $no; ?></td>
<td align="center"><?php echo $d['description']; ?></td>
<td align="center"><a href="#" class="hapus" id="<?php echo $d['pk_reasons']; ?>" >Hapus</a></td>
</tr>
<?php $no++; } ?>
</table>

</div>
